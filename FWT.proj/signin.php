<?php
    include('Connection.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In</title>
    <link rel="stylesheet" href="signin_signup.css">
</head>
<body>
<?php
    if (isset($_POST['upload'])){
        $image_location=$_FILES['image']['tmp_name'];
        $image_name=$_FILES['image']['name'];
        $name_given_user=$_POST['name'];
        $email_given_user=$_POST['email'];
        $number_given_user=$_POST['number'];
        $password_given_user=$_POST['password'];
        $image_extention=pathinfo($image_name,PATHINFO_EXTENSION);
        $image_destination="Uploaded Images/".$number_given_user.".".$image_extention;
        $image_size=$_FILES['image']['size']/(1024*1024); #converted byte into mb
        if(($image_extention!= 'png')){
            echo"<script>alert('Invalid Image Extention')</script>";
            exit();
        }
        if($image_size>1.5){
            echo"<script>alert('Image Size is Too Large')</script>";
            exit();
        }
        $query="INSERT INTO `ticket`(`Name`,`Email Id`,`Number`,`Password` ,`Aadhar Card`) VALUES ('$name_given_user','$email_given_user','$number_given_user','$password_given_user','$image_destination')";
        if(mysqli_query($con,$query)){
            move_uploaded_file($image_location,$image_destination);
            echo"<script>alert('successful')</script> ";
        }
    }
    ?>
    <div class="myform">
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="input-field">
                <label>Name</label>
                <input type="text" placeholder="Enter Your Mobile-Number" name="name">
            </div>
            <div class="input-field">
                <label>Password</label>
                <input type="password" placeholder="Enter Your Mobile-Number" name="password">
            </div>
            <div class="submit-btn">
                <button type="submit" name="signin">signin</button>
            </div>
            <div class="login-signup">
                    <span class="text">Not a member?
                        <a href="signup.php" class="text signup-link">Signup Now</a>
                    </span>
            </div>
        </form>
    </div>
    <?php
            if(isset($_POST['name'])){
                $name_given_by_user=$_POST['name'];
                $password_given_by_user=$_POST['password'];
                $query1="SELECT * FROM user_data  WHERE name='".$name_given_by_user."'AND password='".$password_given_by_user."' limit 1";
                $result1=mysqli_query($con,$query1);

                if(mysqli_num_rows($result1)==1)
                {
                    setcookie("namecookie",$name_given_by_user);
                    header("Location:start.html");
                }
                else{
                echo"<script>alert('wrong username or password')</script>";
                exit();
                }   
            }
            ?>

    
</body>
</html>