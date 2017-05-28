<?php
    require_once('./include/login.inc.php');
?>

<script>
//If login is incorrect, shake the container. -> JQuery
$(document).ready(function() {
    //If loginerror field is shown
	if ($('#loginerror').is(':visible')){
	    //shake the container
		$("#logincontainer").effect("shake");
	}  
});

//redirect for 'forgot password' button
function redirect() {
            window.location = 'index.php?p=reset';
        };
</script>

    <div class="content center-block" id="logincontainer" style="margin-top: 10em;">

        <h3>Sign in with your account</h3>

        <div ng-controller="MyCtrl">
            <form method="post" ng-class="{'submitted': submitted}" ng-submit="save()" action="<?php echo $_SERVER[" PHP_SELF "].'?p='.$_GET['p'];?>">

                <div class='form-group center-block'>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                </div>

                <div class='form-group center-block'>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type='password' class='form-control' name='password' placeholder='Password' required />
                    </div>
                </div>

                <div class="form-group center-block">
                    <button type="submit" class="btn btn-primary btn-block" ng-click="submitted= true;">Log in</button>
                </div>
            </form>

            <form>
                <div class="form-group center-block">
                    <button type="button" class="btn btn-primary btn-block" id="forgotbtn" onclick="redirect();">Forgot Password</button>
                </div>

                <div style="text-align: center;">
                    <h4>No account? Register <a href="./index.php?p=signup">Here</a></h4>
                </div>
            </form>
        </div>
    </div>
