<?php $title = 'Register'; ?>

<div class="auth-container">
    <h1>Register</h1>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="<?= $baseUrl ?>/register" method="POST" class="auth-form">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone">
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
        
        <p class="auth-links">
            Already have an account? <a href="<?= $baseUrl ?>/login">Login here</a>
        </p>
    </form>
</div>
