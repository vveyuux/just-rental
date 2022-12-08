<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
  }
  else{

    


?>

<!DOCTYPE HTML>
<html lang="th">
<head>

<title>Just Rental | Booking Details</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 

<!-- New Fav and touch icon -->
<link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon-icon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon-icon/favicon-16x16.png">
<link rel="manifest" href="assets/images/favicon-icon/site.webmanifest">
<link rel="stylesheet" type="text/css" href="assets/css/print.css" media="print">
</head>
<body>

<div id="printbtn">
<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  
      
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Page Header-->
<section class="page-header payment_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>รายละเอียดการจอง</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="index.php">หน้าหลัก</a></li>
        <li>รายละเอียดการจอง</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 
  </div>
<!--Booking Details-->
<?php
    $bid=intval($_GET['bid']);
    $sql = "SELECT tblvehicles.Vimage1 as Vimage1, tblusers.*,tblbrands.BrandName,tblvehicles.VehiclesTitle,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.VehicleId as vid,tblbooking.Status,tblbooking.PostingDate,tblbooking.id,tblbooking.BookingNumber,
            DATEDIFF(tblbooking.ToDate,tblbooking.FromDate) as totalnodays,tblvehicles.PricePerDay,tblbooking.Insure,tblbooking.Payment,tblbooking.id as bide
			from tblbooking join tblvehicles on tblvehicles.id=tblbooking.VehicleId join tblusers on tblusers.EmailId=tblbooking.userEmail join tblbrands on tblvehicles.VehiclesBrand=tblbrands.id where tblbooking.id=:bid";

    $query = $dbh -> prepare($sql);
    $query -> bindParam(':bid',$bid, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;
    if($query->rowCount() > 0)
    {
    foreach($results as $result)
    {
?>
<div class="content-wrapper" style="padding:20px;">
    <div >
        <div class="row">
            <div class="col-sm-5 col-md-2">
                <div class="logo"> <img src="assets/images/logo_v5.png" alt="image"/> </div>
            </div>
        </div>
    </div>
</div>

<div class="content-wrapper">
			<div class="container-fluid" >

				<div class="row">
					<div class="col-md-12" >

						<h2 class="page-title"></h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">ข้อมูลการจอง</div>
							<div class="panel-body">


<div id="print">
								<table border="1"  class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%"  >
				
									<tbody>
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
                                    <td><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></td>
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
                            
                                
                            </tbody>
                        </table>
                        <div class="text-center">
                        <button onclick="window.print();" class="btn btn-primary" id="printbtn">พิมพ์เอกสาร</button>
								</div>

<?php }}?>
</div>
						</div>

					

					</div>
				</div>

			</div>
		</div>
	</div>


<!--Booking Details-->
<div id="printbtn">
<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>
<!--/Forgot-password-Form --> 

                                    </div>

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->
</html>
<?php } ?>