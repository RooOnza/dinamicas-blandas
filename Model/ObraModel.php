<?php
  require_once(__dir__ . '/Db.php');
  class ObraModel extends Db {

    /**
      * @param null
      * @return array
      * @desc Returns an array of Obras...
    **/

    public function getTable() :array{
      $this->query("SELECT t1.*, t2.desc_status FROM db_obras t1 
                    INNER JOIN db_status_gral t2 ON t1.id_status = t2.id_status 
                    ORDER BY id_obra;");
      $this->execute();
      $obra = $this->fetchAll();

      if (count($obra) > 0) {
        $Response = array(
          'status' => true,
          'data' => $obra,
          'mensaje' => ''
        );
      } else {
        $Response = array(
          'status' => false,
          'data' => true,
          'mensaje' => 'Ooops! la tabla está vacía'
        );
      }
      return $Response;
    }
    
    public function getChildTable(array $params) :array{
      $this->query("SELECT t1.*, t2.desc_escena FROM db_escenas_obra t1 
                    INNER JOIN db_escenas t2 ON t1.id_escena = t2.id_escena 
                    WHERE id_obra = :id_obra ORDER BY orden;");

      $this->bind('id_obra', $params['id_obra']);
      $this->execute();
      $obra = $this->fetchAll();

      if (count($obra) > 0) {
        $Response = array(
          'status' => true,
          'data' => $obra,
          'mensaje' => ''
        );
      } else {
        $Response = array(
          'status' => false,
          'data' => true,
          'mensaje' => 'Ooops! la tabla está vacía'
        );
      }
      return $Response;
    }

    public function getLista() :array{
      $this->query("SELECT * FROM db_escenas
                    WHERE id_status = 1
                    ORDER BY desc_escena;");
      $this->execute();
      $obra = $this->fetchAll();

      if (count($obra) > 0) {
        $Response = array(
          'status' => true,
          'data' => $obra,
          'mensaje' => ''
        );
      } else {
        $Response = array(
          'status' => false,
          'data' => true,
          'mensaje' => 'Ooops! la tabla está vacía'
        );
      }
      return $Response;
    }

    public function insertRecord(array $params) :array{
      $this->query("INSERT INTO db_obras (desc_obra, id_status) VALUES (:desc_obra, :id_status)");
      $this->bind('desc_obra', $params['desc_obra']);
      $this->bind('id_status', $params['id_status']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, obra creada.'
        );
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Sorry, An unexpected error occurred and your request could not be completed.'  
        );
      }
      return $Response;
    }

    public function insertRecordDetail(array $params) :array{
      $this->query("INSERT INTO db_escenas_obra (id_obra, id_escena, orden) 
                    VALUES (:id_obra, :id_escena, :orden)");
      $this->bind('id_obra', $params['id_obra']);
      $this->bind('id_escena', $params['id_escena']);
      $this->bind('orden', $params['orden']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, escena asignada.'
        );
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Sorry, An unexpected error occurred and your request could not be completed.'  
        );
      }
      return $Response;
    }

    public function getRecord(array $params) :array{
      $this->query("SELECT * FROM db_obras WHERE id_obra=:id_obra");
      $this->bind('id_obra', $params['id_obra']);
      $this->execute();
      $obra = $this->fetch();

      if ($obra){
        if (count($obra) > 0) {
          $Response = array(
            'status' => true,
            'data' => $obra
          );
        } else {
          $Response = array(
            'status' => false,
            'mensaje' => 'La obra no existe en DB'
          );
        }
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Error al obtener la obra de DB'
        );
      }
      return $Response;
    }

    public function getRecordDetail(array $params) :array{
      //db_escenas_obra (id_obra, id_escena, id_status)
      $this->query("SELECT * FROM db_escenas_obra WHERE id_obra=:id_obra AND id_escena=:id_escena ORDER BY orden");
      $this->bind('id_obra', $params['id_obra']);
      $this->bind('id_escena', $params['id_escena']);
      $this->execute();
      $obra = $this->fetch();

      if ($obra){
        if (count($obra) > 0) {
          $Response = array(
            'status' => true,
            'data' => $obra
          );
        } else {
          $Response = array(
            'status' => false,
            'mensaje' => 'La escena no existe en DB'
          );
        }
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Error al obtener la escena de DB'
        );
      }
      return $Response;
    }

    public function deleteRecord(array $params) :array{

      $this->query("DELETE FROM db_escenas_obra WHERE id_obra=:id_obra");
      $this->bind('id_obra', $params['id_obra']);
      
      if ($this->execute()) {

        $this->query("DELETE FROM db_obras WHERE id_obra=:id_obra");
        $this->bind('id_obra', $params['id_obra']);
  
        if ($this->execute()) {
          $Response = array(
            'status' => true,
            'mensaje' => 'Vale!, obra eliminada.'
          );
        } else {
          $Response = array(
            'status' => false,
            'mensaje' => 'Sorry, An unexpected error occurred and your request could not be completed.'  
          );
        }  
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Sorry, An unexpected error occurred and your request could not be completed.'  
        );
      }
      return $Response;
    }

    public function deleteRecordDetail(array $params) :array{
      //db_escenas_obra (id_obra, id_escena, id_status)
      $this->query("DELETE FROM db_escenas_obra WHERE id_obra=:id_obra AND id_escena=:id_escena");
      $this->bind('id_obra', $params['id_obra']);
      $this->bind('id_escena', $params['id_escena']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, escena eliminada.'
        );
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Sorry, An unexpected error occurred and your request could not be completed.'  
        );
      }
      return $Response;
    }

    public function updateRecord(array $params) :array{

      $this->query("UPDATE db_obras 
                    SET desc_obra=:desc_obra, id_status=:id_status
                    WHERE id_obra = :id_obra");

      $this->bind('id_obra', $params['id_obra']);
      $this->bind('desc_obra', $params['desc_obra']);
      $this->bind('id_status', $params['id_status']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, obra actualizada.'
        );
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Sorry, An unexpected error occurred and your request could not be completed.'  
        );
      }
      return $Response;
    }

    public function updateRecordDetail(array $params) :array{
      //db_escenas_obra (id_obra, id_escena, orden)
      $this->query("UPDATE db_escenas_obra 
                    SET id_escena=:id_escena, orden=:orden
                    WHERE id_obra = :id_obra 
                    AND id_escena=:id_escena_llave");

      $this->bind('id_obra', $params['id_obra']);
      $this->bind('id_escena_llave', $params['id_escena_llave']);
      $this->bind('id_escena', $params['id_escena']);
      $this->bind('orden', $params['orden']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, escena actualizada.'
        );
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Sorry, An unexpected error occurred and your request could not be completed.'  
        );
      }
      return $Response;
    }

  }
?>
