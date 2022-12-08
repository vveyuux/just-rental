<?php
if(isset($_POST['emailsubscibe']))
{
$subscriberemail=$_POST['subscriberemail'];
$sql ="SELECT SubscriberEmail FROM tblsubscribers WHERE SubscriberEmail=:subscriberemail";
$query= $dbh -> prepare($sql);
$query-> bindParam(':subscriberemail', $subscriberemail, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<script>alert('คุณได้สมัครสมาชิกไปแล้ว.');</script>";
}
else{
$sql="INSERT INTO  tblsubscribers(SubscriberEmail) VALUES(:subscriberemail)";
$query = $dbh->prepare($sql);
$query->bindParam(':subscriberemail',$subscriberemail,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('สมัครสมาชิกสำเร็จแล้ว');</script>";
}
else 
{
echo "<script>alert('อะไรบางอย่างผิดปกติ. กรุณาลองอีกครั้ง');</script>";
}
}
}
?>

<footer>
  <div class="footer-top">
    <div class="container">
      <div class="row">
      
        <div class="col-md-6">
          <h6>เกี่ยวกับเรา</h6>
          <ul>

        
          <li><a href="page.php?type=aboutus">เกี่ยวกับเรา</a></li>
            <li><a href="page.php?type=faqs">คำถามที่พบบ่อย</a></li>
            <li><a href="page.php?type=privacy">นโยบายของเรา</a></li>
          <li><a href="page.php?type=terms">เงื่อนไขการใช้บริการ</a></li>
               <li><a href="admin/">เข้าสู่ระบบผู้ดูแลระบบ</a></li>
          </ul>
        </div>
  
        <div class="col-md-3 col-sm-6">
          <h6>สมัครเพื่อรับข่าวสารเพิ่มเติม</h6>
          <div class="newsletter-form">
            <form method="post">
              <div class="form-group">
                <input type="email" name="subscriberemail" class="form-control newsletter-input" required placeholder="ใส่อีเมลที่นี่" />
              </div>
              <button type="submit" name="emailsubscibe" class="btn btn-block">ติดตาม <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </form>
            <p class="subscribed-text">*เราส่งข้อเสนอที่ดีและข่าวรถเช่าล่าสุดไปยังผู้ใช้ที่สมัครรับข้อมูลของเราทุกสัปดาห์</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-push-6 text-right">
          <div class="footer_widget">
            <p>ช่องทางอื่นสำหรับกาารติดต่อ:</p>
            <ul>
              <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-md-pull-6">
          <p class="copy-right">Copyright &copy; 2022 Just Rental. All Rights Reserved</p>
        </div>
      </div>
    </div>
  </div>
</footer>