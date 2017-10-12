<html>
    <head>
        <title>Vormetric Tokenization Server Demo</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/vormetric.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/css/base.css" />
        <link rel="stylesheet" type="text/css" href="/css/login.css" />
        <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="/css/skin.css" rel="stylesheet">
        <meta charset="UTF-8" />
    </head>
    <body class="slideToLeft" style="left: 0px;">
        <header class="container-fluid">
            <div class="col-md-6">
                <a href="#" class="site-logo"><img src="../vormetric-logo.png"></a>
                <h3><span class="verticalPipe"></span></i>Customer Database</h3>
            </div>
            <div class="col-md-offset-4 col-md-2">
                <h4 class="list-inline pull-right rightsideIcons">
                    <?php
                        include '../config.php';
                        
                        print "Welcome, $user. <a href=\"index.html\">Logout</a>"; 
                    ?>
                </h4>
            </div>
        </header>
        <div id="app_container" class="container-fluid">
        <div class="col-md-1 left-navigation">
            <ul class="list-unstyled">
                <li> <a href="/demo.php"><i class="fa fa-wrench fa-1x" aria-hidden="true"></i> <span>Toolbox</span></a> </li>
                <li class="active">
                    <a href="/appli/databaseview.php" class=""><i class="fa fa-user-circle-o fa-1x" aria-hidden="true""></i> <span>Customer Database</span> </a>
                    <ul id="subMenu">
                        <li class="active"><a href="/appli/databaseview.php">View Database</a></li>
                        <li><a href="/appli/customerform.php">Add Customer</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="col-md-offset-1 col-md-11 perfectWidth">
            <a href="/appli/customerform.php"><button type="button" class="btn btn-primary center-block margetop">Add Customer</button></a>
            <?php
                include '../config.php';
                include '../utils/DBHelper.php';
                include '../utils/VAEHelper.php';
                include '../utils/VTSHelper.php';
                
                print   "
                  <div class=\"col-md-12\">
                  <table width=100% border=1>
                  <TR>
                  <TD bgcolor=#dddddd>CustomerID</TD>
                  <td bgcolor=#dddddd>
                    <b>Firstname</b>
                    </td>
                    <td bgcolor=#dddddd><b>
                      Lastname</b></td>
                    <td bgcolor=#dddddd><b>
                      Birth Date</b></td>
                    <td bgcolor=#dddddd><b>
                      Phone Number</b></td>
                    <td bgcolor=#dddddd><b>
                      Nationality</b></td>
                    <td bgcolor=#dddddd><b>
                      SSN</b></td>
                    <td bgcolor=#dddddd><b>
                      Address</b></td>
                    <td bgcolor=#dddddd><b>
                      City</b></td>
                    <td bgcolor=#dddddd><b>
                      Postcode</b></td>
                    <td bgcolor=#dddddd><b>
                      Country</b></td>
                    <td bgcolor=#dddddd><b>
                      Card Number</b></td>
                    <td bgcolor=#dddddd><b>
                      Expiration Date</b></td>
                    <td bgcolor=#dddddd><b>
                      CVV</b></td>
                    <td bgcolor=#dddddd><b>
                      Delete</b></td></tr>
                  " ; 
                
                $dbh = new DBHelper();
                $vaeh = new VAEHelper();
                $vtsh = new VTSHelper();
                
                //Get all the customers stored in the encryoted database
                $results = $dbh->getAllCustomers();
                
                foreach ($results as $line) {
                  $id = $line['id'];
                  $firstname = $vaeh->decrypt($line['firstname'], $encryption_key);
                  $lastname = $vaeh->decrypt($line['lastname'], $encryption_key);
                  $birth_date = (($res = $vtsh->detokenize($tokengroup, $line['birthDate'], 'datetemplate', $user, $passwd)) == 'KO' ? $line['birthDate'] : $res);
                  
                  $phone_number = ($line['phoneNumber'] !== null ? $vtsh->detokenize($tokengroup, $line['phoneNumber'], 'phonenumber', $user, $passwd) : $line['phoneNumber']);
                  
                  $nationality = $line['nationality'];
                  $ssn = ($line['ssn'] !== null ? $vtsh->detokenize($tokengroup, $line['ssn'], 'ssn', $user, $passwd) : $line['ssn']);
                  $address = ($line['address'] !== null ? $vaeh->decrypt($line['address'], $encryption_key) : $line['address']);
                  $city = ($line['city'] !== null ? $vaeh->decrypt($line['city'], $encryption_key) : $line['city']);
                  $postcode = ($line['postcode'] !== null ? $vtsh->detokenize($tokengroup, $line['postcode'], 'phonenumber', $user, $passwd) : $line['postcode']);
                  $country = $line['country'];
                  $card_number = ($line['cardNumber'] !== null ? $vtsh->detokenize($tokengroup, $line['cardNumber'], 'cardnumber', $user, $passwd) : $line['cardNumber']);
                  $expiration_date = ($line['expirationDate'] !== null ? $vtsh->detokenize($tokengroup, $line['expirationDate'], 'datetemplate_forcb', $user, $passwd) : $line['expirationDate']);
                  $cvv = ($line['cvv'] !== null ? $vtsh->detokenize($tokengroup, $line['cvv'], 'cvv', $user, $passwd) : $line['cvv']);
                
                  print "<tr>
                  <td class=\"idrow\">$id<div class=\"popup\"><img id=\"ID\" src=\"../img/$id.jpg\"></div></td>
                  <td>$firstname</td>
                  <td>$lastname</td>
                  <td>$birth_date</td>
                  <td>$phone_number</td>
                  <td>$nationality</td>
                  <td>$ssn</td>
                  <td>$address</td>
                  <td>$city</td>
                  <td>$postcode</td>
                  <td>$country</td>
                  <td>$card_number</td>
                  <td>$expiration_date</td>
                  <td>$cvv</td>
                  <td nowrap valign=middle><font size=1>
                  <a href=\"delete.php?id=$id&table=customer\">Delete</a></td></tr>";
                }
                print "</table></div>";
            ?>
        </div>
        <footer>
            <a href=javascript:window.open('https://support.vormetric.com/login');>Support </a><span>|</span>
            <a href=javascript:window.open('http://www.vormetric.com')>About </a><span>|</span>
            <!-- <a href="javascript:void(0);">Support</a><span>|</span>
                <a href="javascript:void(0);">About</a><span>|</span>-->
            Copyright &copy; 2016 Vormetric. Inc. All rights reserved.
        </footer>
    </body>
</html>

