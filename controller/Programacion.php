<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/ProgramacionModel.php');
  class programacion extends Controller {

    public $active = 'programacion'; //for highlighting the active link...
    private $programacionModel;

    /**
      * @param null|void
      * @return null|void
      * @desc Checks if the user session is set and creates a new instance of the ProgramacionModel...
    **/
    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: login.php");
      $this->programacionModel = new ProgramacionModel();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns an array of news by calling the ProgramacionModel fetchNews method...
    **/
    public function getNews() :array
    {
      return $this->programacionModel->fetchNews();
    }
  }
 ?>
