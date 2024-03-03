<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="CSS/style.css">
    <title>CRUD Customer Information with Enlarge Image</title>

    <style>
        body {
            background-repeat: no-repeat;
            background-image: url(https://images3.alphacoders.com/166/thumbbig-166055.webp);
            background-size: cover;
            color: #fff;
            box-shadow: inset 0 0 0 2500px rgba(0, 0, 0, 0.5);
        }
        tr {color: #fff;}
        td {color: #fff;}
    </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <h3>จักรยาน<a href="addbicycle_dropdown.php" class="btn btn-info float-end">+เพิ่มข้อมูล</a> </h3> <br/>
                <!-- <table class="table table-striped  table-hover table-responsive table-bordered"> -->
                <table id="employeeTable" class="display table table-striped  table-hover table-responsive table-bordered ">

                    <thead align="center">
                        <tr>
                            <th width="10%">จักรยาน</th>
                            <th width="10%">ชื่อ</th>
                            <th width="15%">ราคา</th>
                            <th width="10%">ประเภท</th>
                            <th width="10%">ภาพ</th>
                            <th width="5%">แก้ไข</th>
                            <th width="5%">ลบ</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        require 'connect.php';
                        $sql =
                            'SELECT * FROM bicycle b, type t WHERE t.typeID = b.typeID';
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach ($result as $r) { ?>
                            <tr>
                                <td><?= $r['bicycleID'] ?></td>
                                <td><?= $r['bicyclename'] ?></td>
                                <td><?= $r['bicycleprice'] ?></td>
                                <td align="right"><?= $r['bicycleID'] ?></td>
                                <td><img src="./image/<?= $r['bicycleimage']; ?>" width="50px" height="50" alt="image" onclick="enlargeImg()" id="img1" ></td>

                                <td><a href="updatebicycleForm.php?bicycleID=<?= $r['bicycleID'] ?>" class="btn btn-warning btn-sm">แก้ไข</a></td>
                                <td><a href="deletebicycle.php?bicycleID=<?= $r['bicycleID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบข้อมูล !!');">ลบ</a></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('customerTable').DataTable();
        });
    </script>
    

</body>

</html>