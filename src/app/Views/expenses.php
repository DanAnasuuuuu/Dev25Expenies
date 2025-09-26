<?php $title = 'Expenses'; ?>

<div class="expenses-page">
    <h1>Expenses</h1>
    
    <div class="expenses-actions">
        <button class="btn btn-primary" onclick="openAddExpenseModal()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add New Expense
        </button>
        <a href="<?= $baseUrl ?>/categories" class="btn btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 6L9 17l-5-5"></path>
            </svg>
            Manage Categories
        </a>
        <a href="<?= $baseUrl ?>/receipts" class="btn btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14,2 14,8 20,8"></polyline>
            </svg>
            Manage Receipts
        </a>
        <a href="<?= $baseUrl ?>/expenses/export" class="btn btn-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                <polyline points="7 10 12 15 17 10"/>
                <line x1="12" y1="15" x2="12" y2="3"/>
            </svg>
            Export CSV
        </a>

    </div>

    <div class="expenses-filters">
        <select name="category" id="category-filter">
            <option value="">All Categories</option>
            <?php foreach ($categories ?? [] as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <input type="date" id="date-filter" name="date">
    </div>

    <div class="expenses-list">
        <?php if (!empty($expenses ?? [])): ?>
            <?php foreach ($expenses as $expense): ?>
                <div class="expense-card">
                    <div class="expense-details">
                        <h3><?= htmlspecialchars($expense['category_name'] ?? 'Unknown') ?></h3>
                        <p class="date"><?= htmlspecialchars($expense['date'] ?? '') ?></p>
                        <p class="amount">$<?= number_format($expense['amount'] ?? 0, 2) ?></p>
                    </div>
                    <div class="expense-actions">
                        <button class="btn btn-edit" onclick="editExpense(<?= $expense['id'] ?>)">Edit</button>
                        <button class="btn btn-delete" onclick="deleteExpense(<?= $expense['id'] ?>)">Delete</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No expenses found.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Add/Edit Expense Modal Template -->
<div id="expense-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <h2>Add New Expense</h2>
        <form id="expense-form" action="<?= $baseUrl ?>/expenses" method="POST">
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" step="0.01" id="amount" name="amount" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" required>
                    <?php foreach ($categories ?? [] as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn" onclick="closeModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function openAddExpenseModal() {
    document.getElementById('expense-modal').style.display = 'block';
    // Reset form
    document.getElementById('expense-form').reset();
    document.querySelector('#expense-modal h2').textContent = 'Add New Expense';
    document.getElementById('expense-form').action = '<?= $baseUrl ?>/expenses';
}

function closeModal() {
    document.getElementById('expense-modal').style.display = 'none';
}

function editExpense(id) {
    // This would typically fetch expense data and populate the form
    document.getElementById('expense-modal').style.display = 'block';
    document.querySelector('#expense-modal h2').textContent = 'Edit Expense';
    document.getElementById('expense-form').action = '<?= $baseUrl ?>/expenses/' + id + '/update';
}

function deleteExpense(id) {
    if (confirm('Are you sure you want to delete this expense?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= $baseUrl ?>/expenses/' + id + '/delete';
        document.body.appendChild(form);
        form.submit();
    }
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('expense-modal');
    if (event.target === modal) {
        closeModal();
    }
}

// Apply filters
document.getElementById('category-filter').addEventListener('change', applyFilters);
document.getElementById('date-filter').addEventListener('change', applyFilters);

function applyFilters() {
    const category = document.getElementById('category-filter').value;
    const date = document.getElementById('date-filter').value;
    
    let url = '<?= $baseUrl ?>/expenses?';
    if (category) url += 'category=' + category + '&';
    if (date) url += 'date=' + date + '&';
    
    window.location.href = url.slice(0, -1); // Remove trailing &
}
</script>
