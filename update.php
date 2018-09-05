<?php
require __DIR__ . '/inc/bootstrap.php';

requireAuth();

require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';

try {
    $loginInfo = getLogin()[0];
} catch (Exception $e) {
    $loginInfo['username'] = '';
}
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="page-header">
                    <h1 class="display-4">Update Login</h1>
                    <p>Update username and password below.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="well col-lg-10 mx-auto">
                <form method="post" action="/CRUD/updateLogin.php" class="form-signin">
                    <?php echo displayFlash(); ?>
                    <fieldset>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                   aria-describedby="emailHelp"
                                   value="<?php echo $loginInfo['username']; ?>"
                            >
                        </div>
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" name="current_password" id="current_password"
                                   placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="new_password"
                                   placeholder="Enter new password">
                            <small class="form-text text-muted">Need help? <a
                                        href="https://www.lastpass.com/password-generator"
                                        target="_blank">Generate</a> a password.
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="confirm_new_password">Confirm new Password</label>
                            <input type="password" class="form-control" name="confirm_new_password"
                                   id="confirm_new_password"
                                   placeholder="Confirm new password"
                            >
                        </div>
                        <button type="submit" class="btn btn-large btn-primary btn-block">Update Information</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>


<?php require_once __DIR__ . '/inc/footer.php'; ?>