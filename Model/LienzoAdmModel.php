<?php
  require_once(__dir__ . '/Db.php');
  class LienzoAdmModel extends Db {

    /**
      * @param null
      * @return array
      * @desc Returns an array of tempo...
    **/

    public function getTable() :array{
      $this->query("SELECT t1.*, t2.desc_tipo FROM db_temporadas t1 INNER JOIN db_tipo_temporada t2 ON t1.id_tipo = t2.id_tipo;");
      $this->execute();
      $tempo = $this->fetchAll();

      if (count($tempo) > 0) {
        $Response = array(
          'status' => true,
          'data' => $tempo,
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
      $this->query("SELECT t1.*, t2.desc_status FROM db_fechas_temporada t1 
                    INNER JOIN db_status_gral t2 ON t1.id_status = t2.id_status
                    WHERE id_temporada = :id_temporada
                    ORDER BY fecha;");
      $this->bind('id_temporada', $params['id_temporada']);
      $this->execute();
      $tempo = $this->fetchAll();

      if (count($tempo) > 0) {
        $Response = array(
          'status' => true,
          'data' => $tempo,
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
      $this->query("INSERT INTO db_temporadas (desc_temporada, id_tipo, permanente) 
                    VALUES (:desc_temporada, :id_tipo, :permanente)");
      $this->bind('desc_temporada', $params['desc_temporada']);
      $this->bind('id_tipo', $params['id_tipo']);
      $this->bind('permanente', $params['permanente']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, temporada creada.'
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
      $this->query("INSERT INTO db_fechas_temporada (id_temporada, fecha, id_status) 
                    VALUES (:id_temporada, :fecha, :id_status)");
      $this->bind('id_temporada', $params['id_temporada']);
      $this->bind('fecha', $params['fecha']);
      $this->bind('id_status', $params['id_status']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, fecha creada.'
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
      $this->query("SELECT * FROM db_temporadas WHERE id_temporada=:id_temporada");
      $this->bind('id_temporada', $params['id_temporada']);
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
            'mensaje' => 'La temporada no existe en DB'
          );
        }
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Error al obtener la temporada de DB'
        );
      }
      return $Response;
    }

    public function getRecordDetail(array $params) :array{
      //db_fechas_temporada (id_temporada, fecha, id_status)
      $this->query("SELECT * FROM db_fechas_temporada WHERE id_temporada=:id_temporada AND fecha=:fecha ORDER BY fecha");
      $this->bind('id_temporada', $params['id_temporada']);
      $this->bind('fecha', $params['fecha']);
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
            'mensaje' => 'La fecha no existe en DB'
          );
        }
      } else {
        $Response = array(
          'status' => false,
          'mensaje' => 'Error al obtener la fecha de DB'
        );
      }
      return $Response;
    }

    public function deleteRecord(array $params) :array{

      $this->query("DELETE FROM db_fechas_temporada WHERE id_temporada=:id_temporada");
      $this->bind('id_temporada', $params['id_temporada']);
      
      if ($this->execute()) {
        $this->query("DELETE FROM db_temporadas WHERE id_temporada=:id_temporada");
        $this->bind('id_temporada', $params['id_temporada']);
  
        if ($this->execute()) {
          $Response = array(
            'status' => true,
            'mensaje' => 'Vale!, temporada eliminada.'
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
      //db_fechas_temporada (id_temporada, fecha, id_status)
      $this->query("DELETE FROM db_fechas_temporada WHERE id_temporada=:id_temporada AND fecha=:fecha");
      $this->bind('id_temporada', $params['id_temporada']);
      $this->bind('fecha', $params['fecha']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, fecha eliminada.'
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

      $this->query("UPDATE db_temporadas 
                    SET desc_temporada=:desc_temporada, id_tipo=:id_tipo, permanente=:permanente
                    WHERE id_temporada = :id_temporada");

      $this->bind('id_temporada', $params['id_temporada']);
      $this->bind('desc_temporada', $params['desc_temporada']);
      $this->bind('id_tipo', $params['id_tipo']);
      $this->bind('permanente', $params['permanente']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, temporada actualizada.'
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
      //db_fechas_temporada (id_temporada, fecha, id_status)
      $this->query("UPDATE db_fechas_temporada 
                    SET fecha=:fecha, id_status=:id_status
                    WHERE id_temporada = :id_temporada 
                    AND fecha=:fecha_llave");

      $this->bind('id_temporada', $params['id_temporada']);
      $this->bind('fecha_llave', $params['fecha_llave']);
      $this->bind('fecha', $params['fecha']);
      $this->bind('id_status', $params['id_status']);

      if ($this->execute()) {
        $Response = array(
          'status' => true,
          'mensaje' => 'Vale!, fecha actualizada.'
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
