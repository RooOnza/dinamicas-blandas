<?php
  require_once(__dir__ . '/Db.php');
  class LienzoAdmModel extends Db {

    /**
      * @param null
      * @return array
      * @desc Returns an array of news....
    **/

    public function getTable() :array{
      $this->query("SELECT * FROM user_record");
      $this->execute();
      $Lienzos = $this->fetchAll();

      if (count($Lienzos) > 0) {
        $Response = array(
          'status' => true,
          'data' => $Lienzos
        );
        return $Response;
      }

      $Response = array(
        'status' => false,
        'data' => []
      );
      return $Response;
    }
    
    public function insertRecord(array $user) :array{
      $this->query("INSERT INTO user_record (UserName, UserEmail) VALUES (:UserName, :UserEmail)");
      $this->bind('UserName', $user['name']);
      $this->bind('UserEmail', $user['email']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'data' => 'Vale!, usuario creado.'
        );
      } else {
        $Response = array(
          'status' => false,
          'data' => 'Sorry, An unexpected error occurred and your request could not be completed.'  
        );
      }
      return $Response;
    }

    public function getRecord(array $user) :array{
      $this->query("SELECT * FROM user_record WHERE ID=:ID");
      $this->bind('ID', $user['id']);
      $this->execute();
      $Lienzo = $this->fetch();

      if (count($Lienzo) > 0) {
        $Response = array(
          'status' => true,
          'data' => $Lienzo
        );
      } else {
        $Response = array(
          'status' => false,
          'data' => 'El usuario no existe en DB'
        );
      }
      return $Response;
    }

    public function deleteRecord(array $user) :array{
      $this->query("DELETE FROM user_record WHERE ID = :ID");
      $this->bind('ID', $user['id']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'data' => 'Vale!, usuario eliminado.'
        );
      } else {
        $Response = array(
          'status' => false,
          'data' => 'Sorry, An unexpected error occurred and your request could not be completed.'  
        );
      }
      return $Response;
    }

    public function updateRecord(array $user) :array{
      $this->query("UPDATE user_record SET UserName = :UserName, UserEmail = :UserEmail WHERE ID = :ID");
      $this->bind('ID', $user['id']);
      $this->bind('UserName', $user['name']);
      $this->bind('UserEmail', $user['email']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'data' => 'Vale!, usuario actualizado.'
        );
      } else {
        $Response = array(
          'status' => false,
          'data' => 'Sorry, An unexpected error occurred and your request could not be completed.'  
        );
      }
      return $Response;
    }
  }
?>
