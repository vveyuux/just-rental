<?php 
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="th">
<head>

<title>Just Rental</title>
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

<!-- Banners -->
<section id="banner" class="banner-section">
<div class="dark-overlay-banner">
  <div class="container">
    <div class="div_zindex">
      <div class="row">
        <div class="col-md-5 col-md-push-7">
          
            <div class="banner_content">
              <h1>&nbsp;</h1>
              <p>&nbsp; </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Banners --> 


<!-- Resent Cat-->
<section class="section-padding gray-bg">
  <div class="container">
    <div class="section-header text-center">
      <h2><span>เราจะหา </span>รถที่ดีที่สุดสำหรับคุณ</h2>
      <p>ยินดีต้อนรับสู่คาร์เรนทัลพอร์ทัล ศูนย์บริการจองรถเช่าออนไลน์จากทั่วโลก คุณสามารถเลือกรถเช่าได้หลากหลายประเภท พร้อมกับข้อเสนอและโปรโมชั่นที่ดีที่สุดในการเช่ารถบนเว็บไซต์ได้ทันที CarRentalPortal.com คือเว็บไซต์ที่ดีที่สุดในการจองรถออนไลน์ หรือสามารถดูข้อเสนอและโปรโมชั่นล่าสุดที่ใช้ได้ในขณะนี้จากระบบการจองรถออนไลน์ของเราด้านบน</p>
    </div>
    <div class="row"> 
      
      <!-- Nav tabs -->
      <div class="recent-tab">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">รถคันใหม่</a></li>
        </ul>
      </div>
      <!-- Recently Listed New Cars -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="resentnewcar">

<?php $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand limit 9";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
?>  

<div class="col-list-3">
<div class="recent-car-list">
<div class="car-info-box"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image"></a>
<ul>
<li><i class="fa fa-car" aria-hidden="true"></i>เชื้อเพลิง <?php echo htmlentities($result->FuelType);?></li>
<li><i class="fa fa-calendar" aria-hidden="true"></i>รุ่นปี <?php echo htmlentities($result->ModelYear);?></li>
<li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> ที่นั่ง</li>
</ul>
</div>
<div class="car-title-m">
<h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"> <?php echo htmlentities($result->VehiclesTitle);?></a></h6>
<span class="price">฿<?php echo htmlentities($result->PricePerDay);?> /วัน</span> 
</div>
<div class="inventory_info_m">
<p><?php echo substr($result->VehiclesOverview,0,70);?></p>
</div>
</div>
</div>
<?php }}?>
       
      </div>
    </div>
  </div>
</section>
<!-- /Resent Cat --> 

<!-- Fun Facts-->
<section class="fun-facts-section">
  <div class="container div_zindex">
    <div class="row">
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-calendar" aria-hidden="true"></i>40+</h2>
            <p>ปีในการทำธุรกิจ</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>1200+</h2>
            <p>รถใหม่สำหรับเช่า</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>1000+</h2>
            <p>รถใช้แล้วสำหรับเช่า</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>600+</h2>
            <p>ลูกค้าที่พึงพอใจ</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Fun Facts--> 


<!--Testimonial -->
<section class="section-padding testimonial-section parallex-bg">
  <div class="container div_zindex">
    <div class="section-header white-text text-center">
      <h2><span>คำรับรองจาก</span>ลูกค้าที่พึงพอใจ</h2>
    </div>
    <div class="row">
      <div id="testimonial-slider">
<?php 
$tid=1;
$sql = "SELECT tbltestimonial.Testimonial,tblusers.FullName from tbltestimonial join tblusers on tbltestimonial.UserEmail=tblusers.EmailId where tbltestimonial.status=:tid limit 4";
$query = $dbh -> prepare($sql);
$query->bindParam(':tid',$tid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>


        <div class="testimonial-m">
 
          <div class="testimonial-content">
            <div class="testimonial-heading">
              <h5><?php echo htmlentities($result->FullName);?></h5>
            <p><?php echo htmlentities($result->Testimonial);?></p>
          </div>
        </div>
        </div>
        <?php }} ?>
        
       
  
      </div>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Testimonial--> 


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