$(document).ready(function() {
    insertRecord();
    getTable();
    getRecord();
    updateRecord();
    deleteRecord();
})

// Insert Record in the Database
function insertRecord() {

    $('button#btn_add').on('click', function() {
        $('#status').html('');
        $('#status').removeClass('alert alert-warning alert-danger alert-success');
        $('#message').html('');
        $('#message').removeClass('alert alert-warning');
        $('form').trigger('reset');
        $('#add_modal').modal('show');
        //$("#nombre").focus();
    });

    $(document).on('click', '#btn_register', function() {

        var nombre = $('#nombre').val();
        var texto = $('#texto').val();
        var ntop = $('#ntop').val();
        var nleft = $('#nleft').val();
        var nheight = $('#nheight').val();
        var nwidth = $('#nwidth').val();
        var status_id = $('#status_id').val();

        // Validar status
        var datosValidos = validateData(nombre, texto, ntop, nleft, nheight, nwidth, status_id);
        if (datosValidos.status){
            $.ajax({
                url : 'conTextoFunc.php',
                method: 'post',
                data:{accion:'insertRecord',nombre:nombre,texto:texto,ntop:ntop,nleft:nleft,
                        nheight:nheight,nwidth:nwidth,status_id:status_id},
                success: function(data) {
                    data = $.parseJSON(data);
                    if(data.status) {
                        $('#status').html(data.mensaje);
                        $('#status').addClass('alert alert-success');
                        getTable();
                        $('#add_modal').modal('hide');

                    } else {
                        $('#status').html(data.mensaje);
                        $('#status').addClass('alert alert-danger');
                    }
                }
            })
        } else {
            $('#message').html(datosValidos.mensaje);
            $('#message').addClass('alert alert-warning');
        }
    })

   $(document).on('click','#btn_close',function() {
       $('form').trigger('reset');
   })   
}

function validateData(nombre, texto, ntop, nleft, nheight, nwidth, status_id){
    var status = true;
    var mensaje = 'Datos OK';
    if(nombre == '' || texto == '' || ntop == '' || nleft == '' || nheight == '' || nwidth == '' || status_id == '') {
        status = false;
        mensaje = 'Favor de capturar todos los campos';
    } else {
        if (status_id == 0){
            status = false;
            mensaje = 'Favor de seleccionar un estatus';    
        }
    }
    return {status:status,mensaje:mensaje};
}

// Display table
function getTable() {
    $.ajax({
        url: 'conTextoFunc.php',
        method: 'post',
        data:{accion:'getTable'},
        success: function(data) {
            data = $.parseJSON(data);
            if(data.status) {
                $('#table').html(data.html);
            } else {
                $('#status').html(data.mensaje);
                if (data.vacio){
                    //$('#table').html('<tr><td>nada</td></tr>');
                    $('#table').html('&nbsp;');
                    $('#status').addClass('alert alert-success');
                } else {
                    $('#status').addClass('alert alert-danger');
                }
            }
        }
    })
}

//Get Particular Record
function getRecord()
{
    $(document).on('click','#btn_edit',function() {
        $('#status').html('');
        $('#status').removeClass('alert alert-warning alert-danger alert-success');
        $('#up-message').html('');
        $('#up-message').removeClass('alert alert-warning');
        var id = $(this).attr('data-id');
        $.ajax({
            url : 'conTextoFunc.php',
            method: 'post',
            data:{accion:'getRecord',id:id},
            dataType: 'JSON',
            success: function(data){
                if(data.status) {
                    $('#up_id').val(data.data['id']);
                    $('#up_nombre').val(data.data['nombre']);
                    $('#up_texto').val(data.data['texto']);
                    $('#up_ntop').val(data.data['ntop']);
                    $('#up_nleft').val(data.data['nleft']);
                    $('#up_nheight').val(data.data['nheight']);
                    $('#up_nwidth').val(data.data['nwidth']);
                    $('#up_status_id').val(data.data['status_id']);
                    $('#update').modal('show');
                } else {
                    $('#status').html(data.mensaje);
                    $('#status').addClass('alert alert-danger');
                }
            }               
        })
    })
}

// Update Record 
function updateRecord() {    
    $(document).on('click','#btn_update',function() {
        var id = $('#up_id').val();
        var nombre = $('#up_nombre').val();
        var texto = $('#up_texto').val();
        var ntop = $('#up_ntop').val();
        var nleft = $('#up_nleft').val();
        var nheight = $('#up_nheight').val();
        var nwidth = $('#up_nwidth').val();
        var status_id = $('#up_status_id').val();

        var datosValidos = validateData(nombre, texto, ntop, nleft, nheight, nwidth, status_id);
        if (datosValidos.status){
            $.ajax({
                url: 'conTextoFunc.php',
                method: 'post',
                data:{accion:'updateRecord',id:id,nombre:nombre,texto:texto,ntop:ntop,nleft:nleft,
                        nheight:nheight,nwidth:nwidth,status_id:status_id},
                success: function(data) {
                    data = $.parseJSON(data);
                    if(data.status) {
                        $('#status').html(data.mensaje);
                        $('#status').addClass('alert alert-success');
                        getTable();
                        $('#update').modal('hide');
                    } else {
                        $('#status').html(data.mensaje);
                        $('#status').addClass('alert alert-danger');
                    }
                }
            })
        } else {
            $('#up-message').html(datosValidos.mensaje);
            $('#up-message').addClass('alert alert-warning');
        }
    })
}

// Delete Function
function deleteRecord() {
    $(document).on('click','#btn_delete',function() {
        var id = $(this).attr('data-id1');

        $('#status').html('');
        $('#status').removeClass('alert alert-warning alert-danger alert-success');
        $('#delete').modal('show');

        $(document).on('click','#btn_delete_record',function() {
            $.ajax({
                url : 'conTextoFunc.php',
                method: 'post',
                data:{accion:'deleteRecord',id:id},
                success: function(data) {
                    data = $.parseJSON(data);
                    if(data.status) {
                        $('#status').html(data.mensaje);
                        $('#status').addClass('alert alert-success');
                        getTable();
                        $('form').trigger('reset');
                        $('#delete').modal('hide');
                    } else {
                        $('#status').html(data.mensaje);
                        $('#status').addClass('alert alert-danger');
                    }
                }
            })
        })    
    })
}




