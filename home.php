<?php
include "db_conn.php";
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['uname']) )
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Management System Create by Mahi</title>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="icon shortcut" href="image/doctor.ico">
    <script src="js/jquery.js"></script>
    <script>
        $(document).ready(function () {
            $(".loginform").click(function () {
                $(".log-in-fix").slideDown();
                $(".signup-fix").slideUp();
            })
            $("#log-close").click(function () {
                $(".log-in-fix").slideUp();
                // $(".signup-fix").slideDown();
            })
            $(".signupform").click(function () {
                $(".signup-fix").slideDown();
                $(".log-in-fix").slideUp();
            })
            $("#si-close").click(function () {
                $(".signup-fix").slideUp();
                // $(".log-in-fix").slideDown();
            })
            $(".sign-2").click(function () {
                $(".log-in-fix").slideUp();
                $(".signup-fix").slideDown();
            })
            $(".log-2").click(function () {
                $(".log-in-fix").slideDown();
                $(".signup-fix").slideUp();
            })
            $(".error-hide").click(function(){
                $(".error").slideUp();
                $(".succ").slideUp();
            })
            $("#next-log").click(function(){
                $(".thank").slideUp();
                $(".log-in-fix").slideDown();
            })
            $(".profile").click(function(){
                $(".update_profile").slideDown();
            })
            $(".upclose").click(function(){
                $(".update_profile").slideUp();
            })
            $(".close_pro_up_msg").click(function(){
                $(".profile_upd_msg").slideUp();
            })
        })
    </script>
    <style>
       div.appointment{
          position: absolute;
          top: 5%;
          left: 40%;
          z-index: 2;
       }
       div.appointment form{
        display: flex;
           flex-direction: column;
       }
    </style>
</head>

