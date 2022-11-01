<?php
require '../../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>labs</title>
    <link rel="stylesheet" href="../styleLab.css">
</head>
<body>
<div class="main-container">
  <div class="heading">
    <h1 class="heading__title">Access Control Vulnerabilities</h1>
</div>
  <div class="cards">
  <?php
    $query="SELECT * FROM web_categories WHERE Id=13";
    $query_run=mysqli_query($con, $query);

        if(mysqli_num_rows($query_run)>0)
        {
            foreach($query_run as $rows)
            {
              for ($x = 1; $x <= $rows['Lab_Count']; $x++) {
              
    ?>
  
    <div class="card card-1">
      <div class="card__icon">lab <?= $x ?></div>
      <h2 class="card__title"><a class="link" href="lab<?= $x ?>.php">SQL injection vulnerability in WHERE clause allowing retrieval of hidden data</a></h2>
      <p class="card__apply">APPRENTICE</p>
    </div>

    <?php
              }
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
</html>