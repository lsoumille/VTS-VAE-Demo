<html>
    <head>
        <title>Vormetric Toolbox</title>
        <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>-->
    </head>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/vormetric.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/base.css" />
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css" />
    <link href="/css/skin.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="/js/asynchronousCalls.js"></script>
    <BODY  bgcolor="#FFFFFF">
        <header class="container-fluid">
            <div class="col-md-6">
                <a href="/intro.php" class="site-logo"><img src="vormetric-logo.png"></a>
                <h3><span class="verticalPipe"></span></i>Vormetric Toolbox</h3>
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
                    <li class="active"> <a href="/demo.php"><i class="fa fa-wrench fa-1x" aria-hidden="true"></i> <span>Toolbox</span></a> </li>
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
                <?php
                    include "utils/DBHelper.php";
                    print "
                    </table>
                    <hr>
                    <table width=100%>
                    <tr><td bgcolor=#dddddd colspan=\"2\"><b>Tokenization :</b></td></tr>
                    <tr>
                	<td>
                	<FORM ACTION=\"vts/tokenize.php\" METHOD=\"POST\" id=\"formTok\">
                
                	<BR>Input to tokenize:  <INPUT  id=\"tokInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
                	<BR>
                     Format:  
                	<input type=\"radio\" name=\"template\" value=\"VTSDemoTok\" checked> Text (FPE)
                	<input type=\"radio\" name=\"template\" value=\"VTSDemoTokDigits\"> Number (FPE)
                	<BR><BR>
                	<input type=\"hidden\" name=\"user\" value=\"$user\">
                	<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
                	<input type=\"hidden\" name=\"action\" value=\"tokenize\">
                
                	<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">
                
                	</FORM>
                	</td>
                	<td>
                	<FORM ACTION=\"vts/detokenize.php\" METHOD=\"POST\" id=\"formDetok\">
                
                	<BR>Input to detokenize:  <INPUT  id=\"detokInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
                	<BR>
                     Format:  
                	<input type=\"radio\" name=\"template\" value=\"VTSDemoTok\" checked> Text (FPE)
                	<input type=\"radio\" name=\"template\" value=\"VTSDemoTokDigits\"> Number (FPE)
                	<BR><BR>
                	<input type=\"hidden\" name=\"user\" value=\"$user\">
                	<input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
                	<input type=\"hidden\" name=\"action\" value=\"tokenize\">
                
                	<INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">
                
                	</FORM>
                	</td> 
                	</tr>
                    <TR><td bgcolor=#dddddd colspan=\"2\"><b>Encryption (AES 256):</b></td><TR>
                    <TD>
                    <FORM ACTION=\"vae/encrypt.php\" METHOD=\"POST\" id=\"formEncrypt\">
                    
                    <BR>Input to Encrypt:  <INPUT id=\"encryptInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
                    <BR>
                    <input type=\"hidden\" name=\"user\" value=\"$user\">
                    <input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
                    <input type=\"hidden\" name=\"action\" value=\"tokenize\">
                    <input type=\"hidden\" name=\"key\" value=\"java_test_key_sym\">
                    
                    <INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">
                    
                    </FORM>
                    </td>
                    <td>
                    <FORM ACTION=\"vae/decrypt.php\" METHOD=\"POST\" id=\"formDecrypt\">
                    
                    <BR>Input to decrypt:  <INPUT  id=\"decryptInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
                    <BR>
                    <input type=\"hidden\" name=\"user\" value=\"$user\">
                    <input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
                    <input type=\"hidden\" name=\"action\" value=\"tokenize\">
                    <input type=\"hidden\" name=\"key\" value=\"java_test_key_sym\">
                    
                    <INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">
                    
                    </FORM>
                    </td> 
                    <TR><td bgcolor=#dddddd colspan=\"2\"><b>Signing (RSA 2048):</b></td><TR>
                    <TD>
                    <FORM ACTION=\"vae/signing.php\" METHOD=\"POST\" id=\"formSign\">
                    
                    <BR>Input to Sign:  <INPUT  id=\"signInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
                    <BR>
                    <input type=\"hidden\" name=\"user\" value=\"$user\">
                    <input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
                    <input type=\"hidden\" name=\"action\" value=\"tokenize\">
                    <input type=\"hidden\" name=\"key\" value=\"vae-keypair\">
                    <INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">
                    
                    </FORM>
                    </td>
                    <td>
                    <FORM ACTION=\"vae/verify.php\" METHOD=\"POST\" id=\"formVerify\">
                    
                    <BR>Input to Verify:  <INPUT  id=\"signToVerifyInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
                    <BR>
                    Signature: <INPUT  id=\"verifyInput\" NAME=\"sign\"  size=\"30\" maxlength=\"500\">
                    <p id=\"resultSig\"></p>
                    <input type=\"hidden\" name=\"user\" value=\"$user\">
                    <input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
                    <input type=\"hidden\" name=\"action\" value=\"tokenize\">
                    <input type=\"hidden\" name=\"key\" value=\"vae-keypair\">
                    
                    <INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">
                    
                    </FORM>
                    </td> 
                    <TR><td bgcolor=#dddddd colspan=\"2\"><b>Digest (SHA 256):</b></td><TR>
                    <TD>
                    <FORM ACTION=\"vae/digest.php\" METHOD=\"POST\" id=\"formDigest\">
                    
                    <BR>Input to Digest:  <INPUT id=\"digestInput\" NAME=\"data\"  size=\"30\" maxlength=\"25\">
                    <p id=\"resultDigest\"></p>
                    <input type=\"hidden\" name=\"user\" value=\"$user\">
                    <input type=\"hidden\" name=\"passwd\" value=\"$passwd\">
                    <input type=\"hidden\" name=\"action\" value=\"tokenize\">
                    <input type=\"hidden\" name=\"algo\" value=\"SHA256\">
                    <INPUT TYPE=\"SUBMIT\" NAME=\"SUBMIT\" VALUE=\"SUBMIT\">
                    </FORM>
                    </td> 
                    </table>
                    <script src=\"js/asynchronousCalls.js\"></script>
                    <iframe id=\"transfoDB\" src=\"/transformationDB.php\" width=\"100%\" height=\"40%\" frameborder=\"0\" scrolling=\"no\"></iframe> 
                    ";
                    ?>
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

