<?php 

    require_once('controller/Escenas.php');

    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST) && count($_POST) > 0) {
                switch ($_POST['accion']) {
                    case 'getTable':
                        getTable();
                        break;
                    case 'getChildTable':
                        getChildTable();
                        break;
                    case 'insertRecord':
                        insertRecord();
                        break;
                    case 'insertRecordDetail':
                        insertRecordDetail();
                        break;
                    case 'getRecord':
                        getRecord();
                        break;
                    case 'getRecordDetail':
                        getRecordDetail();
                        break;
                    case 'getListaActores':
                        getListaActores();
                        break;                            
                    case 'getListaCanvas':
                        getListaCanvas();
                        break;
                    case 'getOrdenExistente':
                        getOrdenExistente();
                        break;
                    case 'updateRecord':
                        updateRecord();
                        break;
                    case 'updateRecordDetail':
                        updateRecordDetail();
                        break;
                    case 'deleteRecord':
                        deleteRecord();
                        break;
                    case 'deleteRecordDetail':
                        deleteRecordDetail();
                        break;
                    default:
                }
            }
        }
    }
    //catch exception
    catch(Exception $e) {
        echo json_encode(['status'=>false,'mensaje'=>'Oops! '. $e->getMessage()]);
    }

    // Insert Record Function
    function insertRecord()
    {
        $escenas = new Escenas();
        $escena = $escenas->insertRecord($_POST);
        echo json_encode($escena);
    }

    function insertRecordDetail() {
        $escenas = new Escenas();
        $escena = $escenas->insertRecordDetail($_POST);
        echo json_encode($escena);
    }

    // Display Data Function
    function getTable() {
        $Escenas = new Escenas();
        $escenas = $Escenas->getTable();
        $value = "";

        if ($escenas['status']){
            
            foreach ($escenas['data'] as $escena){
                $value.= ' <tr><td class="text-center">'.$escena['id_escena'].'</td>
                                <td>'.$escena['desc_escena'].'</td>
                                <td class="text-center">'.$escena['desc_tipo'].'</td>
                                <td>'.$escena['desc_canvas'].'</td>
                                <td class="text-center">'.$escena['tiempo'].'</td>
                                <td class="text-center">'.$escena['desc_status'].'</td>
                                <td class="text-center"> <button class="btn btn-success" id="btn_edit" data-id='.$escena['id_escena'].'><span class="fa fa-edit"></span></button> </td>
                                <td class="text-center"> <button class="btn btn-danger" id="btn_delete" data-id1='.$escena['id_escena'].' ><span class="fa fa-trash"></span></button> </td>
                            </tr>';
            }
        }

        echo json_encode(['status'=>$escenas['status'],'html'=>$value,'vacio'=>$escenas['data'],'mensaje'=>$escenas['mensaje']]);
    }

    // Display Data Function
    function getChildTable() {
        $param = array('id_escena' => $_POST['id_escena']);
        $escenas = new Escenas();
        $escenas = $escenas->getChildTable($param);
        $value = "";

        if ($escenas['status']){
            
            foreach ($escenas['data'] as $escena){
                $value.= ' <tr><td>'.$escena['desc_actor'].'</td>
                                <td class="text-center">'.$escena['desc_tipo'].'</td>
                                <td class="text-center">'.$escena['posicion_x'].'</td>
                                <td class="text-center">'.$escena['posicion_y'].'</td>
                                <td class="text-center">'.$escena['permanente'].'</td>
                                <td class="text-center">'.$escena['tiempo_ini'].'</td>
                                <td class="text-center">'.$escena['tiempo_fin'].'</td>
                                <td class="text-center">'.$escena['orden'].'</td>
                                <td class="text-center"> <button class="btn btn-success escenas" id="btn_edit" data-id="'.$escena['id_actor'].'" data-id_escena="'.$escena['id_escena'].'" data-orden="'.$escena['orden'].'"><span class="fa fa-edit"></span></button> </td>
                                <td class="text-center"> <button class="btn btn-danger escenas" id="btn_delete" data-id1="'.$escena['id_actor'].'" data-id_escena1="'.$escena['id_escena'].'" data-orden1="'.$escena['orden'].'"><span class="fa fa-trash"></span></button> </td>
                            </tr>';
            }
        }

        echo json_encode(['status'=>$escenas['status'],'html'=>$value,'vacio'=>$escenas['data'],'mensaje'=>$escenas['mensaje']]);
    }

    // Get Particular Record
    function getRecord() {
        $Escenas = new Escenas();
        $escena = $Escenas->getRecord($_POST);
        echo json_encode($escena);
    }

    function getRecordDetail() {
        $Escenas = new Escenas();
        $escena = $Escenas->getRecordDetail($_POST);
        echo json_encode($escena);
    }
    
    function getListaActores() {
        $id_tipo = $_POST['id_tipo'];
        $id = $_POST['id'];
        $sel_ini = ($id == '0') ? 'selected' : '';
        $value = '<option value=0 ' . $sel_ini . '>Seleccione actor...</option>';

        $Actores = new Escenas();
        $actores = $Actores->getListaActores($id_tipo);
        
        if ($actores['status']){
            foreach ($actores['data'] as $actor){
                $seleccionado = ($id == $actor['id_actor']) ? 'selected' : '';
                $value.= '<option value='.$actor['id_actor'].' '.$seleccionado.'>'.$actor['desc_actor'].'</option>';
            }
        }

        echo json_encode(['status'=>$actores['status'],'options'=>$value,'vacio'=>$actores['data'],'mensaje'=>$actores['mensaje']]);
    }

    function getListaCanvas() {
        $id = $_POST['id'];
        $sel_ini = ($id == '0') ? 'selected' : '';
        $value = '<option value=0 ' . $sel_ini . '>Seleccione lienzo...</option>';

        $Canvas = new Escenas();
        $canvas = $Canvas->getListaCanvas();
        
        if ($canvas['status']){
            foreach ($canvas['data'] as $canva){
                $seleccionado = ($id == $canva['id_canvas']) ? 'selected' : '';
                $value.= '<option value='.$canva['id_canvas'].' '.$seleccionado.'>'.$canva['desc_canvas'].'</option>';
            }
        }

        echo json_encode(['status'=>$canvas['status'],'options'=>$value,'vacio'=>$canvas['data'],'mensaje'=>$canvas['mensaje']]);
    }

    function getOrdenExistente() {
        $Escenas = new Escenas();
        $escena = $Escenas->getOrdenExistente($_POST);
        echo json_encode($escena);
    }
  
    // Update Function
    function updateRecord() {
        $Escenas = new Escenas();
        $escena = $Escenas->updateRecord($_POST);
        echo json_encode($escena);
    }

    function updateRecordDetail() {
        $Escenas = new Escenas();
        $escena = $Escenas->updateRecordDetail($_POST);
        echo json_encode($escena);
    }

    function deleteRecord() {
        $Escenas = new Escenas();
        $escenas = $Escenas->deleteRecord($_POST);
        echo json_encode($escenas);
    }

    function deleteRecordDetail() {
        $Escenas = new Escenas();
        $escena = $Escenas->deleteRecordDetail($_POST);
        echo json_encode($escena);
    }

?>
