<?php 

    require_once('controller/ConTexto.php');

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
    }

    // Insert Record Function
    function insertRecord()
    {
        $param = array(
            'nombre' => $_POST['nombre'],
            'texto' => $_POST['texto'],
            'ntop' => $_POST['ntop'],
            'nleft' => $_POST['nleft'],
            'nheight' => $_POST['nheight'],
            'nwidth' => $_POST['nwidth'],
            'status_id' => $_POST['status_id'],
          );
                
        $ConTexto = new ConTexto();
        $textos = $ConTexto->insertRecord($param);
        echo json_encode($textos);
    }

    // Display Data Function
    function getTable() {
        $ConTexto = new ConTexto();
        $textos = $ConTexto->getTable();
        $value = "";

        /*
        $value = '<table class="table table-bordered">
        <thead><tr>
            <th class="text-center">Id</td>
            <th>Nombre</td>
            <th>Texto</td>
            <th class="text-center">Top</td>
            <th class="text-center">Left</td>
            <th class="text-center">Height</td>
            <th class="text-center">Width</td>
            <th class="text-center">Estatus</td>
            <th class="text-center">Created at</td>
            <th class="text-center"> Edit </td>
            <th class="text-center"> Delete </td>
        </tr></thead>';
        */
        if ($textos['status']){
            
            foreach ($textos['data'] as $texto){
                $value.= ' <tr><td class="text-center">'.$texto['id'].'</td>
                                <td>'.$texto['nombre'].'</td>
                                <td>'.$texto['texto'].'</td>
                                <td class="text-center">'.$texto['ntop'].'</td>
                                <td class="text-center">'.$texto['nleft'].'</td>
                                <td class="text-center">'.$texto['nheight'].'</td>
                                <td class="text-center">'.$texto['nwidth'].'</td>
                                <td class="text-center">'.$texto['statusDesc'].'</td>
                                <td class="text-center">'.$texto['created_at'].'</td>
                                <td class="text-center"> <button class="btn btn-success" id="btn_edit" data-id='.$texto['id'].'><span class="fa fa-edit"></span></button> </td>
                                <td class="text-center"> <button class="btn btn-danger" id="btn_delete" data-id1='.$texto['id'].' ><span class="fa fa-trash"></span></button> </td>
                            </tr>';
            }
        }

        //$value.='</table>';

        echo json_encode(['status'=>$textos['status'],'html'=>$value,'vacio'=>$textos['data'],'mensaje'=>$textos['mensaje']]);
    }

    // Get Particular Record
    function getRecord() {
        $param = array('id' => $_POST['id']);
        $ConTexto = new ConTexto();
        $texto = $ConTexto->getRecord($param);
        echo json_encode($texto);
    }


    // Update Function
    function updateRecord() {
        $ConTexto = new ConTexto();
        $texto = $ConTexto->updateRecord($_POST);
        echo json_encode($texto);
    }

    function deleteRecord() {
        $param = array('id' => $_POST['id'],);                
        $ConTexto = new ConTexto();
        $textos = $ConTexto->deleteRecord($param);
        echo json_encode($textos);
    }

?>
