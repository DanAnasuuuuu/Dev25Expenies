<?php $title = 'Edit Receipt'; ?>

<div class="receipt-form-page">
    <div class="flex justify-between items-center mb-4">
        <h1>Edit Receipt</h1>
        <a href="<?= $baseUrl ?>/receipts" class="btn btn-secondary">Back to Receipts</a>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <form action="<?= $baseUrl ?>/receipts/<?= $receipt['id'] ?>/edit" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="total_amount">Receipt Total Amount</label>
                <input type="number" step="0.01" id="total_amount" name="total_amount" value="<?= htmlspecialchars($receipt['total_amount'] ?? '') ?>" required>
                <small class="form-help">Enter the total amount shown on the receipt</small>
            </div>

            <div class="form-group">
                <label for="date">Receipt Date</label>
                <input type="date" id="date" name="date" value="<?= htmlspecialchars($receipt['date'] ?? '') ?>" required>
            </div>

            <?php if (!empty($receipt['file_path'])): ?>
                <div class="form-group">
                    <label>Current Receipt File</label>
                    <div class="current-file">
                        <a href="<?= htmlspecialchars($receipt['file_path']) ?>" target="_blank" class="btn btn-sm btn-secondary">View Current File</a>
                        <span class="file-info">File is attached</span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="receipt_file"><?= !empty($receipt['file_path']) ? 'Replace Receipt File' : 'Receipt File (Optional)' ?></label>
                <input type="file" id="receipt_file" name="receipt_file" accept=".jpg,.jpeg,.png,.pdf,.gif">
                <small class="form-help">Upload a photo or PDF of your receipt. Max size: 5MB</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Receipt</button>
                <a href="<?= $baseUrl ?>/receipts" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
