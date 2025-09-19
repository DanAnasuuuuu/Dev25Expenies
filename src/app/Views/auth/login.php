<?php $title = 'Login'; ?>

<div class="auth-container">
    <h1>Login</h1>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="<?= $baseUrl ?>/login" method="POST" class="auth-form">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
        
        <p class="auth-links">
            Don't have an account? <a href="<?= $baseUrl ?>/register">Register here</a>
        </p>
    </form>
</div>
