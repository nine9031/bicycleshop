<!--<!DOCTYPE html>-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>User Registration 265</title>
    <style type="text/css">
        img {
            transition: transform 0.25s ease;
        }

        img:hover {
            -webkit-transform: scale(1.5);
            /* or some other value */
            transform: scale(1.5);
        }
    </style>


</head>

<body>
    <?php
    require 'connect.php';

    $sql_select = 'SELECT * FROM type order by typeID';
    $stmt_s = $conn->prepare($sql_select);
    $stmt_s->execute();

    if (isset($_POST['submit'])) {
        echo "Successfully";
        //if ((isset($_POST['customerID']) && isset($_POST['name'])) != null)
        if (!empty($_POST['bicyclename']) ) {
            echo '<br>' . $_POST['bicyclename'];

            $uploadFile = $_FILES['image']['name'];
            $tmpFile = $_FILES['image']['tmp_name'];
            echo " upload file = " . $uploadFile;
            echo " tmp file = " . $tmpFile;

            $sql = "insert into bicycle(bicyclename,bicycleprice,bicycleimage,typeID)
							values (:bicyclename, :bicycleprice, :bicycleimage, :typeID)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':bicyclename', $_POST['bicyclename']);
            $stmt->bindParam(':bicycleprice', $_POST['bicycleprice']);
            $stmt->bindParam(':bicycleimage', $uploadFile);
            $stmt->bindParam(':typeID', $_POST['typeID']);


            $fullpath = "./image/" . $uploadFile;
            move_uploaded_file($tmpFile, $fullpath);

            echo '
                <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

            try {
                if ($stmt->execute()) :
                    //$message = 'Successfully add new customer';
                    echo '
                        <script type="text/javascript">        
                        $(document).ready(function(){
                    
                            swal({
                                title: "Success!",
                                text: "Successfuly add employee",
                                type: "success",
                                timer: 2500,
                                showConfirmButton: false
                            }, function(){
                                    window.location.href = "index.php";
                            });
                        });                    
                        </script>
                    ';
                else :
                    $message = 'Fail to add new bicycle';
                endif;
                // echo $message;
            } catch (PDOException $e) {
                 echo 'Fail! ' . $e;
            }
            $conn = null;
        }
    }
    ?>




    <div class="container">
        <div class="row">
            <div class="col-md-4"> <br>
                <h3>ฟอร์มเพิ่มข้อมูลจักรยาน</h3>
                <form action="addbicycle_dropdown.php" method="POST" enctype="multipart/form-data">
                    <!-- ศึกษาเพิ่มเติมการอัปโหลดไฟล์ https://www.w3schools.com/php/php_file_upload.asp -->
                    <input type="text" placeholder="bicyclename" name="bicyclename">
                    <br> <br>
                    <input type="number" placeholder="bicycleprice" name="bicycleprice">
                    <br> <br>
                    <label>Select a type code</label>
                    <select name="typeID">
                        <?php
                            while ($cc = $stmt_s->fetch(PDO::FETCH_ASSOC)) :
                            ?>
                        <option value="<?php echo $cc['typeID']; ?>">
                            <?php echo $cc['typename']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <br><br>
                    แนบรูปภาพ:
                    <input type="file" name="image" required>
                    <br><br>
                    <input type="submit" value="Submit" name="submit">
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#customerTable').DataTable();
        });
    </script>



</body>

</html>