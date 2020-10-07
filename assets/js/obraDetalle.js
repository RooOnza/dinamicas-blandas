$(document).ready(function() {
    // Cargar parametros url
    cargarParamURL();

    getTable();
    addRecordDetail();
    saveRecordDetail();
    deleteRecord();
    getRecordDetail();

    estadoInicial();
})

function cargarParamURL(){
    // id=0&acc=add
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('id')) $("#id_obra").val(searchParams.get('id'));  
    if (searchParams.has('acc')) $("#accion").val(searchParams.get('acc'));  
}

function estadoInicial(){
    $(".no_valido_gral").hide();
    $('#btn_add').prop('disabled', true);
    

    if ($("#accion").val() === 'add') $("#lbl_detail").html("Crear Obra");
    if ($("#accion").val() === 'update') {
        $("#lbl_detail").html("Editar Obra");
        getRecord($("#id_obra").val());
    }

    getListaEscenas(0);

    $("#id_estatus").change(function() {  
        estadoAddEscena($("#id_estatus").val());
    });  

    $(document).on('click', '#btn_register', function() {
        switch ($('#accion').val()){
            case 'add':
                insertRecord();
                break;
            case 'update':
                updateRecord();
            break;
        }    
    });

    $(document).on('click','#btn_close',function() {
        $(location).attr('href','obra.php');
    })   

}

 // Save (add / delete) Record in the Database
function saveRecordDetail() {

    $(document).on('click', '#btn_register_detail', function() {
        switch ($('#modal_accion').val()){
            case 'add':
                insertRecordDetail();
                break;
            case 'update':
                updateRecordDetail();
            break;
        }
    
    });

    $(document).on('click','#btn_close_detail',function() {
        $('#form_detalle').trigger('reset');
    })   
 }

function addRecordDetail() {

    $('button#btn_add').on('click', function() {
        $('#status').html('');
        $('#status').removeClass('alert alert-warning alert-danger alert-success');
        $('#message').html('');
        $('#message').removeClass('alert alert-warning');
        $('#form_detalle').trigger('reset');
        $(".no_valido").hide();
        $('#detail_modal').modal('show');
        $('#modal_accion').val('add');
        $("#lbl_detail_modal").html("Agregar Escena");
    });
}

// Insert Record in the Database
function insertRecord() {

    var desc_obra = $('#desc_obra').val();
    var id_status = $('#id_status').val();

    // Validar status
    var datosValidos = validateData(desc_obra, id_status);
    if (datosValidos.status){
        
        $.ajax({
            url : 'ObraFunc.php',
            method: 'post',
            data:{accion:'insertRecord',desc_obra:desc_obra,id_status:id_status},
            success: function(data) {
                data = $.parseJSON(data);
                if(data.status) {
                    $('#status').html(data.mensaje);
                    $('#status').addClass('alert alert-success');
                    $(location).attr('href','obra.php');
                } else {
                    $('#status').html(data.mensaje);
                    $('#status').addClass('alert alert-danger');
                }
            }
        })
    } else {
        $('#status').html(datosValidos.mensaje);
        $('#status').addClass('alert alert-warning');
    }

}

