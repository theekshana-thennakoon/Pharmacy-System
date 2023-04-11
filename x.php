<?php
session_start();
?>
<?php
include('database.php');
?>
<?php
if (!isset($_SESSION['loguser'])){
    header('Location:login.php');
}
?>

<?php

if (isset($_GET['deleteproduct'])){
    
    $id = $_GET['deleteproduct'];
    $sqli = "DELETE FROM products where id = {$id}";
    if($conn->query($sqli) === TRUE){
        header('Location:viewproduct.php');
    }
}

if (isset($_GET['deleteemployee'])){
    
    $id = $_GET['deleteemployee'];
    echo $id;
    $sqli = "DELETE FROM employee where id = {$id}";
    if($conn->query($sqli) === TRUE){
        header('Location:viewemployee.php');
    }
}

?>