<?php


if (isset($_SESSION["loggedUser"])) {

    if ($_SESSION["loggedUser"]->getId_Rol() === 2) {

        require_once "main-admin-navbar.php";
    } else if ($_SESSION["loggedUser"]->getId_Rol() === 3) {

        require_once "admin-navbar.php";
    } else

        header("Location: ../Pelicula/ShowAddView");
} else {
    header("Location: ../Usuario/ShowLoginView");
}
/*Los ultimos 2 headers son para reestringir entradas de no Admins*/

if($resultadoAgregarCine == 0)
{
    echo "<script >alert('El cine se ha agregado satisfactoriamente');</script>";
}
if($resultadoAgregarCine == 1)
{
    echo "<script >alert('ERROR: el nombre del cine ya existe');</script>";
}
?>
<body>
    <div class="container container-fluid mt-4">
        <div class="loginForm">
            <a class="btn btn-secondary" href="<?php echo FRONT_ROOT ?>Cine/ShowListView" role="button">Volver a lista de cines</a>
            <form action="<?php echo FRONT_ROOT ?>Cine/Add" method="POST">
                <h2 class="text-left">Ingresa datos del cine: </h2>
                <br>
                <div class="row">
                    <div class="form-group col-sm text-right">
                        <label for="nombre">Nombre:</label>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm text-right">
                        <label for="direccion">Direccion:</label>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="direccion" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm text-right">
                        <label for="capacidad">Capacidad:</label>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="capacidad" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm text-right">
                        <label for="precio">Precio: $</label>
                    </div>
                    <div>
                        <input type="number" class="form-control" name="precio" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm text-right">
                        <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fas fa-plus-circle"></i> Agregar cine</button>
                    </div>
            </form>
        </div>
    </div>
</body>