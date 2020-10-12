<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/LienzoAdmModel.php');

  class LienzoAdm extends Controller {

    public $active = 'lienzoadm'; //for highlighting the active link...
    private $temporadaModel;

    /**
      * @param null|void
      * @return null|void
      * @desc Checks if the user session is set and creates a new instance of the temporadaModel...
    **/
    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: login.php");
      $this->temporadaModel = new LienzoAdmModel();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns an array of lienzos by calling the temporadaModel getTable method...
    **/
    public function getTable() :array
    {
      return $this->temporadaModel->getTable();
    }

    public function getChildTable(array $data) :array
    {
      return $this->temporadaModel->getChildTable($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns inserting status by calling the temporadaModel insertRecord method...
    **/
    public function insertRecord(array $data) :array
    {
      // Obtener en alfanumérico
      $desc_temporada = stripcslashes(strip_tags($data['desc_temporada']));
      $id_tipo = (int)stripcslashes(strip_tags($data['id_tipo']));
      $permanente = (int)stripcslashes(strip_tags($data['permanente']));

      // Validaciones de serivor
      // ...

      $params = array(
        'desc_temporada' => $desc_temporada,
        'id_tipo' => $id_tipo,
        'permanente' => $permanente,
      );

      $Response = $this->temporadaModel->insertRecord($params);

      return $Response;
    }

    public function insertRecordDetail(array $data) :array
    {
      // Obtener en alfanumérico
      $id_temporada = stripcslashes(strip_tags($data['id_temporada']));
      $fecha = stripcslashes(strip_tags($data['fecha']));
      $id_status = (int)stripcslashes(strip_tags($data['id_status']));

      // Validaciones de serivor
      // ...

      $params = array(
        'id_temporada' => $id_temporada,
        'fecha' => $fecha,
        'id_status' => $id_status,
      );

      $Response = $this->temporadaModel->insertRecordDetail($params);

      return $Response;
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns a single lienzo record by calling the temporadaModel getRecord method...
    **/
    public function getRecord(array $data) :array
    {
      return $this->temporadaModel->getRecord($data);
    }
    public function getRecordDetail(array $data) :array
    {
      return $this->temporadaModel->getRecordDetail($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns updating status by calling the temporadaModel updateRecord method...
    **/
    public function updateRecord(array $data) :array
    {
      return $this->temporadaModel->updateRecord($data);
    }
    public function updateRecordDetail(array $data) :array
    {
      return $this->temporadaModel->updateRecordDetail($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns deleting status by calling the temporadaModel deleteRecord method...
    **/
    public function deleteRecord(array $data) :array
    {
      return $this->temporadaModel->deleteRecord($data);
    }
    public function deleteRecordDetail(array $data) :array
    {
      return $this->temporadaModel->deleteRecordDetail($data);
    }
  }
    
?>
