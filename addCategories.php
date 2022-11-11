<?php
session_start();
require 'config.php';
?>

<!DOCTYPE html>
<?php

    $labs = '<?php
    require "../../config.php";
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>labs</title>
        <link rel="stylesheet" href="../styleLab.css">
    </head>
    <body>

    <?php
        $Id=mysqli_real_escape_string($con,$_GET["Id"]); 
      $query1="SELECT * FROM web_categories WHERE ID=\'$Id\'";
      $query_run1=mysqli_query($con, $query1);
      $row1=mysqli_fetch_array($query_run1);


        $query="SELECT wc.Id ,wc.Topic, ld.LAB_TITLE FROM `web_categories` wc
            inner join lab_data ld ON wc.Id=ld.CategoryID 
            WHERE wc.Id=\'$Id\'";

      $query_run=mysqli_query($con, $query);
      $row=mysqli_fetch_array($query_run);
    ?>
    <div class="main-container">
      <div class="heading">
        <h1 class="heading__title"><?= $row1["Topic"]; ?></h1>
    </div>
      <div class="cards">
        <?php
            if(mysqli_num_rows($query_run)>0)
            {
                foreach($query_run as $x => $rows)
                {
                  
        ?>
      
        <div class="card card-1">
          <div class="card__icon">lab <?= $x+1 ?></div>
          <h2 class="card__title"><a class="link" href="lab<?= $x+1 ?>.php"><?= $rows["LAB_TITLE"] ?></a></h2>
          <p class="card__apply">APPRENTICE</p>
        </div>
    
        <?php
                }
            }
            else
            {
                echo "<h4>No records found!</h4>";
            }
        ?>
      </div>
    </div>
    </body>
    </html>';

    if(isset($_POST['submit']))
    {
        $cname = $_POST["cname"];
        $fname = $_POST["fname"];
        // $image = $_POST["image"];
        $labCount = 0;

        $filename = $_FILES["image"]["name"];

        $tempname = $_FILES["image"]["tmp_name"];
    
        $folder = "images/" . $filename;

        mkdir("labs/".$fname);
        $a = fopen("labs/$fname/$fname".'Labs.php', 'w');
        fwrite($a,$labs);
        fclose($a);
        // echo "<script type = 'text/javascript'>alert('$cname ,done!'); location.href='index.php';</script>";
    
        $sql = "INSERT INTO `web_categories` (`Title`, `Topic`, `Lab_Count`,`Img`) VALUES ('$fname', '$cname','$labCount','$filename')";

        // insert in database 
        $rs = mysqli_query($con, $sql);

        if ($rs && move_uploaded_file($tempname, $folder)) {
            echo 
            "<script> 
            alert('Category Added Sucessfully !');
            location.href='index.php' 
            </script>";
        } else {
                echo "Error! \n ALL fields are compalsory !";
        }
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container" style="width: 60%; margin: auto;">
        <h1 style="text-align: center;" >ADD CATEGORIES</h1>
        <form action="addCategories.php" method="post" enctype="multipart/form-data" style="border: 2px solid;border-radius: 10px;padding: 40px;">
            <label>Category Name: </label>
            <input type="text" name="cname">
            <label>Folder Name :</label>
            <input type="text" name="fname">
            <label>Select Image File:</label>
            <input type="file" accept=".jpg" name="image" />
            <br><br>
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>
</body>
</html>