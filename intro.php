<html>
    <head>
        <title>Vormetric Demo</title>
        <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>-->
    </head>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/vormetric.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/base.css" />
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css" />
    <link href="/css/skin.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
    
    <body  bgcolor="#FFFFFF">
        <header class="container-fluid">
            <div class="row">
            <div class="col-md-6">
                <a href="/intro.php" class="site-logo"><img src="vormetric-logo.png"><img src="thales-logo.png"></a>
                <h3><span class="verticalPipe"></span></i>Vormetric Demo</h3>
            </div>
            <div class="col-md-offset-4 col-md-2">
                <h4 class="list-inline pull-right rightsideIcons">
                    <?php
                        include 'config.php';
                        
                        print "Welcome, $user. <a href=\"index.html\">Logout</a>"; 
                        ?>
                </h4>
            </div>
        </header>
        <div id="app_container" class="container-fluid">
            <div class="col-md-1 left-navigation">
                <ul class="list-unstyled">
                    <li> <a href="/demo.php"><i class="fa fa-wrench fa-1x" aria-hidden="true"></i> <span>Toolbox</span></a> </li>
                    <li>
                        <a href="/appli/databaseview.php" class=""><i class="fa fa-user-circle-o fa-1x" aria-hidden="true""></i> <span>Customer Database</span> </a>
                        <ul id="subMenu">
                            <li><a href="/appli/databaseview.php">View Database</a></li>
                            <li><a href="/appli/customerform.php">Add Customer</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-md-offset-1 col-md-11 perfectWidth">
                <div class="container-fluid" id="content-main">
                    <!-- Content -->
                    <div id="content" class="colMS">
                        <h1>VAE, VTE, VTS & BDT Demonstration</h1>
                    </div>
                    <ul id="admin-box" class="row">
                        <li class="col-md-6">
                            <a href="/demo.php">
                                <div class="adminBlock">
                                    <img src="group_permission.png">
                                    <div class="admin-div c-user">
                                        <p class="counter">Toolbox where you can try Encryption, Tokenization, Signature and Digest.</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="col-md-6">
                            <a href="/appli/databaseview.php">
                                <div class="adminBlock">
                                    <img src="create_mask.png">
                                    <div class="admin-div c-mask">
                                        <p class="counter">Customer database is a real case application with the main Vormetric features included</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <footer>
            <a href=javascript:window.open('https://support.vormetric.com/login');>Support </a><span>|</span>
            <a href=javascript:window.open('http://www.vormetric.com')>About </a><span>|</span>
            <!-- <a href="javascript:void(0);">Support</a><span>|</span>
                <a href="javascript:void(0);">About</a><span>|</span>-->
            Copyright &copy; 2017 Vormetric. Inc. All rights reserved.
        </footer>
    </body>
</html>

