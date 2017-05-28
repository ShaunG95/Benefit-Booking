<?php
//If the fields aren't filled, throw error to check username/password
if (!empty($_POST)) {
    if(!$_POST['username'] || !$_POST['password'] || !$_POST['email']){
        echo "Please enter a username, email and password";
    } else {
        //Retrieve and store variables
        $first = $_POST['firstName'];
        $last = $_POST['lastName'];
        $user = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $passwordproof = $_POST['passwordproof'];
        $encryptedPass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    //Select email from database
    $stmtEmail = $DBH->prepare("SELECT email FROM user WHERE email = :email");
    //Bind email to variable
    $stmtEmail->bindParam(':email', $email);
    //Execute prepared statement
    $stmtEmail->execute();
    
    //Select username from database
    $stmtUser = $DBH->prepare("SELECT username FROM user WHERE username = :user");
    //Bind username to variable
    $stmtUser->bindParam(':user', $user);
    //Execute prepared statement
    $stmtUser->execute();
    
    //If the passwords are not the same, throw error
    if($_POST['password'] !== $_POST['passwordproof']){
        echo "<div class='alert alert-warning alert-dismissable fade in'>
            <a href='#' class='close'' data-dismiss='alert' aria-label='close'>×</a>
            <strong>Error!</strong> Your passwords do not match.
            </div>";
        
    //If there is an account already with that username, throw error
    } elseif($stmtEmail->rowCount() > 0) {
        echo "<div class='alert alert-warning alert-dismissable fade in'>
            <a href='#' class='close'' data-dismiss='alert' aria-label='close'>×</a>
            <strong>Error!</strong> That email address already exists.
            </div>";
            } elseif($stmtUser->rowCount() > 0)  {
            echo "<div class='alert alert-warning alert-dismissable fade in'>
            <a href='#' class='close'' data-dismiss='alert' aria-label='close'>×</a>
            <strong>Error!</strong> That username already exists.
            </div>";
    } else {
        //Insert details into database
        $sql = "INSERT INTO user (firstName, lastName, username, email, password)
 VALUES (:first, :last, :user, :email, :pass)"; $query = $DBH->prepare($sql); $query->execute(array(            ':first' => $first,
                                ':last' => $last,
                                ':user' => $user,
                                ':email' => $email,
                                ':pass' => $encryptedPass,
                            ));
        //Redirect to home page
        
        echo "<div class='alert alert-success alert-dismissable fade in'>
            <a href='#' class='close'' data-dismiss='alert' aria-label='close'>×</a>
            You have been successfully registered!
            </div>";
    }
}
?>

