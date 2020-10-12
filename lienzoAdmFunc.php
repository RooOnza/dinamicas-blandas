<?php 

    require_once('controller/LienzoAdm.php');

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
            'desc_temporada' => $_POST['desc_temporada'],
            'id_tipo' => (int)$_POST['id_tipo'],
            'permanente' => (int)$_POST['permanente'],
          );
                
        $Temporada = new Temporada();
        $tempo = $Temporada->insertRecord($param);
        echo json_encode($tempo);
    }

    function insertRecordDetail() {
        // manejar valores opcionales
        $param = array('id_temporada' => $_POST['id_temporada'],
                        'fecha' => $_POST['fecha'],
                        'id_status' => (int)$_POST['id_status']);

        $Temporada = new Temporada();
        $fecha = $Temporada->insertRecordDetail($param);
        echo json_encode($fecha);
    }

    // Display Data Function
    function getTable() {
        $Temporada = new Temporada();
        $tempos = $Temporada->getTable();
        $value = "";

        if ($tempos['status']){
            
            foreach ($tempos['data'] as $tempo){
                $desc_perma = ($tempo['permanente'] == '1') ? 'Si' : 'No';
                $value.= ' <tr><td class="text-center">'.$tempo['id_temporada'].'</td>
                                <td>'.$tempo['desc_temporada'].'</td>
                                <td class="text-center">'.$tempo['desc_tipo'].'</td>
                                <td class="text-center">'.$desc_perma.'</td>
                                <td class="text-center"> <button class="btn btn-success" id="btn_edit" data-id='.$tempo['id_temporada'].'><span class="fa fa-edit"></span></button> </td>
                                <td class="text-center"> <button class="btn btn-danger" id="btn_delete" data-id1='.$tempo['id_temporada'].' ><span class="fa fa-trash"></span></button> </td>
                            </tr>';
            }
        }

        echo json_encode(['status'=>$tempos['status'],'html'=>$value,'vacio'=>$tempos['data'],'mensaje'=>$tempos['mensaje']]);
    }

    // Display Data Function
    function getChildTable() {
        $param = array('id_temporada' => $_POST['id_temporada']);
        $Temporada = new Temporada();
        $fechas = $Temporada->getChildTable($param);
        $value = "";

        if ($fechas['status']){
            
            foreach ($fechas['data'] as $fecha){
                $value.= ' <tr><td class="text-center">'.$fecha['fecha'].'</td>
                                <td class="text-center">'.$fecha['desc_status'].'</td>
                                <td class="text-center"> <button class="btn btn-success fechas" id="btn_edit" data-id='.$fecha['id_temporada'].' data-fecha="'.$fecha['fecha'].'"><span class="fa fa-edit"></span></button> </td>
                                <td class="text-center"> <button class="btn btn-danger fechas" id="btn_delete" data-id1='.$fecha['id_temporada'].' data-fecha1="'.$fecha['fecha'].'"><span class="fa fa-trash"></span></button> </td>
                            </tr>';
            }
        }

        echo json_encode(['status'=>$fechas['status'],'html'=>$value,'vacio'=>$fechas['data'],'mensaje'=>$fechas['mensaje']]);
    }

    // Get Particular Record
    function getRecord() {
        $param = array('id_temporada' => $_POST['id_temporada']);
        $Temporada = new Temporada();
        $tempo = $Temporada->getRecord($param);
        echo json_encode($tempo);
    }

    function getRecordDetail() {
        $param = array('id_temporada' => $_POST['id_temporada'],'fecha' => $_POST['fecha']);
        $Temporada = new Temporada();
        $fecha = $Temporada->getRecordDetail($param);
        echo json_encode($fecha);
    }

    // Update Function
    function updateRecord() {
        $Temporada = new Temporada();
        $tempo = $Temporada->updateRecord($_POST);
        echo json_encode($tempo);
    }

    function updateRecordDetail() {
        $Temporada = new Temporada();
        $fecha = $Temporada->updateRecordDetail($_POST);
        echo json_encode($fecha);
    }

    function deleteRecord() {
        $param = array('id_temporada' => $_POST['id_temporada'],);                
        $Temporada = new Temporada();
        $tempos = $Temporada->deleteRecord($param);
        echo json_encode($tempos);
    }

    function deleteRecordDetail() {
        $param = array('id_temporada' => $_POST['id_temporada'],'fecha' => $_POST['fecha'],);
        $Temporada = new Temporada();
        $fecha = $Temporada->deleteRecordDetail($param);
        echo json_encode($fecha);
    }

?>
