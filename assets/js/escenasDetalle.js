$(document).ready(function() {
    // Cargar parametros url
    cargarParamURL();
    getListaCanvas(0);

    estadoInicial();

    addRecordDetail();
    saveRecordDetail();
    deleteRecord();
    getTable();
    getRecordDetail();

})

function cargarParamURL(){
    // id=0&acc=add
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('id')) $("#id_escena").val(searchParams.get('id'));  
    if (searchParams.has('acc')) $("#accion").val(searchParams.get('acc'));  
}

function estadoInicial(){
    $(".no_valido_gral").hide();
    $('#btn_add').prop('disabled', true);
    
    if ($("#accion").val() === 'add') $("#lbl_detail").html("Crear Escena");
    if ($("#accion").val() === 'update') {
        $("#lbl_detail").html("Editar Escena");
        getRecord($("#id_escena").val());
    }

    getListaActores(0, 0);

    $("#id_status").change(function() {  
        estadoAddActor($("#id_status").val());
    });  

    $("#id_tipo").change(function() {  
        getListaActores($("#id_tipo").val(), 0);
    });  

    $("#permanente").change(function() {  
        estadoTiempo($("#permanente").is(':checked'));
    });  
    $("#permanente").attr('checked', false); 

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
        $(location).attr('href','escenas.php');
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
        $("#lbl_detail_modal").html("Asignar Actor");
    });
}

