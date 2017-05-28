<div class="container homecontent">

    <h1>Welcome to Benefit <b>Booking</b></h1>
    <hr>
    <h3>Professional rooms, competitive pricing.</h3>
    <hr>
    <div class="row">
        <div class="col-md-4 info">
            <h3 class="home-info-heading">What do we offer?</h3>
            <p1 class="home-info">
                We offer competitive, professional rooms for you to rent out on your desired date.
            </p1>

        </div>
        <div class="col-md-4 info">
            <h3 class="home-info-heading">How does it work?</h3>

            <p1 class="home-info">
                Simply create an account, go to 'rooms', pick your room and the date you wish to book.
            </p1>
        </div>
        <div class="col-md-4 info">
            <h3 class="home-info-heading">What next?</h3>

            <p1 class="home-info">
                You can find your booking information under 'My account', you will also receive an email confirming your booking.
            </p1>
        </div>
    </div>

    <hr>

    <div class="row">

<?php
	if (isset($_SESSION['id'])){
	
	} else { ?>
            <div class="col-lg-12" id="SignupHome">
                <h1>New to Benefit <b>Booking</b>?</h1>
                <h3>Sign up with <i>ease</i></h3>

                <form action='index.php?p=signup' method='POST' ng-class="{'submitted': submitted}" ng-submit="save()">
                    
                    <div class='form-group center-block'>
                                <input type='text' id="noRow-homeFirst" class='form-control' name='firstName' placeholder='First Name' required />
                            </div>
                    
                    <div class='form-group center-block'>
                                <input type='text' id="noRow-homeLast" class='form-control' name='lastName' placeholder='Last Name' required />
                            </div>

                    <div class='form-group center-block'>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type='text' class='form-control' name='username' pattern="[a-z0-9]{3,16}$" title="Your username may only contain lowercase letters, 3-16 characters" placeholder='Username' required />
                        </div>
                    </div>

                    <div class='form-group center-block'>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type='email' class='form-control' name='email' pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" title="This field must contain an @ character. e.g. franky123@gmail.com" placeholder='Email' required />
                        </div>
                    </div>

                    <div class='form-group center-block'>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type='password' class='form-control' name='password' placeholder='Password' required />
                        </div>
                    </div>


                    <div class='form-group center-block'>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type='password' class='form-control' name='passwordproof' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must be at least 8 characters long containing at least 1 number and 1 uppercase letter e.g. Franky123" placeholder='Re-enter Password' required />
                        </div>
                    </div>

                    <div class='form-group center-block'>
                        <button type='submit' ng-click="submitted= true;" class='btn btn-primary btn-block'>Sign Up</button>
                    </div>
                </form>
            </div>
            <?php } ?>
    </div>
</div>
