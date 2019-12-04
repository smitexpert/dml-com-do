$(function(){
    $("#retail_customer_list").dataTable();
})

$("#retail_customer_add_form").submit(function(e){
    e.preventDefault();
    var form_data = $(this).serialize();

    $.ajax({
        url: "../ajax/sm/ajax_retail_list.php",
        method: "POST",
        data: form_data,
        success: function(data){
            if(data == '1'){
                alert("Customer Added Successfully!!!");
            }else{
                alert("Something is Wrong");
                console.log(data);
            }
            $("#retail_customer_add_form").trigger('reset');
            $("#destination").selectpicker("refresh");
            $("#add_modal").modal("toggle");
        }
    })
})

$(".customer_view").click(function(e){
    e.preventDefault();
    var id = $(this).attr("id");
    id = id.replace('customer_', '');
    console.log(id);
})