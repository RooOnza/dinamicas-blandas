<?php 

    require_once('controller/Obra.php');

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
                    case 'getListaEscenas':
                        getListaEscenas();
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
        // manejar valores opcionales
        $param = array(
            'desc_obra' => $_POST['desc_obra'],
            'id_status' => $_POST['id_status'],
          );
                
        $obras = new Obra();
        $obra = $obras->insertRecord($param);
        echo json_encode($obra);
    }

    function insertRecordDetail() {
        // manejar valores opcionales
        $param = array('id_obra' => $_POST['id_obra'],
                        'id_escena' => $_POST['id_escena'],
                        'orden' => $_POST['orden']);

        $obras = new Obra();
        $escena = $obras->insertRecordDetail($param);
        echo json_encode($escena);
    }

    // Display Data Function
    function getTable() {
        $Obras = new Obra();
        $obras = $Obras->getTable();
        $value = "";

        if ($obras['status']){
            
            foreach ($obras['data'] as $obra){
                $value.= ' <tr><td class="text-center">'.$obra['id_obra'].'</td>
                                <td>'.$obra['desc_obra'].'</td>
                                <td class="text-center">'.$obra['desc_status'].'</td>
                                <td class="text-center"> <button class="btn btn-success" id="btn_edit" data-id='.$obra['id_obra'].'><span class="fa fa-edit"></span></button> </td>
                                <td class="text-center"> <button class="btn btn-danger" id="btn_delete" data-id1='.$obra['id_obra'].' ><span class="fa fa-trash"></span></button> </td>
                            </tr>';
            }
        }

        echo json_encode(['status'=>$obras['status'],'html'=>$value,'vacio'=>$obras['data'],'mensaje'=>$obras['mensaje']]);
    }

    // Display Data Function
    function getChildTable() {
        $param = array('id_obra' => $_POST['id_obra']);
        $obras = new Obra();
        $escenas = $obras->getChildTable($param);
        $value = "";

        if ($escenas['status']){
            
            foreach ($escenas['data'] as $escena){
                $value.= ' <tr><td class="text-center">'.$escena['desc_escena'].'</td>
                                <td class="text-center">'.$escena['orden'].'</td>
                                <td class="text-center"> <button class="btn btn-success escenas" id="btn_edit" data-id='.$escena['id_obra'].' data-id_escena="'.$escena['id_escena'].'"><span class="fa fa-edit"></span></button> </td>
                                <td class="text-center"> <button class="btn btn-danger escenas" id="btn_delete" data-id1='.$escena['id_obra'].' data-id_escena1="'.$escena['id_escena'].'"><span class="fa fa-trash"></span></button> </td>
                            </tr>';
            }
        }

        echo json_encode(['status'=>$escenas['status'],'html'=>$value,'vacio'=>$escenas['data'],'mensaje'=>$escenas['mensaje']]);
    }

    // Get Particular Record
    function getRecord() {
        $param = array('id_obra' => $_POST['id_obra']);
        $Obras = new Obra();
        $obra = $Obras->getRecord($param);
        echo json_encode($obra);
    }

    function getRecordDetail() {
        $param = array('id_obra' => $_POST['id_obra'],'id_escena' => $_POST['id_escena']);
        $Obras = new Obra();
        $escena = $Obras->getRecordDetail($param);
        echo json_encode($escena);
    }
    
    function getListaEscenas() {
        $id = $_POST['id'];
        $sel_ini = ($id == '0') ? 'selected' : '';
        $value = '<option value=0 ' . $sel_ini . '>Seleccione estatus...</option>';

        $Obras = new Obra();
        $escenas = $Obras->getLista();
        
        if ($escenas['status']){
            foreach ($escenas['data'] as $escena){
                $seleccionado = ($id == $escena['id_escena']) ? 'selected' : '';
                $value.= '<option value='.$escena['id_escena'].' '.$seleccionado.'>'.$escena['desc_escena'].'</option>';
            }
        }

        echo json_encode(['status'=>$escenas['status'],'options'=>$value,'vacio'=>$escenas['data'],'mensaje'=>$escenas['mensaje']]);
    }

    // Update Function
    function updateRecord() {
        $Obras = new Obra();
        $obra = $Obras->updateRecord($_POST);
        echo json_encode($obra);
    }

    function updateRecordDetail() {
        $Obras = new Obra();
        $escena = $Obras->updateRecordDetail($_POST);
        echo json_encode($escena);
    }

    function deleteRecord() {
        $param = array('id_obra' => $_POST['id_obra'],);                
        $Obras = new Obra();
        $obras = $Obras->deleteRecord($param);
        echo json_encode($obras);
    }

    function deleteRecordDetail() {
        $param = array('id_obra' => $_POST['id_obra'],'id_escena' => $_POST['id_escena'],);
        $Obras = new Obra();
        $escena = $Obras->deleteRecordDetail($param);
        echo json_encode($escena);
    }

?>
