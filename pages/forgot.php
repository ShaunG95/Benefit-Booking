<?php
    //require forgot script
    require_once('./include/forgot.inc.php');
    
    //store emailtoken from URL in a variable
	$emailtoken = ($_GET['emailtoken']);
	
	//if the email token is set
	if(isset($_GET['emailtoken'])){
	    //run query to select the token from the database
		$stmtToken = $DBH->prepare('SELECT email FROM emailtokens WHERE token = :emailtoken');
		$stmtToken->bindValue(':emailtoken', $emailtoken);
		$stmtToken->execute();
		$tokenResult = $stmtToken->fetch(PDO::FETCH_ASSOC);
		
		//If the token exists, output reset password form
		if($stmtToken->rowCount() > 0){
		
		echo "<div class='content center-block'>

                <h3>Reset your password</h3>

    <div ng-controller='MyCtrl'>
        <form method='POST' ng-class='{'submitted': submitted}' ng-submit='save()'>

            <div class='form-group center-block'>
                <input type='password' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}' title='Password must be at least 8 characters long containing at least 1 number and 1 uppercase letter e.g. Franky123'  class='form-control' name='password' placeholder='Password' required>
            </div>
            
            <div class='form-group center-block'>
                <input type='password' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}' title='Password must be at least 8 characters long containing at least 1 number and 1 uppercase letter e.g. Franky123'  class='form-control' name='passwordproof' placeholder='Re-enter Password' required>
            </div>
            
            <div class='form-group center-block'>
                <button type='submit' class='btn btn-primary btn-block' ng-click='submitted= true;'>Reset Password</button>
            </div>

        </form>
    </div>
</div>";
		
		
		} else {
		    //Notify the user that the code is not valid
			echo "<div class='alert alert-danger alert-dismissable fade in'>
	            	<a href='#' class='close'' data-dismiss='alert' aria-label='close'>×</a>
	            	<strong>Warning!</strong> Not a valid code
            </div>";
		}
	
	
	
		

	} else {
		
	}
?>
