<?php
include "db_conn.php";
session_start();
if(isset($_POST['rsubmit']))
{
    if(isset($_POST['rname']) &&
     isset($_POST['remail']) &&
      isset($_POST['runame']) &&
       isset($_POST['rpass']) &&
        isset($_POST['rcpass'])&&
        isset($_FILES['rfile']) )
    {
        function validate($data)
        {
            $data=trim($data);
            $data=stripslashes($data);
            return $data;
        }
        // variable declair
        $name=validate($_POST['rname']);
        $email=validate($_POST['remail']);
        $uname=strtolower(validate($_POST['runame']));
        $pass=validate($_POST['rpass']);
        $cpass=validate($_POST['rcpass']);
        $gender=$_POST['rgen'];

        ###file
        $exte=array("png","jpg","jpeg");
        $filename=$_FILES['rfile']['name'];
        $filetmp=$_FILES['rfile']['tmp_name'];
     #file extenstion find
        $image = $_FILES['rfile']['name'];
        $info = pathinfo($image);
        $image_name =  basename($image,'.'.$info['extension']);
        @$ext = end(explode('.', $image));
        $ext=strtolower($ext);

        $userdata='name=' .$name. '&email=' .$email. '&username=' .$uname;
        if(empty($name))
        {
            header("Location:index.php?error=Please enter name&$userdata");
            exit();
        }
        else if(empty($email))
        {
            header("Location:index.php?error=Please enter Email id&$userdata");
            exit();
        }
        else if(empty($uname))
        {
            header("Location:index.php?error=Please enter username&$userdata");
            exit();
        }
        else if(empty($pass))
        {
            header("Location:index.php?error=Please enter password&$userdata");
            exit();
        }
        else if(empty($cpass))
        {
            header("Location:index.php?error=Please enter confirm password&$userdata");
            exit();
        }
        else if($pass!=$cpass)
        {
            header("Location:index.php?error=Password does not match&$userdata");
            exit();
        }
        else if(empty($gender))
        {
            header("Location:index.php?error=Please select gender&$userdata");
            exit();
        }
        else if(! file_exists($_FILES['rfile']['tmp_name']))
        {
            header("Location:index.php?error=Select Profile Picture&$userdata");
            exit();
        }
        else if(!in_array($ext,$exte))
        {
            header("Location:index.php?error=File Support Jpg and Png Only&$userdata");
            exit();
        }
        else{
            $sql="SELECT * FROM userdetail WHERE username='$uname'";
            $result1=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result1)>0){
                header("Location:index.php?error=This Username is Taken By Other User&$userdata");
                exit();
            }
            else
            {
                $destinationfile='upload/'.$filename;
                move_uploaded_file($filetmp,$destinationfile);
                $q="INSERT INTO `userdetail`(`name`,`email`,`username`,`password`,`gender`,`image`)
                values ('$name','$email','$uname','$cpass','$gender','$destinationfile')";
                $query=mysqli_query($conn,$q);
                $userdata='mname='.$uname;
                $_SESSION['uname']=$uname;
                $_SESSION['name']=$name;
                header("Location:index.php?$userdata");
                exit();
            }
        }


    }
    else{
        header("Location:index.php");
        exit();
    }
}
else{
    header("Location:index.php");
    exit();
}

?>