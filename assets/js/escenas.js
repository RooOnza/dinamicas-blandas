$(document).ready(function() {
    getTable();
    addRecord();
    getRecord();
    deleteRecord();
})

// Display table
function getTable() {
    $.ajax({
        url: 'EscenasFunc.php',
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
        $(location).attr('href','escenasDetalle.php?id=0&acc=add');
    });
}


//Get Particular Record
function getRecord() {
    $(document).on('click','#btn_edit',function() {
        var id_escena = $(this).attr('data-id');
        $(location).attr('href','escenasDetalle.php?id='+id_escena+'&acc=update');
    })
}

// Delete Function
function deleteRecord() {
    $(document).on('click','#btn_delete',function() {
        var id_escena = $(this).attr('data-id1');

        $('#status').html('');
        $('#status').removeClass('alert alert-warning alert-danger alert-success');
        $('#delete').modal('show');

        $(document).on('click','#btn_delete_record',function() {
            $.ajax({
                url : 'EscenasFunc.php',
                method: 'post',
                data:{accion:'deleteRecord',id_escena:id_escena},
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
