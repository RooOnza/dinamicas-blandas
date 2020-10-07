$(document).ready(function() {
    addRecord();
    saveRecord();
    getTable();
    getRecord();
    deleteRecord();
})

// Save (add / delete) Record in the Database
function saveRecord() {

    $(document).on('click', '#btn_register', function() {
        switch ($('#modal_accion').val()){
            case 'add':
                insertRecord();
                break;
            case 'update':
                updateRecord();
            break;
        }
    
    });

    $(document).on('click','#btn_close',function() {
        $('form').trigger('reset');
    })   
 }

function addRecord() {

    $('button#btn_add').on('click', function() {
        $('#status').html('');
        $('#status').removeClass('alert alert-warning alert-danger alert-success');
        $('#message').html('');
        $('#message').removeClass('alert alert-warning');
        $('form').trigger('reset');
        $(".no_valido").hide();
        $('#detail_modal').modal('show');
        $('#modal_accion').val('add');
        $("#lbl_detail_modal").html("Crear Lienzo");
    });
}

// Insert Record in the Database
function insertRecord() {

    var desc_canvas = $('#desc_canvas').val();
    var tamano_x = $('#tamano_x').val();
    var tamano_y = $('#tamano_y').val();
    var color = ($('#color').val() === '') ? null : $('#color').val();
    var estilo = ($('#estilo').val() === '') ? null : $('#estilo').val();
    var id_status = $('#id_status').val();

    // Validar status
    var datosValidos = validateData(desc_canvas, tamano_x, tamano_y, id_status);
    if (datosValidos.status){
        
        $.ajax({
            url : 'CanvasFunc.php',
            method: 'post',
            data:{accion:'insertRecord',desc_canvas:desc_canvas,tamano_x:tamano_x,tamano_y:tamano_y,color:color,
                    estilo:estilo,id_status:id_status},
            success: function(data) {
                data = $.parseJSON(data);
                if(data.status) {
                    $('#status').html(data.mensaje);
                    $('#status').addClass('alert alert-success');
                    getTable();
                    $('#detail_modal').modal('hide');
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

}

function validateData(desc_canvas, tamano_x, tamano_y, id_status){
    var status = true;
    var mensaje = 'Datos OK';
    $(".no_valido").hide();
    if(desc_canvas == '') {
        status = false;
        $('#hlpNombreNOK').show();
    }
    if(tamano_y == '') {
        status = false;
        $('#hlpAltoNOK').show();
    }
    if(tamano_x == '') {
        status = false;
        $('#hlpAnchoNOK').show();
    }
    if (id_status == 0){
        status = false;
        $('#hlpEstatusNOK').show();
    }
    
    if (!status) mensaje = 'Favor de proporcionar la información en rojo'; 

    return {status:status,mensaje:mensaje};
}

// Display table
function getTable() {
    $.ajax({
        url: 'CanvasFunc.php',
        method: 'post',
        data:{accion:'getTable'},
        success: function(data) {
            data = $.parseJSON(data);
            if(data.status) {
                $('#table').html(data.html);
            } else {
                $('#status').html(data.mensaje);
                if (data.vacio){
                    $('#table').html('<tr></tr>');
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
        $('#message').html('');
        $('#message').removeClass('alert alert-warning');
        var id_canvas = $(this).attr('data-id');
        $.ajax({
            url : 'CanvasFunc.php',
            method: 'post',
            data:{accion:'getRecord',id_canvas:id_canvas},
            dataType: 'JSON',
            success: function(data){
                if(data.status) {
                    // Valores
                    $('#id_canvas').val(data.data['id_canvas']);
                    $('#desc_canvas').val(data.data['desc_canvas']);
                    $('#tamano_x').val(data.data['tamano_x']);
                    $('#tamano_y').val(data.data['tamano_y']);
                    $('#color').val(data.data['color']);
                    $('#estilo').val(data.data['estilo']);
                    $('#id_status').val(data.data['id_status']);
                    // Control
                    $(".no_valido").hide();
                    $('#detail_modal').modal('show');
                    $("#lbl_detail_modal").html("Editar Lienzo");
                    $('#modal_accion').val('update');
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
    var id_canvas = $('#id_canvas').val();
    var desc_canvas = $('#desc_canvas').val();
    var tamano_x = $('#tamano_x').val();
    var tamano_y = $('#tamano_y').val();
    var color = ($('#color').val() === '') ? null : $('#color').val();
    var estilo = ($('#estilo').val() === '') ? null : $('#estilo').val();
    var id_status = $('#id_status').val();

    // Validar status
    var datosValidos = validateData(desc_canvas, tamano_x, tamano_y, id_status);
    if (datosValidos.status){
        $.ajax({
            url: 'CanvasFunc.php',
            method: 'post',
            data:{accion:'updateRecord',id_canvas:id_canvas,desc_canvas:desc_canvas,tamano_x:tamano_x,
                        tamano_y:tamano_y,color:color,estilo:estilo,id_status:id_status},
            success: function(data) {
                data = $.parseJSON(data);
                if(data.status) {
                    $('#status').html(data.mensaje);
                    $('#status').addClass('alert alert-success');
                    getTable();
                    $('#detail_modal').modal('hide');
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
}

// Delete Function
function deleteRecord() {
    $(document).on('click','#btn_delete',function() {
        var id_canvas = $(this).attr('data-id1');

        $('#status').html('');
        $('#status').removeClass('alert alert-warning alert-danger alert-success');
        $('#delete').modal('show');

        $(document).on('click','#btn_delete_record',function() {
            $.ajax({
                url : 'CanvasFunc.php',
                method: 'post',
                data:{accion:'deleteRecord',id_canvas:id_canvas},
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




