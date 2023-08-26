<?php
    $con=mysqli_connect("localhost","root","","boat");
    if(mysqli_connect_error())
    {
        echo"cannot connect to database";
    }
?>