<?php
/**
 * @var \App\View\Templater $this
 */
?>

<div class="card signup">
    <h2>Signup</h2>

    <form id="signup-form" class="signup__form">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required="required" placeholder="Username">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required="required" placeholder="Password">
        </div>

        <div class="form-group">
            <label for="confirm-password">Confirm password</label>
            <input type="password" id="confirm-password" name="confirm_password" required="required" placeholder="Confirm password">
        </div>

        <button type="submit" class="button">Create Account</button>
    </form>
</div>
