<?php $title = 'Dashboard'; ?>

<div class="dashboard">
    <h1>Welcome, <?= htmlspecialchars($username ?? 'Guest') ?></h1>
    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>Total Expenses</h3>
            <p class="amount"><?= number_format($totalExpenses ?? 0, 2) ?></p>
        </div>
        <div class="stat-card">
            <h3>This Month</h3>
            <p class="amount"><?= number_format($monthlyExpenses ?? 0, 2) ?></p>
        </div>
        <div class="stat-card">
            <h3>Categories</h3>
            <p class="amount"><?= $categoriesCount ?? 0 ?></p>
        </div>
    </div>
    
    <div class="recent-transactions">
        <h2>Recent Transactions</h2>
        <?php if (!empty($recentTransactions ?? [])): ?>
            <ul class="transaction-list">
                <?php foreach ($recentTransactions as $transaction): ?>
                    <li>
                        <span class="date"><?= htmlspecialchars($transaction['date'] ?? '') ?></span>
                        <span class="category"><?= htmlspecialchars($transaction['category_name'] ?? 'Unknown') ?></span>
                        <span class="amount"><?= number_format($transaction['amount'] ?? 0, 2) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No recent transactions found.</p>
        <?php endif; ?>
    </div>
</div>
