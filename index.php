<?php
require __DIR__ . '/inc/bootstrap.php';

requireAuth();

require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';
?>
    <div class="container">
        <?php print displayFlash('success'); ?>
        <div class="title">
            <h1 class="display-4">Client List</h1>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-primary btn-sort">
                    <input type="checkbox" checked="" autocomplete="off" sort_by="id"> Sort by Id
                </label>
                <label class="btn btn-primary btn-sort">
                    <input type="checkbox" autocomplete="off" sort_by="name"> Sort by Name
                </label>
            </div>
        </div>
        <div class="client-list">
            <?php
            foreach (getAllClients() as $client) {
                include __DIR__ . '/inc/client.php';
            }
            ?>
        </div>
    </div>

<?php require_once __DIR__ . '/inc/footer.php'; ?>