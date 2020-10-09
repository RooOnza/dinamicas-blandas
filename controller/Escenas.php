<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/EscenasModel.php');

  class Escenas extends Controller {

    public $active = 'escenas'; //for highlighting the active link...
    private $escenasModel;

    /**
      * @param null|void
      * @return null|void
      * @desc Checks if the user session is set and creates a new instance of the escenasModel...
    **/
    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: login.php");
      $this->escenasModel = new EscenasModel();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns an array of lienzos by calling the escenasModel getTable method...
    **/
    public function getTable() :array {
      return $this->escenasModel->getTable();
    }

    public function getChildTable(array $data) :array {
      return $this->escenasModel->getChildTable($data);
    }

    public function getListaActores($id_tipo) :array {
      return $this->escenasModel->getListaActores($id_tipo);
    }

    public function getListaCanvas() :array {
      return $this->escenasModel->getListaCanvas();
    }

    public function getOrdenExistente(array $data) : array {
      return $this->escenasModel->getOrdenExistente($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns inserting status by calling the escenasModel insertRecord method...
    **/
    public function insertRecord(array $data) :array
    {
      return $this->escenasModel->insertRecord($data);
    }

    public function insertRecordDetail(array $data) :array
    {
      return $this->escenasModel->insertRecordDetail($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns a single lienzo record by calling the escenasModel getRecord method...
    **/
    public function getRecord(array $data) :array
    {
      return $this->escenasModel->getRecord($data);
    }
    public function getRecordDetail(array $data) :array
    {
      return $this->escenasModel->getRecordDetail($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns updating status by calling the escenasModel updateRecord method...
    **/
    public function updateRecord(array $data) :array
    {
      return $this->escenasModel->updateRecord($data);
    }
    public function updateRecordDetail(array $data) :array
    {
      return $this->escenasModel->updateRecordDetail($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns deleting status by calling the escenasModel deleteRecord method...
    **/
    public function deleteRecord(array $data) :array
    {
      return $this->escenasModel->deleteRecord($data);
    }
    public function deleteRecordDetail(array $data) :array
    {
      return $this->escenasModel->deleteRecordDetail($data);
    }
  }
    
?>
