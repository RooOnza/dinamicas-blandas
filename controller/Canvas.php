<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/CanvasModel.php');

  class Canvas extends Controller {

    public $active = 'canvas'; //for highlighting the active link...
    private $canvasModel;

    /**
      * @param null|void
      * @return null|void
      * @desc Checks if the user session is set and creates a new instance of the canvasModel...
    **/
    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: login.php");
      $this->canvasModel = new CanvasModel();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns an array of lienzos by calling the canvasModel getTable method...
    **/
    public function getTable() :array
    {
      return $this->canvasModel->getTable();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns inserting status by calling the canvasModel insertRecord method...
    **/
    public function insertRecord(array $data) :array
    {
      // Obtener en alfanumérico
      $desc_canvas = stripcslashes(strip_tags($data['desc_canvas']));
      $tamano_x = (int)stripcslashes(strip_tags($data['tamano_x']));
      $tamano_y = (int)stripcslashes(strip_tags($data['tamano_y']));
      $color = stripcslashes(strip_tags($data['color']));
      $estilo = stripcslashes(strip_tags($data['estilo']));
      $id_status = (int)stripcslashes(strip_tags($data['id_status']));

      // Validaciones de serivor
      // ...

      $params = array(
        'desc_canvas' => $desc_canvas,
        'tamano_x' => $tamano_x,
        'tamano_y' => $tamano_y,
        'color' => $color,
        'estilo' => $estilo,
        'id_status' => $id_status,
      );

      $Response = $this->canvasModel->insertRecord($params);

      return $Response;
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns a single lienzo record by calling the canvasModel getRecord method...
    **/
    public function getRecord(array $data) :array
    {
      return $this->canvasModel->getRecord($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns updating status by calling the canvasModel updateRecord method...
    **/
    public function updateRecord(array $data) :array
    {
      return $this->canvasModel->updateRecord($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns deleting status by calling the canvasModel deleteRecord method...
    **/
    public function deleteRecord(array $data) :array
    {
      return $this->canvasModel->deleteRecord($data);
    }
  }
    
?>
