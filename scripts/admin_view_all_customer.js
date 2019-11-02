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
    console.log(id);
})