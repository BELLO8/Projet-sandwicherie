<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Liste des commandes</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($commandes as $commande): ?>
                                <tr>
                                    <td>#<?= $commande['id'] ?></td>
                                    <td><?= htmlspecialchars($commande['user_name']) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($commande['date_comm'])) ?></td>
                                    <td><?= number_format($commande['total'], 2) ?> €</td>
                                    <td>
                                        <span class="badge bg-<?= $this->getStatusBadgeClass($commande['status']) ?>">
                                            <?= $this->getStatusText($commande['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/dashboard/commandes/<?= $commande['id'] ?>"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if ($commande['status'] === 'pending'): ?>
                                            <button type="button" class="btn btn-sm btn-success"
                                                onclick="updateStatus(<?= $commande['id'] ?>, 'completed')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="deleteCommande(<?= $commande['id'] ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateStatus(id, status) {
        if (confirm('Êtes-vous sûr de vouloir mettre à jour le statut de cette commande ?')) {
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

    function deleteCommande(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')) {
            window.location.href = `/dashboard/commandes/${id}/delete`;
        }
    }
</script>