
<?php

class TareaModel extends AppModel
{
	public function __construct(){
		parent::__construct();
	}

	public function getTareas(){
		$tareas = $this->_db->query("SELECT * FROM tareas INNER JOIN categorias ON tareas.categoria_id=categorias.id");

		foreach (range(0, $tareas->columnCount()-1) as $column_index) {
			$meta[] = $tareas->getColumnMeta($column_index);
		}
		$resultado = $tareas->fetchall(PDO::FETCH_NUM);

		for ($i=0; $i < count($resultado); $i++) { 
			$j = 0;
			foreach ($meta as $value) {
				$rows[$i][$value["table"]][$value["name"]] = $resultado[$i][$j];
				$j++;
			}
		}

		return $rows;

		//array("tareas"=array(), "categorias"=>array())

		//return $tareas->fetchall();
	}
	public function agregar($datos = array()){
		$consulta = $this->_db->prepare(
			"INSERT INTO tareas 
			 (nombre, descripcion, fecha, prioridad, categoria_id, estatus)
			 VALUES
			 (:nombre, :descripcion, :fecha, :prioridad, :categoria_id, 0)"
		);
		
		$consulta->bindParam(":nombre" , $datos["nombre"]);
		$consulta->bindParam(":descripcion" , $datos["descripcion"]);
		$consulta->bindParam(":fecha" , $datos["fecha"]);
		$consulta->bindParam(":prioridad" , $datos["prioridad"]);
		$consulta->bindParam(":categoria_id" , $datos["categoria_id"]);

		if ($consulta->execute()) {
			return true;
		}else{
			return false;
		}

	}

	public function actualizar($datos = array()){
		$consulta = $this->_db->prepare(
			"UPDATE tareas SET
			 nombre=:nombre, 
			 descripcion=:descripcion, 
			 fecha=:fecha, 
			 prioridad=:prioridad, 
			 categoria_id=:categoria_id
			 WHERE id=:id"
		);
	$consulta->bindParam(":id" , $datos["id"]);
	$consulta->bindParam(":nombre" , $datos["nombre"]);
	$consulta->bindParam(":descripcion" , $datos["descripcion"]);
	$consulta->bindParam(":fecha" , $datos["fecha"]);
	$consulta->bindParam(":prioridad" , $datos["prioridad"]);
	$consulta->bindParam(":categoria_id" , $datos["categoria_id"]);
	
		if ($consulta->execute()) {
			return true;
		}else{
		return false;
	
		}
	
	}


		public function buscarPorId($id)
		{
			$tarea = $this->_db->prepare("SELECT * FROM tareas WHERE id=:id");
			$tarea->bindParam(":id",$id);
			$tarea->execute();
			$registro = $tarea->fetch();

			if ($registro) 
			{
				return $registro;
			}
			else
			{
				return false;
			}
		}

	   public function eliminar($id) {
        $tarea = $this->_db->prepare(
            "DELETE FROM tareas WHERE id = :id"
        );
        $tarea->bindParam(":id", $id);
        if ($tarea->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function actualizarEstatus($id) {
        $consulta = $this->_db->prepare(
            "UPDATE tareas SET estatus = 1 - estatus WHERE id = :id"
        );
        $consulta->bindParam(":id", $id);
        return $consulta->execute();
    }


}