<?php
$publicaciones = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/users/" . base64_decode($_GET['id']) . "/posts"), true);
?>

<!doctype html>
<html lang="en">

<?php include_once 'components/head.php'; ?>

<body>
    <?php include_once 'components/navbar.php'; ?>
    <div class="container-fluid p-3">
        <div class="row">
            <?php foreach ($publicaciones as $pbl) :
                $comments = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/post/" . $pbl['id']  . "/comments"), true);
            ?>
                <div class="col-xl-6 col-md-6 col-12 mb-3">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h3 class="card-title"><i class="fas fa-bookmark"></i> <?= $pbl['title'] ?></h3>
                            <p class="card-text"><?= $pbl['body'] ?></p>
                            <p class="card-text"><strong>Comentarios</strong></p>
                            <?php
                            $i = 1;
                            foreach ($comments as $comment) : ?>
                                <p class="card-text"><?= $i . ".- " . $comment['body'] ?></p>
                            <?php
                                $i++;
                            endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php
            endforeach; ?>
        </div>
    </div>

    <?php include_once 'components/footer.php'; ?>
    <?php include_once 'components/scripts.php'; ?>

</body>

</html>