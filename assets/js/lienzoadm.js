$(document).ready(function() {
    insertRecord();
    getTable();
    getRecord();
    updateRecord();
    deleteRecord();
})

// Insert Record in the Database
function insertRecord() {
   $(document).on('click', '#btn_register', function() {
        var User = $('#UserName').val();
        var Email = $('#UserEmail').val();

        if(User == "" || Email=="") {
            $('#message').html('Favor de capturar todos los campos');
            $('#message').addClass('alert alert-warning');
        } else {
            $.ajax({
                url : 'LienzoAdmFunc.php',
                method: 'post',
                data:{accion:'insertRecord',UName:User,UEmail:Email},
                success: function(data) {
                    data = $.parseJSON(data);
                    if(data.status) {
                        $('#status').html(data.data);
                        $('#status').addClass('alert alert-success');
                        getTable();
                        $('#Registration').modal('hide');
                    } else {
                        $('#status').html(data.data);
                        $('#status').addClass('alert alert-danger');
                    }
                }
            })
        }
    })

   $(document).on('click','#btn_close',function() {
       $('form').trigger('reset');
   })   
}

// Display table
function getTable() {
    $.ajax({
        url: 'LienzoAdmFunc.php',
        method: 'post',
        data:{accion:'getTable'},
        success: function(data) {
            data = $.parseJSON(data);
            if(data.status) {
                $('#table').html(data.html);
            } else {
                $('#status').html(data.mensaje);
                $('#status').addClass('alert alert-danger');
            }
        }
    })
}

//Get Particular Record
function getRecord()
{
    $(document).on('click','#btn_edit',function() {
        $('#up-message').html('');
        $('#up-message').removeClass('alert alert-warning');
        var ID = $(this).attr('data-id');
        $.ajax({
            url : 'LienzoAdmFunc.php',
            method: 'post',
            data:{accion:'getRecord',UserID:ID},
            dataType: 'JSON',
            success: function(data){
                if(data.status) {
                    $('#Up_User_ID').val(data.data['ID']);
                    $('#Up_UserName').val(data.data['UserName']);
                    $('#Up_UserEmail').val(data.data['UserEmail']);
                    $('#update').modal('show');                   
                }
            }               
        })
    })
}

// Update Record 
function updateRecord() {    
    $(document).on('click','#btn_update',function() {
        var UpdateID = $('#Up_User_ID').val();
        var UpdateUser = $('#Up_UserName').val();
        var UpdateEmail = $('#Up_UserEmail').val();

        if(UpdateUser=="" || UpdateEmail=="") {
            $('#up-message').html('Favor de capturar todos los campos');
            $('#up-message').addClass('alert alert-warning');
            //$('#update').modal('show');
        } else {
            $.ajax({
                url: 'LienzoAdmFunc.php',
                method: 'post',
                data:{accion:'updateRecord',U_ID:UpdateID,U_User:UpdateUser,U_Email:UpdateEmail},
                success: function(data) {
                    data = $.parseJSON(data);
                    if(data.status) {
                        $('#status').html(data.data);
                        $('#status').addClass('alert alert-success');
                        getTable();
                        $('#update').modal('hide');
                    } else {
                        $('#status').html(data.data);
                        $('#status').addClass('alert alert-danger');
                    }
                }
            })
        }
        
    })
}

// Delete Function
function deleteRecord() {
    $(document).on('click','#btn_delete',function() {
        var Delete_ID = $(this).attr('data-id1');
        $('#delete').modal('show');

        $(document).on('click','#btn_delete_record',function() {
            $.ajax({
                url : 'LienzoAdmFunc.php',
                method: 'post',
                data:{accion:'deleteRecord',Del_ID:Delete_ID},
                success: function(data) {
                    data = $.parseJSON(data);
                    if(data.status) {
                        $('#status').html(data.data);
                        $('#status').addClass('alert alert-success');
                        getTable();
                        $('form').trigger('reset');
                        $('#delete').modal('hide');
                    } else {
                        $('#status').html(data.data);
                        $('#status').addClass('alert alert-danger');
                    }
                }
            })
        })
    })
}