<body>
    <!-- <div class="appointment">
        <form action="app.php" method="POST">
            <label for="">Patient Name</label>
            <input type="text" name="pname">
            <label for="">Patient Name</label>
            <input type="date" name="pname">
        </form>
    </div> -->
    <?php if(isset($_GET['upd_succ'])){?>
    <div class="profile_upd_msg">
        <p><?php echo $_GET['upd_succ']?><span class="close_pro_up_msg">&times;</span></p>
    </div><?php }?>
    <nav>
        <div class="logo">
            <h2>Mahi-Code</h2>
        </div>
        <div class="menu">
            <a href="index2.php" class="active">Home</a>
            <a href="#doctor">Doctor</a>
            <a href="#doc-sche">Doctor Schedule</a>
            <a href="#service">Services</a>
            <a href="#clinic">Our Clinic</a>
            <!-- <a href="#" class="loginform">Log-in</a>
            <a href="#" class="signupform">Sign-up</a> -->
            <div class="pro">
                <img src="<?php echo $_SESSION['url']?>" alt="">
                <span><?php echo $_SESSION['uname']?></span>
                <span>
                    <svg  width="16" height="16" fill="white"  viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                      </svg>
                </span>
                <div class="sub-menu">
                    <a href="#" class="profile">Profile</a>
                    <a href="#">Appointment</a>
                    <a href="logout.php">Log-out</a>
                </div>
            </div>
           
        </div>
    </nav>
  <?php if(isset($_GET['upd_error'])){?><div class="update_profile" style="display:flex;"><?php } else {?> <div class="update_profile" style="display:none"><?php } ?>
        
           
        <form action="update_profile.php" method="POST" enctype="multipart/form-data">
            <?php if(isset($_GET['upd_error'])){?><p class="error"><?php echo $_GET['upd_error'] ?><span class="error-hide">&times;</span></p><?php }?>
            <h3>Update Profile</h3>
            <label for="">Username</label>
            <input type="text" name="upd_uname" value="<?php echo $_SESSION['uname'] ?>">
            <label for="">Old Password</label>
            <input type="password" name="upd_opass">
            <label for="">New Password</label>
            <input type="password" name="upd_pass">
            <div class="old_pro">
                <img src="<?php echo $_SESSION['url']?>" alt="">
            </div>
            <label for="">Profle Image</label>
            <input type="file" name="upd_file">
            <div class="button-set"> 
            <button class="btn btn-p" name="submit" type="submit">Update</button>
            <button class="btn btn-s upclose" name="submit" type="reset">Close</button>
        </div>
        </form>
    </div>
    <?php if(isset($_GET['error_sec']) or isset($_GET['succ_sec'])) {?>
    <div class="log-in-fix" style="display:block;z-index:1;">
    <?php } else {?><div class="log-in-fix"><?php } ?>
        <form action="log.php" method="POST">
            <h2>Login</h2>
            <?php if(isset($_GET['error_sec'])){?>
                <p class="error"><?php echo $_GET['error_sec']?><span class="error-hide">&times;</span></p><?php }?>
            <label>Username</label>
            <?php if(isset($_GET['usernamelog'])){ ?>
            <input type="text" name="uname" value="<?php echo $_GET['usernamelog']?>"><?php } else {?>
                <input type="text" name="uname"> <?php }?>
            <label>Password</label>
            <input type="password" name="pass">
            <div class="button-set">
                <button type="submit" name="submit" class="btn btn-p">Log-in</button>
                <button type="reset" name="reset" class="btn btn-s" id="log-close">Close</button>
            </div>
            <div class="account">
                <!-- <a href="">i have already Account</a> -->
                <a href="#" class="sign-2">Sign-Up(New account create)</a>
            </div>

        </form>
    </div>
    <?php if(isset($_GET['mname'])){?>
    <div class="thank" style="display:block">
        <h3>Thank You <?php echo $_SESSION['name']?></h3>
        <table>
            <tr>
                <td><strong>Username:</strong></td>
                <td><?php echo $_SESSION['uname'] ?></td>
            </tr> 
            <tr>
                <td><strong>Password:</strong></td>
                <td>Your remaimber</td>
            </tr>   
        </table>
        <button class="btn btn-p" id="next-log">Next Login</button>
    </div>
    <?php }?>
       <?php if(isset($_GET['error'])or isset($_GET['succ'])){ ?> 
    <div class="signup-fix" style="display:block;z-index:1;">
    <?php } else{?><div class="signup-fix" style="display:none;">
        <?php }?>
        <form action="reg.php" method="POST" enctype="multipart/form-data">
            <h2>Sign-Up</h2>
            <?php if(isset($_GET['error'])){ ?>
            <p class="error"><?php echo $_GET['error'] ?><span class="error-hide">&times;</span></p>
            <?php }?>
            <?php if(isset($_GET['succ'])){ ?>
            <p class="succ"><?php echo $_GET['succ'],$_GET['mname'] ?><span class="error-hide">&times;</span></p>
            <?php }?>
            <label>Name</label>
            <?php if(isset($_GET['name'])){ ?>
            <input type="text" name="rname" value="<?php echo $_GET['name'] ?>"> <?php } else{?>
           <input type="text" name="rname" value=""><?php }?>
                
            <label>Email</label>
            <?php if(isset($_GET['email'])){ ?>
                <input type="email" name="remail" value="<?php echo $_GET['email'] ?>"> 
                <?php } else {?> <input type="email" name="remail" value=""><?php } ?>

            <label>Username</label>
            <?php if(isset($_GET['username'])){ ?>
                <input type="text" name="runame" value="<?php echo $_GET['username']?>">
                <?php } else {?><input type="text" name="runame" PLACEHOLDER="Only small Letter are enter ex.(admin)"><?php }?>
            
            <label>Password</label>
            <input type="password" name="rpass" value="">
            <label>Confirm Password</label>
            <input type="password" name="rcpass">
            <div class="d-set">
                <label>Gender</label>
                <input type="radio" name="rgen" value="male">Male
                <input type="radio" name="rgen" value="female">Female
                <label style="margin-left: 0.5rem;">Profile Image</label>
                <input type="file" name="rfile">
            </div>
            <div class="button-set">
                <button type="submit" name="rsubmit" class="btn btn-p">Create</button>
                <button type="reset" name="reset" class="btn btn-s" id="si-close">Close</button>
            </div>
            <div class="account">
                <a href="#" class="log-2">i have already Account</a>
                <!-- <a href="" class="loginform">Log-in</a> -->
    </div>
        </form>
    </div>

    <section class="try">
        <div class="home-das">
            <div class="details">
                <div class="details-img">
                    <img src="image/doctor.png" alt="" class="doct-img">
                    <div class="new"><h1>Dr. Mahipal Singh</h1>
                        <p>(HOD & Sr. Consultant - Radiology)</p></div>
                </div>
                
                <h1>BEST CLINIC IN OUR CITY</h1>
                
                <p>Dr. Mahipal Singh is a small developer Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Totam, veritatis. Lorem ipsum dolor sit
                    amet.Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, veritatis. Lorem ipsum dolor
                    sit
                    amet.</p>
                <a href="#" class="btn btn-p loginform">Make a Appointment</a>
            </div>
            <div class="img-sec">
                <img src="image/—Pngtree—cartoon cartoon doctor green green_3920660.png" alt="">
            </div>
        </div>
        <div class="wave">
            <img src="image/wave1.png" alt="">
        </div>
    </section>
    <section class="sec-2" id="doctor">
        <div class="sec-head">
            <h2> <span>D</span>OCTOR</h2>
            <img src="image/line-removebg-preview.png" alt="">
        </div>
        <div class="image-para">
            <div class="para">
                <h2>Doctor</h2>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestiae illo quas alias nemo, facilis
                    repellendus similique, inventore suscipit minima nisi officia fugit voluptatum officiis animi qui
                    impedit nihil incidunt culpa rerum cum velit excepturi! Quis nobis vero autem odio! Cumque error
                    consectetur ipsa aspernatur sit quasi officiis eveniet, repellat ea, nam perspiciatis nostrum
                    voluptate
                    inventore ducimus hic sint repudiandae, quaerat consequatur placeat? Omnis accusantium tenetur dolor
                    odit! Ut similique blanditiis quisquam voluptatum culpa quae, qui maxime accusantium illo,
                    voluptates
                    totam possimus placeat numquam fugiat molestias dolorem consectetur deserunt earum ratione?
                    Voluptatem
                    debitis illo, id placeat iste laudantium alias quos nam.</p>
            </div>
            <div class="img-para">
                <img src="image/home-check.png" alt="">
            </div>
        </div>
        <div class="doc-detail">
            <div class="para">
                <h2>Dr. Mahipal Singh(HOD & Sr. Consultant - Radiology)</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero perspiciatis ut asperiores laboriosam
                    sed quasi officiis, harum fugiat nam voluptates quos nisi nulla vel sequi, culpa saepe laborum
                    accusamus porro doloremque! Esse quisquam rem itaque. Natus, nulla quasi quos autem accusantium
                    delectus explicabo eius molestiae veniam laborum distinctio exercitationem hic
                    Natus, nulla quasi quos autem accusantium.
                    delectus explicabo eius molestiae veniam laborum distinctio exercitationem hic.</p>
            </div>
            <div class="doc-img">
                <img src="image/doctor.png" alt="">
            </div>
        </div>
    </section>

    <section class="doc-sche" id="doc-sche">
        <div class="sec-head">
            <h2> <span>D</span>OCTOR <span>S</span>CHEDULE</h2>
            <img src="image/line-removebg-preview.png" alt="">
        </div>
        <DIV class="schedule">
            <div class="tb">
                <center>
                    <table>
                        <thead>
                            <tr>
                                <th>DOCTOR NAME</th>
                                <th>DATE</th>
                                <Th>TIME</Th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="row">
                                <td>Dr. Mahipal Singh</td>
                                <td>15-June-2020</td>
                                <td>08:00 AM to 12:00 PM</td>
                                <td><span>Available</span></td>
                            </tr>
                            <tr class="row">
                                <td>Dr. Mahipal Singh</td>
                                <td>15-June-2020</td>
                                <td>08:00 AM to 12:00 PM</td>
                                <td><span>Available</span></td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-p loginform">Make a Appointment</a>
                </center>
            </div>
        </DIV>
    </section>
    <section class="service" ID="service">
        <div class="sec-head">
            <h2> <span>S</span>ERVICES</h2>
            <img src="image/line-removebg-preview.png" alt="">
        </div>
        <div class="our-service">
            <div class="service-sample">
                <div class="servce-img">
                    <img src="image/service1.png" alt="">
                </div>
                <div class="para">
                    <h3>Minimum Expences </h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed veritatis facere praesentium error
                        quia ratione.</p>
                </div>
            </div>
            <div class="service-sample">
                <div class="servce-img">
                    <img src="image/service2.png" alt="">
                </div>
                <div class="para">
                    <h3>Audience Support</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed veritatis facere praesentium error
                        quia ratione.</p>
                </div>
            </div>
            <div class="service-sample">
                <div class="servce-img">
                    <img src="image/service3.png" alt="">
                </div>
                <div class="para">
                    <h3>Management by Computer</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed veritatis facere praesentium error
                        quia ratione.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="address" id="clinic">
        <div class="sec-head">
            <h2> <span>O</span>UR <span>C</span>LINIC</h2>
            <img src="image/line-removebg-preview.png" alt="">
        </div>
        <div class="our-clinic">
            <!-- <div class="cont">
                <h3>Address and Contact</h3>
                <p>10,Madhuvan Colony</p>
                <p>Near Bus Stand</p>
                <p>Sardar Samand Road ,Pali</p>
                <p>Rajasthan,306401</p>
                <p>Mob:-6354588049</p>
                <h3>Follow us</h3>
                <div class="imgdata">

                </div>
            </div> -->
            <div class="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57484.73008143947!2d73.29093709585366!3d25.777313109054056!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3942725536fc8e7f%3A0x8758f805e49b50!2sPali%2C%20Rajasthan%20306401!5e0!3m2!1sen!2sin!4v1623731655545!5m2!1sen!2sin"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>
    <section class="follow">
        <div class="sec-head">
            <h2> <span>F</span>OLLOW <span>U</span>S</h2>
            <img src="image/line-removebg-preview.png" alt="">
        </div>
        <div class="follo-img">
            <div class="img-1">
                <a href="#"><img src="image/facebook-icon.png" alt=""></a>
            </div>
            <div class="img-1">
                <a href="#"> <img src="image/instagram-icon.png" alt=""></a>
            </div>
            <div class="img-1">
                <a href="#"> <img src="image/twitter-icon.png" alt=""></a>
            </div>
            <div class="img-1">
                <a href="#"> <img src="image/snapchat-icon.png" alt=""></a>
            </div>
            <div class="img-1">
                <a href="#"> <img src="image/whatsapp-icon.png" alt=""></a>
            </div>
            <div class="img-1">
                <a href="#"> <img src="image/linkedin-icon.png" alt=""></a>
            </div>

        </div>


    </section>
    <section class="footer">
        <div class="wave-2">
            <img src="image/wave2.png" alt="">
        </div>
        <div class="link">
            <div class="link-set">
                <h3>Address</h3>
                <p>10,Madhuvan Colony</p>
                <p>Near Bus Stand</p>
                <p>Sardar Samand Road ,Pali</p>
                <p>Rajasthan,306401</p>
                <p>Mob:-6354588049</p>
                <a href="mailto:mahipalsinghw@gmail.com">Mail:Mahipalsinghw@gmail.com</a>
            </div>
            <div class="link-set">
                <h3>Follow us</h3>
                <a href="">Facebook</a>
                <a href="">Whatsapp</a>
                <a href="">Snapchat</a>
                <a href="">Twitter</a>
                <a href="">Linkedin</a>
                <a href="">Instagram</a>
            </div>
            <div class="link-set">
                <h3>Quick Link</h3>
                <a href="index.php">Home</a>
                <a href="#">Doctor</a>
                <a href="#">Doctor-Schedule</a>
                <a href="#" loginform>Make a Appointment</a>
                <a href="#" class="loginform">Log-in</a>
                <a href="#" class="signupform">Sign-up</a>
                <a href="">Developer</a>
            </div>
        </div>
        <div class="developer">
            <p>Copyright 2021 by Refsnes Data. All Rights Reserved.</p>
            <p>Mahi-Code is Powered by This Website</p>
        </div>
    </section>
</body>

</html>
<?php } else {
    header("Location:index.php");
    exit();}
    ?>