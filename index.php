<?php
    // Include header partial
    require_once('./partials/header.php');

    if(isset($_GET['p'])){
        if (file_exists('./pages/'.$_GET['p'].'.php')) {
            require_once('./pages/'.$_GET['p'].'.php');
        }else{
            require_once('./pages/home.php'); 
        }
    }else{
        require_once('./pages/home.php');
    }


    // Include footer partial
    require_once('./partials/footer.php');
?>