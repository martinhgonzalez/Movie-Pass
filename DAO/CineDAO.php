<?php
	namespace DAO;
	
    use DAO\Connection as Connection;
	use Models\Cine as Cine;

	class CineDAO
	{
		private $connection;
		private $tableName = "Cines";		
		
		public function add($cine)
		{
			try
			{
				$query = "INSERT INTO ".$this->tableName." (nombre, direccion) VALUES (:nombre, :direccion);";
				
				$parameters["nombre"]=$cine->getNombre();
				$parameters["direccion"]=$cine->getDireccion();

				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
			}
			catch(Exception $ex)
			{
				return null;
			}
		}

		function remove($cine)
		{
			try
			{
				$query = "DELETE FROM ".$this->tableName." WHERE id_cine = :id_cine;";

				$parameters["id_cine"]=$cine->getId();
				
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
			}
			catch(Exception $ex)
			{
				return null;
			}
		}

		public function getAll()
		{
			try
			{
				$list = array();
				$query = "SELECT * FROM ".$this->tableName;
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);
				
				foreach ($resultSet as $row)
				{
					$cine = new Cine();
					$cine->setId($row["id_cine"]);
					$cine->setNombre($row["nombre"]);
					$cine->setDireccion($row["direccion"]);

					array_push($list, $cine);
				}
				
				return $list;
			}
			catch(Exception $ex)
			{
				return null;
			}
		}

		public function getCine($cine)
		{
			try
			{
				$query = "SELECT * FROM ".$this->tableName." WHERE id_cine = ".$cine->getId().";";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);
				
				foreach ($resultSet as $row)
				{
					$cine->setId($row["id_cine"]);
					$cine->setNombre($row["nombre"]);
					$cine->setDireccion($row["direccion"]);

					return $cine;
				}
				return null;
			}
			catch(Exception $ex)
			{
				return null;
			}
		}

		public function getByNombre($cine)
		{
			try
			{
				$query = "SELECT * FROM ".$this->tableName." WHERE nombre = '".$cine->getNombre()."';";
				$this->connection = Connection::GetInstance();
				$resultSet = $this->connection->Execute($query);
				
				foreach ($resultSet as $row)
				{
					$cine = new Cine();
					$cine->setId($row["id_cine"]);
					$cine->setNombre($row["nombre"]);
					$cine->setDireccion($row["direccion"]);
					return $cine;
				}
				return null;
			}
			catch(Exception $ex)
			{
				return null;
			}
		}

		public function edit($cine)
		{
			try
			{
				$query = "UPDATE ".$this->tableName." SET id_cine = :id_cine, nombre = :nombre, direccion = :direccion WHERE id_cine =".$cine->getId().";";

				$parameters["id_cine"] = $cine->getId();
				$parameters["nombre"]= $cine->getNombre();
				$parameters["direccion"]= $cine->getDireccion();
				$parameters["id_cine"] = $cine->getId();

				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);
			}
			catch(Exception $ex)
			{
				return null;
			}
		}
	}
?>