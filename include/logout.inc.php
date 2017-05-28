<?php
//stop session and return to homepage
session_start();
if (isset($_SESSION['id'])){
    unset($_SESSION['id']);
    session_destroy();
    $_SESSION['id'] = "false";
    echo "<script>window.location.href = 'http://www.shaunguy.worcestercomputing.com/benefitbooking/index.php';</script>";
}
?>
