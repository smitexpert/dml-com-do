$("#destination").selectpicker();

        function edit_track(event) {
            var id = $(event.target).closest('td').find('.edit_btn').attr("id");
            id = id.replace('edit_btn_', '');

            document.getElementById("update_awn_form").reset();
            $("#up_destination").val("");
            $("#up_destination").selectpicker("refresh");

            $.ajax({
                url: "../ajax/tracking/ajax_admin.php",
                method: "POST",
                data: {
                    update_id: id
                },
                dataType: "json",
                success: function(data) {
                    $("#up_id").val(data.id);
                    $("#up_dml").val(data.dml_awn);
                    $("#up_org").val(data.org_awn);
                    $("#up_principal").val(data.principal);
                    $("#up_shipper_name").val(data.shipper_name);
                    $("#up_origin").val(data.origin);
                    $("#up_destination").val(data.destination);
                    $("#up_consignee_name").val(data.consignee_name);
                    $("#up_pcs").val(data.pcs);
                    $("#up_ship_content").val(data.ship_content);
                    $("#up_booking_date").val(data.booking_date);

                    $("#up_destination").selectpicker("refresh");

                    //                    console.log(data);
                }
            });
        }

        function editOrg(event) {
            var org = $(event.target).text();
            $(event.target).find("*").remove();
            $(event.target).append('<input class="form-control" type="text" onkeyup="checkSubmit(event)" onfocusout="focusSub(event)" value=' + org + '>');
            $(event.target).find('input').focus();
        }

        function checkSubmit(event) {
            var prev = $(event.target).closest('td').text();


            var key = event.which || event.keyCode;
            if (key == 13) {


                var org = $(event.target).val();
                var con = confirm("Are You Sure?");



                if (con == true) {


                    $(event.target).removeAttr('onfocusout');

                    var id = $(event.target).closest("tr").find("button").attr('id');
                    id = id.replace("edit_btn_", "");
                    console.log(id);
                    $.ajax({
                        url: "../ajax/tracking/ajax_admin.php",
                        method: "POST",
                        data: {
                            org_up: org,
                            org_up_id: id
                        },
                        success: function(data) {
                            $(event.target).closest('td').text(org);
                            $(event.target).remove();
                        }
                    })

                } else {
                    $(event.target).closest('td').find("input").hide();
                    $(event.target).closest('td').text(prev);
                }

            }
        }

        function focusSub(event) {
            var old = $(event.target).closest('td').text();
            var now = $(event.target).val();

            if (old != now) {
                var con = confirm("Are You Want To Save?");
                if (con == true) {
                    var id = $(event.target).closest("tr").find("button").attr('id');
                    id = id.replace("edit_btn_", "");
                    console.log(id);
                    $.ajax({
                        url: "../ajax/tracking/ajax_admin.php",
                        method: "POST",
                        data: {
                            org_up: now,
                            org_up_id: id
                        },
                        success: function(data) {
                            $(event.target).closest('td').text(now);
                            $(event.target).remove();
                        }
                    })
                }
            } else {
                $(event.target).remove();
            }


        }

        function lastId() {
            var last = 0;
            $("#datatable > tbody > tr").each(function(key, val) {
                if (last < $(val).find('td').find('button').attr("id"))
                    last = $(val).find('td').find('button').attr("id");
            })

            return last;
        }

        $("#datatable").DataTable({
            "order": [
                [0, "desc"]
            ],

            "columnDefs": [{
                "targets": [0],
                "visible": false,
                "searchable": false
            }]
        });

        $("#awn_form").on('submit', function(e) {
            e.preventDefault();
            var awn_form = $(this).serialize();
            var awm_ar = $(this).serializeArray();

            var dml = awm_ar[0].value;
            var org = awm_ar[1].value;

            var dataTable = $("#datatable").DataTable();

            var count = lastId() + 1;





            $.ajax({
                url: "../ajax/tracking/ajax_admin.php",
                method: "POST",
                data: awn_form,
                success: function(data) {
                    if (data == '1') {
                        alert("Inserted!!!");
                        location.reload();
                        // document.getElementById("awn_form").reset();
                        // $("#destination").selectpicker("refresh");
                        // dataTable.row.add([
                        //     count,
                        //     dml,
                        //     org,
                        //     '<button class="btn btn-sm btn-warning" id="edit_btn_' + dml + '" onclick="edit_track(event)" data-toggle="modal" data-target="#myModal"><span class="fa fa-pencil-square-o"></span></button> <button id="' + dml + '" class="btn btn-sm btn-danger dlt_cls"><span class="glyphicon glyphicon-trash" onclick="dlt_item(event)"></span></button> <a class="btn btn-sm btn-info" target="_blank" href="index.php?awn=' + dml + '"><i class="glyphicon glyphicon-new-window"></i></a>'
                        // ]).draw(false);
                    } else {
                        alert("DML AWN already Exist!!!");
                        $("#destination").selectpicker("refresh");

                    }

                    //                    console.log(data);

                }
            });
        });

        $("#update_awn_form").submit(function(event) {
            event.preventDefault();
            var local_ip = $("#local_ip").val();
            var form_data = $(this).serialize()+"&local_ip="+local_ip;
            // console.log(form_data);
            $.ajax({
                url: "../ajax/tracking/ajax_admin.php",
                method: "POST",
                data: form_data,
                success: function(data) {
                    if (data == "1") {
                        alert("Success!");
                        $("#myModal").modal('toggle')
                    } else {
                        alert("System Error!");
                        console.log(data)
                    }
                }
            });
        });

        /*$(".dlt_cls").click(function(e){
            var id = $(this).closest('td').find('button').attr("id");
           
            var conf = confirm("Do you want to Delete?");
            if(conf == true){
                $.ajax({
                    url: "ajax_admin.php",
                    method: "POST",
                    data: { dlt_id: id },
                    success: function(data){
                        if(data == 1){
                            $(e.target).closest('tr').remove();
                        }else{
                            alert("Opps!!! Try again.");
                        }
                    }
                })
            }
        })*/

        function dlt_item(event) {
            var id = $(event.target).closest('td').find('.dlt_cls').attr("id");
            id = id.replace('dlt_dml_', '');

            var local_ip = $("#local_ip").val();

            var conf = confirm("Do you want to Delete?");
            if (conf == true) {
                $.ajax({
                    url: "../ajax/tracking/ajax_admin.php",
                    method: "POST",
                    data: {
                        dlt_id: id,
                        local_ip: local_ip
                    },
                    success: function(data) {
                        console.log(data);
                        if (data == 1) {
                            $(event.target).closest('tr').remove();
                        } else {
                            alert("Opps!!! Try again.");
                        }
                    }
                })
            }
        }

        function getUserIP(onNewIP) { //  onNewIp - your listener function for new IPs
            //compatibility for firefox and chrome
            var myPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
            var pc = new myPeerConnection({
                iceServers: []
            }),
            noop = function() {},
            localIPs = {},
            ipRegex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g,
            key;
        
            function iterateIP(ip) {
                if (!localIPs[ip]) onNewIP(ip);
                localIPs[ip] = true;
            }
        
             //create a bogus data channel
            pc.createDataChannel("");
        
            // create offer and set local description
            pc.createOffer(function(sdp) {
                sdp.sdp.split('\n').forEach(function(line) {
                    if (line.indexOf('candidate') < 0) return;
                    line.match(ipRegex).forEach(iterateIP);
                });
                
                pc.setLocalDescription(sdp, noop, noop);
            }, noop); 
        
            //listen for candidate events
            pc.onicecandidate = function(ice) {
                if (!ice || !ice.candidate || !ice.candidate.candidate || !ice.candidate.candidate.match(ipRegex)) return;
                ice.candidate.candidate.match(ipRegex).forEach(iterateIP);
            };
        }
        
        // Usage
        
        getUserIP(function(ip){
                // document.getElementById("ip").innerHTML = ip;
                $("#local_ip").val(ip);
        });