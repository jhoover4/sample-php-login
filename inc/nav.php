<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="/"><?php echo getenv('COMPANY_NAME') ?> Clients</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">View Clients</a>
            </li>
            <?php
            if (isAuthenticated()) {
                echo "<li class='nav-item'><a class='nav-link' href='/update.php'>Change Login</a></li>";
            }
            ?>
            <li class="nav-item">
                <?php
                if (!isAuthenticated()) {
                    echo "<a class='nav-link' href='/login.php'>Login</a>";
                } else {
                    echo "<a class='nav-link' href='/CRUD/doLogout.php'>Logout</a>";
                }
                ?>
            </li>
        </ul>
    </div>
</nav>