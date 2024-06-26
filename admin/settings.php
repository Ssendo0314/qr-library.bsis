<?php
require_once 'core/init.php';

$user = new UserLogin(); //Current

if (Input::exists()) {
	$currentPass = Input::get('currentPassword');
	if ($user->isLoggedIn() && Hash::make($currentPass, $user->data()->password)) {
		$newPass = Input::get('newPassword');
		if ($user->updatePassword($newPass)) {
			echo "success"; // Return success if password is updated
		} else {
			echo "error"; // Return error if password update fails
		}
	} else {
		echo "wrong_password"; // Return wrong_password if current password is incorrect
	}


	if (isset($_POST['username'])) {
		$newUsername = $_POST['username'];
		if ($user->isLoggedIn()) {
			$updateResult = $user->updateUsername($newUsername);
			if ($updateResult) {
				echo "success";
			} else {
				echo "error";
			}
			exit; // Stop further execution after AJAX call
		} else {
			echo "error"; // Return error if user is not logged in
			exit;
		}
	}

	// if (isset($_POST['username'])) {
	// 	$newUsername = $_POST['username'];
	// 	$updateResult = $user->updateUsername($newUsername);
	// 	if ($updateResult) {
	// 		echo "success";
	// 	} else {
	// 		echo "error";
	// 	}
	// } else {
	// 	echo "error";
	// }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- bootstrap 3.0.2 -->
	<link href="styles/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- font Awesome -->
	<link href="styles/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="styles/admin/css/all.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
	<!-- Bootstrap Validator CSS -->
	<link href="styles/admin/css/bootstrapValidator.min.css" rel="stylesheet">
	<!-- DATA TABLES -->
	<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		.text_wrapper {}

		.edit_link {
			color: #0965F1;
		}

		.change {
			color: #0965F1;
		}

		.editbox {
			overflow: hidden;
			border: solid 1px #0099CC;
			width: 190px;
			font-size: 12px;
			padding: 5px
		}
	</style>
	<title>BPC Malolos Campus</title>
</head>

<body class="skin-blue">
	<!-- header logo: style can be found in header.less -->
	<?php include_once('navigation.php'); ?>

	<!-- Right side column. Contains the navbar and content of the page -->
	<aside class="right-side">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Administrator Settings
			</h1>
			<ol class="breadcrumb">
				<li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
				<li class="active">Administrator Settings</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title"><i class="fa fa-user-circle"></i> Login Information</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="progress-table-wrap">
								<div class="progress-table">
									<?php
									$user = DB::getInstance()->get('userLogin', array('id', '=', Session::get(Config::get('sessions/session_name'))));
									foreach ($user->results() as $user) {
									?>
										<div class="table-row">
											<div class="first">Username:</div>
											<div class="second">
												<div id="changeUsernameMessage">
													<?php echo $user->username; ?>
													<?php if (Session::exists('Updated')) { ?>
														<p class="text-success"><?php echo Session::flash('Updated'); ?></p>
													<?php } ?>
												</div>

												<div id="changeUname" style="display: none">
													<b>Change Username</b>
													<hr>
													<form id="changeUsername" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col-xs-10">
														<div class="form-group">
															Username:
															<input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username; ?>">
														</div>
														<button type="submit" class="btn btn-default">Save Changes</button>
														<button id="cancelUsername" type="button" class="btn btn-danger">Cancel</button>
													</form>
												</div>
											</div>
											<div class="third"><button class="edit_link btn btn-link" id="editUsername">Edit</button></div>
										</div>
										<div class="table-row">
											<div class="first">Password:</div>
											<div class="second">
												<div id="changepassmessage">
													Change your password here
													<?php if (Session::exists('wrongPassword')) { ?>
														<p class="text-danger"><?php echo Session::flash('wrongPassword'); ?></p>
													<?php } ?>
													<?php if (Session::exists('passwordChanged')) { ?>
														<p class="text-success"><?php echo Session::flash('passwordChanged'); ?></p>
													<?php } ?>
												</div>

												<div id="changePass" style="display: none">
													<b>Change your password here</b>
													<hr>
													<form id="changePassword" action="" method="post" class="col-xs-10">
														<div class="form-group">
															<input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password" required>
														</div>
														<div class="form-group">
															<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" required>
														</div>
														<div class="form-group">
															<input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password" required>
														</div>
														<button type="submit" class="btn btn-default">Save Changes</button>
														<button id="cancelPass" type="button" class="btn btn-danger">Cancel</button>
													</form>
												</div>
											</div>
											<div class="third"><button class="edit_link btn btn-link" id="change">Change Password</button></div>
										</div>
									<?php
									} ?>
								</div>
							</div>
						</div><!-- /.box-body -->

					</div><!-- /.box -->

				</div><!-- /.col -->
			</div><!-- /.row (main row) -->
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title"><i class="fa fa-user-circle"></i> User Information</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
							<div class="progress-table-wrap">
								<div class="progress-table">
									<?php
									$user = DB::getInstance()->get('userLogin', array('id', '=', Session::get(Config::get('sessions/session_name'))));
									foreach ($user->results() as $user) {
									?>
										<div class="table-row">
											<div class="first">Firstname:</div>
											<div class="second">
												<?php if (!$user->fname == '') {
													echo $user->fname;
												} else {
													echo '<p style="color: gray;">Click Edit User Info Button</p>';
												} ?>
											</div>
										</div>
										<div class="table-row">
											<div class="first">Lastname:</div>
											<div class="second">
												<?php if (!$user->lname == '') {
													echo $user->lname;
												} else {
													echo '<p style="color: gray;">Click Edit User Info Button</p>';
												} ?>
											</div>
										</div>
										<?php if (Session::exists('userUpdated')) { ?>
											<div class="table-row">
												<div class="first"></div>
												<div class="second">
													<p class="text-success"><?php echo Session::flash('userUpdated'); ?></p>
												</div>
											</div>
										<?php } ?>
										<div class="table-row">
											<div class="first">
												<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
													<i class="fa fa-edit fa-fw"></i>&nbsp;Edit User Info
												</button>
											</div>
											<div class="second">
												<button type="submit" class="btn btn-info" data-toggle="modal" data-target="#avatar">
													View/Edit Avatar
												</button>
											</div>
										</div>
										<!-- Modal -->
										<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title" id="exampleModalLabel">Edit User Information</h3>
													</div>
													<div class="modal-body">
														<form id="editUserInfoForm" enctype="multipart/form-data" action="updateName.php" method="post">
															<label class="control-label" for="fname">
																<font color="#EC0003">*</font> Firstname
															</label>
															<div class="form-group">
																<input type="text" class="form-control" id="fname" name="fname" value="<?php echo $user->fname; ?>" placeholder="Input Firstname" required>
															</div>
															<label class="control-label" for="lname">
																<font color="#EC0003">*</font> Lastname
															</label>
															<div class="form-group">
																<input type="text" class="form-control" id="lname" name="lname" value="<?php echo $user->lname; ?>" placeholder="Input Lastname" required>
															</div>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-success" value="save"><i class="glyphicon glyphicon-edit"></i> Save</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
														</form>
													</div>
												</div>
											</div>
										</div>
										<!-- Modal -->
										<div class="modal fade" id="avatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h3 class="modal-title" id="exampleModalLabel">View or Edit Avatar</h3>
													</div>
													<div class="modal-body">
														<form enctype="multipart/form-data" method="post" action="editUserInfo.php">
															<center>
																<?php if (!$user->avatar == '') {
																	echo '<img width="50%" src="admin/uploads/avatar/' . $user->avatar . '">';
																} else {
																	echo '<img width="50%" src="admin/uploads/avatar/default.jpg" >';
																} ?>
															</center>
															<hr>
															<label class="control-label" for="upload">
																<font color="#EC0003">*</font> Upload New Avatar
															</label>
															<div class="form-group">
																<input type="file" id="fileName" name='upload' accept=".jpg,.jpeg,.png" onchange="validateFileType()" required>
															</div>
															<script type="text/javascript">
																function validateFileType() {
																	var fileName = document.getElementById("fileName").value;
																	var idxDot = fileName.lastIndexOf(".") + 1;
																	var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
																	if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
																		//TO DO
																	} else {
																		alert("Only jpg/jpeg and png files are allowed!");
																	}
																}
															</script>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
														</form>
													</div>
												</div>
											</div>
										</div>
									<?php
									} ?>
								</div>

							</div>

						</div><!-- /.box -->

					</div><!-- /.box -->

				</div><!-- /.col -->
			</div><!-- /.row (main row) -->
		</section><!-- /.content -->
	</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->

	<!-- jQuery 2.0.2 -->
	<script src="styles/admin/js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- AdminLTE App -->
	<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
	<!-- Bootstrap Validator JS -->
	<script src="styles/admin/js/bootstrapValidator.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#cancelPass").click(function() {
				$("#change").show();
				$("#changePass").hide();
				$("#changepassmessage").show();
			});

			$("#change").click(function() {
				$("#change").hide();
				$("#changePass").show();
				$("#changepassmessage").hide();
			});

			$("#cancelUsername").click(function() {
				$("#editUsername").show();
				$("#changeUname").hide();
				$("#changeUsernameMessage").show();
			});

			$("#editUsername").click(function() {
				$("#editUsername").hide();
				$("#changeUname").show();
				$("#changeUsernameMessage").hide();
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			var validator = $("#changePassword").bootstrapValidator({
				fields: {
					currentPassword: {
						validators: {
							notEmpty: {
								message: "Password is required."
							},
							stringLength: {
								min: 6,
								max: 35,
								message: "Password must be beetween 6 and 35 characters long"
							}
						}
					},
					newPassword: {
						validators: {
							notEmpty: {
								message: "New Password is required."
							},
							stringLength: {
								min: 6,
								max: 35,
								message: "Password must be beetween 6 and 35 characters long"
							}
						}
					},
					confirmNewPassword: {
						validators: {
							notEmpty: {
								message: "Confirm new password is required."
							},
							stringLength: {
								min: 6,
								max: 35,
								message: "Password must be beetween 6 and 35 characters long"
							},
							identical: {
								field: 'newPassword',
								message: 'This must be the same as the password'
							}
						}
					},
				}
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			// AJAX request for changing username
			$("#changeUsername").submit(function(event) {
				event.preventDefault(); // Prevent form submission

				var formData = $(this).serialize(); // Serialize form data

				$.ajax({
					type: "POST",
					url: window.location.href, // Submit to the same page
					data: formData,
					success: function(response) {
						if (response == "success") {
							$("#changeUsernameMessage").html("<p class='text-success'>Username has been successfully updated.</p>");
							alert("Username has been successfully updated.");
							location.reload();
						} else {
							$("#changeUsernameMessage").html("<p class='text-danger'>Failed to update username!</p>");
							alert("Failed to update username!");
						}
					}
				});
			});

			// AJAX request for changing password
			$("#changePassword").submit(function(e) {
				e.preventDefault(); // Prevent the form from submitting normally

				// Get form data
				var formData = $(this).serialize();

				// Send AJAX request
				$.ajax({
					type: "POST",
					url: window.location.href,
					data: formData,
					success: function(response) {
						if (response === "success") {
							alert("Password changed successfully!"); // Show success message
							location.reload(); // Refresh the page after success
						} else if (response === "wrong_password") {
							alert("Incorrect current password!"); // Show error message for wrong password
						} else {
							alert("Failed to change password!"); // Show error message for other failures
						}
					},
				});
			});


			// // AJAX request for changing first/last name
			// $("#editUserInfoForm").click(function() {
			// 	e.preventDefault();
			// 	var newFirstname = $('#fname').val();
			// 	var newLastname = $('#lname').val();

			// 	$.ajax({
			// 		type: 'POST',
			// 		url: 'updateName.php',
			// 		data: {
			// 			fName: newFirstname,
			// 			lname: newLastname
			// 		},
			// 		success: function(response) {
			// 			if (response === 'success') {
			// 				alert('Name updated successfully.');
			// 				// location.reload(); // Refresh the page after successful update
			// 			} else {
			// 				alert('Failed to update name.');
			// 			}
			// 		},
			// 		error: function() {
			// 			alert('An error occurred while processing your request.');
			// 		}
			// 	});
			});
		});
	</script>
</body>

</html>