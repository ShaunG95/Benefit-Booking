<script>
    //Store todays date as a variable
	var dateToday = new Date();
	$(function(){
	        //Configuration for calendar and for DB storage format
    		$("#datepicker").datepicker({
    		minDate: dateToday,
    		dateFormat: 'd-mm-y'
    		}).val()
  	});
</script>
	
	<?php
	    //require book script
	    require_once('./include/book.inc.php');
	    //get the room id from the URL and store in a variable
	    $room_id = ($_GET['id']);
	        //if the room exists
	        if(isset($_GET['id'])){
	            //run a query to search for the room details
	            $stmt = $DBH->prepare('SELECT * FROM rooms WHERE room_id = :roomid');
	            $stmt->bindValue(':roomid', $room_id);
	            $stmt->execute();
	            $result = $stmt->fetch(PDO::FETCH_ASSOC);
	        } else {
	            //Otherwise, the room does not exist!
	            echo 'Room does not exist!';
	        }

    //Output the room details found
	echo "<div class='content center-block'>
	    <h3>Confirm your booking</h3>
	<hr>
	
	<div class='center-block'>
		<img class='roomimage center-block' src='data:image/jpeg;base64,".base64_encode($result['room_image'])."'/>
	
	<b><p style='text-align: center;'>".$result['room_name']."</p></b>
	        
	<hr>
	
	<h4>Services</h4>
	        
	<div class='row'>
	    <div class='col-sm-6'>
	        <ul class='info list-unstyled'>

	            <li><b>Room Size:</b> ".$result['room_size']."
	            </li>
	            <li><b>Capacity:</b> ".$result['room_capacity']."
	            </li>
	            <li><b>Projector:</b> ".$result['room_projector']."
	            </li>
	        </ul>
	    </div>
	    <div class='col-sm-6'>
	        <ul class='info list-unstyled'>
	            <li><b>Computers:</b> ".$result['room_pcs']."
	            </li>
	            <li><b>WiFi:</b> ".$result['room_wifi']."
	            </li>
	            <li><b>Rental Time:</b> ".$result['room_rentaltime']."
	            </li>
	        </ul>
	    </div>
	</div>
	</div>

	<p><b>Available:</b> Now</p>
	    <hr>
	    
	    <h4>Book your room:</h4>";

	?>
	
	<?php
	if(isset($_SESSION['id'])){
	    echo "<form method='POST'>
	        <div class='form-group center-block'>
	            <input name='bookingdate' class='form-control' type='text' placeholder='Date' id='datepicker' required>
	        </div>
	    <button type='submit' class='btn btn-primary btn-block center-block' style='max-width: 60%; margin-top: 0; padding: 14px 16px;'>Confirm Booking</button>

	    </form>
	</div>";   
	
	} else {
	    echo "<div class='alert alert-info' style='text-align: center;'>
	    You are not logged in. Please click <a href='index.php?p=login'>here</a> to login or create an account to view our rooms.
	</div>"; 
	}
?>