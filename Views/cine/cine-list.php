<?php require_once(VIEWS_PATH."navbar.php"); ?>
<div class="container-fluid mb-4">
    <div class="col-sm-12 col-md-10 offset-sm-0 offset-md-1 bg-dark-transparent text-white rounded shadow p-2">
        <?php require_once(VIEWS_PATH."alert.php"); ?>
        <h2 class="col-sm-12 col-md-6 text-light pb-2 mb-2">Lista de cines</h2>
        <table id="sortable" class="table table-striped table-responsive-md text-light align-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Salas</th>
                    <th>Funciones</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cineList as $cine) { ?>
                <tr>
                    <td><?php echo $cine->getId(); ?></td>
                    <td><a href="<?php echo FRONT_ROOT ?>Cine/ShowFichaView/<?php echo $cine->getId();?>" class="text-light"><img src="<?php echo FRONT_ROOT.IMG_PATH."cinema.png" ?>" height="35" class="rounded-circle z-depth-0 mr-2" alt="cinema image"><b><?php echo $cine->getNombre(); ?></b></a></td>
                    <td><?php echo $cine->getDireccion(); ?></td>
                    <td><?php echo count($this->salaDAO->getByCine($cine)); ?></td>
                    <td><?php echo count($this->funcionDAO->getByCine($cine)); ?></td>
                    <td><a href="<?php echo FRONT_ROOT ?>Cine/ShowFichaView/<?php echo $cine->getId();?>" class="view" title="" data-toggle="tooltip" data-original-title="View Details"><h4><i class="fa fa-arrow-circle-right"></i></h4></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <a class="btn btn-primary btn-block mt-2" href="<?php echo FRONT_ROOT ?>Cine/ShowAddView" role="button"><i class="fa fa-plus-circle"></i> Agregar cine</a>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#sortable').DataTable( {
        "columnDefs": [
            { "orderable": false, "targets": 5 }
        ]
        } );
    } );
</script>