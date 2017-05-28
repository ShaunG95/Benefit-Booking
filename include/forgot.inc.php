<?php

//If POST is not empty
if (!empty($_POST)) {
    //Check if password or password proof have been posted
    if(!$_POST['password'] || !$_POST['passwordproof']){
        //If not, warn the user that fields are empty
        echo "<div class='alert alert-danger alert-dismissable fade in'>
            <a href='#' class='close'' data-dismiss='alert' aria-label='close'>×</a>
            <strong>Warning!</strong> Please fill in all fields.
            </div>";
    } else {
        //set the variables equal to what the user entered
       $password = $_POST['password'];
	   $passwordproof = $_POST['passwordproof'];
        //encrypt the entered password and define a variable for this
	   $encryptedpass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    	//If the passwords are not the same, throw error
    	if($_POST['password'] !== $_POST['passwordproof']){
        	echo "Your passwords do not match";
            }
    
        //If the email token is set in the URL
    	if(isset($_GET['emailtoken'])){
            //Store it in a variable
            $emailtoken = ($_GET['emailtoken']);
            
            //Prepare a query to select the emailtoken from DB
    		$stmtFetchUser = $DBH->prepare("SELECT * FROM user WHERE tokenreset = :emailtoken");
            //Bind the value
    		$stmtFetchUser->bindValue(':emailtoken', $emailtoken);
            //Execute the query
    		$stmtFetchUser->execute();
            //Fetch all associated info of the found user
    		$resultFetchUser = $stmtFetchUser->fetch(PDO::FETCH_ASSOC);
            //Set variable userid with the id found in results
    		$userid = $resultFetchUser['id'];
    		
    		//If a user is found
    		if($stmtFetchUser->rowCount() > 0){
    		
    			//Update the record with new password
	    		$stmtUpdate = $DBH->prepare("UPDATE user SET password = :password WHERE id = :userid");
	    		$stmtUpdate->bindValue(':userid', $userid);
                	$stmtUpdate->bindValue(':password', $encryptedpass);
                	$stmtUpdate->execute();
                	
	                //Then remove the token from emailtokens
	                $stmtRemoveToken = $DBH->prepare("DELETE FROM emailtokens WHERE token = :emailtoken");
	                $stmtRemoveToken->bindValue(':emailtoken', $emailtoken);
	                $stmtRemoveToken->execute();
               		
               		//also remove from user table
               		$stmtRemoveTokenUser = $DBH->prepare("UPDATE user SET tokenreset = NULL where id = :userid");
               		$stmtRemoveTokenUser->bindValue(':userid', $userid);
               		$stmtRemoveTokenUser->execute();
               		
            //Redirect to homepage
			echo "<script>window.location = './index.php';</script>";
    		} else {
                //If the code is incorrect, warn the user
    			echo "<div class='alert alert-danger alert-dismissable fade in'>
            		<a href='#' class='close'' data-dismiss='alert' aria-label='close'>×</a>
            		<strong>Error!</strong> This token has expired or has already been used!
            		</div>";
    		}
        }
    }
}



?>
