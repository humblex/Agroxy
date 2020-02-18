<?php
	require('connections.php');
	require('func.php');

	$signObj = new threadDisplay();
	$signObj->setDB($serverName,$serverDatabase,$serverUsername,$serverPassword);
	$signObj->getDB();
	


	  if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']))
	  { 
	  	//checks if field was filled
		if(isset($_POST['surname']) && isset($_POST['firstname']) && isset($_POST['othernames']) && isset($_POST['emailaddress']) && isset($_POST['phonenumber']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmpassword']) && isset($_POST['location']) && isset($_POST['state']))
		{
	  
			    //insert data
		   $srname = strip_tags($_POST['surname']);
		   $ftname = strip_tags($_POST['firstname']);
		   $ornames = strip_tags($_POST['othernames']);
		   $emaddress = strip_tags($_POST['emailaddress']);
		   $phnumber = strip_tags($_POST['phonenumber']);
		    $usname = strip_tags($_POST['username']);
		     $pword = $_POST['password'];
		      $confpassword = $_POST['confirmpassword'];
		       $lction = strip_tags($_POST['location']);
		        $stat = strip_tags($_POST['state']);

		        $signObj->signDetails($srname,$ftname,$ornames,$emaddress,$phnumber,$usname,$pword,$confpassword,$lction,$stat);
		 
	   }
}


?>
<!DOCTYPE html>
<html>
<head>
<title>Agroxy Forum | Sign Up</title>
<meta name="viewport" content="width=device-width, initial-scale=1">	
<!--<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script> -->
<meta name="keywords" content="Bootstrap Responsive Templates, Iphone Compatible Templates, Smartphone Compatible Templates, Ipad Compatible Templates, Flat Responsive Templates"/>
<script src="js/jquery-1.11.0.min.js"></script>
<link href="font-awesome/css/font-awesome.min.css" rel='stylesheet' type='text/css' />
<link href="font-awesome/css/font-awesome.css" rel='stylesheet' type='text/css' />
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!--<link href='http://fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic' rel='stylesheet' type='text/css'>-->

<style type="text/css">
  body{
    padding: 0;
    margin: 0;
    background: url('images/bnr.jpg') no-repeat center fixed;
    -webkit-background-size:cover;
    -moz-background-size:over;
    o-background-size:cover;
    background-size: cover;
    display: table;
    width: 100%;
    height:100%;
		filter: alpha(opacity=60); /* For IE8 and earlier */
		font-weight: bold;
  }

    .transbox{
      width: 700px;
      height: 780px;
      background-color: #FFF;
      opacity: 0.8;
      padding: 2%;
      margin: auto;
      margin-top: 5%
    }

    .btn-primary{
        padding:10px 20px;
        border-radius: 0;
        font-weight: 600;
        color:#FFF;
    }
    .footer{
    	background: url('images/bnr.jpg') no-repeat center fixed;
    }

  </style>
</head>
<body>
	<!--start-header-->
			<div id="home" class="header">
					<div class="top-header">
						<div class="container">
							<div class="logo">
								<a href="index.php"><h3>Agroxy</h3><h1>Forum</h1></a>  
							</div>
							<!--start-top-nav-->
							 <div class="top-nav">
								<ul>
									<li class="active"><a class="play-icon popup-with-zoom-anim" href="login.php"><span> </span>Log in</a></li>
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
				</div>
			<!---pop-up-box
					  <script type="text/javascript" src="js/modernizr.custom.min.js"></script>    
					<link href="css/popup-box.css" rel="stylesheet" type="text/css" media="all"/>
					<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>-->

					
		<div class="navgation">
					<div class="menu">
                         <a class="toggleMenu" href="#"><img src="images/menu-icon.png" alt="" /> </a>
							<ul class="nav" id="nav">
							<li><a href="index.php">Home</a></li>
							<li><a href="market.php">Market</a></li>
							<li><a href="forum2.php">Forum</a></li>
							<li><a href="articles.php">Articles</a></li>
							<li><a href="contact.php">Contact</a></li>
							</ul>
                            
					</div>
					<div class="search2">
					  <form>
						 <input type="text" placeholder="Search.." />
						 <input type="submit" value="">
					  </form>
					</div>
					<div class="clearfix"> </div>
		</div>
		</div>
		<div class="wrapper">

  <div class="transbox">
    <div class="col-md-12">
    
	<form action="signup.php" method="post" class="sky-form boxed" validate="validate">
			  <header><center>CREATE ACCOUNT</center></header>
			<h2><i class="fa fa-users"></i> FARMER <small class="note bold">IT'S FREE</small></h2><br/><br/>
				<div class="input-group">
				  <span class="input-group-addon" id="group-addon1"><i class="fa fa-user"></i></span>
				  <input type="text" name="surname" class="form-control" placeholder="Enter your Surname" required>
				</div><br>

				<div class="input-group">
				  <span class="input-group-addon"><i class="fa fa-user"></i></span>
				  <input type="text" name="firstname" class="form-control" placeholder="Enter your Firstname" required>
				</div><br>

				<div class="input-group">
				  <span class="input-group-addon"><i class="fa fa-user"></i></span>
				  <input type="text" name="othernames" class="form-control" placeholder="Enter your Othername" required>
				</div><br>
				
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
					<b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
				  <input type="text" name="emailaddress" class="form-control" placeholder="Email address" required>
				</div><br>

				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-phone"></i></span>
				  <input type="text" name="phonenumber" class="form-control" placeholder="Enter Phone Number" required>
				</div><br>

				<div class="input-group">
				  <span class="input-group-addon"><i class="fa fa-user"></i></span>
				  <input type="text" name="username" class="form-control" placeholder="Enter username" required>
				</div><br>

				<div class="input-group">
				  <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
				  <input type="password" name="password" class="form-control" placeholder="Password" required>
				  <b class="tooltip tooltip-bottom-right">password should be easily remembered</b>
				</div><br>

				<div class="input-group">
				  <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
				  <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
				</div><br>		

				<div class="input-group">
				  <span class="input-group-addon"><i class="fa fa-home"></i></span>
				  <input type="text" name="location" class="form-control" placeholder="Enter your address or farm location" required>
				</div><br>

				<div class="input-group">
				  <span class="input-group-addon"><i class="fa fa-home"></i></span>
				  <input type="text" name="state" class="form-control" placeholder="Enter the state where you reside" required>
				</div><br>

		<hr>
			  <button type="submit" name="submit" class="btn btn-primary btn-flat btn-block btn-lg "> Create Account &nbsp<span class="fa fa-check-circle"></span></button>

      </form>
    </div>
  </div>

  <!-- Control Sidebar -->
</div>

		 <div class="footer">
                         <div class="container">
                                    <div class="footer-text">
										<p>DESIGN BY <a href="contact.php">Agwu Ajah Chukwu</a></p>
										<p>CopyRight <a href="contact.php">Agroxy Forum</a> @2017</p>
									</div>
                         </div>
					<a href="" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
     </div>
</body>
</html>