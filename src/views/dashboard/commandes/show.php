<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Détails de la commande #<?= $commande['id'] ?></h5>
                <a href="/dashboard/commandes" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6>Informations client</h6>
                        <p>
                            <strong>Nom :</strong> <?= htmlspecialchars($commande['user_name']) ?><br>
                            <strong>Date :</strong> <?= date('d/m/Y H:i', strtotime($commande['date_comm'])) ?><br>
                            <strong>Statut :</strong>
                            <span class="badge bg-<?= $this->getStatusBadgeClass($commande['status']) ?>">
                                <?= $this->getStatusText($commande['status']) ?>
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6>Résumé de la commande</h6>
                        <p>
                            <strong>Total :</strong> <?= number_format($commande['total'], 2) ?> €<br>
                            <strong>Méthode de paiement :</strong> <?= $commande['payment_method'] ?><br>
                            <strong>Adresse de livraison :</strong>
                            <?= htmlspecialchars($commande['delivery_address']) ?>
                        </p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($details as $detail): ?>
                            <tr>
                                <td><?= htmlspecialchars($detail['food_name']) ?></td>
                                <td><?= number_format($detail['price'], 2) ?> €</td>
                                <td><?= $detail['quantity'] ?></td>
                                <td><?= number_format($detail['price'] * $detail['quantity'], 2) ?> €</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total :</strong></td>
                                <td><strong><?= number_format($commande['total'], 2) ?> €</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <?php if ($commande['status'] === 'pending'): ?>
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-success"
                        onclick="updateStatus(<?= $commande['id'] ?>, 'completed')">
                        <i class="fas fa-check"></i> Valider la commande
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
function updateStatus(id, status) {
    if (confirm('Êtes-vous sûr de vouloir valider cette commande ?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/dashboard/commandes/${id}/status`;

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'status';
        input.value = status;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>