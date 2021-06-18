<?php
include "db_conn.php";
session_start();
if(isset($_POST['submit']))
{
    if(isset($_POST['uname'])&& isset($_POST['pass']))
    {
        function validate($data)
        {
            $data=trim($data);
            $data=stripslashes($data);
            return $data;
        }
        $username=strtolower(validate($_POST['uname']));
        $password=validate($_POST['pass']);
        $userdatalog='usernamelog='.$username;
        if(empty($username))
        {
            header("Location:index.php?error_sec=Please Enter Username&$userdatalog");
            exit();
        }
        else if(empty($password))
        {
            header("Location:index.php?error_sec=Please Enter Password&$userdatalog");
            exit();
        }
        else{
            $sql="SELECT * FROM userdetail where username='$username' and password='$password'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)===1)
            {
                $row=mysqli_fetch_assoc($result);
                if($row['username']===$username && $row['password']===$password)
                {
                    $_SESSION['id']=$row['id'];
                    $_SESSION['uname']=$row['username'];
                    $_SESSION['name']=$row['name'];
                    $_SESSION['url']=$row['image'];
                    header("Location:home.php");
                    exit();
                }
                else{
                    header("Location:index.php?error_sec=Username and Password is Wrong&$userdatalog");
                    exit();
                }
            }
            else{
                header("Location:index.php?error_sec=Username and Password is Wrong&$userdatalog");
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