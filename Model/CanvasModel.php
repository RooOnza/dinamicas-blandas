<?php
  require_once(__dir__ . '/Db.php');
  class CanvasModel extends Db {

    /**
      * @param null
      * @return array
      * @desc Returns an array of textos...
    **/

    public function getTable() :array{
      $this->query("SELECT t1.*, t2.desc_status FROM db_canvas t1 INNER JOIN db_status_gral t2 ON t1.id_status = t2.id_status;");
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
      $this->query("INSERT INTO db_canvas (desc_canvas, tamano_x, tamano_y, color, estilo, id_status) 
                    VALUES (:desc_canvas, :tamano_x, :tamano_y, :color, :estilo, :id_status)");
      $this->bind('desc_canvas', $params['desc_canvas']);
      $this->bind('tamano_x', $params['tamano_x'], PDO::PARAM_INT);
      $this->bind('tamano_y', $params['tamano_y'], PDO::PARAM_INT);
      $this->bind('color', $params['color']);
      $this->bind('estilo', $params['estilo']);
      $this->bind('id_status', $params['id_status'], PDO::PARAM_INT);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, lienzo creado.'
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
      $this->query("SELECT * FROM db_canvas WHERE id_canvas=:id_canvas");
      $this->bind('id_canvas', $params['id_canvas']);
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
      $this->query("DELETE FROM db_canvas WHERE id_canvas=:id_canvas");
      $this->bind('id_canvas', $params['id_canvas']);

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

      $this->query("UPDATE db_canvas 
                    SET desc_canvas=:desc_canvas, tamano_x=:tamano_x, tamano_y=:tamano_y, color=:color, 
                        estilo=:estilo, id_status=:id_status 
                    WHERE id_canvas = :id_canvas");

      $this->bind('id_canvas', $params['id_canvas']);
      $this->bind('desc_canvas', $params['desc_canvas']);
      $this->bind('tamano_x', $params['tamano_x']);
      $this->bind('tamano_y', $params['tamano_y']);
      $this->bind('color', $params['color']);
      $this->bind('estilo', $params['estilo']);
      $this->bind('id_status', $params['id_status']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, lienzo actualizado.'
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
