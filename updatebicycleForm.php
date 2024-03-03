<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Update</title>

    <style>
        body {
            background-repeat: no-repeat;
            background-image: url(https://images2.alphacoders.com/165/thumbbig-165960.webp);
            background-size: cover;
            color: #fff;
        }
    </style>
  </head>
  <body>

<?php

    require 'connect.php';

    $sql_select = 'select * from bicycle order by bicycleID';
    $stmt_s = $conn->prepare($sql_select);
    $stmt_s->execute();
    echo "bicycleID = ".$_GET['bicycleID'];

    if (isset($_GET['bicycleID'])) {
        $sql_select_customer = 'SELECT * FROM bicycle WHERE bicycleID=?';
        $stmt = $conn->prepare($sql_select_customer);
        $stmt->execute([$_GET['bicycleID']]);
        echo "get = ".$_GET['bicycleID'];
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }

?>

    
<div class="container">
      <div class="row">
        <div class="col-md-4"> <br>
          <h3>ฟอร์มแก้ไขข้อมูลจักรยาน</h3>
          <form action="updatebicycle.php" method="POST">
           <input type="hidden" name="bicycleID" value="<?= $result['bicycleID'];?>">

           <label for="name" class="col-sm-2 col-form-label"> ชื่อ:  </label>
              
                <input type="text" name="bicyclename" class="form-control" required value="<?php echo $result["bicyclename"]; ?>">
            
                <label for="name" class="col-sm-2 col-form-label"> ราคา :  </label>
             
                <input type="number" name="bicycleprice" class="form-control" required value="<?php echo $result["bicycleprice"] ?>">
          
            <br> <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
          </form>
        </div>
      </div>
    </div>

  </body>
</html>