// Insert Record in the Database
function insertRecordDetail() {

    var id_obra = $('#id_obra').val();
    var id_escena = $('#id_escena').val();
    var orden = $('#orden').val();

    // Validar status
    var datosValidos = validateDataDetail(id_escena, orden);
    if (datosValidos.status){
        
        $.ajax({
            url : 'ObraFunc.php',
            method: 'post',
            data:{accion:'insertRecordDetail',id_obra:id_obra,id_escena:id_escena,orden:orden},
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

function validateData(desc_obra, id_status){
    var status = true;
    var mensaje = 'Datos OK';
    $(".no_valido_gral").hide();
    if(desc_obra == '') {
        status = false;
        $('#hlpNombreNOK').show();
    }
    if(id_status == '0') {
        status = false;
        $('#hlpEstatusNOK').show();
    }
    
    if (!status) mensaje = 'Favor de proporcionar la información en rojo'; 

    return {status:status,mensaje:mensaje};
}

function validateDataDetail(id_escena, orden){
    var status = true;
    var mensaje = 'Datos OK';
    $(".no_valido").hide();
    if(id_escena == '0') {
        status = false;
        $('#hlpEscenaNOK').show();
    }
    if(orden == '') {
        status = false;
        $('#hlpOrdenNOK').show();
    }
    
    if (!status) mensaje = 'Favor de proporcionar la información en rojo'; 

    return {status:status,mensaje:mensaje};
}

// Display table
function getTable() {
    var id_obra = $('#id_obra').val();
    $.ajax({
        url: 'ObraFunc.php',
        method: 'post',
        data: {accion:'getChildTable',id_obra:id_obra},
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

//Get particular Record
function getRecord(id) {
    $('#status').html('');
    $('#status').removeClass('alert alert-warning alert-danger alert-success');
    $('#message').html('');
    $('#message').removeClass('alert alert-warning');
    $.ajax({
        url : 'ObraFunc.php',
        method: 'post',
        data:{accion:'getRecord',id_obra:id},
        dataType: 'JSON',
        success: function(data){
            if(data.status) {
                // Valores
                $('#id_obra').val(data.data['id_obra']);
                $('#desc_obra').val(data.data['desc_obra']);
                $('#id_status').val(data.data['id_status']);
                estadoAddEscena(data.data['id_status']);
            } else {
                $('#status').html(data.mensaje);
                $('#status').addClass('alert alert-danger');
            }
        }               
    })
}

//Get Detail Particular Record
function getRecordDetail()
{
    $(document).on('click','#btn_edit',function() {
        $('#status').html('');
        $('#status').removeClass('alert alert-warning alert-danger alert-success');
        $('#message').html('');
        $('#message').removeClass('alert alert-warning');
        var id_obra = $(this).attr('data-id');
        var id_escena = $(this).attr('data-id_escena');
        $.ajax({
            url : 'ObraFunc.php',
            method: 'post',
            data:{accion:'getRecordDetail',id_obra:id_obra,id_escena:id_escena},
            dataType: 'JSON',
            success: function(data){
                if(data.status) {
                    // Valores
                    $('#id_escena').val(data.data['id_escena']);
                    $('#orden').val(data.data['orden']);
                    $('#id_escena_llave').val(data.data['id_escena']);                    
                    // Control
                    $(".no_valido").hide();
                    $('#detail_modal').modal('show');
                    $("#lbl_detail_modal").html("Editar Escena");
                    $('#modal_accion').val('update');
                } else {
                    $('#status').html(data.mensaje);
                    $('#status').addClass('alert alert-danger');
                }
            }               
        })
    })
}

// Display table
function getListaEscenas(id) {
    $.ajax({
        url: 'ObraFunc.php',
        method: 'post',
        data: {accion:'getListaEscenas',id:id},
        success: function(data) {
            data = $.parseJSON(data);
            if(data.status) {
                $('#id_escena').html(data.options);
            } else {
                $('#status').html(data.mensaje);
                if (data.vacio){
                    $('#status').addClass('alert alert-success');
                } else {
                    $('#status').addClass('alert alert-danger');
                }
            }
        }
    })
}

// Update Record 
function updateRecord() {    
    var id_obra = $('#id_obra').val();
    var desc_obra = $('#desc_obra').val();
    var id_status = $('#id_status').val();

    // Validar status
    var datosValidos = validateData(desc_obra, id_status);
    if (datosValidos.status){
        $.ajax({
            url: 'ObraFunc.php',
            method: 'post',
            data:{accion:'updateRecord',id_obra:id_obra,desc_obra:desc_obra,id_status:id_status},
            success: function(data) {
                data = $.parseJSON(data);
                if(data.status) {
                    $('#status').html(data.mensaje);
                    $('#status').addClass('alert alert-success');
                    $(location).attr('href','obra.php');
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

// Update Record 
function updateRecordDetail() {    
    var id_obra = $('#id_obra').val();
    var id_escena = $('#id_escena').val();
    var orden = $('#orden').val();
    var id_escena_llave = $('#id_escena_llave').val();

    // Validar status
    var datosValidos = validateDataDetail(id_escena, orden);
    if (datosValidos.status){
        $.ajax({
            url: 'ObraFunc.php',
            method: 'post',
            data:{accion:'updateRecordDetail',id_obra:id_obra,id_escena_llave:id_escena_llave,id_escena:id_escena,orden:orden},
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
        var id_obra = $(this).attr('data-id1');
        var id_escena = $(this).attr('data-id_escena1');

        $('#status').html('');
        $('#status').removeClass('alert alert-warning alert-danger alert-success');
        $('#delete').modal('show');

        $(document).on('click','#btn_delete_record',function() {
            $.ajax({
                url : 'ObraFunc.php',
                method: 'post',
                data:{accion:'deleteRecordDetail',id_obra:id_obra,id_escena:id_escena},
                success: function(data) {
                    data = $.parseJSON(data);
                    if(data.status) {
                        $('#status').html(data.mensaje);
                        $('#status').addClass('alert alert-success');
                        getTable();
                        $('#form_detalle').trigger('reset');
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

function estadoAddEscena(estatus){
    $('.escenas').prop('disabled', true);
    if (estatus == '1') {
        if ($('#id_obra').val() !== '0') {
            $('.escenas').prop('disabled', false);
        }
    }
}
