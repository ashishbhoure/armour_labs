<?php
session_start();
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>add labs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <form action="addLabs.php" method="POST">
    <label for="categories">categories:</label>
    <select name="labs" id="labs">
    <?php
    $query="SELECT * FROM web_categories";
    $query_run=mysqli_query($con, $query);

        if(mysqli_num_rows($query_run)>0)
        {
            foreach($query_run as $rows)
            {
    ?>
  

    <option name="c_id" value="<?= $rows['Id'];?>">
        <?= $rows['Topic']; ?>
    </option>
    <?php
            }
        }
        else
        {
            echo "<h4>No records found!</h4>";
        }
    ?>
  </select><br><br>
    <p><lable>title :</lable></p>
    <input type="text" name="name" placeholder="write title"/>
  <p><label>DATA :</label></p>
  <textarea name="data" rows="10" cols="100" placeholder="paste your code here" ></textarea>
  <br>
        <input type="submit" name="submit" value="Submit">
       
    </form>
    <?php
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $data=$_POST['data'];
    $value= $_POST['labs'];
    $query="SELECT * FROM web_categories WHERE Id='$value'";
    $query_run=mysqli_query($con, $query);
    $rows=mysqli_fetch_array($query_run);
    $path= $rows['Image'];
    $count = $rows['Lab_Count'];
    $labCount = "UPDATE web_categories SET Lab_Count=$count+1 WHERE Id='$value' ";
    $query1_run=mysqli_query($con, $labCount);
    $count1=$rows['Lab_Count']+1;
    $file_name = "labs/$path/lab".$count1.".php";
    $include_file = "<?php \nrequire '../../config.php'; \n?>";
    
    $a = fopen($file_name, 'w');
    fwrite($a,$include_file."\n".$data);
    fclose($a);
    if(file_exists($file_name)){
        $_SESSION['message']=" Data Updated Sucessfully!";
        echo 
        "<script> 
        location.href='index.php' ;
        </script>";
        exit;
    }
    else{
        $_SESSION['message']=" Error! Unable to update data!";
        echo 
        "<script> 
        location.href='index.php' ;
        </script>";
        exit;
    }
}
?>
    </div>
</body>
</html>