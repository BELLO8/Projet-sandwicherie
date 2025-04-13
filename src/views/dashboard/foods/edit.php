<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Modifier le produit</h5>
            </div>
            <div class="card-body">
                <form action="/dashboard/foods/<?= $food['id'] ?>/edit" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= htmlspecialchars($food['name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>
                            <?= htmlspecialchars($food['description']) ?>
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Prix</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="price" name="price"
                                step="0.01" min="0" value="<?= $food['price'] ?>" required>
                            <span class="input-group-text">€</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Catégorie</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Sélectionnez une catégorie</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"
                                    <?= $category['id'] == $food['category_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image actuelle</label>
                        <?php if ($food['image']): ?>
                            <div class="mb-2">
                                <img src="/<?= $food['image'] ?>" alt="Image actuelle"
                                    class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted">Laissez vide pour conserver l'image actuelle</small>
                    </div>

                    <div class="text-end">
                        <a href="/dashboard/foods" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>