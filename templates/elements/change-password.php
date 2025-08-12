<?php
/**
 * @var \App\View\Templater $this
 */
?>

<div class="card change-password">
    <h2>Change password</h2>

    <form id="change-password-form" class="change-password__form">
        <div class="input-group">
            <label for="change-password-username" class="input-group__label">Username</label>
            <input type="text" id="change-password-username" name="username" required="required" placeholder="Username" class="input-group__input">
        </div>
        <div class="input-group">
            <label for="current-password" class="input-group__label">Current password</label>
            <input type="password" id="current-password" name="current_password" required="required" placeholder="Current password" class="input-group__input">
        </div>
        <div class="input-group">
            <label for="new-password" class="input-group__label">New password</label>
            <input type="password" id="new-password" name="new_password" required="required" placeholder="New password" class="input-group__input">
        </div>
        <div class="input-group">
            <label for="confirm-new-password" class="input-group__label">Confirm password</label>
            <input type="password" id="confirm-new-password" name="confirm_new_password" required="required" placeholder="Confirm password"
                   class="input-group__input">
        </div>
        <button type="submit" class="button">Change Password</button>
    </form>
</div>
