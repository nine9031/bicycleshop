<?php

if (isset($_POST['bicycleID']) && isset($_POST['bicyclename']) && isset($_POST['bicycleprice'])) {
    require 'connect.php';

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $bicycleID = $_POST['bicycleID'];
    $bicyclename = $_POST['bicyclename'];
    $bicycleprice =  $_POST['bicycleprice'];

    echo 'bicycleID = ' . $bicycleID;
    echo 'bicyclename = ' . $bicyclename;
    echo 'bicycleprice = ' . $bicycleprice;


    $sql = "UPDATE bicycle SET bicyclename = :bicyclename, bicycleprice = :bicycleprice WHERE bicycleID = :bicycleID";
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':bicycleprice', $_POST['bicycleprice']);
    $stmt->bindParam(':bicyclename', $_POST['bicyclename']);
    $stmt->bindParam(':bicycleID', $_POST['bicycleID']);


    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if ($stmt->execute()) {
        echo '
        <script type="text/javascript">
        
        $(document).ready(function(){
        
            swal({
                title: "Success!",
                text: "Successfuly update customer information",
                type: "success",
                timer: 2500,
              }, function(){
                    window.location.href = "index.php";
              });
        });
        
        </script>
        ';
    }
    $conn = null;
}