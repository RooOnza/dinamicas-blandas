<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/ConTextoModel.php');

  class ConTexto extends Controller {

    public $active = 'contenido'; //for highlighting the active link...
    private $ConTextoModel;

    /**
      * @param null|void
      * @return null|void
      * @desc Checks if the user session is set and creates a new instance of the ConTextoModel...
    **/
    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: login.php");
      $this->ConTextoModel = new ConTextoModel();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns an array of lienzos by calling the ConTextoModel getTable method...
    **/
    public function getTable() :array
    {
      return $this->ConTextoModel->getTable();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns inserting status by calling the ConTextoModel insertRecord method...
    **/
    public function insertRecord(array $data) :array
    {
      // Obtener en alfanumérico
      $nombre = stripcslashes(strip_tags($data['nombre']));
      $texto = stripcslashes(strip_tags($data['texto']));
      $ntop = stripcslashes(strip_tags($data['ntop']));
      $nleft = stripcslashes(strip_tags($data['nleft']));
      $nheight = stripcslashes(strip_tags($data['nheight']));
      $nwidth = stripcslashes(strip_tags($data['nwidth']));
      $status_id = stripcslashes(strip_tags($data['status_id']));

      // Validaciones de serivor
      // ...

      $params = array(
        'nombre' => $nombre,
        'texto' => $texto,
        'ntop' => $ntop,
        'nleft' => $nleft,
        'nheight' => $nheight,
        'nwidth' => $nwidth,
        'status_id' => $status_id,
      );

      $Response = $this->ConTextoModel->insertRecord($params);

      return $Response;
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns a single lienzo record by calling the ConTextoModel getRecord method...
    **/
    public function getRecord(array $data) :array
    {
      return $this->ConTextoModel->getRecord($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns updating status by calling the ConTextoModel updateRecord method...
    **/
    public function updateRecord(array $data) :array
    {
      return $this->ConTextoModel->updateRecord($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns deleting status by calling the ConTextoModel deleteRecord method...
    **/
    public function deleteRecord(array $data) :array
    {
      return $this->ConTextoModel->deleteRecord($data);
    }
  }
    
?>
