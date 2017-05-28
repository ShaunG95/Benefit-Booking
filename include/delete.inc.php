<?php
//If delete field has been POSTed (Uses HIDDEN field)
if(isset($_POST['delete'])){
    //Set user id to session id
    $userid = ($_SESSION['id']);
	
    //Prepare query, find associated booking that user has
	$stmtSelectBooking = $DBH->prepare("SELECT * FROM bookings WHERE user_id = :userid");
    //Bind the userid value
	$stmtSelectBooking->bindValue(':userid', $userid);
    //Execute the query
	$stmtSelectBooking->execute();
	
    //Select all information from the user
	$stmtSelectUser = $DBH->prepare("SELECT * FROM user WHERE id = :userid");
    //Bind userid value
	$stmtSelectUser->bindValue(':userid', $userid);
    //Execute the query
	$stmtSelectUser->execute();
    //Fetch all associated information for the user
	$resultSelectUser = $stmtSelectUser->fetch(PDO::FETCH_ASSOC);
    //Define the following variables
	$useremail = $resultSelectUser['email'];
	$username = $resultSelectUser['username'];
	
    //Update the user and set the room booked to 0 (Null)
    $queryuser = "UPDATE user SET room_booked='0' WHERE id = :userid";
    //Prepare the query
    $stmtuser = $DBH->prepare("$queryuser");
    //Bind the userid
    $stmtuser->bindValue(':userid', $userid);
    //Execute the query
    $stmtuser->execute();

    //Delete the record in bookings to reflect the 'room_booked' value in user table
	$stmtDeleteBooking = $DBH->prepare("DELETE FROM bookings WHERE user_id = :userid");
    //Bind the value
	$stmtDeleteBooking->bindValue(':userid', $userid);
    //Execute the query
	$stmtDeleteBooking->execute();
	
    //Send an email to the user with the following information
    $to=$useremail;
    $subject="Cancellation Confirmation";
    $from = 'guys1_14@uni.worc.ac.uk';
    $body='Dear '.$username.' <br><br> This is an email to confirm that your room booking has been cancelled.
    You can find updated information on the "My account" section of the website.<br><br>
    Kindest Regards,<br><br>
    Benefit <b>Booking</b>';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .="From: " . strip_tags($from) . "\r\n";
    $headers .="Reply-To: ". strip_tags($from) . "\r\n";
    $headers .= "Content-type: text/html;charset=UTF-8"."\r\n";

    mail($to,$subject,$body,$headers);
	
    //Redirect with &bookingcancelled in the URL.
    echo "<script>window.location = './index.php?p=myaccount&bookingcancelled';</script>";
}
?>