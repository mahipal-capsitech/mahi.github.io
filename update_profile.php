<?php
include "db_conn.php";
session_start();
if(isset($_POST['submit'])){
    if(isset($_POST['upd_uname'])&& isset($_POST['upd_opass'])&& isset($_POST['upd_pass'])&& isset($_FILES['upd_file']))
    {
        function validate($data)
        {
            $data=trim($data);
            $data=stripslashes($data);
            return $data;
        }
        $uname=strtolower(validate($_POST['upd_uname']));

        $opass=validate($_POST['upd_opass']);
        $pass=validate($_POST['upd_pass']);
        $upd_userdata="upd_user=".$uname;
        // file extension 
        $filetmp=$_FILES['upd_file']['tmp_name'];
        $filename=$_FILES['upd_file']['name'];
        $exta=array("png","jpg","jpeg");
        $image=$_FILES['upd_file']['name'];
        $info=pathinfo($image);
        $image_name=basename($image,'.'.$info['extension']);
        @$ext=end(explode('.',$image));
        $ext=strtolower($ext);
        if(empty($uname))
        {
            header("Location:home.php?upd_error=Please Enter Username&$upd_userdata");
            exit();
        }
        else if(empty($opass))
        {
            header("Location:home.php?upd_error=Please Enter Old Password&$upd_userdata");
            exit();
        }
        else if(empty($pass))
        {
            header("Location:home.php?upd_error=Please Enter Password&$upd_userdata");
            exit();
        }
        else if(! file_exists($_FILES['upd_file']['tmp_name']))
        {
            header("Location:home.php?upd_error=Please Select Profile&$upd_userdata");
            exit();

        }
        else if(! in_array($ext,$exta))
        {
            header("Location:home.php?upd_error=only jpg and png img format&$upd_userdata");
            exit();
        }
        else{
            $sql="SELECT * FROM userdetail where username='$uname'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)===1)
            {
                $row=mysqli_fetch_assoc($result);
                if($row['password']===$opass)
                {
                    $destinationfile='upload/'.$filename;
                    move_uploaded_file($filetmp,$destinationfile);
                    $id=$_SESSION['id'];
                    // echo "<script type="text/script">alert($id)</script>";
                    $sql2="UPDATE userdetail SET password='$pass',image='$destinationfile' WHERE id='$id'";
                    $result2=mysqli_query($conn,$sql2);
                    if($result2)
                    {
                       
                        // $_SESSION['id']=$row['id'];
                        $_SESSION['uname']=$row['username'];
                        // $_SESSION['name']=$row['name'];
                        $_SESSION['url']=$destinationfile;
                        // $pro_new=$_SESSION['url'];
                        header("Location:home.php?upd_succ=Your Account is Update");
                        exit();
                    }
                    else{
                        header("Location:home.php?errorreg=This Username is Taken By Other User&$userdetails");
                        exit();
                    } 
                }
                else{
                    header("Location:home.php?upd_error=Old Password is wrong&$upd_userdata");
                exit();
                }
            }
            else{
                header("Location:home.php?upd_error=Old Password is wrong&$upd_userdata");
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