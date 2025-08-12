<?php
/**
 * @var \App\View\Templater $this
 */
?>

<div class="card signup">
    <h2>Signup</h2>

    <form id="signup-form" class="signup__form">
        <div class="input-group">
            <label for="username" class="input-group__label">Username</label>
            <input type="text" id="username" name="username" required="required" placeholder="Username" class="input-group__input">
        </div>

        <div class="input-group">
            <label for="password" class="input-group__label">Password</label>
            <input type="password" id="password" name="password" required="required" placeholder="Password" class="input-group__input">
        </div>

        <div class="input-group">
            <label for="confirm-password" class="input-group__label">Confirm password</label>
            <input type="password" id="confirm-password" name="confirm_password" required="required" placeholder="Confirm password" class="input-group__input">
        </div>

        <button type="submit" class="button">Create Account</button>
    </form>
</div>
