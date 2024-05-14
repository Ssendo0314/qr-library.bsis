<?php

require_once 'core/init.php';

$user = new UserLogin(); //Current

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ABOUT US</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	
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
	blockquote {  
		border-style: solid;
		border-width: 5px;
		font-size: 15px;
		font-family: "Times New Roman", Times, serif;
		border-color: #eee #17b978;
		border-left: 5px solid #17b978;
		padding:20px;
	}
	p { 
	    font-family: "Times New Roman", Times, serif;
	    
	}
	</style>
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
				<a href="home.php" class="breadcrumb-item f1-s-3 cl9">
					Home 
				</a>

				<span class="breadcrumb-item f1-s-3 cl9">
					About Us
				</span>
			</div>
		</div>
	</div>

	<!-- Page heading -->
	<div class="container p-t-4 p-b-40">
		<h2 class="f1-l-1 cl2">
			ABOUT US
		</h2>
	</div>

	<!-- Content -->
	<section class="bg0 p-b-60">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-8 p-b-30">
					<div class="p-r-10 p-r-0-sr991">
						<blockquote>
							<b class="text-danger">VISION</b><hr>
							<p>A leading quality polytechnic college nurturing highly employable, globally-competitive, excellently skilled and competent graduates.</p>
						</blockquote>
						<blockquote>
							<b class="text-danger">MISSION</b><hr>
							<p>The Bulacan Polytechnic College commits itself to:</p> 
							<br>

								<p>•Equip students with the relevant technological and intellectual skills and competencies to be globally competitive and highly employable;</p>
								<p>•Engage in productive and useful research studies for innovation and development of the BPC, its adopted community and stakeholders;</p>
								<p>•Provide industry-driven curricular programs;</p>
								<p>•Provide continuous professional and spiritual development among its faculty and staff;</p>
								<p>•Maintain the quality of its learning facilities at par with that of the industry and international standards;</p>
								<p>•Sustain servant leadership and excellent delivery of instruction; and</p>
								<p>•Open doors of opportunities for students through local and international partnerships, collaborations, and linkage </p> 
						</blockquote> 
						<blockquote>
							<b class="text-danger">LIBRARY OBJECTIVES</b><hr>
						
								<p>1. To provide adequate resources to meet the needs and demands of th library clintele. </p> 
								<p>2. To support the curriculum by providing related materials useful for theadvancement of the profession. </p> 
								<p>3. To serve as an instrument to support goals and objectives of Bulacan Polytechnic College. </p>
								<p>4. To maintain quick, efficient and effectiv service to the users at all times. </p> 
						</blockquote> 
					</div>
				</div>
				<!-- Sidebar -->
				<div class="col-md-5 col-lg-4 p-b-30">
					<div class="p-l-10 p-rl-0-sr991 p-t-5">
				
							
						</div>
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