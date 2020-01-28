$(function(){
    $('#datatable').dataTable();
})

function add_track_up(event){
    $("#add_tracking_update_from").trigger('reset');
    var id = $(event.target).closest('td').find('.edit_btn').attr("id");
    id = id.replace('edit_btn_', '')
    $("#dml_awn").val(id);
}

function get_track_up(event){
    $("#view_track_status").find("*").remove();
    var id = $(event.target).closest('td').find('.dlt_cls').attr("id");
    id = id.replace('edit_btn_', '');
    id = id.replace('dlt_dml_', '');
    
    $.ajax({
        url: '../ajax/tracking/up_track_status.php',
        method: 'POST',
        data: {
            get_update_table: id
        },
        success: function(data){
            $("#view_track_status").append(data);
        }
    })
}

function select_track_up(event){
    $("#add_static_tracking_update_from").trigger('reset');
    var id = $(event.target).closest('td').find('.select_btn').attr("id");
    id = id.replace('select_btn_', '')
    $("#sel_dml_awn").val(id);
}

$("#add_tracking_update_from").submit(function(e){
    e.preventDefault();
    var form_data = $(this).serialize();
    console.log(form_data);
    $.ajax({
        url: '../ajax/tracking/up_track_status.php',
        method: 'POST',
        data: form_data,
        success: function(data){
            console.log(data);
            $("#myModal").modal('toggle')
        }
    })
})

$("#add_static_tracking_update_from").submit(function(e){
    e.preventDefault();
    var form_data = $(this).serialize();
    console.log(form_data);
    $.ajax({
        url: '../ajax/tracking/up_track_status.php',
        method: 'POST',
        data: form_data,
        success: function(data){
            console.log(data);
            $("#statusSelectModal").modal('toggle')
        }
    })
})