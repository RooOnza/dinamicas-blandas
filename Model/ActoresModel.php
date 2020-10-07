<?php
  require_once(__dir__ . '/Db.php');
  class ActoresModel extends Db {

    /**
      * @param null
      * @return array
      * @desc Returns an array of actores...
    **/

    public function getTable() :array{
      $this->query("SELECT t1.*, t2.desc_status, t3.desc_tipo 
                    FROM db_actores t1 
                    INNER JOIN db_status_gral t2 ON t1.id_status = t2.id_status
                    INNER JOIN db_tipo_actores t3 ON t1.id_tipo = t3.id_tipo
                    ORDER BY id_actor;");
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
      $this->query("INSERT INTO db_actores (desc_actor, id_tipo, estilo, id_status) 
                    VALUES (:desc_actor, :id_tipo, :estilo, :id_status)");

      $this->bind('desc_actor', $params['desc_actor']);
      $this->bind('id_tipo', $params['id_tipo']);
      $this->bind('estilo', $params['estilo']);
      $this->bind('id_status', $params['id_status']);

      if ($this->execute()) {
        $id_actor = $this->getActorId();
        if ($id_actor > -1){
          $Response = $this->insertTipo($id_actor, $params);
        } else {
          $Response = array('status' => false,'mensaje' => 'Sorry, there was an error getting the max id from Actors table.');
        }        
      } else {
        $Response = array('status' => false,'mensaje' => 'Sorry, An unexpected error occurred, request could not be completed.');
      }
      return $Response;
    }

    private function getActorId():int {
      $this->query("SELECT MAX(id_actor) AS id FROM db_actores;");
      $this->execute();
      $Actor = $this->fetch();
      if ($Actor){
        if (count($Actor) > 0) {
          $Response = $Actor['id'];
        } else {
          $Response = -1;
        }
      } else {
        $Response = -1;
      }
      return $Response;
    }

    private function insertTipo(int $id_actor, array $params): array {
      // Condicionar query por tipo
      $tipo = $params['id_tipo'];
      // Punto
      if ($tipo == 1) {
        $this->query("INSERT INTO db_puntos (id_actor, diametro, color, contenido) 
                      VALUES (:id_actor, :diametro, :color, :contenido);");
        $this->bind('id_actor', $id_actor);
        $this->bind('diametro', $params['p_diametro']);
        $this->bind('color', $params['p_color']);
        $this->bind('contenido', $params['p_contenido']);
      }
      // Rectángulo
      if ($tipo == 2) {
        $this->query("INSERT INTO db_rectangulos (id_actor, tamano_x, tamano_y, color, contenido) 
                      VALUES (:id_actor, :tamano_x, :tamano_y, :color, :contenido);");
        $this->bind('id_actor', $id_actor);
        $this->bind('tamano_x', $params['r_tamano_x']);
        $this->bind('tamano_y', $params['r_tamano_y']);
        $this->bind('color', $params['r_color']);
        $this->bind('contenido', $params['r_contenido']);
      }

      if ($this->execute()) {
        $Response = array('status' => true, 'mensaje' => 'Vale!, actor creado.');
      } else {
        $Response = array('status' => false, 'mensaje' => 'Sorry, An unexpected error occurred, your request could not be completed.');
      }
      return $Response;
    }

    public function getRecord(array $params) :array{
      // Condicionar query por tipo
      $tipo = $params['id_tipo'];
      // Punto
      if ($tipo == 1) {
        $this->query("SELECT t1.*, t2.* FROM db_actores t1 
                      INNER JOIN db_puntos t2 ON t1.id_actor = t2.id_actor 
                      WHERE t1.id_actor=:id_actor;");
      }
      // Rectángulo
      if ($tipo == 2) {
        $this->query("SELECT t1.*, t2.* FROM db_actores t1 
                      INNER JOIN db_rectangulos t2 ON t1.id_actor = t2.id_actor 
                      WHERE t1.id_actor=:id_actor;");
      }

      $this->bind('id_actor', $params['id_actor']);
      $this->execute();
      $Actor = $this->fetch();

      if ($Actor){
        if (count($Actor) > 0) {
          $Response = array(
            'status' => true,
            'data' => $Actor
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
      // Condicionar query por tipo
      $tipo = $params['id_tipo'];
      // Punto
      if ($tipo == 1) {
        $this->query("DELETE FROM db_puntos WHERE id_actor=:id_actor;
                      DELETE FROM db_actores WHERE id_actor=:id_actor");
      }
      // Rectangulo
      if ($tipo == 2) {
        $this->query("DELETE FROM db_rectangulos WHERE id_actor=:id_actor;
                      DELETE FROM db_actores WHERE id_actor=:id_actor");
      }

      $this->bind('id_actor', $params['id_actor']);

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
      // Condicionar query por tipo
      $tipo = $params['id_tipo'];
      // Punto
      if ($tipo == 1) {
        $this->query("UPDATE db_actores 
                      SET desc_actor=:desc_actor, id_tipo=:id_tipo, estilo=:estilo, id_status=:id_status 
                      WHERE id_actor = :id_actor;
                      DELETE FROM db_puntos WHERE id_actor = :id_actor; 
                      DELETE FROM db_rectangulos WHERE id_actor = :id_actor; 
                      INSERT INTO db_puntos (id_actor, diametro, color, contenido) 
                      VALUES (:id_actor, :diametro, :color, :contenido);");

        $this->bind('diametro', $params['p_diametro']);
        $this->bind('color', $params['p_color']);
        $this->bind('contenido', $params['p_contenido']);
      }
      // Rectángulo
      if ($tipo == 2) {
        $this->query("UPDATE db_actores 
                      SET desc_actor=:desc_actor, id_tipo=:id_tipo, estilo=:estilo, id_status=:id_status 
                      WHERE id_actor = :id_actor;
                      DELETE FROM db_puntos WHERE id_actor = :id_actor; 
                      DELETE FROM db_rectangulos WHERE id_actor = :id_actor; 
                      INSERT INTO db_rectangulos (id_actor, tamano_x, tamano_y, color, contenido) 
                      VALUES (:id_actor, :tamano_x, :tamano_y, :color, :contenido);");

        $this->bind('tamano_x', $params['r_tamano_x']);
        $this->bind('tamano_y', $params['r_tamano_y']);
        $this->bind('color', $params['r_color']);
        $this->bind('contenido', $params['r_contenido']);
      }


      $this->bind('id_actor', $params['id_actor']);
      $this->bind('desc_actor', $params['desc_actor']);
      $this->bind('id_tipo', $params['id_tipo']);
      $this->bind('estilo', $params['estilo']);
      $this->bind('id_status', $params['id_status']);

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
