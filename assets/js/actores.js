$(document).ready(function() {
    estadoInicial();
    getTable();
    addRecord();
    saveRecord();
    getRecord();
    deleteRecord();
})

function estadoInicial(){
    estadoXTipo(0);
    $("#id_tipo").change(function() {  
        estadoXTipo($("#id_tipo").val());
    });  
}

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
        $("#lbl_detail_modal").html("Crear Actor");
        estadoXTipo(0);
    });
}

// Insert Record in the Database
function insertRecord() {

    var desc_actor = $('#desc_actor').val();
    var id_tipo = $('#id_tipo').val();
    var estilo = ($('#estilo').val() === '') ? '' : $('#estilo').val();
    var id_status = $('#id_status').val();
    // propiedades específicas por actor
    var p_diametro = $('#p_diametro').val();
    var p_color = $('#p_color').val();
    var p_contenido = $('#p_contenido').val();
    // propiedades específicas por actor rectángulo
    var r_tamano_x = $('#r_tamano_x').val();
    var r_tamano_y = $('#r_tamano_y').val();
    var r_color = $('#r_color').val();
    var r_contenido = $('#r_contenido').val();

    var datosValidos = validateData(desc_actor, id_tipo, id_status, p_diametro, r_tamano_x, r_tamano_y);
    if (datosValidos.status){
        
        $.ajax({
            url : 'ActoresFunc.php',
            method: 'post',
            data:{accion:'insertRecord',desc_actor:desc_actor,id_tipo:id_tipo,estilo:estilo,id_status:id_status,
                    p_diametro:p_diametro,p_color:p_color,p_contenido:p_contenido,
                    r_tamano_x:r_tamano_x,r_tamano_y:r_tamano_y,r_color:r_color,r_contenido:r_contenido},
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

function validateData(desc_actor, id_tipo, id_status, p_diametro, r_tamano_x, r_tamano_y){
    var status = true;
    var mensaje = 'Datos OK';
    $(".no_valido").hide();
    if(desc_actor == '') {
        status = false;
        $('#hlpNombreNOK').show();
    }
    if (id_tipo == 0){
        status = false;
        $('#hlpTipoNOK').show();
    }
    if (id_status == 0){
        status = false;
        $('#hlpEstatusNOK').show();
    }
    // Validar propiedades de Punto
    if (id_tipo == 1){
        if (p_diametro == ''){
            status = false;  
            $('#hlpPDiametroNOK').html('... y mi diámetro? :(');
            $('#hlpPDiametroNOK').show();
        } else {
            if (parseInt(p_diametro) <= 0){
                status = false;
                $('#hlpPDiametroNOK').html('... este valor no :(');
                $('#hlpPDiametroNOK').show();
            }    
        }    
    }
    // Validar propiedades de Rectángulo
    if (id_tipo == 2){
        if (r_tamano_x == ''){
            status = false;            
            $('#hlpRTamanoXNOK').html('... y mi x? :(');
            $('#hlpRTamanoXNOK').show();
        } else {
            if (parseInt(r_tamano_x) <= 0){
                status = false;
                $('#hlpRTamanoXNOK').html('... este valor no :(');
                $('#hlpRTamanoXNOK').show();
            }    
        }    
        if (r_tamano_y == ''){
            status = false;            
            $('#hlpRTamanoYNOK').html('... y mi y? :(');
            $('#hlpRTamanoYNOK').show();
        } else {
            if (parseInt(r_tamano_y) <= 0){
                status = false;
                $('#hlpRTamanoYNOK').html('... este valor no :(');
                $('#hlpRTamanoYNOK').show();
            }    
        }    
    } 
    
    if (!status) mensaje = 'Favor de proporcionar la información en rojo'; 

    return {status:status,mensaje:mensaje};
}

// Display table
function getTable() {
    $.ajax({
        url: 'ActoresFunc.php',
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
        var id_actor = $(this).attr('data-id');
        var id_tipo = $(this).attr('data-id_tipo');
        $.ajax({
            url : 'ActoresFunc.php',
            method: 'post',
            data:{accion:'getRecord',id_actor:id_actor,id_tipo:id_tipo},
            dataType: 'JSON',
            success: function(data){
                if(data.status) {
                    var tipo = data.data['id_tipo'];
                    // Valores
                    $('#id_actor').val(data.data['id_actor']);
                    $('#desc_actor').val(data.data['desc_actor']);
                    $('#id_tipo').val(tipo);
                    $('#estilo').val(data.data['estilo']);
                    $('#id_status').val(data.data['id_status']);
                    estadoXTipo(tipo)
                    //Punto
                    if (tipo == 1){
                        $('#p_diametro').val(data.data['diametro']);
                        $('#p_color').val(data.data['color']);
                        $('#p_contenido').val(data.data['contenido']);
                    }
                    //Rectángulo
                    if (tipo == 2){
                        $('#r_tamano_x').val(data.data['tamano_x']);
                        $('#r_tamano_y').val(data.data['tamano_y']);
                        $('#r_color').val(data.data['color']);
                        $('#r_contenido').val(data.data['contenido']);
                    }

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

// Update Record 
function updateRecord() {    
    var id_actor = $('#id_actor').val();
    var desc_actor = $('#desc_actor').val();
    var id_tipo = $('#id_tipo').val();
    var estilo = ($('#estilo').val() === '') ? null : $('#estilo').val();
    var id_status = $('#id_status').val();
    // propiedades específicas por actor punto
    var p_diametro = $('#p_diametro').val();
    var p_color = $('#p_color').val();
    var p_contenido = $('#p_contenido').val();
    // propiedades específicas por actor rectángulo
    var r_tamano_x = $('#r_tamano_x').val();
    var r_tamano_y = $('#r_tamano_y').val();
    var r_color = $('#r_color').val();
    var r_contenido = $('#r_contenido').val();

    // Validar status
    var datosValidos = validateData(desc_actor, id_tipo, id_status, p_diametro, r_tamano_x, r_tamano_y);
    if (datosValidos.status){
        $.ajax({
            url: 'ActoresFunc.php',
            method: 'post',
            data:{accion:'updateRecord',id_actor:id_actor,desc_actor:desc_actor,id_tipo:id_tipo,estilo:estilo,
                        id_status:id_status,p_diametro:p_diametro,p_color:p_color,p_contenido:p_contenido,
                        r_tamano_x:r_tamano_x,r_tamano_y:r_tamano_y,r_color:r_color,r_contenido:r_contenido},
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
        var id_actor = $(this).attr('data-id1');
        var id_tipo = $(this).attr('data-id_tipo1');

        $('#status').html('');
        $('#status').removeClass('alert alert-warning alert-danger alert-success');
        $('#delete').modal('show');

        $(document).on('click','#btn_delete_record',function() {
            $.ajax({
                url : 'ActoresFunc.php',
                method: 'post',
                data:{accion:'deleteRecord',id_actor:id_actor,id_tipo:id_tipo},
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

function estadoXTipo(tipo){
    $(".divTipo").hide();
    switch(tipo){
        case '1':
            $("#divPunto").show();
            break;
        case '2':
            $("#divRectangulo").show();
            break;
    }
}
