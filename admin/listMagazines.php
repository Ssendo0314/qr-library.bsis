<?php
if (Input::exists()) {
		$PNG_TEMP_DIR =  dirname(__FILE__).DIRECTORY_SEPARATOR.'magazineQRCodes'.DIRECTORY_SEPARATOR;
		
		$magazines = DB:: getInstance()->get('magazines', array('id','=',Input::get('id')));							
		foreach($magazines->results() as $magazines){
			unlink($PNG_TEMP_DIR.$magazines->qrcode);
		}
		
		$contents = DB:: getInstance()->delete('magazines', array('id','=',Input::get('id')));													
		Session::flash('Deleted', 'Record has been successfully deleted.');
		Redirect::to('admin.php?action=listMagazines');
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
<!-- Ionicons -->
<link href="styles/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                        Magazine List
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="admin.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">Magazine List</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Magazine List</h3>    
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-primary btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <?php if(Session::exists('Deleted')){ ?>
                                             <div class="alert alert-danger">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Deleted'); ?>
                                             </div>
                                    <?php }?> 
                                    <?php if(Session::exists('Updated')){ ?>
                                             <div class="alert alert-success">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Updated'); ?>
                                             </div>
                                    <?php }?>
									<?php if(Session::exists('Added')) { ?>
										<div class="alert alert-success">
											<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Added'); ?>
										</div>
									<?php }?>
                                    <table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
												<th>ISBN</th>
												<th>Title of the Magazine</th>
                                                <th>Author</th>
												<th>Date Published</th>
												<th>Status</th>
												<th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$magazines = DB:: getInstance()->query("SELECT * FROM magazines");		
												foreach($magazines->results() as $magazines){ ?>
														<tr>
															<td><?php echo $magazines->isbn ; ?></td>
															<td><?php echo $magazines->magazineTitle ; ?></td>
															<td><?php echo $magazines->author ; ?></td>
															<td><?php echo $magazines->datePublished ; ?></td>
															<td align="center">
																<?php if($magazines->is_borrowed == 1){?>
																	<span class="label label-danger"> Not Available </span></td>
																<?php }else{?>
																	<span class="label label-success"> Available </span></td>
																<?php }?>
															</td>
															<td align="center">
																<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal_<?php echo ucwords($magazines->id); ?>" >View QRCODE</button>
																<!-- Modal -->
																<div id="myModal_<?php echo ucwords($magazines->id); ?>" class="modal fade" role="dialog">
																	<div class="modal-dialog">

																	<!-- Modal content-->
																		<div class="modal-content">
																			<div class="modal-header">
																				<h4 class="modal-title"><?php echo ucwords($magazines->magazineTitle); ?></h4>
																			</div>
																			<div class="modal-body" >
																				<image src="admin/magazineQRCodes/<?php echo ucwords($magazines->qrcode) ?>"/>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-primary" onclick="printImg('admin/magazineQRCodes/<?php echo ucwords($magazines->qrcode) ?>')">Print</button>
																				<a href="admin/magazineQRCodes/<?php echo ucwords($magazines->qrcode) ?>" download><button type="button" class="btn btn-primary">Download</button></a>
																				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			</div>
																		</div>

																	</div>
																</div>
																<?php require_once ('delete-confirm.php');?>
																<form method="POST" action="" style="display:inline">
																	<input type="hidden" name="id" value="<?php echo $magazines->id;  ?>">
																	<button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Confirm Delete" data-message="Are you sure you want to delete this?">
																		<i class="glyphicon glyphicon-trash"></i> Delete
																	</button>
																</form>
																<form method="POST" action="admin.php?action=editMagazine&id=<?php echo $magazines->id; ?>" style="display:inline">
																	<button class="btn btn-xs btn-primary" type="submit">
																		<i class="glyphicon glyphicon-edit"></i> Edit
																	</button>
																</form>
															</td>
														</tr>
												<?php 
												}
												?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
								<div class="box-footer">
                                	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
									Add New Magazine
									</button>
									<!-- Modal -->
									<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title" id="exampleModalLabel">Add New Magazine</h3>
										</div>
										<div class="modal-body">
											<form enctype="multipart/form-data" method="post" action="addMagazine.php">
												<label class="control-label" for="isbn"><font color="#EC0003">*</font> International Standard Book Number</label>
												<div class="form-group">
													<input type="text" class="form-control" id="isbn" name="isbn" placeholder="Input ISBN" required >
												</div>
												<label class="control-label" for="magazineTitle"><font color="#EC0003">*</font> Magazine Title</label>
												<div class="form-group">
													<input type="text" class="form-control" id="magazineTitle" name="magazineTitle" placeholder="Input Title of the Magazine" required >
												</div>
												<label class="control-label" for="author"><font color="#EC0003">*</font> Author</label>
												<div class="form-group">
													<input type="text" class="form-control" id="author" name="author" placeholder="Input Author" required >
												</div>
												<label class="control-label" for="datePublished"><font color="#EC0003">*</font> Date Published</label>
												<div class="form-group">
														<input type="text" class="form-control" id="datePublished" name="datePublished" placeholder="mm/dd/yyyy" required  data-provide="datepicker">
												</div>
												
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-lg btn-success" value="save"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
											<button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancel</button>
											</form>
										</div>
										</div>
									</div>
									</div>
                                </div>
                            </div><!-- /.box -->

                        </div><!-- /.col -->
                    </div><!-- /.row (main row) -->
					
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="styles/admin/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Bootstrap Datepicker -->
<script src="js/bootstrap-datepicker.min.js"></script>
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
    $(function() {
        $("#articles").dataTable();
    });
	function printImg(url) {
	  var win = window.open('');
	  win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
	  win.focus();
	}
</script>
<script type="text/javascript">
  $('#confirmDelete').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>
</body>

</html>
