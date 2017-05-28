<?php
//If the fields aren't filled, throw error to check all fields are filled
if (!empty($_POST)) {
    if(!$_POST['username'] || !$_POST['password']){
        echo "<div class='alert alert-danger alert-dismissable fade in'>
            <a href='#' class='close'' data-dismiss='alert' aria-label='close'>×</a>
            <strong>Warning!</strong> Please fill in all fields.
            </div>";
    } else {
        //request username and password input
        $user = $_REQUEST['username'];
        $pass = $_REQUEST['password'];
    }
    
    //Select the account with entered username
    $stmt = $DBH->prepare('SELECT id,username,password FROM user WHERE username = :user');
    //Bind the username variable
    $stmt->bindValue(':user', $user);
    //Execute query
    $stmt->execute();
    //Fetch all associated info of that user
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //Encrypt the entered password and check if it matches the password stored
	if(count($result) > 0 && password_verify($_POST['password'], $result['password']) ){
        //If successful, create a session and return to home
        $_SESSION['id'] = $result['id'];
            echo "<script>window.location = './index.php';</script>";
        } else {
            //Otherwise, output an error
            echo "<div class='alert alert-danger alert-dismissable fade in' id='loginerror'>
            <a href='#' class='close'' data-dismiss='alert' aria-label='close'>×</a>
            <strong>Warning!</strong> Username or Password Incorrect
            </div>";
        }
}
?>