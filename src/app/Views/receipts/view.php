<?php $title = 'View Receipt'; ?>

<div class="receipt-view-page">
    <div class="flex justify-between items-center mb-4">
        <h1>Receipt Details</h1>
        <div class="flex gap-2">
            <a href="<?= $baseUrl ?>/receipts/<?= $receipt['id'] ?>/edit" class="btn btn-warning">Edit</a>
            <a href="<?= $baseUrl ?>/receipts" class="btn btn-secondary">Back to Receipts</a>
        </div>
    </div>

    <div class="card">
        <div class="receipt-details-view">
            <div class="receipt-header">
                <h2><?= htmlspecialchars($receipt['category_name'] ?? 'Unknown Category') ?></h2>
                <span class="receipt-date"><?= htmlspecialchars($receipt['date'] ?? '') ?></span>
            </div>

            <div class="receipt-info-grid">
                <div class="info-item">
                    <label>Receipt Amount</label>
                    <span class="amount">$<?= number_format($receipt['total_amount'] ?? 0, 2) ?></span>
                </div>
                <div class="info-item">
                    <label>Transaction Amount</label>
                    <span class="amount">$<?= number_format($receipt['transaction_amount'] ?? 0, 2) ?></span>
                </div>
                <div class="info-item">
                    <label>Transaction Date</label>
                    <span><?= htmlspecialchars($receipt['transaction_date'] ?? '') ?></span>
                </div>
                <div class="info-item">
                    <label>Category</label>
                    <span><?= htmlspecialchars($receipt['category_name'] ?? 'Unknown') ?></span>
                </div>
            </div>

            <?php if (!empty($receipt['file_path'])): ?>
                <div class="receipt-file-section">
                    <h3>Receipt File</h3>
                    <div class="file-preview">
                        <?php
                        $extension = strtolower(pathinfo($receipt['file_path'], PATHINFO_EXTENSION));
                        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                            <img src="<?= htmlspecialchars($receipt['file_path']) ?>" alt="Receipt Image" class="receipt-image">
                        <?php elseif ($extension === 'pdf'): ?>
                            <div class="pdf-preview">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14,2 14,8 20,8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10,9 9,9 8,9"></polyline>
                                </svg>
                                <p>PDF Document</p>
                            </div>
                        <?php endif; ?>
                        <div class="file-actions">
                            <a href="<?= htmlspecialchars($receipt['file_path']) ?>" target="_blank" class="btn btn-primary">View File</a>
                            <a href="<?= htmlspecialchars($receipt['file_path']) ?>" download class="btn btn-secondary">Download</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="no-file">
                    <p>No receipt file attached</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
