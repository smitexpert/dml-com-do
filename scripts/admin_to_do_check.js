$("#app_table").dataTable();
$("#visit_plan").dataTable();

$("#select_staff").change(function () {
    var staff_id = $(this).find(":selected").val();
    var date = $("#todo_select_date").val();

    if ((staff_id != "") && (date != "")) {
        $(".view_item").css("display", "block");
        $.ajax({
            url: "../ajax/sm/ajax_admin_to_do_check.php",
            method: "POST",
            data: {
                visit_plan_ajax: '',
                staff_id: staff_id,
                to_do_date: date
            },
            dataType: "JSON",
            success: function (data) {
                var t = $("#visit_plan").DataTable();
                t.clear().draw();
                $.each(data, function (index, d) {
                    t.row.add([
                        index + 1,
                        d.company_name,
                        d.comment,
                        d.plan_date,
                        d.plan_time,
                        d.status,
                        "<a href='#' onclick='plan_view(event)' id='plan_" + d.id + "' class='btn btn-sm btn-warning plan_view' data-toggle='modal' data-target='#planModal'>#</a>"
                    ]).draw(false);
                })
            }
        })

        $.ajax({
            url: "../ajax/sm/ajax_admin_to_do_check.php",
            method: "POST",
            data: {
                app_plan_ajax: '',
                staff_id: staff_id,
                to_do_date: date
            },
            dataType: "JSON",
            success: function (data) {
                var t = $("#app_table").DataTable();
                t.clear().draw();
                $.each(data, function (index, d) {
                    t.row.add([
                        index + 1,
                        d.company_name,
                        d.name,
                        d.comment,
                        d.app_date,
                        d.app_time,
                        d.status,
                        "<a href='#' onclick='app_view(event)' id='app_" + d.id + "' class='btn btn-sm btn-warning app_view' data-toggle='modal' data-target='#appModal'>#</a>"
                    ]).draw(false);

                })
            }
        })
    }else{
        $(".view_item").css("display", "none");
    }
})

$(function () {
    $("#todo_select_date").datepicker({
        dateFormat: "yy-mm-dd"
    });
})

$("#todo_view_form").submit(function (e) {
    e.preventDefault();
    var staff_id = $("#select_staff").find(":selected").val();
    var date = $("#todo_select_date").val();

    if ((staff_id != "") && (date != "")) {
        $.ajax({
            url: "../ajax/sm/ajax_admin_to_do_check.php",
            method: "POST",
            data: {
                visit_plan_ajax: '',
                staff_id: staff_id,
                to_do_date: date
            },
            dataType: "JSON",
            success: function (data) {
                var t = $("#visit_plan").DataTable();
                t.clear().draw();
                $.each(data, function (index, d) {
                    t.row.add([
                        index + 1,
                        d.company_name,
                        d.comment,
                        d.plan_date,
                        d.plan_time,
                        d.status,
                        "<a href='#' onclick='plan_view(event)' id='plan_" + d.id + "' class='btn btn-sm btn-warning plan_view' data-toggle='modal' data-target='#planModal'>#</a>"
                    ]).draw(false);
                })
            }
        })

        $.ajax({
            url: "../ajax/sm/ajax_admin_to_do_check.php",
            method: "POST",
            data: {
                app_plan_ajax: '',
                staff_id: staff_id,
                to_do_date: date
            },
            dataType: "JSON",
            success: function (data) {
                var t = $("#app_table").DataTable();
                t.clear().draw();
                $.each(data, function (index, d) {
                    t.row.add([
                        index + 1,
                        d.company_name,
                        d.name,
                        d.comment,
                        d.app_date,
                        d.app_time,
                        d.status,
                        "<a href='#' onclick='app_view(event)' id='app_" + d.id + "' class='btn btn-sm btn-warning app_view' data-toggle='modal' data-target='#appModal'>#</a>"
                    ]).draw(false);

                })
            }
        })
    }
})

function plan_view(event){
    var id = $(event.target).attr("id");
    id = id.replace('plan_', '');
    $.ajax({
      url: "../ajax/sm/ajax_view_plan.php",
      method: "POST",
      data: {
        plan_view_modal: id
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data);
        $("#visit_company").text(data.company_name);
        $("#visit_address").text(data.address);
        $("#visit_date").text(data.plan_date);
        $("#visit_time").text(data.plan_time);
        $("#visit_plan_id").val(data.id);
        $("#visit_status").val(data.status);
        $("#visit_report").val("");
      }
    })

    $.ajax({
      url: "../ajax/sm/ajax_reoport_form.php",
      method: "POST",
      data: {
        visit_get_report: id
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data);
        if(data.report != null){
          $("#visit_report").val(data.report)
        }
      }
    })
}

function app_view(event){
    var id = $(event.target).attr("id");
    id = id.replace('app_', '');
    $.ajax({
      url: "../ajax/sm/ajax_view_plan.php",
      method: "POST",
      data: {
        app_view_modal: id
      },
      dataType: 'JSON',
      success: function(data){
        // console.log(data);
        $("#app_company_name").text(data.company_name);
        $("#app_address").text(data.address);
        $("#app_date").text(data.app_date);
        $("#app_id").val(id);
        $("#app_time").text(data.app_time);
        $("#app_contact_name").text(data.name);
        $("#app_mobile").text(data.mobile);
        $("#app_email").text(data.email);
        $("#app_status").val(data.status);
        $("#app_report").val("");
        
      }
    })

    $.ajax({
      url: "../ajax/sm/ajax_reoport_form.php",
      method: "POST",
      data: {
        app_get_report: id
      },
      dataType: "JSON",
      success: function(data){
        // console.log(data);
        if(data.report != null){
          $("#app_report").val(data.report)
        }
      }
    })
}

$("#app_report_form").submit(function(e){
    e.preventDefault();
    var form_data = $(this).serialize();
    $.ajax({
      url: "../ajax/sm/ajax_reoport_form.php",
      method: "POST",
      data: form_data,
      success: function(data){
        if(data == '1'){
          alert("Status Updated!");
          $('#appModal').modal('toggle');
          // console.log(data);
        }else if(data == '0'){
          alert("Status Not Updated!");
          $('#appModal').modal('toggle');
          // console.log(data);
        }else{
          alert("Something Wrong@");
          $('#appModal').modal('toggle');
          console.log(data);
        }
      }
    })
  })

  $("#visit_report_form").submit(function(e){
    e.preventDefault();
    var form_data = $(this).serialize();
    $.ajax({
      url: "../ajax/sm/ajax_reoport_form.php",
      method: "POST",
      data: form_data,
      success: function(data){
        if(data == '1'){
          alert("Status Updated!");
          $('#planModal').modal('toggle');
          // console.log(data);
        }else if(data == '0'){
          alert("Status Not Updated!");
          $('#planModal').modal('toggle');
          // console.log(data);
        }else{
          alert("Something Wrong@");
          $('#planModal').modal('toggle');
          // console.log(data);
        }
      }
    })
  })