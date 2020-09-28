<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/LienzoModel.php');
  class Lienzo extends Controller {

    public $active = 'lienzo'; //for highlighting the active link...
    private $LienzoModel;

    /**
      * @param null|void
      * @return null|void
      * @desc Checks if the user session is set and creates a new instance of the LienzoModel...
    **/
    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: login.php");
      $this->LienzoModel = new LienzoModel();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns an array of news by calling the LienzoModel fetchNews method...
    **/
    public function getNews() :array
    {
      return $this->LienzoModel->fetchNews();
    }
  }
 ?>
