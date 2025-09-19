<?php $title = 'Create Category'; ?>

<div class="category-form-page">
    <div class="flex justify-between items-center mb-4">
        <h1>Create New Category</h1>
        <a href="<?= $baseUrl ?>/categories" class="btn btn-secondary">Back to Categories</a>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <form action="<?= $baseUrl ?>/categories" method="POST">
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Description (Optional)</label>
                <textarea id="description" name="description" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="color">Color</label>
                <div class="flex gap-2 items-center">
                    <input type="color" id="color" name="color" value="#6366f1" style="width: 60px; height: 40px; border: none; border-radius: var(--radius-md);">
                    <input type="text" id="color-text" value="#6366f1" style="flex: 1;" readonly>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Create Category</button>
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
