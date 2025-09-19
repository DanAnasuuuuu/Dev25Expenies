<?php $title = 'Edit Category'; ?>

<div class="category-form-page">
    <div class="flex justify-between items-center mb-4">
        <h1>Edit Category</h1>
        <a href="<?= $baseUrl ?>/categories" class="btn btn-secondary">Back to Categories</a>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <form action="<?= $baseUrl ?>/categories/<?= $category['id'] ?>/edit" method="POST">
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($category['name'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description (Optional)</label>
                <textarea id="description" name="description" rows="3"><?= htmlspecialchars($category['description'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="color">Color</label>
                <div class="flex gap-2 items-center">
                    <input type="color" id="color" name="color" value="<?= htmlspecialchars($category['color'] ?? '#6366f1') ?>" style="width: 60px; height: 40px; border: none; border-radius: var(--radius-md);">
                    <input type="text" id="color-text" value="<?= htmlspecialchars($category['color'] ?? '#6366f1') ?>" style="flex: 1;" readonly>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Category</button>
                <a href="<?= $baseUrl ?>/categories" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
// Color picker sync
document.getElementById('color').addEventListener('input', function() {
    document.getElementById('color-text').value = this.value;
});
</script>
