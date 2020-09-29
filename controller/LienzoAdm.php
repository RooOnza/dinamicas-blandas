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
      * @desc Returns an array of news by calling the LienzoModel fetchNews method...
    **/
    public function getNews() :array
    {
      return $this->LienzoAdmModel->fetchNews();
    }

  }

?>
