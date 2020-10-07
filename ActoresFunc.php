<?php 

    require_once('controller/Actores.php');

    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST) && count($_POST) > 0) {
                switch ($_POST['accion']) {
                    case 'getTable':
                        getTable();
                        break;
                    case 'insertRecord':
                        insertRecord();
                        break;
                    case 'getRecord':
                        getRecord();
                        break;
                    case 'updateRecord':
                        updateRecord();
                        break;
                    case 'deleteRecord':
                        deleteRecord();
                        break;
                    default:
                }
            }
        }
    }
    //catch exception
    catch(Exception $e) {
        echo json_encode(['status'=>false,'mensaje'=>'Oops! '. $e->getMessage()]);
        //echo json_encode(array('status' => false, 'mensaje' => 'Oops! '. $e->getMessage()));
    }

    // Insert Record Function
    function insertRecord()
    {
        $Actores = new Actores();
        $actores = $Actores->insertRecord($_POST);
        echo json_encode($actores);
    }

    // Display Data Function
    function getTable() {
        $Actores = new Actores();
        $actores = $Actores->getTable();
        $value = "";

        if ($actores['status']){
            foreach ($actores['data'] as $actor){
                $value.= ' <tr><td class="text-center">'.$actor['id_actor'].'</td>
                                <td>'.$actor['desc_actor'].'</td>
                                <td class="text-center">'.$actor['desc_tipo'].'</td>
                                <td class="text-center">'.$actor['desc_status'].'</td>
                                <td class="text-center"> <button class="btn btn-success" id="btn_edit" data-id='.$actor['id_actor'].' data-id_tipo='.$actor['id_tipo'].'><span class="fa fa-edit"></span></button> </td>
                                <td class="text-center"> <button class="btn btn-danger" id="btn_delete" data-id1='.$actor['id_actor'].' data-id_tipo1='.$actor['id_tipo'].'><span class="fa fa-trash"></span></button> </td>
                            </tr>';
            }
        }

        echo json_encode(['status'=>$actores['status'],'html'=>$value,'vacio'=>$actores['data'],'mensaje'=>$actores['mensaje']]);
    }

    // Get Particular Record
    function getRecord() {
        $Actores = new Actores();
        $actor = $Actores->getRecord($_POST);
        echo json_encode($actor);
    }


    // Update Function
    function updateRecord() {
        $Actores = new Actores();
        $actor = $Actores->updateRecord($_POST);
        echo json_encode($actor);
    }

    function deleteRecord() {
        $Actores = new Actores();
        $actores = $Actores->deleteRecord($_POST);
        echo json_encode($actores);
    }

?>
