<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/ObraModel.php');

  class Obra extends Controller {

    public $active = 'obra'; //for highlighting the active link...
    private $obraModel;

    /**
      * @param null|void
      * @return null|void
      * @desc Checks if the user session is set and creates a new instance of the obraModel...
    **/
    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: login.php");
      $this->obraModel = new ObraModel();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns an array of lienzos by calling the obraModel getTable method...
    **/
    public function getTable() :array
    {
      return $this->obraModel->getTable();
    }

    public function getChildTable(array $data) :array
    {
      return $this->obraModel->getChildTable($data);
    }

    public function getLista() :array
    {
      return $this->obraModel->getLista();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns inserting status by calling the obraModel insertRecord method...
    **/
    public function insertRecord(array $data) :array
    {
      // Obtener en alfanumérico
      $desc_obra = stripcslashes(strip_tags($data['desc_obra']));
      $id_status = (int)stripcslashes(strip_tags($data['id_status']));
      
      // Validaciones de serivor
      // ...

      $params = array(
        'desc_obra' => $desc_obra,
        'id_status' => $id_status,
      );

      $Response = $this->obraModel->insertRecord($params);

      return $Response;
    }

    public function insertRecordDetail(array $data) :array
    {
      // Obtener en alfanumérico
      $id_obra = stripcslashes(strip_tags($data['id_obra']));
      $id_escena = stripcslashes(strip_tags($data['id_escena']));
      $orden = stripcslashes(strip_tags($data['orden']));

      // Validaciones de serivor
      // ...

      $params = array(
        'id_obra' => $id_obra,
        'id_escena' => $id_escena,
        'orden' => $orden,
      );

      $Response = $this->obraModel->insertRecordDetail($params);

      return $Response;
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns a single lienzo record by calling the obraModel getRecord method...
    **/
    public function getRecord(array $data) :array
    {
      return $this->obraModel->getRecord($data);
    }
    public function getRecordDetail(array $data) :array
    {
      return $this->obraModel->getRecordDetail($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns updating status by calling the obraModel updateRecord method...
    **/
    public function updateRecord(array $data) :array
    {
      return $this->obraModel->updateRecord($data);
    }
    public function updateRecordDetail(array $data) :array
    {
      return $this->obraModel->updateRecordDetail($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns deleting status by calling the obraModel deleteRecord method...
    **/
    public function deleteRecord(array $data) :array
    {
      return $this->obraModel->deleteRecord($data);
    }
    public function deleteRecordDetail(array $data) :array
    {
      return $this->obraModel->deleteRecordDetail($data);
    }
  }
    
?>
