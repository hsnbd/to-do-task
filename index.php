<?php require('app/functions.php');  ?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--all stylesheet file -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">


</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="body effect col-md-5 mx-auto">
<?php
  require('view/home.php');
 ?>
            </div>
        </div>





        <div class="row">
            <div class="footer fixed-bottom text-center col-md-12">
                <p>Copyright by &copy; Baker Hasan - 2016-2017</p>
            </div>
        </div>
        
<!--container end-->
    </div>

    
<!--all script file -->
    <script src="js/jquery-3.2.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
