<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
  }
  else{
    if(isset($_REQUEST['pmid']))
	{
$pmid=intval($_GET['pmid']);
$payment=2;
/*
$paper=$_FILES["paper"]["name"];
if($paper != NULL){
  echo "<script>alert('ยืนยันการชำระสำเร็จแล้ว');</script>";
echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";
move_uploaded_file($_FILES["paper"]["tmp_name"],"assets/images/paid/".$_FILES["paper"]["name"]);
$sql="UPDATE tblbooking SET Paper=:paper WHERE id=:pmid";
$query = $dbh->prepare($sql);
$query->bindParam(':paper',$paper,PDO::PARAM_STR);
$query->bindParam(':pmid',$pmid,PDO::PARAM_STR);
$query->execute();
*/

$sql = "UPDATE tblbooking SET Payment=:payment WHERE  id=:pmid";
$query = $dbh->prepare($sql);
$query -> bindParam(':payment',$payment, PDO::PARAM_STR);
$query-> bindParam(':pmid',$pmid, PDO::PARAM_STR);
$query -> execute();

echo "<script>alert('ยืนยันการชำระสำเร็จแล้ว');</script>";
echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";
//}
}

?>

<!DOCTYPE HTML>
<html lang="th">
<head>

<title>Just Rental | Payment</title>
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

</head>
<body>

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
        <h1>การชำระเงิน</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="index.php">หน้าหลัก</a></li>
        <li>การชำระเงิน</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<!--Payment-->
<?php 
$bid=intval($_GET['bid']);
$sql = "SELECT tblusers.*,tblvehicles.Vimage1 as Vimage1, tblusers.*,tblbrands.BrandName,tblvehicles.VehiclesTitle,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.VehicleId as vid,tblbooking.Status,tblbooking.PostingDate,tblbooking.id,tblbooking.BookingNumber,
DATEDIFF(tblbooking.ToDate,tblbooking.FromDate) as totalnodays,tblvehicles.PricePerDay,tblbooking.Insure
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
<section class="payment section-padding">
  <div class="container">
    <div class="row">
      <div class="col-md-100">
        <h3 style="text-align:center">การชำระเงินค่ามัดจำการจองรถเช่าผ่าน QR Code</h3>

        <?php if($error){?><div class="errorWrap"><strong>ผิดพลาด</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>สำเร็จ</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

        <div class="contact_form gray-bg">
          <form  method="post" enctype="multipart/form-data">
            <div class="form-group">
              <p class="control-label" style="text-align:center">กรุณาสแกน QR Code ด้านล่างนี้ </p>
              <div style="text-align:center">
                <?php
                  require_once("lib/PromptPayQR.php");
                  $ppd=$result->PricePerDay;
                  $PromptPayQR = new PromptPayQR(); // new object
                  $PromptPayQR->size = 8; // Set QR code size to 8
                  $PromptPayQR->id = '0994585445'; // PromptPay ID
                  $PromptPayQR->amount = $ppd; // Set amount (not necessary)
                  echo '<img src="' . $PromptPayQR->generate() . '" />';
                ?>
                <p class="control-label" style="text-align:center"><br>ค่ามัดจำของท่านคือ <span style="color: #2dcc70"><?php echo htmlentities($ppd=$result->PricePerDay);?></span> บาท ตามราคาเช่าต่อวันของรถ <span style="color: #228dcb"><?php echo htmlentities($result->VehiclesTitle);?> </span></p>
                <p class="control-label" style="text-align:center">โดยชื่อบัญชี<span style="color: #2dcc70"> ผู้โอน </span>ต้องตรงกับชื่อ<span style="color: #228dcb"> โปรไฟล์ </span>เท่านั้น</p>
              </div>
          </form>
        </div>
      </div>
      
    </div>
    <div class="clearfix"><br></div>
    <div class="form-group">
              <h4 style="color:red">หมายเลขการจอง #<?php echo htmlentities($result->BookingNumber);?></h4>
                <div class="vehicle_img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></a> </div>
                <div class="vehicle_title">

                  <h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>"> <?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h6>
                  <p><b>จาก </b> <?php echo htmlentities($result->FromDate);?> <b>ถึง </b> <?php echo htmlentities($result->ToDate);?></p>
                  <div style="float: left"><p><b>ข้อความ:</b> <?php echo htmlentities($result->message);?> </p></div>
                </div>
                <div class="clearfix"></div>
              </div>
              </div>
              <div class="form-group">
                <table>
                <h4 style="color:#de302f">ข้อมูลผู้เช่า</h4>
                  <tr>
                    <th>ชื่อ</th>
                    <th>อีเมล</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>ที่อยู่</th>
                    <th>เมือง</th>
                    <th>ประเทศ</th>
                  </tr>
                  <tr>
                    <td><?php echo htmlentities($result->FullName);?></td>
                    <td><?php echo htmlentities($result->EmailId);?></td>
                    <td><?php echo htmlentities($result->ContactNo);?></td>
                    <td><?php echo htmlentities($result->Address);?></td>
                    <td><?php echo htmlentities($result->City);?></td>
                    <td><?php echo htmlentities($result->Country);?></td>
                  </tr>
                </table>
              </div>
              <div class="form-group">
                <h4 style="color:#de302f">ใบแจ้งหนี้</h4>
                <table>
                  <tr>
                    <th>ชื่อรถ</th>
                    <th>จากวันที่</th>
                    <th>ถึงวันที่</th>
                    <th>จำนวนวันทั้งหมด</th>
                    <th width=100>เช่า / วัน</th>
                    <th width=150>ประกันภัย / วัน</th>
                  </tr>
                  <tr>
                    <td><?php echo htmlentities($result->VehiclesTitle);?>, <?php echo htmlentities($result->BrandName);?></td>
                    <td><?php echo htmlentities($result->FromDate);?></td>
                      <td> <?php echo htmlentities($result->ToDate);?></td>
                      <td><?php echo htmlentities($tds=abs($result->totalnodays));?></td>
                        <td> <?php echo htmlentities($ppd=$result->PricePerDay);?></td>
                        <td> 
                          <?php 
                            $insuretype=$result->Insure;
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
                    <th colspan="5" style="text-align:center;"> ผลรวมทั้งสิ้น</th>
                    <th><?php echo htmlentities($tds*$ppd+$tds*$insureprice);?></th>
                  </tr>
                </table>
                <!--
                <form  method="POST" enctype="multipart/form-data">
                <div class="form-group">
                
                          <label for="files" class="btn">แนบสลิปการโอน</label>
											<input type="file" name="paper" id="files" style="visibility:hidden;" >
                          
                          </div>
                          </form>
                          -->
                <div>
                                            <a href="payment.php?pmid=<?php echo htmlentities($result->id);?>" onclick="return confirm('คุณต้องการยืนยันการโอนเงินมัดจำนี้หรือไม่')" class="btn btn-primary"> ยืนยันการโอน</a>
												</div>
								</div>
                
                
              </div>
            </div>
  </div>
</section>
<?php $cnt=$cnt+1; }} ?>
<!--Payment-->


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