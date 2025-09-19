<?php $title = 'Receipt Management'; ?>

<div class="receipts-page">
    <div class="flex justify-between items-center mb-4">
        <h1>Receipt Management</h1>
        <a href="<?= $baseUrl ?>/receipts/create" class="btn btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add Receipt
        </a>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <!-- Receipt Statistics -->
    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>Total Receipts</h3>
            <p class="amount"><?= $totalReceipts ?? 0 ?></p>
        </div>
        <div class="stat-card">
            <h3>This Month</h3>
            <p class="amount">$<?= number_format($monthlyTotal ?? 0, 2) ?></p>
        </div>
    </div>

    <!-- Receipt Filters -->
    <div class="expenses-filters">
        <input type="date" id="date-from" name="date_from" placeholder="From Date">
        <input type="date" id="date-to" name="date_to" placeholder="To Date">
        <button class="btn btn-secondary" onclick="applyFilters()">Filter</button>
        <a href="<?= $baseUrl ?>/receipts" class="btn btn-secondary">Clear</a>
    </div>

    <!-- Receipts List -->
    <div class="receipts-list">
        <?php if (!empty($receipts ?? [])): ?>
            <?php foreach ($receipts as $receipt): ?>
                <div class="receipt-card">
                    <div class="receipt-details">
                        <div class="receipt-header">
                            <h3><?= htmlspecialchars($receipt['category_name'] ?? 'Unknown') ?></h3>
                            <span class="receipt-date"><?= htmlspecialchars($receipt['date'] ?? '') ?></span>
                        </div>
                        <div class="receipt-amounts">
                            <p class="receipt-amount">$<?= number_format($receipt['total_amount'] ?? 0, 2) ?></p>
                            <p class="transaction-amount">Transaction: $<?= number_format($receipt['transaction_amount'] ?? 0, 2) ?></p>
                        </div>
                        <?php if (!empty($receipt['file_path'])): ?>
                            <div class="receipt-file">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <span>Receipt attached</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="receipt-actions">
                        <a href="<?= $baseUrl ?>/receipts/<?= $receipt['id'] ?>/view" class="btn btn-sm btn-secondary">View</a>
                        <a href="<?= $baseUrl ?>/receipts/<?= $receipt['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger" onclick="deleteReceipt(<?= $receipt['id'] ?>)">Delete</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14,2 14,8 20,8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10,9 9,9 8,9"></polyline>
                </svg>
                <h3>No Receipts Found</h3>
                <p>Start by adding your first receipt to track your expenses.</p>
                <a href="<?= $baseUrl ?>/receipts/create" class="btn btn-primary">Add Receipt</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function applyFilters() {
    const dateFrom = document.getElementById('date-from').value;
    const dateTo = document.getElementById('date-to').value;
    
    let url = '<?= $baseUrl ?>/receipts?';
    if (dateFrom) url += 'date_from=' + dateFrom + '&';
    if (dateTo) url += 'date_to=' + dateTo + '&';
    
    window.location.href = url.slice(0, -1); // Remove trailing &
}

function deleteReceipt(id) {
    if (confirm('Are you sure you want to delete this receipt? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= $baseUrl ?>/receipts/' + id + '/delete';
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
