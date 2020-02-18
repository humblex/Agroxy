<?php
	session_start();
  	require('connections.php');
  	require('func.php');

  	$object = new threadDisplay();
  	$object->setDB($serverName,$serverDatabase,$serverUsername,$serverPassword);
	$object->getDB();
	

	 if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']))
	 {
	 	if(isset($_POST['username']) && isset($_POST['pass']))
	 	{
	 		$username = strip_tags($_POST['username']);
	 		$pass = $_POST['pass'];

	 		$object->login($username,$pass);

	 	}
	 	/*else 
	 	{
            $error = "<div class='alert alert-danger' >Invalid username/password</div>";
        }*/
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Agroxy Forum | Login</title>
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
      height: 410px;
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
									<li class="active"><a class="play-icon popup-with-zoom-anim" href="signup.php"><span> </span>SIGN UP</a></li>
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
				</div>
			<!---pop-up-box---->
					  <script type="text/javascript" src="js/modernizr.custom.min.js"></script>    
					<link href="css/popup-box.css" rel="stylesheet" type="text/css" media="all"/>
					<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>

					
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
						 <input type="text" value="Search.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search..';}"/>
						 <input type="submit" value="">
					  </form>
					</div>
					<div class="clearfix"> </div>
		</div>
		</div>
		<div class="wrapper">

  <div class="transbox">
    <div class="col-md-12">
    
	<form action="login.php" method="post" class="sky-form boxed" validate="validate">
			  <h2><center>ACCOUNT LOG IN</center></h2><br><br>		
				<div class="input-group">
				  <span class="input-group-addon"><i class="fa fa-user"></i></span>
				  <input type="text" name="username" class="form-control" placeholder="Enter username" required>
				</div><br><br>
				
				<div class="input-group">
				 <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
				  <input type="password" name="pass" class="form-control" placeholder="Password">
				</div><br><br>

		<hr>
			  <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-flat btn-block btn-lg ">

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
					<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
     </div>
</body>
</html>