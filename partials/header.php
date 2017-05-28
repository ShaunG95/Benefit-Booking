<?php
    //Start a session with the user
    session_start();

    // Include DB
    require_once('./include/db.inc.php');
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Benefit Booking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--Bootstrap framework implementation, styles were overriden extensively in style.css-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- JQuery CSS, edited slightly in code but used mainly so code doesn't break. Used for datepicker (book.php) & shake effect (Login/Signup) -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!--Personal Stylesheet-->
  	    <link rel="stylesheet" type="text/css" href="./css/style.css">
  	    <!--JQuery Framework, edited for both shake effect and datepicker. Datepicker used different variables for functionality & changed variables in shake effect for login container-->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <!--JQuery UI - Unsure what this is used for but I didn't want to break anything by removing it, I get confused with multiple jquery files. Apologies but referencing anyway-->
  	    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	    <!--Bootstrap JS, mainly used to add styles to header navbar (See below)-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <script>
    		$(function(){
    			//If an anchor tag is active, apply 'active' class to it
    			//This function works by applying a class to the 'a' tag which has pre-defined styling in CSS.
        		$('a').each(function(){
            			if ($(this).prop('href') == window.location.href) {
                			$(this).addClass('active'); $(this).parents('li').addClass('active');
            			}
        		});
    		});

    	</script>
    </head>
    
    

    <body class="page_<?php echo $_GET['p'];?>">
        <header id="navigation">
            <nav class="navbar navbar-default" role="navigation" style="background-color: #337ab7; border-color: #326b9c;">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="navbar-brand"><a href="index.php">
                                Benefit Booking
                            </a></div>
                    </div>

                    <div class="collapse navbar-collapse" id="navbar-brand">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.php?p=rooms" class='active-page'>Rooms</a></li>
                            <li><a href="index.php?p=aboutus">About Us</a></li>
                            <?php
                                //If the user is logged in, show 'My Account' and 'Logout'
                                if (isset($_SESSION['id'])){
                                    echo "<li><a href='index.php?p=myaccount'>My Account</a></li>";
                                    echo "<li><a href='include/logout.inc.php'>Logout</a></li>";
                                } else {
                                    //If the user is NOT logged in, show 'Login' and 'Signup'
                                    echo "<li><a href='index.php?p=login'>Login</a></li>";
                                    echo "<li><a href='index.php?p=signup'>Sign Up</a></li>";
                                }
                            ?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
