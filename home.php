	<?php

require_once 'core/init.php';

$user = new UserLogin(); //Current

if($user->isLoggedIn()) {
    Redirect::to('index.php');
}

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
            $user = new UserLogin();
			$logindetails = new LoginDetails();
			
            $login = $user->login(Input::get('username'), Input::get('password'), Input::get('permission'));

            if($login) {
				try {
				$user->update(array(
					'online' => 1,
					), $user->data()->id);
				} catch(Exception $e) {
					$error;
				}
				$lastInsertId = $logindetails->insertUserLoginDetails($user->data()->id);
				$_SESSION['login_details_id'] = $lastInsertId;
				
				if($user->isAdmin()) {
                    Redirect::to('admin.php');
				}else{
				    Redirect::to('index.php');
				}
            } else {
				Session::flash('incorrectData', 'Incorrect username or password');
            }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
<style>
	.facade {
            background: linear-gradient(rgb(0 0 0 / 20%), rgb(0 0 0 / 20%)),  url('https://bulacanpolytechniccollege.com/bpc-banner.jpg');
            background-size: cover;
            height: 100vh;

        }
        #newNav{
            background-color: rgb(7, 131, 7) !important;
        }
        .newFooter {
            height: 30px !important;
        /* position: fixed; */
        left: 0;
        bottom: 0;
        width: 100%;
        background-color:rgb(7, 131, 7);
        color: white;
        /* text-align: center; */
        /* padding: 1.5rem 30px; */
        }
</style>
</head>
<body class="animsition">
	
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			
			<?php include 'includes/top-header.php'; ?>
		</div>
	</header>
	<!-- Content -->
	<main>
        <div id="app"></div>
    <section class="section facade">
        <div class="container pt-lg pb-300" style=""> 
            <div class="row justify-content-center text-center" >
                <div class="col-md-12">
                	<br><br>
                    <img src="https://bulacanpolytechniccollege.com/Bulacan Polytechnic College icon.ico" 
                        alt="">
                        <br>
                        <h1 class="text-white" style="text-shadow: 5px 5px black; font-weight:600;font-size: 50px;">
                            BULACAN POLYTECHNIC COLLEGE 
                            <br>
                            ELECTRONIC LIBRARY SYSTEM
                        </h1>
                </div>
            </div>
        </div>

    </section>
    </main>
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
<!--=======================
	========================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>