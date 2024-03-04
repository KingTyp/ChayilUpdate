<?php
 require_once('../config.php'); 
 
 ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Chayil Realtors Ltd</title>
</head>
<body>
    <!----------------------- Main Container -------------------------->
     <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!----------------------- Login Container -------------------------->
       <div class="row border rounded-5 p-3 bg-white shadow box-area">
    <!--------------------------- Left Box ----------------------------->
       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
           <div class="featured-image mb-3">
            <img src="images/2.png" class="img-fluid" style="width: 250px;">
           </div>
           <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">SYSTEM DATABASE</p>
           <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Evolving Forward...</small>
       </div> 
    <!-------------------- ------ Right Box ---------------------------->
        
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                     <h2>Chayil Realtors Ltd</h2>
                     <p>Please login!</p>
                </div>
                <form id="login-frm" action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control form-control-lg bg-light fs-6" placeholder="Enter Username!" required>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Enter Email!" required>
                </div>
                <div class="input-group mb-1">
                    <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Enter Password!" required>
                </div>
                <div class="input-group mb-5 d-flex justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="formCheck">
                        <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                    </div>
                   
                </div>
                <div class="input-group mb-3">
                    <button type="submit" name="submit" class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                </div>
                </form>
                
               
          </div>
       </div> 
      </div>
    </div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
  })
</script>
</body>
</html>