<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Liste des produits</h5>
                <a href="/dashboard/foods/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouveau produit
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Catégorie</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($foods as $food): ?>
                            <tr>
                                <td>
                                    <?php if ($food['image']): ?>
                                        <img src="/<?= $food['image'] ?>" alt="<?= $food['name'] ?>" 
                                             class="img-thumbnail" style="max-width: 100px;">
                                    <?php else: ?>
                                        <span class="text-muted">Aucune image</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($food['name']) ?></td>
                                <td><?= htmlspecialchars($food['description']) ?></td>
                                <td><?= number_format($food['price'], 2) ?> €</td>
                                <td><?= htmlspecialchars($food['category_name'] ?? 'Non catégorisé') ?></td>
                                <td>
                                    <a href="/dashboard/foods/<?= $food['id'] ?>/edit" 
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" 
                                            onclick="deleteFood(<?= $food['id'] ?>)">
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
function deleteFood(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) {
        window.location.href = '/dashboard/foods/' + id + '/delete';
    }
}
</script> 