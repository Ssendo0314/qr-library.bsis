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
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="styles/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <SCRIPT LANGUAGE="Javascript" SRC="styles/admin/js/FusionCharts.js"></SCRIPT>
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
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">Home or Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <?php
                        $books = DB::getInstance()->query("SELECT * FROM books");
                        $countBooks = DB::getInstance()->count($books); ?>
                        <div class="inner">
                            <h3>
                                <?php echo $countBooks; ?>
                            </h3>
                            <p>
                                Books
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="admin.php?action=Sbooklist" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <?php
                        $booksBorrowed = DB::getInstance()->query("SELECT * FROM books WHERE is_borrowed=1");
                        $countBookB = DB::getInstance()->count($booksBorrowed); ?>
                        <div class="inner">
                            <h3>
                                <?php echo $countBookB; ?>
                            </h3>
                            <p>
                                Books Borrowed
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <a href="admin.php?action=Sbooklist" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <?php
                        $booksAvailable = DB::getInstance()->query("SELECT * FROM books WHERE is_borrowed=0");
                        $countBookA = DB::getInstance()->count($booksAvailable); ?>
                        <div class="inner">
                            <h3>
                                <?php echo $countBookA; ?>
                            </h3>
                            <p>
                                Book Available
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <a href="admin.php?action=Sbooklist" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div><!-- ./col -->


<!-- Display transaction table under borrowerID -->
<section class="content">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Transaction List</h3>
                    <!-- Add button for collapsing and removing -->
                    <div class="pull-right box-tools">
                        <button class="btn btn-primary btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-primary btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <!-- Your PHP logic to display success and error messages -->
                    <!-- Your table structure to display transaction data -->
                    <!-- Update SQL query to fetch transactions for the specific borrowerID -->
                    <table class="table table-bordered table-hover" id="articles">
                        <thead>
                            <tr>
                                <th>Transaction</th>
                                <th>Title of the Book</th>
                                <th>Transaction Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $userId = $_SESSION['user'];
                            $transactions = DB::getInstance()->query("SELECT * FROM booktransactions WHERE borrowerID = ?", [$userId]);

                            foreach ($transactions->results() as $transaction) {
                                echo '<tr>';
                                echo '<td>' . $transaction->transactionType . '</td>';
                                echo '<td>' . $transaction->bookTitle . '</td>';
                                echo '<td>' . date('M d, Y - g:i A', strtotime($transaction->transactionDate . ' ' . $transaction->transactionTime)) . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </section><!-- /.content -->

        </section><!-- /.content -->

        <?php
        // Check for overdue books
        $overdueBooks = DB::getInstance()->query("SELECT * FROM books WHERE is_borrowed = 1 AND borrowerID = ? AND dateBorrowed < DATE_SUB(NOW(), INTERVAL 3 DAY)", [$userId]);
        $countOverdueBooks = DB::getInstance()->count($overdueBooks);
        ?>

        <!-- Display banner and button if there are overdue books -->
        <?php if ($countOverdueBooks > 0) : ?>
            <div class="alert alert-danger">
                <strong>Warning!</strong> There are <?php echo $countOverdueBooks; ?> overdue books.
                <!-- Button to go to Sborrowed page -->
                <a href="admin.php?action=Sborrowed" class="btn btn-primary">View Overdue Books</a>
            </div>
        <?php endif; ?>
    </aside><!-- /.right-side -->

    

    </div><!-- ./wrapper -->

    <!-- jQuery 2.0.2 -->
    <script src="styles/admin/js/jquery.min.js"></script>
    <!-- jQuery UI 1.10.3 -->
    <script src="styles/admin/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="styles/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
    <!-- page script -->
</body>

</html>