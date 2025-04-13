<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Liste des slides</h5>
                <a href="/dashboard/slides/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouveau slide
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
                                <th>Position</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            <?php foreach ($slides as $slide): ?>
                                <tr data-id="<?= $slide['id'] ?>">
                                    <td>
                                        <?php if ($slide['image']): ?>
                                            <img src="/<?= $slide['image'] ?>" alt="<?= $slide['title'] ?>"
                                                class="img-thumbnail" style="max-width: 100px;">
                                        <?php else: ?>
                                            <span class="text-muted">Aucune image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($slide['title']) ?></td>
                                    <td><?= htmlspecialchars($slide['description']) ?></td>
                                    <td>
                                        <span class="badge bg-primary"><?= $slide['position'] ?></span>
                                    </td>
                                    <td>
                                        <a href="/dashboard/slides/<?= $slide['id'] ?>/edit"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="deleteSlide(<?= $slide['id'] ?>)">
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

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(function() {
        $("#sortable").sortable({
            update: function(event, ui) {
                const positions = {};
                $("#sortable tr").each(function(index) {
                    positions[$(this).data('id')] = index + 1;
                });

                $.ajax({
                    url: '/dashboard/slides/update-positions',
                    method: 'POST',
                    data: {
                        positions: positions
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        }
                    }
                });
            }
        });
    });

    function deleteSlide(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce slide ?')) {
            window.location.href = '/dashboard/slides/' + id + '/delete';
        }
    }
</script>