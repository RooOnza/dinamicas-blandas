<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/UsersModel.php');
  class Users extends Controller {

    public $active = 'users'; //for highlighting the active link...
    private $usersModel;

    /**
      * @param null|void
      * @return null|void
      * @desc Checks if the user session is set and creates a new instance of the UsersModel...
    **/
    public function __construct()
    {
      if (!isset($_SESSION['auth_status'])) header("Location: login.php");
      $this->usersModel = new UsersModel();
    }

    /**
      * @param null|void
      * @return array
      * @desc Returns an array of news by calling the UsersModel fetchNews method...
    **/
    public function getNews() :array
    {
      return $this->usersModel->fetchNews();
    }
  }
 ?>
