<?php
//If post is not empty
if (!empty($_POST)) {
    //If email hasn't been entered
    if(!$_POST['email']){
        echo "<div class='alert alert-danger alert-dismissable fade in'>
            <a href='#' class='close'' data-dismiss='alert' aria-label='close'>×</a>
            <strong>Warning!</strong> Please fill in email/username
            </div>";
    //Otherwise, define the variable for the posted email
    } else {
         $email = $_POST['email'];
    }
    //Select the record with entered email
    $stmt = $DBH->prepare('SELECT id,username,email FROM user WHERE email = :email');
    //Bind the email variable
    $stmt->bindValue(':email', $email);
    //Execute query
    $stmt->execute();
    //Fetch all associated info of that user
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $username = $result['username'];
    
    //Check if the user exists
	if($stmt->rowCount() > 0){
            //If successful, generate a random string for an emailtoken
            $emailtoken = hash('sha512', uniqid());
            $msg = "Your reset link has been sent, if you cannot find this, please check your spam folder.";
            $to=$email;
            $subject="Password Reset";
            $from = 'guys1_14@uni.worc.ac.uk';
            $body='Dear '.$username.'<br><br> A password reset was recently requested from Benefit Booking.<br><br> 	If this was not you, please ignore this email.<br><br> Otherwise, please click the following link to reset your password: shaunguy.worcestercomputing.com/benefitbooking/index.php?p=forgot&emailtoken='.$emailtoken;
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .="From: " . strip_tags($from) . "\r\n";
            $headers .="Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "Content-type: text/html;charset=UTF-8"."\r\n";
        
            mail($to,$subject,$body,$headers);
            //Alert the user that a reset link has been sent
            echo "<div class='alert alert-success alert-dismissable fade in'>
            <a href='#' class='close'' data-dismiss='alert' aria-label='close'>×</a>
            <strong>Success! </strong>".$msg."
            </div>";
            
            //Insert the emailtoken into DB
            $queryInsert = "INSERT INTO emailtokens (email, token)
            			VALUES (:email, :token)";
            $stmtInsert = $DBH->prepare($queryInsert);
            $stmtInsert->bindValue(':email', $email);
            $stmtInsert->bindValue(':token', $emailtoken);
            $stmtInsert->execute();
            
            //Update the user table with the token that has been sent
            $queryUser = "UPDATE user SET tokenreset=:token WHERE email = :email";
            $stmtUser = $DBH->prepare($queryUser);
            $stmtUser->bindValue(':email', $email);
            $stmtUser->bindValue(':token', $emailtoken);
            $stmtUser->execute();

        } else {
            //Otherwise, output an error
            echo "<div class='alert alert-danger alert-dismissable fade in'>
            <a href='#' class='close'' data-dismiss='alert' aria-label='close'>×</a>
            <strong>Warning!</strong> Unknown Email Address
            </div>";
        }
}
?>
