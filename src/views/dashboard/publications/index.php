<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Liste des publications</h5>
                <a href="/dashboard/publications/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvelle publication
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Date de création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($publications as $publication): ?>
                            <tr>
                                <td>
                                    <?php if ($publication['image']): ?>
                                        <img src="/<?= $publication['image'] ?>" alt="<?= $publication['title'] ?>" 
                                             class="img-thumbnail" style="max-width: 100px;">
                                    <?php else: ?>
                                        <span class="text-muted">Aucune image</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($publication['title']) ?></td>
                                <td><?= htmlspecialchars($publication['description']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($publication['created_at'])) ?></td>
                                <td>
                                    <a href="/dashboard/publications/<?= $publication['id'] ?>/edit" 
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" 
                                            onclick="deletePublication(<?= $publication['id'] ?>)">
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
function deletePublication(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette publication ?')) {
        window.location.href = '/dashboard/publications/' + id + '/delete';
    }
}
</script> 