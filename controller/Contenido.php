<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/ContenidoModel.php');
  class Contenido extends Controller {

    public $active = 'contenido'; //for highlighting the active link...
    private $ContenidoModel;

    /**
      * @param null|void
      * @return null|void
      * @desc Checks if the user session is set and creates a new instance of the ContenidoModel...
    **/
    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: login.php");
      $this->ContenidoModel = new ContenidoModel();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns an array of news by calling the ContenidoModel fetchNews method...
    **/
    public function getNews() :array
    {
      return $this->ContenidoModel->fetchNews();
    }
  }
 ?>
