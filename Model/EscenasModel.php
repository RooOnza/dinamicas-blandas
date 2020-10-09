<?php
  require_once(__dir__ . '/Db.php');
  class EscenasModel extends Db {

    /**
      * @param null
      * @return array
      * @desc Returns an array of Escenas...
    **/

    public function getTable() :array{
      $this->query("SELECT t1.*, t2.desc_status, t3.desc_canvas, t4.desc_tipo 
                    FROM db_escenas t1 
                    INNER JOIN db_status_gral t2 ON t1.id_status = t2.id_status 
                    INNER JOIN db_canvas t3 ON t1.id_canvas = t3.id_canvas 
                    INNER JOIN db_tipo_escena t4 ON t1.id_tipo = t4.id_tipo 
                    ORDER BY t1.id_escena;");
      $this->execute();
      $escena = $this->fetchAll();

      if (count($escena) > 0) {
        $Response = array(
          'status' => true,
          'data' => $escena,
          'mensaje' => ''
        );
      } else {
        $Response = array(
          'status' => false,
          'data' => true,
          'mensaje' => 'Ooops! la tabla padre está vacía'
        );
      }
      return $Response;
    }
    
    public function getChildTable(array $params) :array{
      $this->query("SELECT t1.*, t2.desc_actor, t3.desc_tipo, t4.desc_status 
                    FROM db_escena_actores t1 
                    INNER JOIN db_actores t2 ON t1.id_actor = t2.id_actor 
                    INNER JOIN db_tipo_actores t3 ON t2.id_tipo = t3.id_tipo 
                    INNER JOIN db_status_gral t4 ON t1.id_status = t4.id_status 
                    WHERE t1.id_escena = :id_escena 
                    AND t2.id_status = 1 
                    ORDER BY t1.orden;");

      $this->bind('id_escena', $params['id_escena']);
      $this->execute();
      $escena = $this->fetchAll();

      if (count($escena) > 0) {
        $Response = array(
          'status' => true,
          'data' => $escena,
          'mensaje' => ''
        );
      } else {
        $Response = array(
          'status' => false,
          'data' => true,
          'mensaje' => 'Ooops! la tabla hija está vacía'
        );
      }
      return $Response;
    }

    public function getListaActores($id_tipo) :array{
      $this->query("SELECT * FROM db_actores WHERE id_tipo = :id_tipo AND id_status = 1 ORDER BY id_actor;");

      $this->bind('id_tipo', $id_tipo);
      $this->execute();
      $actores = $this->fetchAll();

      if (count($actores) > 0) {
        $Response = array(
          'status' => true,
          'data' => $actores,
          'mensaje' => ''
        );
      } else {
        $Response = array(
          'status' => true,
          'data' => true,
          //'mensaje' => 'Ooops! la tabla actores está vacía'
        );
      }
      return $Response;
    }

    public function getListaCanvas() :array{
      $this->query("SELECT * FROM db_canvas WHERE id_status = 1 ORDER BY id_canvas;");
      $this->execute();
      $canvas = $this->fetchAll();

      if (count($canvas) > 0) {
        $Response = array(
          'status' => true,
          'data' => $canvas,
          'mensaje' => ''
        );
      } else {
        $Response = array(
          'status' => true,
          'data' => true,
          //'mensaje' => 'Ooops! la tabla lienzos está vacía'
        );
      }
      return $Response;
    }

    public function getOrdenExistente(array $params) : array {
      $this->query("SELECT COUNT(*) AS tot FROM db_escena_actores 
                    WHERE id_escena = :id_escena AND id_actor = :id_actor AND orden = :orden;");
      $this->bind('id_escena', $params['id_escena']);
      $this->bind('id_actor', $params['id_actor']);
      $this->bind('orden', $params['orden']);
      $this->execute();
      $escena = $this->fetch();

      if ($escena){
        if (count($escena) > 0) {
          $Response = array(
            'status' => true,
            'data' => $escena
          );
        } else {
          $Response = array(
            'status' => false,
            'mensaje' => 'El orden del actor no existe en DB'
          );
        }
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Error al obtener el orden del actor de DB'
        );
      }
      return $Response;
    }

    public function insertRecord(array $params) :array{
      $this->query("INSERT INTO db_escenas (desc_escena, tiempo, id_canvas, id_tipo, id_status) 
                    VALUES (:desc_escena, :tiempo, :id_canvas, :id_tipo, :id_status)");
      $this->bind('desc_escena', $params['desc_escena']);
      $this->bind('tiempo', $params['tiempo']);
      $this->bind('id_canvas', $params['id_canvas']);
      $this->bind('id_tipo', $params['id_tipo_esc']);
      $this->bind('id_status', $params['id_status']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, escena creada.'
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
      $this->query("INSERT INTO db_escena_actores (id_escena, id_actor, posicion_x, posicion_y, permanente, 
                                                 tiempo_ini, tiempo_fin, estilo, orden, id_status) 
                    VALUES (:id_escena, :id_actor, :posicion_x, :posicion_y, :permanente, 
                            :tiempo_ini, :tiempo_fin, :estilo, :orden, :id_status)");

      $this->bind('id_escena', $params['id_escena']);
      $this->bind('id_actor', $params['id_actor']);
      $this->bind('posicion_x', $params['posicion_x']);
      $this->bind('posicion_y', $params['posicion_y']);
      $this->bind('permanente', $params['permanente']);
      $this->bind('tiempo_ini', $params['tiempo_ini']);
      $this->bind('tiempo_fin', $params['tiempo_fin']);
      $this->bind('estilo', $params['estilo']);
      $this->bind('orden', $params['orden']);
      $this->bind('id_status', $params['id_status_det']);
      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, actor asignado.'
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
      $this->query("SELECT * FROM db_escenas WHERE id_escena=:id_escena");
      $this->bind('id_escena', $params['id_escena']);
      $this->execute();
      $escena = $this->fetch();

      if ($escena){
        if (count($escena) > 0) {
          $Response = array(
            'status' => true,
            'data' => $escena
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

    public function getRecordDetail(array $params) :array{
      $this->query("SELECT t1.*, t2.id_tipo FROM db_escena_actores t1
                    INNER JOIN db_actores t2 ON t1.id_actor = t2.id_actor
                    WHERE t1.id_escena=:id_escena AND t1.id_actor=:id_actor 
                    AND t1.orden = :orden
                    ORDER BY orden;");
      $this->bind('id_escena', $params['id_escena']);
      $this->bind('id_actor', $params['id_actor']);
      $this->bind('orden', $params['orden']);
      $this->execute();
      $escena = $this->fetch();

      if ($escena){
        if (count($escena) > 0) {
          $Response = array(
            'status' => true,
            'data' => $escena
          );
        } else {
          $Response = array(
            'status' => false,
            'mensaje' => 'El actor no existe en DB'
          );
        }
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Error al obtener el actor de DB'
        );
      }
      return $Response;
    }

    public function deleteRecord(array $params) :array{

      $this->query("DELETE FROM db_escena_actores WHERE id_escena=:id_escena");
      $this->bind('id_escena', $params['id_escena']);
      
      if ($this->execute()) {

        $this->query("DELETE FROM db_escenas WHERE id_escena=:id_escena");
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
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Sorry, An unexpected error occurred and your request could not be completed.'  
        );
      }
      return $Response;
    }

    public function deleteRecordDetail(array $params) :array{
      $this->query("DELETE FROM db_escena_actores WHERE id_escena=:id_escena AND id_actor=:id_actor AND orden=:orden;");
      $this->bind('id_escena', $params['id_escena']);
      $this->bind('id_actor', $params['id_actor']);
      $this->bind('orden', $params['orden']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, actor eliminado.'
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

      $this->query("UPDATE db_escenas 
                    SET desc_escena=:desc_escena, id_canvas=:id_canvas, tiempo=:tiempo, id_tipo=:id_tipo, id_status=:id_status
                    WHERE id_escena = :id_escena");

      $this->bind('id_escena', $params['id_escena']);
      $this->bind('desc_escena', $params['desc_escena']);
      $this->bind('id_canvas', $params['id_canvas']);
      $this->bind('tiempo', $params['tiempo']);
      $this->bind('id_tipo', $params['id_tipo_esc']);
      $this->bind('id_status', $params['id_status']);

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

    public function updateRecordDetail(array $params) :array{
      //db_escena_actores (id_actor, id_actor, orden)
      $this->query("UPDATE db_escena_actores 
                    SET id_actor=:id_actor, posicion_x=:posicion_x, posicion_y=:posicion_y, permanente=:permanente, 
                        tiempo_ini=:tiempo_ini, tiempo_fin=:tiempo_fin, estilo=:estilo, orden=:orden
                    WHERE id_escena = :id_escena 
                    AND id_actor=:id_actor_llave
                    AND orden=:orden_llave;");

      $this->bind('id_escena', $params['id_escena']);
      $this->bind('id_actor_llave', $params['id_actor_llave']);
      $this->bind('id_actor', $params['id_actor']);
      $this->bind('posicion_x', $params['posicion_x']);
      $this->bind('posicion_y', $params['posicion_y']);
      $this->bind('permanente', $params['permanente']);
      $this->bind('tiempo_ini', $params['tiempo_ini']);
      $this->bind('tiempo_fin', $params['tiempo_fin']);
      $this->bind('estilo', $params['estilo']);
      $this->bind('orden', $params['orden']);
      $this->bind('orden_llave', $params['orden_llave']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, actor actualizado.'
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
