<HTML>
<HEAD>
  <TITLE>Application Demo</TITLE>
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script src="/js/testUser.js"></script>


</HEAD>
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
<link href="/js/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet">

<header>
  <div>
    <div class="col-md-6"> <a href="#" class="site-logo"><img src="../vormetric-logo.png"></a>
      <h3><span class="verticalPipe"></span>Add new customer</h3>
    </div>
    <div class="col-md-offset-4 col-md-2">
      <h4 class="list-inline pull-right rightsideIcons">
      <?php
        include '../config.php';

        print "Welcome, $user. <a href=\"index.html\">Logout</a>"; 
      ?>
    </h4>
    </div>
  </div>
</header>

<div id="app_container" class="container-fluid">
  <div class="col-md-1 left-navigation">
      <ul class="list-unstyled">
        <li> <a href="/demo.php"><i class="fa fa-wrench fa-1x" aria-hidden="true"></i> <span>Toolbox</span></a> </li>
    <li class="active"> <a href="/appli/databaseview.php" class=""><i class="fa fa-user-circle-o fa-1x" aria-hidden="true""></i> <span>Customer Database</span> </a>
      <ul id="subMenu">
                 <li><a href="/appli/databaseview.php">View Database</a></li>
                 <li><a href="/appli/customerform.php">Add Customer</a></li>
             </ul>
    </li>
      </ul>
    </div>
    
    <div class="col-md-offset-1 col-md-11 perfectWidth">
      <form id="userForm" class="form-horizontal" enctype="multipart/form-data" action="adduser.php" method="post">
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">First Name</label>  
  <div class="col-md-5">
  <input id="name" name="name" placeholder="First Name" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="surname">Last Name</label>  
  <div class="col-md-5">
  <input id="surname" name="surname" placeholder="Last Name" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<div class="form-group">
    <label class="col-md-4 control-label" for="birthdate">Date Of Birth</label>
    <div class="col-md-5">
      <input type="text" id="datepicker" name="datepicker" class="form-control" placeholder="Choose">
    </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="phonenumber">Phone number</label>
    <div class="col-md-5">
      <input id="phonenumber" name="phonenumber" placeholder="Phone Number" class="form-control input-md" type="text">
    </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="phonenumber">Nationality</label>
    <div class="col-md-5">
      <input id="nationality" name="nationality" placeholder="Nationality" class="form-control input-md" type="text">
    </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="phonenumber">Social Security Number</label>
    <div class="col-md-5">
      <input id="ssn" name="ssn" placeholder="SSN" class="form-control input-md" type="text">
    </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Address</label>
    <div class="col-md-5">
        <input id="address" name="address" type="text" placeholder="Address" class="form-control">
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="textinput">Postcode</label>
    <div class="col-md-5">
        <input id="postcode" name="postcode" type="text" placeholder="Post Code" class="form-control">
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="textinput">City</label>
    <div class="col-md-5">
        <input id="city" name="city" type="text" placeholder="City" class="form-control">
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Country</label>
  <div class="col-md-5">
    <input id="country" name="country" type="text" placeholder="Country" class="form-control">
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="picture">ID Photo</label>
  <div class="col-md-4">
    <input id="picture" name="picture" class="input-file" type="file">
  </div>
</div>

<div class="form-group">
        <label class="col-md-4 control-label" for="card-number">Card Number</label>
        <div class="col-md-5">
          <input type="text" class="form-control" name="card-number" id="card-number" placeholder="Debit/Credit Card Number">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="expiry-month">Expiration Date</label>
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-6">
              <select class="form-control col-md-4" name="expiry-month" id="expiry-month">
                <option>Month</option>
                <option value="01">Jan (01)</option>
                <option value="02">Feb (02)</option>
                <option value="03">Mar (03)</option>
                <option value="04">Apr (04)</option>
                <option value="05">May (05)</option>
                <option value="06">June (06)</option>
                <option value="07">July (07)</option>
                <option value="08">Aug (08)</option>
                <option value="09">Sep (09)</option>
                <option value="10">Oct (10)</option>
                <option value="11">Nov (11)</option>
                <option value="12">Dec (12)</option>
              </select>
            </div>
            <div class="col-md-6">
              <select class="form-control" name="expiry-year">
                <option>Year</option>
                <option value="17">2017</option>
                <option value="18">2018</option>
                <option value="19">2019</option>
                <option value="20">2020</option>
                <option value="21">2021</option>
                <option value="22">2022</option>
                <option value="23">2023</option>
                <option value="24">2024</option>
                <option value="25">2025</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-4 control-label" for="cvv">Card CVV</label>
        <div class="col-md-5">
          <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code">
        </div>
      </div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="validation"></label>
  <div class="col-md-8">
    <input id="validation" name="validation" value="Save" class="btn btn-success" type="submit"></input>
  </div>
</div>

</fieldset>
</form>
<script type="text/javascript">
  //DATE PICKER
  $(function() {
        $( "#datepicker" ).datepicker({
            dateFormat : 'mm/dd/yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });
</script>
    </div>
  </div>
<footer>
   <a href=javascript:window.open('https://support.vormetric.com/login');>Support </a><span>|</span>
   <a href=javascript:window.open('http://www.vormetric.com')>About </a><span>|</span>
   <!-- <a href="javascript:void(0);">Support</a><span>|</span>
<a href="javascript:void(0);">About</a><span>|</span>-->
   Copyright &copy; 2016 Vormetric. Inc. All rights reserved.

</footer>
