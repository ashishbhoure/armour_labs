<?php
require 'config.php';

//signup

if (isset($_POST['fname'])) {
    // get the post records
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $psw = $_POST['psw'];
    // database insert SQL code
    $sql = "INSERT INTO `registration` (`fname`, `lname`, `email`, `password` ) VALUES ('$fname', '$lname', '$email', '$psw')";

    // insert in database 
    $rs = mysqli_query($con, $sql);

    if ($rs) {
     echo 
     "<script> 
     alert('Signed up Successfully!');
     location.href='index.php' 
     </script>";
   } else {
        echo "Error!";
   }
}



   //login


   

if(isset($_POST['loginSubmit']))
   {
    $login_email = $_POST['email'];
    $login_pass = $_POST['psw'];
 
       // check email is register  or not 
       $query ="SELECT * FROM `registration` WHERE email = '$login_email' ";

       $result = mysqli_query($con,$query);
      
       $row = mysqli_fetch_array($result);
          // if email exists or not
         if ($login_email == $row['email']) {
             // code...
               // if password exists
             if($login_pass == $row['password'])
             {
                echo 
                "<script> 
                alert('Login Successful!');
                location.href='index.php' ;
                </script>";
                exit;
                     
                    
             }
             // if password is wrong then else is work 
             else{
                  echo "<script>alert('Wrong Password!'); location.href='index.php'; </script>";
                 
             }
         }
         else{
            echo "<script>alert('Email not registered! Please signup first.');  </script>";
            echo "<h2><a href='http://localhost/xyz_labs/index.php' >Click to Sign Up!</a></h2>";

         }
        }
?>