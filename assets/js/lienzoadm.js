$(document).ready(function() {
    getTable();
    addRecord();
    getRecord();
    deleteRecord();
})

// Display table
function getTable() {
    $.ajax({
        url: 'lienzoAdmFunc.php',
        method: 'post',
        data: {accion:'getTable'},
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

function addRecord() {
    $('button#btn_add').on('click', function() {
        $(location).attr('href','temporadaDetalle.php?idt=0&acc=add');
    });
}


//Get Particular Record
function getRecord() {
    $(document).on('click','#btn_edit',function() {
        var id_temporada = $(this).attr('data-id');
        $(location).attr('href','temporadaDetalle.php?idt='+id_temporada+'&acc=update');
    })
}

// Delete Function
function deleteRecord() {
    $(document).on('click','#btn_delete',function() {
        var id_temporada = $(this).attr('data-id1');

        $('#status').html('');
        $('#status').removeClass('alert alert-warning alert-danger alert-success');
        $('#delete').modal('show');

        $(document).on('click','#btn_delete_record',function() {
            $.ajax({
                url : 'lienzoAdmFunc.php',
                method: 'post',
                data:{accion:'deleteRecord',id_temporada:id_temporada},
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
