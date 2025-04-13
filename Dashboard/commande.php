<?php
require 'auth.php';
force_connexion();
require '../src/db.class.php';
$DB = new DB();

// Configuration de la pagination
$items_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Récupération des paramètres de recherche
$search_nom = isset($_GET['search_nom']) ? trim($_GET['search_nom']) : '';
$search_numero = isset($_GET['search_numero']) ? trim($_GET['search_numero']) : '';
$search_status = isset($_GET['search_status']) ? trim($_GET['search_status']) : '';
$search_date = isset($_GET['search_date']) ? trim($_GET['search_date']) : '';

// Construction de la requête SQL avec filtres
$sql = "SELECT * FROM commande WHERE 1=1";
$params = [];

if ($search_nom) {
	$sql .= " AND (nom_cli LIKE ? OR prenom_cli LIKE ?)";
	$params[] = "%$search_nom%";
	$params[] = "%$search_nom%";
}
if ($search_numero) {
	$sql .= " AND num_cli LIKE ?";
	$params[] = "%$search_numero%";
}
if ($search_status !== '') {
	$sql .= " AND status_command = ?";
	$params[] = $search_status;
}
if ($search_date) {
	$sql .= " AND DATE(date_comm) = ?";
	$params[] = $search_date;
}

// Comptage total des résultats
$count_sql = str_replace('SELECT *', 'SELECT COUNT(*) as count', $sql);
$total_orders = $DB->select($count_sql, $params)[0]->count;
$total_pages = ceil($total_orders / $items_per_page);

// Ajout de la pagination et du tri
$sql .= " ORDER BY date_comm DESC LIMIT $offset, $items_per_page";

// Récupération des commandes
$commandes = $DB->select($sql, $params);

