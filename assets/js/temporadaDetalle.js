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
    // idt=0&acc=add
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('idt')) $("#id_temporada").val(searchParams.get('idt'));  
    if (searchParams.has('acc')) $("#accion").val(searchParams.get('acc'));  
}

function estadoInicial(){
    $(".no_valido_gral").hide();
    $("#divPermanente").hide();
    $("#permanente").attr('checked', false);  
    $('#btn_add').prop('disabled', true);
    

    if ($("#accion").val() === 'add') $("#lbl_detail").html("Crear Temporada");
    if ($("#accion").val() === 'update') {
        $("#lbl_detail").html("Editar Temporada");
        getRecord($("#id_temporada").val());
    }

    $("#id_tipo").change(function() {  
        estadoPermanente($("#id_tipo").val());
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
        $(location).attr('href','temporada.php');
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
        $("#lbl_detail_modal").html("Crear Fecha");
    });
}

// Insert Record in the Database
function insertRecord() {

    var desc_temporada = $('#desc_temporada').val();
    var id_tipo = $('#id_tipo').val();
    var permanente = ($("#permanente").is(':checked')) ? '1' : '0';

    // Validar status
    var datosValidos = validateData(desc_temporada, id_tipo);
    if (datosValidos.status){
        
        $.ajax({
            url : 'TemporadaFunc.php',
            method: 'post',
            data:{accion:'insertRecord',desc_temporada:desc_temporada,id_tipo:id_tipo,permanente:permanente},
            success: function(data) {
                data = $.parseJSON(data);
                if(data.status) {
                    $('#status').html(data.mensaje);
                    $('#status').addClass('alert alert-success');
                    $(location).attr('href','temporada.php');
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

    var id_temporada = $('#id_temporada').val();
    var fecha = $('#fecha').val();
    var hora = $('#hora').val();
    var id_status = $('#id_status').val();

    // Validar status
    var datosValidos = validateDataDetail(fecha, hora, id_status);
    if (datosValidos.status){
        
        var fechahora = fecha + ' ' + hora;
        $.ajax({
            url : 'TemporadaFunc.php',
            method: 'post',
            data:{accion:'insertRecordDetail',id_temporada:id_temporada,fecha:fechahora,id_status:id_status},
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

function validateData(desc_temporada, id_tipo){
    var status = true;
    var mensaje = 'Datos OK';
    $(".no_valido_gral").hide();
    if(desc_temporada == '') {
        status = false;
        $('#hlpNombreNOK').show();
    }
    if(id_tipo == '0') {
        status = false;
        $('#hlpTipoNOK').show();
    }
    
    if (!status) mensaje = 'Favor de proporcionar la información en rojo'; 

    return {status:status,mensaje:mensaje};
}

function validateDataDetail(fecha, hora, id_status){
    var status = true;
    var mensaje = 'Datos OK';
    $(".no_valido").hide();
    if(fecha == '') {
        status = false;
        $('#hlpFechaNOK').show();
    }
    if(hora == '') {
        status = false;
        $('#hlpHoraNOK').show();
    }
    if(id_status == '0') {
        status = false;
        $('#hlpEstatusNOK').show();
    }
    
    if (!status) mensaje = 'Favor de proporcionar la información en rojo'; 

    return {status:status,mensaje:mensaje};
}

// Display table
function getTable() {
    var id_temporada = $('#id_temporada').val();
    $.ajax({
        url: 'TemporadaFunc.php',
        method: 'post',
        data: {accion:'getChildTable',id_temporada:id_temporada},
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
        url : 'TemporadaFunc.php',
        method: 'post',
        data:{accion:'getRecord',id_temporada:id},
        dataType: 'JSON',
        success: function(data){
            if(data.status) {
                // Valores
                $('#id_temporada').val(data.data['id_temporada']);
                $('#desc_temporada').val(data.data['desc_temporada']);
                $('#id_tipo').val(data.data['id_tipo']);
                $("#permanente").attr('checked', data.data['permanente'] == "1"); 
                estadoPermanente(data.data['id_tipo']);
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
        var id_temporada = $(this).attr('data-id');
        var fecha = $(this).attr('data-fecha');
        $.ajax({
            url : 'TemporadaFunc.php',
            method: 'post',
            data:{accion:'getRecordDetail',id_temporada:id_temporada,fecha:fecha},
            dataType: 'JSON',
            success: function(data){
                if(data.status) {
                    // Valores
                    var fechahora = data.data['fecha'].split(" ");
                    $('#fecha').val(fechahora[0]);
                    $('#hora').val(fechahora[1]);
                    $('#id_status').val(data.data['id_status']);
                    $('#fecha_llave').val(data.data['fecha']);                    
                    // Control
                    $(".no_valido").hide();
                    $('#detail_modal').modal('show');
                    $("#lbl_detail_modal").html("Editar Fecha");
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
    var id_temporada = $('#id_temporada').val();
    var desc_temporada = $('#desc_temporada').val();
    var id_tipo = $('#id_tipo').val();
    var permanente = ($("#permanente").is(':checked')) ? '1' : '0';

    // Validar status
    var datosValidos = validateData(desc_temporada, id_tipo);
    if (datosValidos.status){
        $.ajax({
            url: 'TemporadaFunc.php',
            method: 'post',
            data:{accion:'updateRecord',id_temporada:id_temporada,desc_temporada:desc_temporada,
                        id_tipo:id_tipo,permanente:permanente},
            success: function(data) {
                data = $.parseJSON(data);
                if(data.status) {
                    $('#status').html(data.mensaje);
                    $('#status').addClass('alert alert-success');
                    $(location).attr('href','temporada.php');
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
    var id_temporada = $('#id_temporada').val();
    var fecha = $('#fecha').val();
    var hora = $('#hora').val();
    var id_status = $('#id_status').val();
    var fecha_llave = $('#fecha_llave').val();

    // Validar status
    var datosValidos = validateDataDetail(fecha, hora, id_status);
    if (datosValidos.status){
        var fechahora = fecha + ' ' + hora;
        $.ajax({
            url: 'TemporadaFunc.php',
            method: 'post',
            data:{accion:'updateRecordDetail',id_temporada:id_temporada,fecha_llave:fecha_llave,fecha:fechahora,id_status:id_status},
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
        var id_temporada = $(this).attr('data-id1');
        var fecha = $(this).attr('data-fecha1');

        $('#status').html('');
        $('#status').removeClass('alert alert-warning alert-danger alert-success');
        $('#delete').modal('show');

        $(document).on('click','#btn_delete_record',function() {
            $.ajax({
                url : 'TemporadaFunc.php',
                method: 'post',
                data:{accion:'deleteRecordDetail',id_temporada:id_temporada,fecha:fecha},
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

function estadoPermanente(tipo){
    $("#divPermanente").hide();
    $('.fechas').prop('disabled', true);
    if (tipo == '1') {
        $("#divPermanente").show();
        if ($('#id_temporada').val() !== '0') $('.fechas').prop('disabled', false);
    }
}


