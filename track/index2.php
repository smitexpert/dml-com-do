<?php
$awn = "";

if(isset($_GET['awn'])){
    $awn = $_GET['awn'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DML Shipment Tracking</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
   <div class="container">
       <div class="row">
           <div class="col-md-12">
               <div class="tracking-group">
                  <div class="logo-head">
                      <img src="logo.png" alt="">
                      <h1>DML Track &amp; Trace</h1>
                  </div>
                   <div class="input-item">
                       <form action="" id="tracking_form">
                           <input id="awn" type="text" name="awn" placeholder="Enter Your Tracking Number" value="<?php echo $awn;?>" ><button>TRACK</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
       <div class="row">
           <div class="col-md-12">
              <div class="loading"><img src="giphy.gif" alt=""></div>
               <div id="result_table"></div>
           </div>
       </div>
       <!--<div class="footer-btn">
            <div class="login-link">
                <a href="admin.php">Login</a>
            </div>
       </div>-->
   </div>
    
    <script src="jquery-3.3.1.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
    <script>
        
        $(document).ready(function(){
            var awn = $("#awn").val();
            if(awn != ""){
                $(".loading").css("display", "block");
                $("#result_table").find("*").remove();
                $.ajax({
                    url: 'ajax.php',
                    method: 'get',
                    data: { awn: awn },
                    success: function(result){
                        $(".loading").css("display", "none");
                        if(result != 0){
                            $("#result_table").append(result);
                        }else{
                            alert("AWN Not Found!!!");
                        }
                    }
                });
            }
            
        });
        
        $("#tracking_form").on('submit', function(e){
            e.preventDefault();
            $(".loading").css("display", "block");
            var form_data = $(this).serialize();
            
            $("#result_table").find("*").remove();
            $.ajax({
                url: 'ajax.php',
                method: 'get',
                data: form_data,
                success: function(result){
                    $(".loading").css("display", "none");
                    if(result != 0){
                        $("#result_table").append(result);
                    }else{
                        alert("AWN Not Found!!!");
                    }
                }
            })
        })
    </script>
</body>
</html>