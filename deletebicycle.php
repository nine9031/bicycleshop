<?php

require('connect.php');


$sql = "DELETE FROM bicycle WHERE bicycleID = :bicycleID";
$stml = $conn->prepare($sql);
$stml->bindParam(':bicycleID', $_GET["bicycleID"]);
 echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
    
if($stml->execute()) :
    
        $message = "Successfully delete bicycle".$_GET['bicycleID'].".";
           echo '
        <script type="text/javascript">
        
 
        
        </script>
        ';


else :
    $message = "Fail to delete customer information.";
endif;
$conn = null;

header("Location:index.php");

?>