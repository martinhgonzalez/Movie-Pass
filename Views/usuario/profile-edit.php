<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-md-8 col-lg-4 offset-sm-0 offset-md-2 offset-lg-4 bg-light rounded shadow p-md-4 p-lg-4 p-xl-4">
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <form action="<?php echo FRONT_ROOT ?>Usuario/Update/<?php echo $usuario->getId(); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $usuario->getId(); ?>">
            <div class="row">
                <div class="form-group col">
                    <a class="btn btn-secondary shadow-sm" href="<?php echo FRONT_ROOT ?>Usuario/ShowProfileView/<?php echo $usuario->getId(); ?>" role="button">Volver a perfil</a>
                </div>
                <div class="form-group col text-center">
                    <h2>Modificar perfil</h2>
                </div>
            </div>

            <div class="row">
                <div class="form-group col">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $usuario->getEmail();?>" readonly="readonly">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="<?php echo $usuario->getNombre();?>" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" name="apellido" value="<?php echo $usuario->getApellido();?>" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="dni">Dni:</label>
                    <input type="number" class="form-control" name="dni" value="<?php echo $usuario->getDni();?>" readonly="readonly">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="password">Contraseña anterior:</label>
                    <input type="password" class="form-control" name="previouspassword">
                </div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="password">Contraseña nueva:</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group col">
                    <label for="confirmpassword">Repite contraseña:</label>
                    <input type="password" class="form-control" name="confirmpassword">
                </div>
            </div>
            <div class="custom-file mb-2">
                <input type="hidden" name="MAX_FILE_SIZE" value="50000" />
                <input type="file" name ="image" class="custom-file-input" id="validatedCustomFile">
                <label class="custom-file-label" for="validatedCustomFile"><i class="fa fa-user"></i> Imagen de perfil (MAX: 5MB)</label>
                <div class="invalid-feedback">Imagen invalida.</div>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block mt-2 shadow-sm"><i class="fa fa-plus-circle"></i> Actualizar datos</button>
        </form>
    </div>
</div>