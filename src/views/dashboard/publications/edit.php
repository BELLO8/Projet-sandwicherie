<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Modifier la publication</h5>
            </div>
            <div class="card-body">
                <form action="/dashboard/publications/<?= $publication['id'] ?>/edit" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="<?= htmlspecialchars($publication['title']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>
                            <?= htmlspecialchars($publication['description']) ?>
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image actuelle</label>
                        <?php if ($publication['image']): ?>
                            <div class="mb-2">
                                <img src="/<?= $publication['image'] ?>" alt="Image actuelle"
                                    class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted">Laissez vide pour conserver l'image actuelle</small>
                    </div>

                    <div class="text-end">
                        <a href="/dashboard/publications" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>