<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/ActoresModel.php');

  class Actores extends Controller {

    public $active = 'actores'; //for highlighting the active link...
    private $actoresModel;

    /**
      * @param null|void
      * @return null|void
      * @desc Checks if the user session is set and creates a new instance of the actoresModel...
    **/
    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: login.php");
      $this->actoresModel = new ActoresModel();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns an array of actores by calling the actoresModel getTable method...
    **/
    public function getTable() :array
    {
      return $this->actoresModel->getTable();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns inserting status by calling the actoresModel insertRecord method...
    **/
    public function insertRecord(array $data) :array
    {
      /*
      // Obtener en alfanumérico
      $desc_actor = stripcslashes(strip_tags($data['desc_actor']));
      //$posicion_x = stripcslashes(strip_tags($data['posicion_x']));
      //$posicion_y = stripcslashes(strip_tags($data['posicion_y']));
      $id_tipo = stripcslashes(strip_tags($data['id_tipo']));
      $estilo = stripcslashes(strip_tags($data['estilo']));
      $id_status = stripcslashes(strip_tags($data['id_status']));

      // Validaciones de serivor
      // ...
      //'posicion_x' => $posicion_x,'posicion_y' => $posicion_y,
      $params = array(
        'desc_actor' => $desc_actor,
        'id_tipo' => $id_tipo,
        'estilo' => $estilo,
        'id_status' => $id_status,
      );
      */
      $Response = $this->actoresModel->insertRecord($data);

      return $Response;
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns a single actor record by calling the actoresModel getRecord method...
    **/
    public function getRecord(array $data) :array
    {
      return $this->actoresModel->getRecord($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns updating status by calling the actoresModel updateRecord method...
    **/
    public function updateRecord(array $data) :array
    {
      return $this->actoresModel->updateRecord($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns deleting status by calling the actoresModel deleteRecord method...
    **/
    public function deleteRecord(array $data) :array
    {
      return $this->actoresModel->deleteRecord($data);
    }
  }
    
?>
