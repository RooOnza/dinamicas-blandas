<?php 

    require_once('controller/Canvas.php');

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
        // manejar valores opcionales
        $param = array(
            'desc_canvas' => $_POST['desc_canvas'],
            'tamano_x' => (int)$_POST['tamano_x'],
            'tamano_y' => (int)$_POST['tamano_y'],
            'color' => (isset($_POST['color'])) ? $_POST['color'] : null,
            'estilo' => (isset($_POST['estilo'])) ? $_POST['estilo'] : null,
            'id_status' => (int)$_POST['id_status'],
          );
                
        $Canvas = new Canvas();
        $textos = $Canvas->insertRecord($param);
        echo json_encode($textos);
    }

    // Display Data Function
    function getTable() {
        $Canvas = new Canvas();
        $textos = $Canvas->getTable();
        $value = "";

        if ($textos['status']){
            
            foreach ($textos['data'] as $texto){
                $value.= ' <tr><td class="text-center">'.$texto['id_canvas'].'</td>
                                <td>'.$texto['desc_canvas'].'</td>
                                <td class="text-center">'.$texto['tamano_y'].'</td>
                                <td class="text-center">'.$texto['tamano_x'].'</td>
                                <td class="text-center">'.$texto['color'].'</td>
                                <td class="text-center">'.$texto['desc_status'].'</td>
                                <td class="text-center"> <button class="btn btn-success" id="btn_edit" data-id='.$texto['id_canvas'].'><span class="fa fa-edit"></span></button> </td>
                                <td class="text-center"> <button class="btn btn-danger" id="btn_delete" data-id1='.$texto['id_canvas'].' ><span class="fa fa-trash"></span></button> </td>
                            </tr>';
            }
        }

        //$value.='</table>';

        echo json_encode(['status'=>$textos['status'],'html'=>$value,'vacio'=>$textos['data'],'mensaje'=>$textos['mensaje']]);
    }

    // Get Particular Record
    function getRecord() {
        $param = array('id_canvas' => $_POST['id_canvas']);
        $Canvas = new Canvas();
        $texto = $Canvas->getRecord($param);
        echo json_encode($texto);
    }


    // Update Function
    function updateRecord() {
        $Canvas = new Canvas();
        $texto = $Canvas->updateRecord($_POST);
        echo json_encode($texto);
    }

    function deleteRecord() {
        $param = array('id_canvas' => $_POST['id_canvas'],);                
        $Canvas = new Canvas();
        $textos = $Canvas->deleteRecord($param);
        echo json_encode($textos);
    }

?>
