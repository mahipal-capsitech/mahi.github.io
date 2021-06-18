<?php
    $server="localhost";
    $mainuser="root";
    $mainpass="";
    $main_db="doctor";
    $conn=mysqli_connect($server,$mainuser,$mainpass,$main_db);
    if(!$conn)
    {
        echo "Server is Not Found 404 Mahi-Error";
    }
?>