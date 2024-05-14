 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SIGNUP</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">
    
    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            
            <?php include 'includes/top-header.php'; ?>
            <!--  -->
            <?php include 'includes/wrap-main-nav.php'; ?>  
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="container">
        <div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
            <div class="f2-s-1 p-r-30 m-tb-6">
                <a href="index.php" class="breadcrumb-item f1-s-3 cl9">
                    Home 
                </a>

                <span class="breadcrumb-item f1-s-3 cl9">
                    Login
                </span>
            </div>
        </div>
    </div>

    <!-- Page heading -->
    <div class="container p-t-4 p-b-40">
        <h2 class="f1-l-1 cl2" style="text-align:center">
            SIGN UP
        </h2>
    </div>

    <!-- Content -->
<section class="bg0 p-b-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 p-b-80">
                <div class="p-r-10 p-r-0-sr991">
                    <form method="post" action="signup_process.php">
                        <?php if (Session::exists('signup_success')) { ?>
                            <div class="alert alert-success">
                                <i class="glyphicon glyphicon-info-sign"></i> &nbsp;<?php echo Session::flash('signup_success'); ?>
                            </div>
                        <?php } ?>
                        <?php if (Session::exists('signup_error')) { ?>
                            <div class="alert alert-danger">
                                <i class="fa fa-close"></i> &nbsp;<?php echo Session::flash('signup_error'); ?>
                            </div>
                        <?php } ?>
                        <label style="font-size: 20px; padding-bottom:5px;" for="permission"> Signup as: </label>
                        <select class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" class="form-control" name="permission" id="permission" required>
                            <option hidden value="">Select One</option>
                            <?php
                            $permissions = DB::getInstance()->query("SELECT * FROM groups");
                            foreach ($permissions->results() as $permission) {
                            ?>
                                <option value="<?php echo $permission->id ?>"><?php echo ucwords($permission->name) ?></option>
                            <?php } ?>
                        </select>
                        <!-- Add additional fields for signup information -->
                        <input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="username" placeholder="Username" required>
                        <input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="password" name="password" placeholder="Password" required>
                        <input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="firstname" placeholder="First Name" required>
                        <input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="middlename" placeholder="Middle Name" required>
                        <input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="lastname" placeholder="Last Name" required>
                        <input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="email" name="email" placeholder="Email" required>
                        
                        <!-- Add more fields as needed -->

                        <center>
                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                            <button type="submit" class="size-a-20 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-20">
                                Sign Up
                            </button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

    
    <!-- Footer -->
    <?php include 'includes/footer.html'; ?>

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <span class="fas fa-angle-up"></span>
        </span>
    </div>


<!--===============================================================================================-->  
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>
</html>