<?php
$currentPage = $_SERVER['REQUEST_URI'] ?? '/';
$baseUrl = $baseUrl ?? '/Dev25Expenies/public';
?>
<nav class="main-nav">
    <div class="nav-brand">
        <a href="<?= $baseUrl ?>/">Dev25Expenies</a>
    </div>
    <div class="nav-links">
        <a href="<?= $baseUrl ?>/" class="<?= $currentPage === '/' ? 'active' : '' ?>">Dashboard</a>
        <a href="<?= $baseUrl ?>/expenses" class="<?= $currentPage === '/expenses' ? 'active' : '' ?>">Expenses</a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="<?= $baseUrl ?>/categories" class="<?= $currentPage === '/categories' ? 'active' : '' ?>">Categories</a>
            <a href="<?= $baseUrl ?>/receipts" class="<?= $currentPage === '/receipts' ? 'active' : '' ?>">Receipts</a>
            <a href="<?= $baseUrl ?>/logout">Logout</a>
        <?php else: ?>
            <a href="<?= $baseUrl ?>/login" class="<?= $currentPage === '/login' ? 'active' : '' ?>">Login</a>
            <a href="<?= $baseUrl ?>/register" class="<?= $currentPage === '/register' ? 'active' : '' ?>">Register</a>
        <?php endif; ?>
    </div>
</nav>
