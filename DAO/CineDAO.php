<?php
	/**
	 * @author Guille
	 * @version 1.0
	 * @created 06-oct.-2019 19:06:02
	 */
	namespace DAO;

	use Models\Cine as Cine;

	class CineDAO
	{
		private $cineList = array();
		private $fileName = ROOT."Data/cines.json";

		/**
		 * 
		 * @param cine
		 */
		public function add(Cine $cine)
		{
			$this->retrieveData();

			array_push($this->cineList, $cine);
				
			$this->saveData();
		}

		public function getAll()
		{
			$this->Retrievedata();

			return $this->cineList;
		}

		public function saveData()
		{
			$arrayToEncode = array();

			foreach($this->cineList as $cine)
			{
				$valuesArray["nombre"]= $cine->getNombre();
				$valuesArray["direccion"]= $cine->getDireccion();
				$valuesArray["capacidad"]=$cine->getCapacidad();
				$valuesArray["precio"]=$cine->getPrecio();
			
				array_push($arrayToEncode, $valuesArray);
			}

			$jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

			file_put_contents($fileName, $jsonContent);
		}

		public function retrieveData()
		{
			$this->cineList = array();

			if(file_exists($fileName));
			{
				$jsonContent = file_get_contents($fileName);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$cine = new Cine();
					$cine->setNombre($valuesArray["nombre"]);
					$cine->setDireccion($valuesArray["direccion"]);
					$cine->setCapacidad($valuesArray["capacidad"]);
					$cine->setPrecio($valuesArray["precio"]);

					array_push($this->cineList, $cine);
				}
			}
		}

		/**
		 * retorna 0 si no existe, la id si existe
		 * @param cineAbuscar debe tener al menos el parametro "id" o el "nombre"
		 */
		public function cineExiste(Cine $cineAbuscar)
		{
			if(file_exists($fileName));
			{
				$jsonContent = file_get_contents($fileName);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$cine = new Cine();
					$cine->setNombre($valuesArray["nombre"]);
					$cine->setDireccion($valuesArray["direccion"]);
					$cine->setCapacidad($valuesArray["capacidad"]);
					$cine->setPrecio($valuesArray["precio"]);

					if($cine->getNombre() === $cineAbuscar->getNombre())
					{
						return $cine;
					}
				}
			}
			return 0;
		}

		/**
		 * 
		 * @param nombre
		 */
		public function eliminarCine($nombre)
		{
			$this->cineList = array();

			if(file_exists($fileName))
			{
				$jsonContent = file_get_contents($fileName);

				$arrayToDencode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$cine = new Cine();
					$cine->setNombre($valuesArray["nombre"]);
					$cine->setDireccion($valuesArray["direccion"]);
					$cine->setCapacidad($valuesArray["capacidad"]);
					$cine->setPrecio($valuesArray["precio"]);

					if($nombre != $cine->getNombre())
					{
						array_push($this->cineList, $cine);
					}
				}
				$this->SaveData();
			}
		}

		public function cineXid($id)
		{
			$this->cineList = array();

			if(file_exists($fileName));
			{
				$jsonContent = file_get_contents($fileName);

				$arrayToDecode = ($jsonContent) ? json_decode ($jsonContent, true) : array();
				
				foreach($arrayToDecode as $valuesArray)
				{
					$cine = new Cine();
					$cine->setId($valuesArray["id"]);
					$cine->setNombre($valuesArray["nombre"]);
					$cine->setDireccion($valuesArray["direccion"]);
					$cine->setCapacidad($valuesArray["capacidad"]);
					$cine->setPrecio($valuesArray["precio"]);

					if($id === $cine->getId())
					{
						return $cine;
					}

				}
			}
			return null;
		}
	}
?>