<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!---- PHP ---->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php

    // Llamamos a "db.php" para conectarnos a la Base de Datos
    require "db.php";

    // Iniciamos la sesion
    session_start();

    // En el caso de que la sesion no este iniciada redirigimos a login
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
        return;
    }

    // Realizamos una consulta SQL para imprimir los contactos guardándolos en la variable "contactos" 
    $contactos = $con->query("SELECT * FROM contactos WHERE id_usuario = {$_SESSION['user']['id']}");

?>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!---- PHP ---->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!------------------------------------------------------------------------------------------------>
<!------- Head ------>
<!------------------------------------------------------------------------------------------------>
<?php require "static/head.php" ?>
<!------------------------------------------------------------------------------------------------>
<!------- Head ------>
<!------------------------------------------------------------------------------------------------>

<!------------------------------------------------------------------------------------------------>
<!------- Barra de Navegación ------>
<!------------------------------------------------------------------------------------------------>
<?php require "static/header.php" ?>
<!------------------------------------------------------------------------------------------------>
<!------- Barra de Navegación ------>
<!------------------------------------------------------------------------------------------------>

<!------------------------------------------------------------------------------------------------>
<!------- MAIN ------>
<!------------------------------------------------------------------------------------------------>
<main>
    <div class="container pt-4 p-3">
        <div class="row">
            <!----------------------------------------------------------------------->
            <!------- Tarjetas de Contactos ------>
            <!----------------------------------------------------------------------->
            <?php if ($contactos->rowCount() == 0): ?>
                <div class="col-md-4 mx-auto">
                    <div class="card card-body text-center">
                        <p>No tienes contactos, añade alguno</p>
                        <a href="add.php">Añadir Contacto!</a>
                    </div>
                </div>
            <?php endif ?>

            <?php foreach ($contactos as $contacto) : ?>
                <div class="col-md-4 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h3 class="card-title text-capitalize"><?= $contacto["nombre"]?></h3>
                            <p class="m-2"><?= $contacto["numero_telefono"] ?></p>
                            <a href="editar.php?id=<?= $contacto["id"] ?>" class="btn btn-secondary mb-2">Editar Contacto</a>
                            <a href="eliminar.php?id=<?= $contacto["id"] ?>" class="btn btn-danger mb-2">Eliminar Contacto</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
            <!----------------------------------------------------------------------->
            <!------- Tarjetas de Contactos ------>
            <!----------------------------------------------------------------------->
        </div>
    </div>
</main>
<!------------------------------------------------------------------------------------------------>
<!------- MAIN ------>
<!------------------------------------------------------------------------------------------------>

<!------------------------------------------------------------------------------------------------>
<!------- Footer ------>
<?php require "static/footer.php" ?>
<!------------------------------------------------------------------------------------------------>
<!------- Footer ------>
<!------------------------------------------------------------------------------------------------>
