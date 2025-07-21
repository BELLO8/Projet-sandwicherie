<?php
require 'auth.php';
force_connexion();
require '../src/db.class.php';
$DB = new DB();
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Commande invalide.');
}
$id = (int)$_GET['id'];
$commande = $DB->select('SELECT * FROM commande WHERE id_command = ?', [$id]);
if (!$commande) {
    die('Commande introuvable.');
}
$commande = $commande[0];
$produits = unserialize($commande->produits_command);
$total = 0;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Reçu Commande #<?= $commande->id_command ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 20px;
        color: #1a1a1a;
    }

    .receipt {
        max-width: 700px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        position: relative;
    }

    .receipt::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
    }

    .header {
        padding: 40px 40px 30px;
        background: #fafbfc;
        border-bottom: 1px solid #e9ecef;
        text-align: center;
    }

    .logo {
        max-width: 120px;
        max-height: 80px;
        margin-bottom: 20px;
    }

    .receipt-title {
        font-size: 28px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .receipt-number {
        font-size: 16px;
        color: #6c757d;
        font-weight: 500;
    }

    .content {
        padding: 40px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .info-card {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        border-left: 4px solid #667eea;
    }

    .info-card h3 {
        font-size: 14px;
        font-weight: 600;
        color: #495057;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-size: 15px;
    }

    .info-item:last-child {
        margin-bottom: 0;
    }

    .info-label {
        font-weight: 600;
        color: #495057;
        min-width: 80px;
        margin-right: 12px;
    }

    .info-value {
        color: #212529;
    }

    .status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .status.validated {
        background: #d4edda;
        color: #155724;
    }

    .status.pending {
        background: #fff3cd;
        color: #856404;
    }

    .products-section {
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, #667eea, transparent);
        margin-left: 20px;
    }

    .products-table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .products-table th {
        background: #667eea;
        color: white;
        padding: 16px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .products-table td {
        padding: 16px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: top;
    }

    .products-table tr:hover {
        background: #f8f9fa;
    }

    .products-table tr:last-child td {
        border-bottom: none;
    }

    .product-name {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 4px;
    }

    .product-details {
        font-size: 13px;
        color: #6c757d;
        font-style: italic;
    }

    .quantity {
        text-align: center;
        font-weight: 600;
        color: #667eea;
    }

    .price {
        text-align: right;
        font-weight: 600;
        font-family: 'Courier New', monospace;
    }

    .total-section {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 24px;
        border-radius: 12px;
        text-align: right;
        margin-bottom: 30px;
    }

    .total-amount {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
        font-family: 'Courier New', monospace;
    }

    .total-label {
        font-size: 16px;
        opacity: 0.9;
        font-weight: 500;
    }

    .actions {
        text-align: center;
    }

    .print-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 16px 40px;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .print-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    @media print {
        body {
            background: white;
            padding: 0;
        }

        .receipt {
            box-shadow: none;
            border-radius: 0;
        }

        .print-btn {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .content {
            padding: 20px;
        }

        .header {
            padding: 30px 20px 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .receipt-title {
            font-size: 24px;
        }

        .total-amount {
            font-size: 28px;
        }

        .products-table {
            font-size: 14px;
        }

        .products-table th,
        .products-table td {
            padding: 12px 8px;
        }
    }
    </style>
</head>

<body>
    <div class="receipt">
        <div class="header">
            <img src="../assets/images/logo1.png" alt="Logo" class="logo">
            <h1 class="receipt-title">Reçu de Commande</h1>
            <p class="receipt-number">#<?= $commande->id_command ?></p>
        </div>

        <div class="content">
            <div class="info-grid">
                <div class="info-card">
                    <h3>Informations Client</h3>
                    <div class="info-item">
                        <span class="info-label">Nom :</span>
                        <span
                            class="info-value"><?= htmlspecialchars(ucfirst($commande->nom_cli) . ' ' . ucfirst($commande->prenom_cli)) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tél :</span>
                        <span class="info-value"><?= htmlspecialchars($commande->num_cli) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Adresse :</span>
                        <span class="info-value"><?= htmlspecialchars($commande->add_cli) ?></span>
                    </div>
                </div>

                <div class="info-card">
                    <h3>Détails Commande</h3>
                    <div class="info-item">
                        <span class="info-label">Date :</span>
                        <span class="info-value"><?= date('d/m/Y à H:i', strtotime($commande->date_comm)) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Statut :</span>
                        <span class="status <?= $commande->status_command == 1 ? 'validated' : 'pending' ?>">
                            <?= $commande->status_command == 1 ? 'Validée' : 'En attente' ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="products-section">
                <h2 class="section-title">Produits Commandés</h2>
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Détails</th>
                            <th>Qté</th>
                            <th>Prix unitaire</th>
                            <th>Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produits as $produit):
                            $sous_total = $produit['item_price'] * $produit['item_qte'];
                            $total += $sous_total;
                        ?>
                        <tr>
                            <td>
                                <div class="product-name"><?= htmlspecialchars($produit['item_name']) ?></div>
                            </td>
                            <td>
                                <div class="product-details">
                                    <?= !empty($produit['item_detail']) ? htmlspecialchars(implode(', ', $produit['item_detail'])) : '-' ?>
                                </div>
                            </td>
                            <td class="quantity"><?= $produit['item_qte'] ?></td>
                            <td class="price"><?= number_format($produit['item_price'], 0, ',', ' ') ?> CFA</td>
                            <td class="price"><?= number_format($sous_total, 0, ',', ' ') ?> CFA</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="total-section">
                <div class="total-amount"><?= number_format($total + 200, 0, ',', ' ') ?> CFA</div>
                <div class="total-label">Total à payer (avec livraison)</div>
            </div>

            <div class="actions">
                <button class="print-btn" onclick="window.print()">
                    📄 Imprimer le Reçu
                </button>
            </div>
        </div>
    </div>
</body>

</html>