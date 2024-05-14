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
	<style>
	blockquote {  
		border-style: solid;
		border-width: 5px;
		font-size: 15px;
		font-style: italic;
		border-color: #eee #17b978;
		border-left: 5px solid #17b978;
		padding:20px;
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
						<p class="f1-s-11 cl6 p-b-25">
							TThe Bulacan Polytechnic College (BPC) was formerly known as the Bulacan Public Community College (BPCC). It was established upon the approval of the Secretary of Education on June 8, 1971 and started its operations in 1972. The approval came under the leadership of Governor Ignacio (Nacing) Santiago and the principal of Marcelo H. Del Pilar High School (MHPHS) Miss Juana E. Ladia, who then become the first school administrator. BPCC started with 44 enrollees. Two courses were initially offered from 1972 to 1974: the two-year Junior Secretarial course with 15 students and the General Education course with 29 students. Classes were held at Marcelo H. Del Pilar High School Main Building and started from 5pm to 9pm.
						</p>

						<p class="f1-s-11 cl6 p-b-25">
						</p>

						<p class="f1-s-11 cl6 p-b-25">
						</p>
						<blockquote>
							<b class="text-danger">PHILOSOPHY</b><hr>
							<p>Home of the Brave, the Beautiful, and the Blessed.</p>
						</blockquote>
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