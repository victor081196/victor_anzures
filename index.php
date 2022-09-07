<?php
$users = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/users"), true);
?>
<!doctype html>
<html lang="en">

<?php include_once 'components/head.php'; ?>

<body>
    <?php include_once 'components/navbar.php'; ?>
    <div class="container-fluid p-3">
        <div class="row">
            <?php foreach ($users as $user) : ?>
                <div class="col-xl-4 col-md-6 col-12 mb-3">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h3 class="card-title"><i class="fa fa-user"></i> <?= $user['name'] ?></h3>
                            <p class="card-text"><?= $user['username'] ?></p>
                            <a href="#" class="btn btn-primary btnMostrarUser" id="<?= $user['id'] ?>">Seleccionar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include_once 'components/footer.php'; ?>
    <?php include_once 'components/scripts.php'; ?>

    <script>
        $(".btnMostrarUser").on("click", function() {
            var id = $(this).attr('id');
            $.ajax({
                type: "GET",
                url: 'https://jsonplaceholder.typicode.com/users/' + id,
                // data: datos,
                cache: false,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(res) {
                    $("#modalUsuario").modal('show');
                    $("#nombre").text(res.name)
                    $("#usuario").text(res.username)
                    $("#email").text(res.email)
                    var direccion = res.address.street + " " + res.address.suite + " " + res.address.city + " " + res.address.zipcode;
                    $("#direccion").text(direccion)

                    $(".post").attr("href", "post?id=" + btoa(res.id));
                    $(".task").attr("href", "task?id=" + btoa(res.id));
                }
            })
        })
    </script>

</body>

</html>


<!-- Modal -->
<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mostrar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td scope="row">Nombre</td>
                        <td id="nombre" style="font-weight:bold;"></td>
                    </tr>
                    <tr>
                        <td scope="row">Usuario</td>
                        <td id="usuario" style="font-weight:bold;"></td>
                    </tr>
                    <tr>
                        <td scope="row">Correo</td>
                        <td id="email" style="font-weight:bold;"></td>
                    </tr>
                    <tr>
                        <td scope="row">Dirección</td>
                        <td id="direccion" style="font-weight:bold;"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <a type="button" class="btn btn-dark post">POST</a>
                <a type="button" class="btn btn-primary task">TODOS</a>
            </div>
        </div>
    </div>
</div>