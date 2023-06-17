<?php
    session_start();
    require_once 'class.user.php';
    $user_login = new USER();

    if($user_login->is_logged_in()!="")
    {
    ?>
        <script>
            window.location.href = "home.php";
        </script>
    <?php
    }

    if(isset($_POST['login']))
    {
        $uname = trim(strtolower($_POST['email']));
        $upass = trim($_POST['password']);
        
        if($user_login->login($uname,$upass))
        {
            $stmt = $user_login->runQuery("SELECT * FROM users WHERE email=:email_id");
            $stmt->execute(array(":email_id"=>$uname));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row['firstname'] != '' && $row['lastname'] != '' && $row['telephone'] != '' && $row['acct_number'] != '')
            {
            ?>
                <script>
                    window.location.href = "index.php";
                </script>
            <?php
            }
            else
            {
            ?>
                <script>
                    window.location.href = "setup.php";
                </script>
            <?php
            }
        }
    }
?>
<!-- - var menuBorder = true-->
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="TEKYield is an online investment platform that gives investors or customers 30% interest or returns on their investment after 30 days of investment">
  <meta name="keywords" content="Tekyield, Invest, Investment, Make money, Interest, Returns, Online Investment, Online Business">
  <meta name="author" content="TEKYield">
  <title>Login :: TEKYield</title>
  <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/icheck.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/custom.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN STACK CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
  <!-- END STACK CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/pages/login-register.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page"
data-open="click" data-menu="vertical-menu" data-col="1-column">
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <div class="p-1">
                      <!-- <img src="app-assets/images/logo/stack-logo-dark.png" alt="branding logo"> -->
                      <span style="font-size:30px; font-weight:bold; text-transform:none"><center><i class="fa fa-fort-awesome"></i> Safevest</center></span>
                    </div>
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>Login</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form class="form-horizontal form-simple" method="post">
                        <?php
                            if(isset($_GET['error']))
                            {
                            ?>
                                <div class='alert alert-success'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Wrong Details!</strong> 
                                </div>
                            <?php
                            }elseif(isset($_GET['inactive'])){
                            ?>
                                <div class='alert alert-danger'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Your Account has not been activated <br />
                                </div>
                            <?php
                            }
                        ?>
                      <fieldset class="form-group position-relative has-icon-left mb-0">
                        <input type="text" class="form-control form-control-lg" id="user-name" name="email" placeholder="Your Email"
                        required>
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control form-control-lg" id="user-password" name="password" placeholder="Enter Password"
                        required>
                        <div class="form-control-position">
                          <i class="fa fa-key"></i>
                        </div>
                      </fieldset>
                      <!-- <div class="form-group row">
                        <div class="col-md-6 col-12 text-center text-md-left">
                          <fieldset>
                            <input type="checkbox" id="remember-me" class="chk-remember">
                            <label for="remember-me"> Remember Me</label>
                          </fieldset>
                        </div>
                        <div class="col-md-6 col-12 text-center text-md-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                      </div> -->
                      <button type="submit" class="btn btn-success btn-lg btn-block" name="login"><i class="ft-unlock"></i> Login</button>
                    </form>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="">
                    <p class="float-sm-left text-center m-0"><a href="recover-password.php" class="card-link">Recover password</a></p>
                    <p class="float-sm-right text-center m-0"><a href="register.php" class="card-link">Sign Up</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <!-- BEGIN VENDOR JS-->
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"
  type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN STACK JS-->
  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <!-- END STACK JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="app-assets/js/scripts/forms/form-login-register.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
</body>
</html>