<?php
    namespace Controllers;
    
    use DAO\EstadisticaDAO as EstadisticaDAO;
    use DAO\PeliculaDAO as PeliculaDAO;
    use DAO\CineDAO as CineDAO;
    use DAO\SalaDAO as SalaDAO;
    use DAO\FuncionDAO as FuncionDAO;
    use Models\Pelicula as Pelicula;
    use Models\Cine as Cine;
    use Models\Sala as Sala;
    use Models\Funcion as Funcion;

	class EstadisticaController extends Administrable
	{
        private $estadisticaDAO;
        private $peliculaDAO;
        private $cineDAO;
        private $salaDAO;
        private $funcionDAO;

        function __construct()
        {
            $this->estadisticaDAO = new EstadisticaDAO();
            $this->peliculaDAO = new PeliculaDAO();
            $this->cineDAO = new CineDAO();
            $this->salaDAO = new SalaDAO();
            $this->funcionDAO = new FuncionDAO();
        }

		public function Index($idPelicula = null, $idCine = null, $idFuncion = null, $fechaInicio = null, $fechaFin = null)
		{
            if (!$this->loggedIn()) Functions::redirect("Home");
			if (!$this->isMainAdmin()) Functions::redirect("Home");

            if($idPelicula != null) $idPelicula = Functions::validateData($idPelicula);
            if($idCine != null) $idCine = Functions::validateData($idCine);
            if($idFuncion != null) $idFuncion = Functions::validateData($idFuncion);
            if($fechaInicio != null) $fechaInicio = Functions::validateData($fechaInicio);
            if($fechaFin != null) $fechaFin = Functions::validateData($fechaFin);

            $pelicula = new Pelicula();
            $cine = new Cine();
            $funcion = new Funcion();
            $sala = new Sala();

            $peliculaList = $this->peliculaDAO->getAll();
            $cineList = $this->cineDAO->getAll();

            // Cargar datos en el formulario de los parametros que recibo
            if($idPelicula != null)
            {
                $pelicula->setId($idPelicula);
                $pelicula = $this->peliculaDAO->getPelicula($pelicula);
            }
            if($idCine != null)
            {
                $cine->setId($idCine);
                $cine = $this->cineDAO->getCine($cine);
            }
            if($idFuncion != null)
            {
                $funcion->setId($idFuncion);
                $funcion = $this->funcionDAO->getFuncion($funcion);
            }
            if($fechaInicio != null && $fechaFin != null && $fechaInicio > $fechaFin)
            {
                $fechaInicio = $fechaFin;
                Functions::flash("Ese rango de tiempo no existe. Se modifico para solucionarlo.","warning");
            }

            // Load funciones en base a pelicula y cine
            if($idPelicula != null && $idCine != null)
            {
                $funcionList = $this->funcionDAO->getByCinePelicula($cine,$pelicula,$fechaInicio,$fechaFin);
            }
            else if($idPelicula != null)
            {
                $funcionList = $this->funcionDAO->getByPelicula($pelicula,$fechaInicio,$fechaFin, false);
            }
            else if($idCine != null)
            {
                $funcionList = $this->funcionDAO->getByCine($cine,$fechaInicio,$fechaFin);
            }
            else
            {
                $funcionList = $this->funcionDAO->getAll($fechaInicio,$fechaFin);
            }

            // Inicio estadisticas
            if($idFuncion != null) $count = 1;
            else $count = count($funcionList);

            $estadistica['vendido'] = array();
            $estadistica['remanente'] = array();
            $estadistica['capacidad'] = array();
            $estadistica['recaudacion'] = array();
            $estadistica['novendido'] = array();
            if($count > 0)
            {
                if($idFuncion != null)
                {
                    $estadistica['vendido'][0] = $this->estadisticaDAO->getCantidadVendidaFuncion($funcion);
                    $estadistica['remanente'][0] = $this->estadisticaDAO->getRemanenteFuncion($funcion);
                    $estadistica['capacidad'][0] = $estadistica['vendido'][0] + $estadistica['remanente'][0];
                    $estadistica['recaudacion'][0] = $this->estadisticaDAO->getRecaudacionFuncion($funcion);

                    $sala->setId($funcion->getIdSala());
                    $sala = $this->salaDAO->getSala($sala);
                    $precio = $sala->getPrecio();

                    $estadistica['novendido'][0] = $estadistica['remanente'][0] * $precio;
                }
                else
                {
                    foreach($funcionList as $key=>$funcion)
                    {
                        $estadistica['vendido'][$key] = $this->estadisticaDAO->getCantidadVendidaFuncion($funcion);
                        $estadistica['remanente'][$key] = $this->estadisticaDAO->getRemanenteFuncion($funcion);
                        $estadistica['capacidad'][$key] = $estadistica['vendido'][$key] + $estadistica['remanente'][$key];
                        $estadistica['recaudacion'][$key] = $this->estadisticaDAO->getRecaudacionFuncion($funcion);
                                             
                        $sala->setId($funcion->getIdSala());
                        $sala = $this->salaDAO->getSala($sala);
                        $precio = $sala->getPrecio();

                        $estadistica['novendido'][$key] = $estadistica['remanente'][$key] * $precio;
                    }
                    
                }
            }
            // Fin estadisticas

            require_once(VIEWS_PATH."estadistica/searchbar.php");
            require_once(VIEWS_PATH."estadistica/estadistica.php");
            require_once(VIEWS_PATH."estadistica/estadistica-list.php");
        }
	}
?>