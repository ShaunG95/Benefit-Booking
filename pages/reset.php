<?php
    require_once('./include/reset.inc.php');
?>

    <div class="content center-block">

        <form method="post" action="<?php echo $_SERVER[" PHP_SELF "].'?p='.$_GET['p'];?>">

            <h3>Enter your email address</h3>

            <div class="form-group center-block">
                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
            </div>

            <div class="form-group center-block">
                <button type="submit" class="btn btn-primary btn-block" ng-click="submitted= true;">Request Reset</button>
            </div>
        </form>
    </div>
