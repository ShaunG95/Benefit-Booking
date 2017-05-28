<?php
    require_once('./include/signup.inc.php');
?>

<script>
$(document).ready(function() {
    //If the alert appears, shake the form - Uses JQuery
	if ($('.alert').is(':visible')){
		$("#signupform").effect("shake");
		console.log('shown');
	}  
});
</script>

    <div class="content center-block" id="signupform" style="margin-top: 10em;">

        <h1 style="padding: 10px 0px;">Join Us</h1>

        <div ng-controller="MyCtrl">
            <form action='index.php?p=signup' method='POST' ng-class="{'submitted': submitted}" ng-submit="save()">

                <div class='form-group center-block'>


                    <input type='text' class='form-control' name='firstName' placeholder='First Name' required />
                </div>



                <div class='form-group center-block'>
                    <input type='text' class='form-control' name='lastName' placeholder='Last Name' required />
                </div>


                <div class='form-group center-block'>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
                        <input type='text' class='form-control' name='username' pattern="[a-z0-9]{3,16}$" title="Your username may only contain lowercase letters or numerical characters with a length of 3-16 characters" placeholder='Username' required />
                    </div>
                </div>

                <div class='form-group center-block'>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type='email' class='form-control' name='email' pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" title="Follow the format '@address.com' (e.g. test@googlemail.com)" placeholder='Email' required />
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
                <p style="text-align: center;">By registering I agree to the <a href="#">Privacy Policy</a></p>
            </form>
        </div>
    </div>
