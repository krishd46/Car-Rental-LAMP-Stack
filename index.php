<!doctype html>
<html lang="en">

    <?php 
        session_start(); 
        require 'connection.php';
        $conn = Connect();
    ?>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/user.css">
        <link rel="stylesheet" href="assets/w3css/w3.css">

        <link rel="shortcut icon" type="image/png" href="assets/img/P.png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic,700italic" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

        <title>Car Rental | Mindscript</title>

    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">


        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="color: black">

        <div class="container">
        
        <div class="navbar-header">
        
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
            <i class="fa fa-bars"></i>
        </button>
        
        <a class="navbar-brand page-scroll" href="index.php">
        Online Car Rental
        </a>

        </div>

        <?php
        if(isset($_SESSION['login_client'])){
        ?> 

        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <li>
                <a href="index.php">Home</a>
                </li>

                <li>
                <a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_client']; ?></a>
                </li>
                
                <li>
                <ul class="nav navbar-nav navbar-right">
                <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Control Panel <span class="caret"></span> </a>
                <ul class="dropdown-menu">
                <li> <a href="entercar.php">Add Car</a></li>
                <li> <a href="enterdriver.php"> Add Driver</a></li>
                <li> <a href="clientview.php">View</a></li>
                </ul>
                </li>
                </ul>
                </li>
                <li>
                <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                </li>
            </ul>
        </div>

        <?php
        }
        else if (isset($_SESSION['login_customer'])){
        ?>

        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <li>
                <a href="index.php">Home</a>
                </li>
                <li>
                <a href="#"><span class="glyphicon glyphicon-user"></span>Welcome <?php echo $_SESSION['login_customer']; ?></a>
                </li>
                <ul class="nav navbar-nav">
                <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Garage <span class="caret"></span> </a>
                <ul class="dropdown-menu">
                <li> <a href="prereturncar.php">Return Now</a></li>
                <li> <a href="mybookings.php"> My Bookings</a></li>
                </ul>
                </li>
                </ul>
                <li>
                <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                </li>
            </ul>
        </div>

        <?php
        }
        else {
        ?>

        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
            <li>
            <a href="index.php">Home</a>
            </li>
            <li>
            <a href="clientlogin.php">Renter</a>
            </li>
            <li>
            <a href="customerlogin.php">Borrower</a>
            </li>
            </ul>
        </div>

        <?php   }
        ?>

        </div>

        </nav>
        <div class="bgimg-1">
        <header class="intro">
        <div class="intro-body">
        <div class="container">
        <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <h1 class="brand-heading" style="color: white">Car Rental</h1>
        <p class="intro-text">
        Online Car Lending And Borrowing Service
        </p>
        <a href="#sec2" class="btn btn-circle page-scroll blink">
        <i class="fa fa-angle-double-down animated"></i>
        </a>
        </div>
        </div>
        </div>
        </div>
        </header>
        </div>

        <div id="sec2" style="color: #777;background-color:white;text-align:center;padding:50px 80px;text-align: justify;">
        <h3 style="text-align:center;">Currently Available Cars</h3>
        <br>
        <section class="menu-content">
        <?php   
        $sql1 = "SELECT * FROM cars WHERE car_availability='yes'";
        $result1 = mysqli_query($conn,$sql1);

        if(mysqli_num_rows($result1) > 0) {
        while($row1 = mysqli_fetch_assoc($result1)){
        $car_id = $row1["car_id"];
        $car_name = $row1["car_name"];
        $ac_price = $row1["ac_price"];
        $ac_price_per_day = $row1["ac_price_per_day"];
        $non_ac_price = $row1["non_ac_price"];
        $non_ac_price_per_day = $row1["non_ac_price_per_day"];
        $car_img = $row1["car_img"];

        ?>
        <a href="booking.php?id=<?php echo($car_id) ?>">
        <div class="sub-menu">


        <img class="card-img-top" src="<?php echo $car_img; ?>" alt="Card image cap">
        <h5> <?php echo $car_name; ?> </h5>
        <h6> AC Fare: <?php echo ("???" . $ac_price . "/km & ???" . $ac_price_per_day . "/day"); ?></h6>
        <h6> Non-AC Fare: <?php echo ("???" . $non_ac_price . "/km & ???" . $non_ac_price_per_day . "/day"); ?> </h6>

        </div> 
        </a>
        <?php }}
        else {
        ?>   
        <h1> No cars available :( </h1>
        <?php
        }
        ?>                           
        </section>

        </div>

        <div class="bgimg-2">
        <div class="caption">
        <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;"></span>
        </div>
        </div>


        <div class="w3-content w3-container w3-padding-64" id="contact">

        <h3 class="w3-center">Feel free to share your feedback!</h3>
        <p class="w3-center"><em>Feedback</em></p>

        <div class="w3-row w3-padding-32 w3-section">
        <div class="w3-col m4 w3-container">
        </div>
        <div class="w3-col m8 w3-panel">
        <div class="w3-large w3-margin-bottom">
        <i class="fa fa-map-marker fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Mindscript <br>
        <i class="fa fa-phone fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone: +919876543210<br>
        <i class="fa fa-envelope fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Email: email@mindscript.com<br>
        </div>
        <p>Lend / Rent car easily.</p>
        <form action="action_page.php" method="POST">
        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
        <div class="w3-half">
        <input class="w3-input w3-border" type="text" placeholder="Name" required name="name">
        </div>
        <div class="w3-half">
        <input class="w3-input w3-border" type="text" placeholder="Email" required name="e_mail">
        </div>
        </div>
        <input class="w3-input w3-border" type="text" placeholder="Message" required name="message">
        <button class="w3-button w3-black w3-right w3-section" type="submit">
        <i class="fa fa-paper-plane"></i> Send message
        </button>
        </form>
        </div>
        </div>
        </div>


        <script>
        function sendGaEvent(category, action, label) {
            ga('send', {
                hitType: 'event',
                eventCategory: category,
                eventAction: action,
                eventLabel: label
            });
        };
    </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCuoe93lQkgRaC7FB8fMOr_g1dmMRwKng&callback=myMap" type="text/javascript"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>

        <script src="assets/js/jquery.easing.min.js"></script>

        <script src="assets/js/theme.js"></script>





        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        
    <body>

</html>