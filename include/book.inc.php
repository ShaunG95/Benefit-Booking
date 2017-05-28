<?php
//If POST is not empty, run code
if(!empty($_POST)){
    //If there is no booking selected, return to book page
	if(!$_POST['bookingdate']){
	echo "<script>window.location = './index.php?p=book';</script>";
        //Otherwise, set date to the booking date chosen
	  } else {
	   $date = $_POST['bookingdate'];
	  }
        //Set userid equal to the session id
	   $userid = ($_SESSION['id']);
	   
        //If the room id is found in the URL
	   if(isset($_GET['id'])){
        //Set the roomid variable equal to the variable found in URL
	   $room_id = ($_GET['id']);
	   
           //Select all info from user where the userid matches
        $stmtGetuser = $DBH->prepare("SELECT * FROM user WHERE id = :userid");
           //Bind the variable
        $stmtGetuser->bindValue(':userid', $userid);
           //Execute
        $stmtGetuser->execute();
           //Fetch associated info from DB
        $result = $stmtGetuser->fetch(PDO::FETCH_ASSOC);
           //Set username and useremail equal to the results retrieved
        $username = $result['username'];
        $useremail = $result['email'];
           
           //Establish query
	   $querybook = "INSERT INTO bookings (user_id, booking_date, user_email, room_id)
	   					VALUES (:userid, :bookingdate, :useremail, :room_id)";
           //Prepare the query
	   $stmtbook = $DBH->prepare("$querybook");
           //Insert record with chosen variables
	   $stmtbook->execute(array(
                                ':userid' => $userid,
                                ':bookingdate' => $date,
                                ':useremail' => $useremail,
                                ':room_id' => $room_id,
                            ));
                            
            
           //Update the user table to reflect the booked room
        $queryuser = "UPDATE user SET room_booked=:room_id WHERE id = :userid";
           //Prepare the query
        $stmtuser = $DBH->prepare("$queryuser");
           //Bind the values
        $stmtuser->bindValue(':userid', $userid);
        $stmtuser->bindValue(':room_id', $room_id);
           //Execute the query
        $stmtuser->execute();
            
           
            //Define variables for email  
            $to=$useremail;
            $subject="Booking Successful!";
            $from = 'guys1_14@uni.worc.ac.uk';
            $body='Dear '.$username.' <br><br> This is an email to confirm that your room has been successfully booked for the '.$date.'.
            You can find information regarding your booking on the "My account" section of the website.<br><br>
            Kindest Regards,<br><br>
            Benefit <b>Booking</b>';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .="From: " . strip_tags($from) . "\r\n";
            $headers .="Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "Content-type: text/html;charset=UTF-8"."\r\n";
            
           //Send user email with the following variables (The content)
            mail($to,$subject,$body,$headers);
            
           //Redirect to auth page
            echo "<script>window.location = './index.php?p=auth';</script>";
		}
	}
