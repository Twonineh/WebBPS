<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid']==0)) {
  header('location:logout.php');
} else {

  // Xử lý yêu cầu xóa dịch vụ
  if(isset($_GET['delid'])) {
    $service_id = intval($_GET['delid']);
    $query = mysqli_query($con, "DELETE FROM tblservices WHERE ID = $service_id");
    if ($query) {
      echo "<script>alert('Service deleted successfully');</script>";
      echo "<script>window.location.href='manage-services.php'</script>";
    } else {
      echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
  }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>BPS || Manage Services</title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
<!-- Các liên kết và tệp phụ thuộc khác -->
</head>
<body class="cbp-spmenu-push">
	<div class="main-content">
		<!--left-fixed -navigation-->
		<?php include_once('includes/sidebar.php');?>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<?php include_once('includes/header.php');?>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
				<div class="tables">
					<h3 class="title1">Manage Services</h3>
					
					<div class="table-responsive bs-example widget-shadow">
						<h4>Update Services:</h4>
						<table class="table table-bordered"> 
							<thead> 
								<tr> 
									<th>#</th> 
									<th>Service Name</th> 
									<th>Service Price</th> 
									<th>Creation Date</th>
									<th>Action</th> 
									<th>Delete</th>
								</tr> 
							</thead> 
							<tbody>
								<?php
								$ret = mysqli_query($con, "select * from tblservices");
								$cnt = 1;
								while ($row = mysqli_fetch_array($ret)) {
								?>
									<tr> 
										<th scope="row"><?php echo $cnt;?></th> 
										<td><?php echo $row['ServiceName'];?></td> 
										<td><?php echo $row['Cost'];?></td>
										<td><?php echo $row['CreationDate'];?></td> 
										<td><a href="edit-services.php?editid=<?php echo $row['ID'];?>">Edit</a></td> 
										<td><a href="manage-services.php?delid=<?php echo $row['ID'];?>" onclick="return confirm('Are you sure you want to delete this service?');">Delete</a></td>
									</tr> 
								<?php 
								$cnt = $cnt + 1;
								}?>
							</tbody> 
						</table> 
					</div>
				</div>
			</div>
		</div>
		<!--footer-->
		<?php include_once('includes/footer.php');?>
		<!--//footer-->
	</div>
	<!-- Các tệp JavaScript khác -->
</body>
</html>
<?php }  ?>
