<?php
$tasks = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/users/" . base64_decode($_GET['id']) . "/todos"), true);
?>

<!doctype html>
<html lang="en">

<?php include_once 'components/head.php'; ?>

<body>
    <?php include_once 'components/navbar.php'; ?>
    <div class="container-fluid p-3">
        <div class="row">
            <div class="col-12 mb-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modelId">
                    <i class="fa fa-plus"></i> Agregar tarea
                </button>

                <!-- Modal -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Agregar tarea</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="formNewTask">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Titulo</label>
                                                <input type="hidden" name="userId" value="<?= base64_decode($_GET['id']) ?>">
                                                <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="completed" value="true">
                                                <label class="custom-control-label" for="customCheck1">Completado</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach (array_reverse($tasks) as $task) : ?>
                <div class="col-xl-6 col-md-6 col-12 mb-3">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h3 class="card-title"><i class="fas fa-tasks"></i> <?= $task['title'] ?></h3>
                            <?php if ($task['completed']) : ?>
                                <p class="card-text"><i class="fas fa-check-circle text-success fa-lg"></i></p>
                            <?php else : ?>
                                <p class="card-text"><i class="fas fa-times-circle text-danger fa-lg"></i></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include_once 'components/footer.php'; ?>
    <?php include_once 'components/scripts.php'; ?>

    <script>
        $("#formNewTask").on("submit", function(e) {
            e.preventDefault();
            var datos = new FormData(this);
            $.ajax({
                type: "POST",
                url: 'https://jsonplaceholder.typicode.com/posts',
                data: datos,
                cache: false,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(res) {
                    if(res.id){
                        alert("La tarea se agrego correctamente")
                        // window.location.reload();
                    }
                }
            })
        })
    </script>

</body>

</html>