include('includes/sidenav.php');
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><em class="fa fa-home"></em></a></li>
            <li class="active">Commandes</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header" style="font-weight:900;">Commandes</h2>
        </div>
    </div>

    <!-- Barre de recherche avancée -->
    <div class="row" style="margin: 20px 0;">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Recherche avancée</h3>
                </div>
                <div class="panel-body">
                    <form id="searchForm" method="GET" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nom du client</label>
                                    <input type="text" class="form-control" name="search_nom" id="search_nom"
                                        value="<?= htmlspecialchars($search_nom) ?>" placeholder="Nom du client">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Numéro de téléphone</label>
                                    <input type="text" class="form-control" name="search_numero" id="search_numero"
                                        value="<?= htmlspecialchars($search_numero) ?>"
                                        placeholder="Numéro de téléphone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="search_status" id="search_status">
                                        <option value="">Tous les status</option>
                                        <option value="0" <?= $search_status === '0' ? 'selected' : '' ?>>En attente
                                        </option>
                                        <option value="1" <?= $search_status === '1' ? 'selected' : '' ?>>Validée
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date de commande</label>
                                    <input type="date" class="form-control" name="search_date" id="search_date"
                                        value="<?= htmlspecialchars($search_date) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Rechercher</button>
                                <button type="reset" class="btn btn-default">Réinitialiser</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <?php if (empty($commandes)) : ?>
        <h3 class="m-0" style="text-align:center;color:#ccc;font-weight:900;">Aucune commande</h3>
        <?php else : ?>
        <table class="table table-bordered">
            <thead style="font-size:11px;">
                <tr>
                    <th>Nom et Prenom</th>
                    <th>Numero</th>
                    <th>Adresse</th>
                    <th>Livraison</th>
                    <th>Date livraison</th>
                    <th>Produits commandés</th>
                    <th>Date et Heure de commande</th>
                    <th>Status de la commande</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande) : ?>
                <tr>
                    <td><?= htmlspecialchars(ucfirst($commande->nom_cli) . " " . ucfirst($commande->prenom_cli)) ?></td>
                    <td><?= htmlspecialchars($commande->num_cli) ?></td>
                    <td><?= htmlspecialchars(ucfirst($commande->add_cli)) ?></td>
                    <td><?= htmlspecialchars(ucfirst($commande->livraison)) ?></td>
                    <td><?= date("d-m-Y", strtotime($commande->date_livr)) ?></td>
                    <td>
                        <button type="button" class="btn btn-info" data-toggle="modal"
                            data-target="#produit-<?= $commande->id_command ?>">
                            Produits commandés
                        </button>

                        <div class="modal fade" id="produit-<?= $commande->id_command ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Détails de la commande</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Produit</th>
                                                    <th>Prix</th>
                                                    <th>Sous-Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
														$total = 0;
														$produits = unserialize($commande->produits_command);
														foreach ($produits as $produit) :
															$sous_total = $produit['item_price'] * $produit['item_qte'];
															$total += $sous_total;
														?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="../Dashboard/upload/food/<?= htmlspecialchars($produit['item_img']) ?>"
                                                                alt="<?= htmlspecialchars($produit['item_name']) ?>"
                                                                width="60" class="mr-3">
                                                            <div>
                                                                <h6 class="mb-0">
                                                                    <?= htmlspecialchars($produit['item_name']) ?></h6>
                                                                <?php if (!empty($produit['item_detail'])): ?>
                                                                <small class="text-muted">
                                                                    <?= implode(', ', array_map('htmlspecialchars', $produit['item_detail'])) ?>
                                                                </small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        <?= number_format($produit['item_price'], 0, ',', ' ') ?> CFA x
                                                        <?= $produit['item_qte'] ?>
                                                    </td>
                                                    <td class="align-middle">
                                                        <?= number_format($sous_total, 0, ',', ' ') ?> CFA
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                                <tr class="table-primary">
                                                    <td colspan="2" class="text-right"><strong>Total + frais de
                                                            livraison:</strong></td>
                                                    <td><strong><?= number_format($total + 200, 0, ',', ' ') ?>
                                                            CFA</strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><?= date("(D) d-M-Y H:i:s", strtotime($commande->date_comm)) ?></td>
                    <td>
                        <span class="btn <?= $commande->status_command == 0 ? 'btn-info' : 'btn-success' ?>">
                            <?= $commande->status_command == 0 ? 'En attente' : 'Validée' ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($commande->status_command == 0): ?>
                        <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#confirmModal<?= $commande->id_command ?>">
                            <i class="fa fa-check"></i> Valider
                        </button>

                        <div class="modal fade" id="confirmModal<?= $commande->id_command ?>" tabindex="-1"
                            role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmation de validation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir valider cette commande ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Annuler</button>
                                        <a href="update_status.php?id=<?= $commande->id_command ?>&status=1"
                                            class="btn btn-success">
                                            <i class="fa fa-check"></i> Confirmer
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <a href="update_status.php?id=<?= $commande->id_command ?>&status=0" class="btn btn-warning">
                            <i class="fa fa-refresh"></i> Remettre en attente
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($total_pages > 1): ?>
        <nav aria-label="Page navigation" class="text-center">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link"
                        href="?page=<?= $page - 1 ?><?= $search_nom ? '&search_nom=' . urlencode($search_nom) : '' ?><?= $search_numero ? '&search_numero=' . urlencode($search_numero) : '' ?><?= $search_status ? '&search_status=' . urlencode($search_status) : '' ?><?= $search_date ? '&search_date=' . urlencode($search_date) : '' ?>"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                    <a class="page-link"
                        href="?page=<?= $i ?><?= $search_nom ? '&search_nom=' . urlencode($search_nom) : '' ?><?= $search_numero ? '&search_numero=' . urlencode($search_numero) : '' ?><?= $search_status ? '&search_status=' . urlencode($search_status) : '' ?><?= $search_date ? '&search_date=' . urlencode($search_date) : '' ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link"
                        href="?page=<?= $page + 1 ?><?= $search_nom ? '&search_nom=' . urlencode($search_nom) : '' ?><?= $search_numero ? '&search_numero=' . urlencode($search_numero) : '' ?><?= $search_status ? '&search_status=' . urlencode($search_status) : '' ?><?= $search_date ? '&search_date=' . urlencode($search_date) : '' ?>"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Scripts -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Initialisation des modals
    $('.modal').on('show.bs.modal', function() {
        $(this).find('.modal-dialog').css({
            'margin-top': function() {
                return ($(window).height() - $(this).height()) / 2;
            }
        });
    });

    // Gestion de la recherche
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const params = new URLSearchParams();

        for (const [key, value] of formData.entries()) {
            if (value) params.append(key, value);
        }

        window.location.href = '?' + params.toString();
    });

    // Afficher les messages de succès ou d'erreur
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    Swal.fire({
        title: 'Succès!',
        text: 'Le statut de la commande a été mis à jour avec succès.',
        icon: 'success',
        confirmButtonText: 'OK',
        timer: 3000,
        timerProgressBar: true
    });
    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
    Swal.fire({
        title: 'Erreur!',
        text: 'Une erreur est survenue lors de la mise à jour du statut de la commande.',
        icon: 'error',
        confirmButtonText: 'OK'
    });
    <?php endif; ?>
});
</script>

</body>

</html>