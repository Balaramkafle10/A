<?php
include 'connection.php';

if(isset($_GET['customer_id'])){
    $id= $_GET['customer_id'];

    $query = "DELETE FROM customers WHERE customer_id='$id'";
    $result= mysqli_query($conn, $query);

    if($result){
        echo "customers record deleted succesfully.";
    }else{
        echo "error deleting customer record:".mysqli_error($conn);
    }
    } else{
        echo "Invalid id.";
        exit;
    }
    mysqli_close($conn);
    header('location:user_list.php')

?>