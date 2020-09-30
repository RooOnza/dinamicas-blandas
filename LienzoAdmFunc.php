<?php 

    require_once('controller/LienzoAdm.php');

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
            'name' => $_POST['UName'],
            'email' => $_POST['UEmail'],
          );
                
        $lienzoadm = new LienzoAdm();
        $lienzos = $lienzoadm->insertRecord($param);
        echo json_encode($lienzos);
    }

    // Display Data Function
    function getTable() {
        $lienzoadm = new LienzoAdm();
        $lienzos = $lienzoadm->getTable();
        $value = "";

        if ($lienzos['status']){
            $value = '<table class="table table-bordered">
                        <thead><tr>
                            <th class="text-center"> User ID </td>
                            <th> User User </td>
                            <th> User Email</td>
                            <th class="text-center"> Edit </td>
                            <th class="text-center"> Delete </td>
                        </tr></thead>';
            
            foreach ($lienzos['data'] as $lienzo){
                $value.= ' <tr>
                                <td class="text-center"> '.$lienzo['ID'].' </td>
                                <td> '.$lienzo['UserName'].' </td>
                                <td> '.$lienzo['UserEmail'].'</td>
                                <td class="text-center"> <button class="btn btn-success" id="btn_edit" data-id='.$lienzo['ID'].'><span class="fa fa-edit"></span></button> </td>
                                <td class="text-center"> <button class="btn btn-danger" id="btn_delete" data-id1='.$lienzo['ID'].'><span class="fa fa-trash"></span></button> </td>
                            </tr>';
            }

            $value.='</table>';
        }

        echo json_encode(['status'=>$lienzos['status'],'html'=>$value]);
    }

    // Get Particular Record
    function getRecord() {
        $param = array('id' => $_POST['UserID']);
        $lienzoadm = new LienzoAdm();
        $lienzo = $lienzoadm->getRecord($param);
        echo json_encode($lienzo);
    }


    // Update Function
    function updateRecord() {
        $Update_ID = $_POST['U_ID'];
        $Update_User =$_POST['U_User'];
        $Update_Email = $_POST['U_Email'];

        $param = array(
            'id' => $_POST['U_ID'],
            'name' => $_POST['U_User'],
            'email' => $_POST['U_Email'],
        );                

        $lienzoadm = new LienzoAdm();
        $lienzo = $lienzoadm->updateRecord($param);
        echo json_encode($lienzo);
    }

    function deleteRecord() {
        $param = array('id' => $_POST['Del_ID'],);                
        $lienzoadm = new LienzoAdm();
        $lienzos = $lienzoadm->deleteRecord($param);
        echo json_encode($lienzos);
    }

?>





