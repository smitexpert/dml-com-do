$(function(){
    $("#customer_table").dataTable({
        "pageLength": 25
    });
})

$(".contact_person").click(function(e){
    e.preventDefault();
    var id = $(this).attr("id");
    id = id.replace("contact_person_", '');
    $("#contact_perosns_body").find("*").remove();
    $.ajax({
        url: "../ajax/sm/ajax_admin_view_all_customer.php",
        method: "POST",
        data: {
            get_contact_person: id
        },
        success: function(data){
            $("#contact_perosns_body").append(data);
        }
    })
})

$(".total_visit").click(function(e){
    e.preventDefault();
    var id = $(this).attr("id");
    id = id.replace("total_visit_", '');
    $("#total_visit_body").find("*").remove();
    $.ajax({
        url: "../ajax/sm/ajax_admin_view_all_customer.php",
        method: "POST",
        data: {
            total_visit: id
        },
        success: function(data){
            $("#total_visit_body").append(data);
        }
    })
})

$(".appointment").click(function(e){
    e.preventDefault();
    var id = $(this).attr("id");
    id = id.replace("appointment_", '');
    $("#appointment_body").find("*").remove();
    $.ajax({
        url: "../ajax/sm/ajax_admin_view_all_customer.php",
        method: "POST",
        data: {
            appointment: id
        },
        success: function(data){
            $("#appointment_body").append(data);
        }
    })
})

$(".edit").click(function(e){
    e.preventDefault();
    var id = $(this).attr("id");
    id = id.replace("edit_", '');
    $("#customer_edit_form").trigger("reset");
    $.ajax({
        url: "../ajax/sm/ajax_admin_edit_customer.php",
        method: "POST",
        data: {
            get_customer_info: id
        },
        dataType: "JSON",
        success: function(data){
            $("#edit_company_id").val(data.company_id);
            $("#edit_company_name").val(data.company_name);
            $("#edit_company_contact").val(data.name);
            $("#edit_contact").val(data.contact);
            $("#edit_email_address").val(data.email);
            $("#edit_address").val(data.address);
            $("#edit_assigne").val(data.assign_to);
            $("#edit_assigne").selectpicker('refresh');
            // console.log(data);
        }
    })
})

$("#customer_edit_form").submit(function(e){
    e.preventDefault();
    var form_data = $(this).serialize();
    
    $.ajax({
        url: "../ajax/sm/ajax_admin_edit_customer.php",
        method: "POST",
        data: form_data,
        success: function(data){
            $("#edit_modal").modal('toggle');
            if(data == '1'){
                alert("Update Success!");
            }else{
                alert("Something Wrong@");
                console.log(data);
            }
        }
    })
})