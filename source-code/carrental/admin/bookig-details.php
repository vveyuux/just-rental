<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status="2";
$sql = "UPDATE tblbooking SET Status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();
  echo "<script>alert('ยกเลิกการจองสำเร็จแล้ว');</script>";
echo "<script type='text/javascript'> document.location = 'canceled-bookings.php'; </script>";
}


if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$status=1;

$sql = "UPDATE tblbooking SET Status=:status WHERE  id=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('ยืนยันการจองสำเร็จแล้ว');</script>";
echo "<script type='text/javascript'> document.location = 'confirmed-bookings.php'; </script>";
}

if(isset($_REQUEST['pmid']))
	{
$pmid=intval($_GET['pmid']);
$payment=1;

$sql = "UPDATE tblbooking SET Payment=:payment WHERE  id=:pmid";
$query = $dbh->prepare($sql);
$query -> bindParam(':payment',$payment, PDO::PARAM_STR);
$query-> bindParam(':pmid',$pmid, PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('ยืนยันการชำระสำเร็จแล้ว');</script>";
echo "<script type='text/javascript'> document.location = 'paid-booking.php'; </script>";
}


 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Just Rental | New Bookings   </title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">รายละเอียดการจอง</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">ข้อมูลการจอง</div>
							<div class="panel-body">


<div id="print">
								<table border="1"  class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%"  >
				
									<tbody>

									<?php 
$bid=intval($_GET['bid']);
									$sql = "SELECT tblusers.*,tblbrands.BrandName,tblvehicles.VehiclesTitle,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.VehicleId as vid,tblbooking.Status,tblbooking.PostingDate,tblbooking.id,tblbooking.BookingNumber,
DATEDIFF(tblbooking.ToDate,tblbooking.FromDate) as totalnodays,tblvehicles.PricePerDay,tblbooking.Insure,tblbooking.Payment
									  from tblbooking join tblvehicles on tblvehicles.id=tblbooking.VehicleId join tblusers on tblusers.EmailId=tblbooking.userEmail join tblbrands on tblvehicles.VehiclesBrand=tblbrands.id where tblbooking.id=:bid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':bid',$bid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
	<h3 style="text-align:center; color:red">#<?php echo htmlentities($result->BookingNumber);?> ข้อมูลการจอง </h3>

		<tr>
											<th colspan="4" style="text-align:center;color:blue">ข้อมูลผู้เช่า</th>
										</tr>
										<tr>
											<th>เลขการจอง</th>
											<td>#<?php echo htmlentities($result->BookingNumber);?></td>
											<th>ชื่อ</th>
											<td><?php echo htmlentities($result->FullName);?></td>
										</tr>
										<tr>											
											<th>อีเมล</th>
											<td><?php echo htmlentities($result->EmailId);?></td>
											<th>เบอร์โทรศัพท์</th>
											<td><?php echo htmlentities($result->ContactNo);?></td>
										</tr>
											<tr>											
											<th>ที่อยู่</th>
											<td><?php echo htmlentities($result->Address);?></td>
											<th>เมือง</th>
											<td><?php echo htmlentities($result->City);?></td>
										</tr>
											<tr>											
											<th>ประเทศ</th>
											<td colspan="3"><?php echo htmlentities($result->Country);?></td>
										</tr>

										<tr>
											<th colspan="4" style="text-align:center;color:blue">ข้อมูลการจอง</th>
										</tr>
											<tr>											
											<th>ชื่อรถ</th>
											<td><a href="edit-vehicle.php?id=<?php echo htmlentities($result->vid);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></td>
											<th>วันที่จอง</th>
											<td><?php echo htmlentities($result->PostingDate);?></td>
										</tr>
										<tr>
											<th>จากวันที่</th>
											<td><?php echo htmlentities($result->FromDate);?></td>
											<th>ถึงวันที่</th>
											<td><?php echo htmlentities($result->ToDate);?></td>
										</tr>
<tr>
	<th>จำนวนวันทั้งหมด</th>
	<td><?php echo htmlentities($tdays=$result->totalnodays);?></td>
	<th>ค่าเช่าต่อวัน</th>
	<td><?php echo htmlentities($ppdays=$result->PricePerDay);?></td>
</tr>
<tr>
	<th>ประเภทประกัน</th>
	<td><?php echo htmlentities($insuretype=$result->Insure);?></td>
	<th>ราคาต่อวัน</th>
	<td>
		<?php 
		if ($insuretype == 'ชั้น 1'){
			echo htmlentities($insureprice = 1500);
		}
		elseif ($insuretype == 'ชั้น 2+'){
			echo htmlentities($insureprice = 1000);
		}
		elseif ($insuretype == 'ชั้น 3+'){
			echo htmlentities($insureprice = 500);
		}
		else{
			$insureprice = 0;
		} ?>
	</td>
</tr>
<tr>
	<th colspan="3" style="text-align:center">ผลรวมทั้งสิ้น</th>
	<td><?php echo htmlentities($tdays*$ppdays+$insureprice*$tdays);?></td>
</tr>
<tr>
<th>สถานะการจอง</th>
<td><?php 
if($result->Status==0)
{
echo htmlentities('ยังไม่ได้ยืนยัน');
} else if ($result->Status==1) {
echo htmlentities('ยืนยันแล้ว');
}
 else{
 	echo htmlentities('ยกเลิกแล้ว');
 }
										?></td>
										<th>วันล่าสุดที่มีการแก้ไข</th>
										<td><?php echo htmlentities($result->LastUpdationDate);?></td>
									</tr>
									<tr>
										<th>สถานะการชำระค่ามัดจำ</th>
										<td colspan="3">
											<span style="color:#2dcc70"><?php 
												if($result->Payment==1){
													echo htmlentities("ชำระแล้ว");
												}?></span>
												<span style="color:#de302f">
												<?php
												if($result->Payment==0){
													echo htmlentities("ค้างชำระ");
												}
											?></span>
											<span style="color:#f76d2b">
                                        <?php
                                        if($result->Payment==2){
                                            echo htmlentities("รอดำเนินการ");
                                        }
                                    ?></span>
										</td>
									</tr>
									<tr>
									<td style="text-align:center" colspan="4">
									<?php if($result->Payment==0 and $result->Status==1) {?>
	<a href="bookig-details.php?pmid=<?php echo htmlentities($result->id);?>" onclick="return confirm('คุณต้องการยืนยันการชำระเงินนี้หรือไม่')" class="btn btn-primary"> ยืนยันการชำระเงินค่ามัดจำ</a> 
	<?php } else if($result->Payment==2 and $result->Status==1) {?>
		<a href="bookig-details.php?pmid=<?php echo htmlentities($result->id);?>" onclick="return confirm('คุณต้องการยืนยันการชำระเงินนี้หรือไม่')" class="btn btn-primary"> ยืนยันการชำระเงินค่ามัดจำ</a>
									<?php if($result->Status==0){ ?>
											
										
				<a href="bookig-details.php?aeid=<?php echo htmlentities($result->id);?>" onclick="return confirm('คุณต้องการยืนยันการจองนี้หรือไม่')" class="btn btn-primary"> ยืนยันการจอง</a> 

<a href="bookig-details.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('คุณต้องการยกเลิกการจองนี้หรือไม่')" class="btn btn-danger"> ยกเลิกการจอง</a>
</td>

</tr>

										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
								<form method="post">
	   <input name="Submit2" type="submit" class="txtbox4" value="พิมพ์เอกสาร" onClick="return f3();" style="cursor: pointer;"  />
	</form>

							</div>
						</div>

					

					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script language="javascript" type="text/javascript">
function f3()
{
window.print(); 
}
</script>
</body>
</html>
<?php }}} ?>
