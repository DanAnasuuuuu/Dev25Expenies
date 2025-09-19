<?php $title = 'Add Receipt'; ?>

<div class="receipt-form-page">
    <div class="flex justify-between items-center mb-4">
        <h1>Add New Receipt</h1>
        <a href="<?= $baseUrl ?>/receipts" class="btn btn-secondary">Back to Receipts</a>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <form action="<?= $baseUrl ?>/receipts" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="transaction_id">Related Transaction</label>
                <select id="transaction_id" name="transaction_id" required>
                    <option value="">Select a transaction</option>
                    <?php foreach ($transactions ?? [] as $transaction): ?>
                        <option value="<?= $transaction['id'] ?>">
                            <?= htmlspecialchars($transaction['category_name'] ?? 'Unknown') ?> - 
                            $<?= number_format($transaction['amount'], 2) ?> - 
                            <?= htmlspecialchars($transaction['date']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="total_amount">Receipt Total Amount</label>
                <input type="number" step="0.01" id="total_amount" name="total_amount" required>
                <small class="form-help">Enter the total amount shown on the receipt</small>
            </div>

            <div class="form-group">
                <label for="date">Receipt Date</label>
                <input type="date" id="date" name="date" required>
            </div>

            <div class="form-group">
                <label for="receipt_file">Receipt File (Optional)</label>
                <input type="file" id="receipt_file" name="receipt_file" accept=".jpg,.jpeg,.png,.pdf,.gif">
                <small class="form-help">Upload a photo or PDF of your receipt. Max size: 5MB</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save Receipt</button>
                <a href="<?= $baseUrl ?>/receipts" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
// Auto-fill receipt amount when transaction is selected
document.getElementById('transaction_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    if (selectedOption.value) {
        const amountText = selectedOption.text.split(' - ')[1];
        const amount = amountText.replace('$', '').replace(',', '');
        document.getElementById('total_amount').value = amount;
    }
});

// Set default date to today
document.getElementById('date').value = new Date().toISOString().split('T')[0];
</script>
