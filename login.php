<?php
require __DIR__ . '/inc/bootstrap.php';

require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="page-header">
                    <h1 class="display-4">Please Login</h1>
                    <p>Access is restricted, please login below.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="well col-lg-10 mx-auto">
                <form method="post" action="/CRUD/doLogin.php" class="form-signin">
                    <?php echo displayFlash('error'); ?>
                    <fieldset>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                   aria-describedby="emailHelp"
                                   placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="Enter password">
                        </div>
                        <button type="submit" class="btn btn-large btn-primary btn-block">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>


<?php require_once __DIR__ . '/inc/footer.php'; ?>