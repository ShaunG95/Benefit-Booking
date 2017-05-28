<h1>Rooms</h1>

<?php
    //Select all records from rooms table
    $query = "SELECT * FROM rooms";
    $stmt = $DBH->prepare($query);
    $stmt->execute();
    //fetch associated information of rooms
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //define the result of room id to a variable
    $room_id = $result['room_id'];
    
    /*Do while loop: This loop continues outputting records in the database for every result that is found. There are 5 rooms stored in the database
    and this code will continue outputting rooms with defined styles until 5 records are output*/
    do {
    $room_id = $result['room_id'];
    echo "<div class='roomlist container' style='overflow: auto;'>
        <div class='row'>
            <div class='col-sm-4'>
            
        <img class='roomimage img-responsive center-block' alt='roomimage' src='data:image/jpeg;base64,".base64_encode($result['room_image'])."'/>
        </div>

            <div class='col-sm-4'>
                <b><h3>".$result['room_name']."</h3></b>
                <hr>

                <ul class='list-unstyled'>
                    <h4>Services</h4>
                    <li><b>Room Size:</b>
                        ".$result['room_size']."
                    </li>
                    <li><b>Capacity:</b>
                        ".$result['room_capacity']."
                    </li>
                    <li><b>Projector:</b>
                        ".$result['room_projector']."
                    </li>
                    <li><b>Computers:</b>
                        ".$result['room_pcs']."
                    </li>
                    <li><b>WiFi:</b>
                        ".$result['room_wifi']."
                    </li>
                </ul>
            </div>

            <div class='col-sm-4' style='border-left: 1px solid #;'>
                <div style='padding-top: 40px; padding-bottom: 5px;'>
                    <strong><p style='text-align: center;'>Available Now</p></strong>
                    <p style='text-align: center;'>Rental Time:
                        ".$result['room_rentaltime']."
                    </p>
                </div>
                <div>
                     <form method='post' action='index.php?p=book&id=".$room_id."'>
                        <button type='submit' 
                        class='btn btn-primary btn-block center-block'
                        style='max-width: 60%; margin-top: 0; padding: 14px 16px;'>Book</button>
                	</form> 
                </div>
            </div>
        </div>
    </div>";
    //Output results while records exist
} while($result = $stmt->fetch(PDO::FETCH_ASSOC));