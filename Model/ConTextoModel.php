<?php
  require_once(__dir__ . '/Db.php');
  class ConTextoModel extends Db {

    /**
      * @param null
      * @return array
      * @desc Returns an array of textos...
    **/

    public function getTable() :array{
      $this->query("SELECT t1.*, t2.statusDesc FROM db_textos t1 INNER JOIN db_status t2 ON t1.status_id = t2.id;");
      $this->execute();
      $textos = $this->fetchAll();

      if (count($textos) > 0) {
        $Response = array(
          'status' => true,
          'data' => $textos,
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
      $this->query("INSERT INTO db_textos 
                           (nombre, texto, ntop, nleft, nheight, nwidth, status_id) 
                    VALUES (:nombre, :texto, :ntop, :nleft, :nheight, :nwidth, :status_id)");
      $this->bind('nombre', $params['nombre']);
      $this->bind('texto', $params['texto']);
      $this->bind('ntop', $params['ntop']);
      $this->bind('nleft', $params['nleft']);
      $this->bind('nheight', $params['nheight']);
      $this->bind('nwidth', $params['nwidth']);
      $this->bind('status_id', $params['status_id']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, texto creado.'
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
      $this->query("SELECT * FROM db_textos WHERE id=:id");
      $this->bind('id', $params['id']);
      $this->execute();
      $Lienzo = $this->fetch();

      if ($Lienzo){
        if (count($Lienzo) > 0) {
          $Response = array(
            'status' => true,
            'data' => $Lienzo
          );
        } else {
          $Response = array(
            'status' => false,
            'mensaje' => 'El lienzo no existe en DB'
          );
        }
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Error al obtener el lienzo de DB'
        );
      }
      return $Response;
    }

    public function deleteRecord(array $params) :array{
      $this->query("DELETE FROM db_textos WHERE id=:id");
      $this->bind('id', $params['id']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, lienzo eliminado.'
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

      $this->query("UPDATE db_textos 
                    SET nombre=:nombre, texto=:texto, ntop=:ntop, nleft=:nleft, nheight=:nheight, 
                        nwidth=:nwidth, status_id=:status_id 
                    WHERE id = :id");

      $this->bind('id', $params['id']);
      $this->bind('nombre', $params['nombre']);
      $this->bind('texto', $params['texto']);
      $this->bind('ntop', $params['ntop']);
      $this->bind('nleft', $params['nleft']);
      $this->bind('nheight', $params['nheight']);
      $this->bind('nwidth', $params['nwidth']);
      $this->bind('status_id', $params['status_id']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, texto actualizado.'
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
