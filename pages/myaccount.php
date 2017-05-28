<?php

$error = '';

//if the user is logged in
if($_SESSION['id']){
    //select all details from the user table that match the users id
    $query = "SELECT * FROM user WHERE id = :id";
    //prepare query
    $stmt = $DBH->prepare($query);
    //bind the id for safety (just incase)
    $stmt->bindParam(':id', $_SESSION['id']);
    //execute the query
    $stmt->execute();
    //fetch any associated information and create result variable
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    //Otherwise display an error
    $error = "You are not logged in.";
}
?>

    <div class="content center-block" style="overflow: auto;">

        <h1>My Account</h1>

        <?php
		if($error){
			echo "<h1>Error!</h1>";
			echo "<p>".$error."</p>";
		}else{
	?>

            <div class="items-myAccount">
                <p><strong>First Name:</strong>
                    <?php 
                    //Output content with upper case first character
                    echo ucfirst($result['firstName']); 
                    ?>
                </p>
                <p><strong>Last Name:</strong>
                    <?php 
                    //Output content with upper case first character
                    echo ucfirst($result['lastName']); 
                    ?>
                </p>
                <p><strong>Email Address:</strong>
                    <?php 
                    //Output content with upper case first character
                    echo ucfirst($result['email']); 
                    ?>
                </p>
            </div>

            <?php } ?>
            <hr>

            <h1>Booking</h1>

            <?php
        //set userid equal to session id
    	$userid = ($_SESSION['id']);
    	
    	//select bookings where the userid matches
        $stmtLookupBooked = $DBH->prepare("SELECT * FROM bookings WHERE user_id = :userid");
        //bind the userid variable for security
        $stmtLookupBooked->bindValue(':userid', $userid);
        //execute the query
        $stmtLookupBooked->execute();
        //fetch associated and store result
        $resultLookupBooked = $stmtLookupBooked->fetch(PDO::FETCH_ASSOC);
        //set roomid equal to the result obtained
        $roomid = $resultLookupBooked['room_id'];
        
        //start another query selecting all rooms from rooms equal to the user id variable
        $stmtLookupRoom = $DBH->prepare("SELECT * FROM rooms WHERE room_id = :roomid");
        //bind variables for security
        $stmtLookupRoom->bindValue(':roomid', $roomid);
        //execute query
        $stmtLookupRoom->execute();
        //fetch associated results
        $resultLookupRoom = $stmtLookupRoom->fetch(PDO::FETCH_ASSOC);
        
        //if a record exists
        if(count($roomid) > 0){
            //include the delete script for good measure
            require_once('./include/delete.inc.php');
            
            //output all results of found record
    	echo "<img class='roomimage center-block' src='data:image/jpeg;base64,".base64_encode($resultLookupRoom['room_image'])."'/>
    	<div class='col-sm-12'>
                <b><p style='text-align: center;'>".$resultLookupRoom['room_name']."</p></b>
                <hr>

                <ul class='list-unstyled'>
                    <h4>Services</h4>
                    <li><b>Room Size:</b>
                        ".$resultLookupRoom['room_size']."
                    </li>
                    <li><b>Capacity:</b>
                        ".$resultLookupRoom['room_capacity']."
                    </li>
                    <li><b>Projector:</b>
                        ".$resultLookupRoom['room_projector']."
                    </li>
                    <li><b>Computers:</b>
                        ".$resultLookupRoom['room_pcs']."
                    </li>
                    <li><b>WiFi:</b>
                        ".$resultLookupRoom['room_wifi']."
                    </li>
                    <li><b>Date Booked:</b>
                        ". substr($resultLookupBooked['booking_date'],2)."
                    </li>
                </ul>
                
                <form method='POST'>
                    <input type='hidden' name='delete'>
                    <button type='submit' class='btn btn-primary btn-block center-block' style='max-width: 60%; margin-top: 0; padding: 14px 16px;'>Cancel Booking</button>
                <form>
            </div>";
            //if the URL contains 'bookingcancelled'
          } elseif(isset($_GET['bookingcancelled'])){
                //notify the user that their room has been removed from the database
                echo "<div class='alert alert-success alert fade in'>
                <p>Your booking has been successfully cancelled. An e-mail has been sent to you to confirm your cancellation.</p>
                </div>";
            } else {
                //Notify the user that no records are found
                echo "<div class='alert alert-info alert fade in'>
                <p>You have not booked a room yet</p>
                </div>";
        }
?>

    </div>
