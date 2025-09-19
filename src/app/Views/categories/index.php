<?php $title = 'Category Management'; ?>

<div class="categories-page">
    <div class="flex justify-between items-center mb-4">
        <h1>Category Management</h1>
        <button class="btn btn-primary" onclick="openAddCategoryModal()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add Category
        </button>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="category-grid">
        <?php foreach ($categories ?? [] as $category): ?>
            <div class="category-item" style="border-left-color: <?= htmlspecialchars($category['color'] ?? '#6366f1') ?>">
                <div class="category-name"><?= htmlspecialchars($category['name']) ?></div>
                <?php if (!empty($category['description'])): ?>
                    <div class="category-description"><?= htmlspecialchars($category['description']) ?></div>
                <?php endif; ?>
                <div class="category-actions mt-2">
                    <button class="btn btn-sm btn-secondary" onclick="editCategory(<?= $category['id'] ?>)">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteCategory(<?= $category['id'] ?>)">Delete</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (!empty($categoryStats ?? [])): ?>
        <div class="mt-4">
            <h2>Category Statistics</h2>
            <div class="dashboard-stats">
                <?php foreach ($categoryStats as $stat): ?>
                    <div class="stat-card">
                        <h3><?= htmlspecialchars($stat['name']) ?></h3>
                        <p class="amount">$<?= number_format($stat['total_amount'], 2) ?></p>
                        <p class="text-light"><?= $stat['transaction_count'] ?> transactions</p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Add/Edit Category Modal -->
<div id="category-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <h2 id="modal-title">Add New Category</h2>
        <form id="category-form" action="<?= $baseUrl ?>/categories" method="POST">
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
                <button type="submit" class="btn btn-primary">Save Category</button>
                <button type="button" class="btn btn-secondary" onclick="closeCategoryModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function openAddCategoryModal() {
    document.getElementById('category-modal').style.display = 'block';
    document.getElementById('modal-title').textContent = 'Add New Category';
    document.getElementById('category-form').reset();
    document.getElementById('category-form').action = '<?= $baseUrl ?>/categories';
    document.getElementById('color').value = '#6366f1';
    document.getElementById('color-text').value = '#6366f1';
}

function closeCategoryModal() {
    document.getElementById('category-modal').style.display = 'none';
}

function editCategory(id) {
    // This would typically fetch category data and populate the form
    document.getElementById('category-modal').style.display = 'block';
    document.getElementById('modal-title').textContent = 'Edit Category';
    document.getElementById('category-form').action = '<?= $baseUrl ?>/categories/' + id + '/edit';
}

function deleteCategory(id) {
    if (confirm('Are you sure you want to delete this category? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= $baseUrl ?>/categories/' + id + '/delete';
        document.body.appendChild(form);
        form.submit();
    }
}

// Color picker sync
document.getElementById('color').addEventListener('input', function() {
    document.getElementById('color-text').value = this.value;
});

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('category-modal');
    if (event.target === modal) {
        closeCategoryModal();
    }
}
</script>
