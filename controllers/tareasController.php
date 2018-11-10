<?php  

/**
 * @author Julio Guevara
 * @version 1.0
 */

	/** 
	 * Class tareasController
	 * @package App\Controller
	 */
	
	class tareasController extends AppController
	{
		public function __construct()
		{
			parent::__construct();
		}



		/**
		 * Index de la aplicación
		 *  @return mixed|void
		 *
		 */
		public function index()
		{   /** @var TareaModel $tareas */
			$tareas = $this->loadModel("tarea");
			$categorias = $this->loadModel("categoria");
			$this->_view->tareas=$tareas->getTareas();
			$this->_view->categorias=$categorias->getCategorias();
			$this->_view->titulo="Pagina principal";
			$this->_view->renderizar("index");
		}

		/**
		 * Este metodo agregar una tarea
		 * Si detecta una entrada de datos mediante el POST, llama el metodo que guarda una tarea
		 */
		public function agregar()
		{
			if($_POST)
			{
				$tareas = $this->loadModel("tarea");
				$this->_view->tareas = $tareas->agregar($_POST);
				$this->redirect(array("controller"=>"tareas"));
			}
			$categorias = $this->loadModel("categoria");
			$this->_view->categorias=$categorias->getCategorias();
			$this->_view->titulo="Agregar Tarea";
			$this->_view->renderizar("agregar");
		}

		/**
		 * Editar una tarea
		 * @param type|null $id Obtiene el Id de la Tarea 
		 * @return type
		 */
		public function editar($id=null)
		{
			if($_POST)
			{
				$tareas = $this->loadModel("tarea");
				$tareas->actualizar($_POST);
				$this->redirect(array("controller"=>"tareas"));
			}
			$tareas = $this->loadModel("tarea");
			$this->_view->tarea = $tareas->buscarPorId($id);

			$categorias = $this->loadModel("categoria");
			$this->_view->categorias=$categorias->getCategorias();

			$this->_view->titulo="Editar Tarea";
			$this->_view->renderizar("editar");
		}
		/**
		 * Eliminar una aplicacion
		 * @param type $id 
		 * @return type
		 */
		public function eliminar($id)
		{
			$tarea = $this->loadModel("tarea");
			$registro = $tarea->buscarPorId($id);
			if(!empty($registro))
			{
				$tarea->eliminar($id);
				$this->redirect(array("controller"=>"tareas"));
			}			
		}
    public function cambiarEstado($id) {
        /**
         * @var TareaModel $tareas
         */
        $tareas = $this->loadModel("tarea");
        $tareas->actualizarEstatus($id);
        $this->redirect(array("controller"=>"tareas"));
        
    }
		
	}
?>