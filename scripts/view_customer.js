$("#company_list").change(function(){
    var company_id = $(this).find(":selected").val();
    if(company_id != ""){
        $(".nav_view").css("display", "block");
        $(".view_body").css("display", "none");
        $("#body_task").css("display", "block");
        $(".nav_view li").removeClass("active");
        $("#task").closest("li").addClass("active")
        get_contact_person_list();
    }else{
        $(".nav_view").css("display", "none");
        $("#body_task").css("display", "none");
    }
})

$(".nav_view li").click(function(){
    $(".nav_view li").removeClass("active");
    $(this).addClass("active");
    var tab_id = $(this).find("a").attr("id");
    $(".view_body").css("display", "none");
    $("#body_"+tab_id).css("display", "block");
    
})


$( function() {
    $( "#plan_date" ).datepicker({
        minDate: 0,
        dateFormat: "yy-mm-dd"
    });
  } );
$( function() {
    $( "#app_date" ).datepicker({
        minDate: 0,
        dateFormat: "yy-mm-dd"
    });
  } );
$( function() {
    $( "#history_date" ).datepicker();
  } );

  $('.time').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    minTime: '9:00am',
    maxTime: '6:00pm',
    defaultTime: '11',
    startTime: '9:00am',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});

$("#add_contact_person").submit(function(e){
    e.preventDefault();
    var company_id = $("#company_list").find(":selected").val();
    var form_data = $(this).serialize()+"&company_id="+company_id;
    
    $.ajax({
        url: '../ajax/sm/ajax_view_customer.php',
        method: "POST",
        data: form_data,
        success: function(data){
            if(data == 1){
                alert("Success!")
                get_contact_person_list_table()
                $("#add_contact_person").trigger('reset');
            }else{
                alert("SOMETHING WRONG@")
                console.log(data)
            }
        }
    })
})

$(".table").DataTable();

function get_contact_person_list_table(){
    var company_id = $("#company_list").find(":selected").val();
    
    $.ajax({
        url: '../ajax/sm/ajax_view_customer.php',
        method: "POST",
        data: {
            get_contact_person_list_table: company_id
        },
        dataType: "json",
        success: function(data){
            var t = $("#contact_person_list").DataTable();
            t.clear().draw();

            if(data != ""){
                var id=1;
                $.each(data, function(index, d){
                    t.row.add( [
                        id,
                        d.name,
                        d.designation,
                        d.mobile,
                        d.email
                    ] ).draw( false );
                    id++;
                    
                })
            }
            
            // console.log(data)
            
            
        }
    })
}

$("#contact").click(function(){
    get_contact_person_list_table()
})

function get_contact_person_list(){
    var company_id = $("#company_list").find(":selected").val();
    $("#contact_person").find("*").remove();
    $("#contact_person").selectpicker('refresh');
    $.ajax({
        url: '../ajax/sm/ajax_view_customer.php',
        method: "POST",
        data: {
            get_contact_person_list: company_id
        },
        success: function(data){
            $("#contact_person").append(data);
            $("#contact_person").selectpicker('refresh');
        }
    })
}

$("#task").click(function(){
    
    
    get_contact_person_list();
})

$("#add_visit_plan").submit(function(e){
    e.preventDefault();
    var company_id = $("#company_list").find(":selected").val();
    var form_data = $(this).serialize()+"&plan_company_id="+company_id;
    
    var plan_date = $("#plan_date").val()
    var plan_comment = $("#plan_comment").val()

    if((plan_date != "") && (plan_comment != "")){
        $.ajax({
            url: '../ajax/sm/ajax_view_customer.php',
            method: "POST",
            data: form_data,
            success: function(data){
                if(data == '1'){
                    alert("Success!");
                    $("#add_visit_plan").trigger('reset');
                }else{
                    alert("Somthing Wrong!");
                    console.log(data);
                }
            }
        })
    }else{
        alert("FILL OUT ALL INPUT FIELDS");
    }

    
})

$("#add_app_plan").submit(function(e){
    e.preventDefault();
    var company_id = $("#company_list").find(":selected").val();
    var form_data = $(this).serialize()+"&app_company_id="+company_id;
    var app_date = $("#app_date").val();
    var contact_person = $("#contact_person").find(":selected").val();
    var comment = $("#comment").val();

    if((app_date != "") && (contact_person != "") && (comment != "")){
        $.ajax({
            url: '../ajax/sm/ajax_view_customer.php',
            method: "POST",
            data: form_data,
            success: function(data){
                if(data == '1'){
                    alert("Success!");
                    $("#add_app_plan").trigger('reset');
                    $("#contact_person").selectpicker('refresh')
                }else{
                    alert("Somthing Wrong!");
                    console.log(data);
                }
            }
        })
    }else{
        alert("FILL OUT ALL INPUT FIELDS");
    }
})