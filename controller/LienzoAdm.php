<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/LienzoAdmModel.php');

  class LienzoAdm extends Controller {

    public $active = 'lienzo'; //for highlighting the active link...
    private $LienzoAdmModel;

    /**
      * @param null|void
      * @return null|void
      * @desc Checks if the user session is set and creates a new instance of the LienzoAdmModel...
    **/
    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: login.php");
      $this->LienzoAdmModel = new LienzoAdmModel();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns an array of lienzos by calling the LienzoAdmModel getTable method...
    **/
    public function getTable() :array
    {
      return $this->LienzoAdmModel->getTable();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns inserting status by calling the LienzoAdmModel insertRecord method...
    **/
    public function insertRecord(array $data) :array
    {
      // Obtener en alfanumérico
      $name = stripcslashes(strip_tags($data['name']));
      $email = stripcslashes(strip_tags($data['email']));

      // Validaciones de serivor
      // ...

      $Payload = array(
        'name' => $name,
        'email' => $email,
      );

      $Response = $this->LienzoAdmModel->insertRecord($Payload);

      return $Response;
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns a single lienzo record by calling the LienzoAdmModel getRecord method...
    **/
    public function getRecord(array $data) :array
    {
      return $this->LienzoAdmModel->getRecord($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns updating status by calling the LienzoAdmModel updateRecord method...
    **/
    public function updateRecord(array $data) :array
    {
      return $this->LienzoAdmModel->updateRecord($data);
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns deleting status by calling the LienzoAdmModel deleteRecord method...
    **/
    public function deleteRecord(array $data) :array
    {
      return $this->LienzoAdmModel->deleteRecord($data);
    }
  }
    
?>