// Insert Record in the Database
function insertRecord() {

    var desc_escena = $('#desc_escena').val();
    var id_tipo_esc = $('#id_tipo_esc').val();
    var tiempo = $('#tiempo').val();
    var id_canvas = $('#id_canvas').val();
    var id_status = $('#id_status').val();

    // Validar status
    var datosValidos = validateData(desc_escena, id_tipo_esc, tiempo, id_canvas, id_status);
    if (datosValidos.status){
        
        $.ajax({
            url : 'EscenasFunc.php',
            method: 'post',
            data:{accion:'insertRecord',desc_escena:desc_escena,id_tipo_esc:id_tipo_esc,tiempo:tiempo,
                            id_canvas:id_canvas,id_status:id_status},
            success: function(data) {
                data = $.parseJSON(data);
                if(data.status) {
                    $('#status').html(data.mensaje);
                    $('#status').addClass('alert alert-success');
                    $(location).attr('href','escenas.php');
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

    var id_escena = $('#id_escena').val();
    var id_actor = $('#id_actor').val();
    var id_tipo = $('#id_tipo').val();
    var permanente = ($("#permanente").is(':checked')) ? '1' : '0';
    var tiempo_ini = $('#tiempo_ini').val();
    var tiempo_fin = $('#tiempo_fin').val();
    var posicion_x = $('#posicion_x').val();
    var posicion_y = $('#posicion_y').val();
    var estilo = $('#estilo').val();
    var orden = $('#orden').val();
    var id_status_det = $('#id_status_det').val();

    // Validar status
    var datosValidos = validateDataDetail(id_actor, id_tipo, permanente, tiempo_ini, tiempo_fin, 
                                            posicion_x, posicion_y, orden, id_status_det);
    if (datosValidos.status){
        
        $.ajax({
            url : 'EscenasFunc.php',
            method: 'post',
            data:{accion:'insertRecordDetail',id_escena:id_escena,id_actor:id_actor,id_tipo:id_tipo,permanente:permanente,
                            tiempo_ini:tiempo_ini,tiempo_fin:tiempo_fin, posicion_x:posicion_x, posicion_y:posicion_y,
                            estilo:estilo,orden:orden,id_status_det:id_status_det},
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

function validateData(desc_escena, id_tipo_esc, tiempo, id_canvas, id_status){
    var status = true;
    var mensaje = 'Datos OK';
    $(".no_valido_gral").hide();
    if(desc_escena == '') {
        status = false;
        $('#hlpNombreNOK').show();
    }
    if(id_tipo_esc == '0') {
        status = false;
        $('#hlpTipoEscNOK').show();
    }
    if(id_canvas == '0') {
        status = false;
        $('#hlpCanvasNOK').show();
    }
    if(tiempo == '') {
        status = false;
        $('#hlpTiempoNOK').show();
    }
    if(id_status == '0') {
        status = false;
        $('#hlpEstatusNOK').show();
    }
    
    if (!status) mensaje = 'Favor de proporcionar la información en rojo'; 

    return {status:status,mensaje:mensaje};
}

function validateDataDetail(id_actor, id_tipo, permanente, tiempo_ini, tiempo_fin, 
                            posicion_x, posicion_y, orden, id_status_det){
    var status = true;
    var mensaje = 'Datos OK';
    $(".no_valido").hide();
    if(id_tipo == '0') {
        status = false;
        $('#hlpTipoNOK').show();
    }
    if(id_actor == '0') {
        status = false;
        $('#hlpActorNOK').show();
    }
    if(permanente == '0') {
        if(tiempo_ini == '') {
            status = false;
            $('#hlpTiempoIniNOK').show();
        }
        if(tiempo_fin == '') {
            status = false;
            $('#hlpTiempoFinNOK').show();
        }
    }
    if(posicion_x == '') {
        status = false;
        $('#hlpPosXNOK').show();
    }
    if(posicion_y == '') {
        status = false;
        $('#hlpPosYNOK').show();
    }
    if(orden == '') {
        status = false;
        $('#hlpOrdenNOK').show();
    }
    if(id_status_det == '0') {
        status = false;
        $('#hlpEstatusDetNOK').show();
    }
    
    if (!status) mensaje = 'Favor de proporcionar la información en rojo'; 

    return {status:status,mensaje:mensaje};
}

// Display table
function getTable() {
    var id_escena = $('#id_escena').val();
    $.ajax({
        url: 'EscenasFunc.php',
        method: 'post',
        data: {accion:'getChildTable',id_escena:id_escena},
        success: function(data) {
            data = $.parseJSON(data);
            if(data.status) {
                $('#table').html(data.html);
                estadoAddActor($("#id_status").val());
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
        url : 'EscenasFunc.php',
        method: 'post',
        data:{accion:'getRecord',id_escena:id},
        dataType: 'JSON',
        success: function(data){
            if(data.status) {
                // Valores
                $('#id_escena').val(data.data['id_escena']);
                $('#desc_escena').val(data.data['desc_escena']);
                $('#id_tipo_esc').val(data.data['id_tipo']);
                $('#id_canvas').val(data.data['id_canvas']);
                $('#tiempo').val(data.data['tiempo']);
                $('#id_status').val(data.data['id_status']);
                estadoAddActor(data.data['id_status']);
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
        var id_actor = $(this).attr('data-id');
        var id_escena = $(this).attr('data-id_escena');
        var orden = $(this).attr('data-orden');
        $.ajax({
            url : 'EscenasFunc.php',
            method: 'post',
            data:{accion:'getRecordDetail',id_escena:id_escena,id_actor:id_actor,orden:orden},
            dataType: 'JSON',
            success: function(data){
                if(data.status) {
                    // Valores
                    $('#id_tipo').val(data.data['id_tipo']);
                    getListaActores(data.data['id_tipo'], data.data['id_actor']);
                    $('#id_actor_llave').val(data.data['id_actor']);
                    $('#posicion_x').val(data.data['posicion_x']);
                    $('#posicion_y').val(data.data['posicion_y']);
                    $("#permanente").attr('checked', data.data['permanente'] == "1"); 
                    estadoTiempo(data.data['permanente'] == "1");
                    $('#tiempo_ini').val(data.data['tiempo_ini']);
                    $('#tiempo_fin').val(data.data['tiempo_fin']);
                    $('#estilo').val(data.data['estilo']);
                    $('#orden').val(data.data['orden']);
                    $('#orden_llave').val(data.data['orden']);
                    $('#id_status_det').val(data.data['id_status']);
                    // Control
                    $(".no_valido").hide();
                    $('#detail_modal').modal('show');
                    $("#lbl_detail_modal").html("Editar Actor");
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
function getListaActores(id_tipo, id) {
    $.ajax({
        url: 'EscenasFunc.php',
        method: 'post',
        data: {accion:'getListaActores',id_tipo:id_tipo,id:id},
        success: function(data) {
            data = $.parseJSON(data);
            if(data.status) {
                $('#id_actor').html(data.options);
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

// Display table
function getListaCanvas(id) {
    $.ajax({
        url: 'EscenasFunc.php',
        method: 'post',
        data: {accion:'getListaCanvas',id:id},
        success: function(data) {
            data = $.parseJSON(data);
            if(data.status) {
                $('#id_canvas').html(data.options);
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
    var id_escena = $('#id_escena').val();
    var desc_escena = $('#desc_escena').val();
    var id_tipo_esc = $('#id_tipo_esc').val();
    var tiempo = $('#tiempo').val();
    var id_canvas = $('#id_canvas').val();
    var id_status = $('#id_status').val();

    // Validar status
    var datosValidos = validateData(desc_escena, id_tipo_esc, tiempo, id_canvas, id_status);
    if (datosValidos.status){
        $.ajax({
            url: 'EscenasFunc.php',
            method: 'post',
            data:{accion:'updateRecord',id_escena:id_escena,desc_escena:desc_escena,id_tipo_esc:id_tipo_esc,
                            tiempo:tiempo,id_canvas:id_canvas,id_status:id_status},
            success: function(data) {
                data = $.parseJSON(data);
                if(data.status) {
                    $('#status').html(data.mensaje);
                    $('#status').addClass('alert alert-success');
                    $(location).attr('href','escenas.php');
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
    var id_escena = $('#id_escena').val();
    var id_actor = $('#id_actor').val();
    var id_actor_llave = $('#id_actor_llave').val();
    var id_tipo = $('#id_tipo').val();
    var permanente = ($("#permanente").is(':checked')) ? '1' : '0';
    var tiempo_ini = $('#tiempo_ini').val();
    var tiempo_fin = $('#tiempo_fin').val();
    var posicion_x = $('#posicion_x').val();
    var posicion_y = $('#posicion_y').val();
    var estilo = $('#estilo').val();
    var orden = $('#orden').val();
    var orden_llave = $('#orden_llave').val();
    var id_status_det = $('#id_status_det').val();

    // Validar status
    var datosValidos = validateDataDetail(id_actor, id_tipo, permanente, tiempo_ini, tiempo_fin, 
                                            posicion_x, posicion_y, orden, id_status_det);
    if (datosValidos.status){
        // 
        actualizarValidandoOrden(id_escena, id_actor, id_actor_llave, id_tipo,permanente, tiempo_ini, tiempo_fin,
                                    posicion_x, posicion_y, estilo, orden, orden_llave, id_status_det);
    } else {
        $('#message').html(datosValidos.mensaje);
        $('#message').addClass('alert alert-warning');
    }
}

function actualizarValidandoOrden(id_escena, id_actor, id_actor_llave, id_tipo,permanente, tiempo_ini, tiempo_fin,
                                    posicion_x, posicion_y, estilo, orden, orden_llave, id_status_det){
    $.ajax({
        url: 'EscenasFunc.php',
        method: 'post',
        data: {accion:'getOrdenExistente',id_escena:id_escena, id_actor:id_actor, orden:orden},
        success: function(data) { 
            data = $.parseJSON(data);
            if(data.status) {
                if (data.data['tot'] == 0) {
                    $.ajax({
                        url: 'EscenasFunc.php',
                        method: 'post',
                        data:{accion:'updateRecordDetail',id_escena:id_escena,id_actor:id_actor,id_actor_llave:id_actor_llave,
                                        id_tipo:id_tipo,permanente:permanente,tiempo_ini:tiempo_ini,tiempo_fin:tiempo_fin, 
                                        posicion_x:posicion_x, posicion_y:posicion_y,estilo:estilo,orden:orden,
                                        orden_llave:orden_llave, id_status_det:id_status_det},
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
                    $('#message').html('Ooops! ese orden lo tiene asignado otro actor, me das uno único?! :)');
                    $('#message').addClass('alert alert-warning');
                }
            } else {
                $('#status').html(data.mensaje);
                $('#status').addClass('alert alert-danger');
            }
        }
    })
}

// Delete Function
function deleteRecord() {
    $(document).on('click','#btn_delete',function() {
        var id_actor = $(this).attr('data-id1');
        var id_escena = $(this).attr('data-id_escena1');
        var orden = $(this).attr('data-orden1');

        $('#status').html('');
        $('#status').removeClass('alert alert-warning alert-danger alert-success');
        $('#delete').modal('show');

        $(document).on('click','#btn_delete_record',function() {
            $.ajax({
                url : 'EscenasFunc.php',
                method: 'post',
                data:{accion:'deleteRecordDetail',id_escena:id_escena,id_actor:id_actor,orden:orden},
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

function estadoAddActor(estatus){
    $('.escenas').prop('disabled', true);
    if (estatus == '1') {
        if ($('#id_escena').val() !== '0') {
            $('.escenas').prop('disabled', false);
        }
    }
}

function estadoTiempo(permanente){
    $('#divTiempo').hide();
    if (!permanente) $('#divTiempo').show();
}