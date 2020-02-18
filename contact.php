<!DOCTYPE html>
<html>
<head>
<title>Agroxy Forum | Contact</title>
<meta name="viewport" content="width=device-width, initial-scale=1">	
<meta name="keywords" content="Bootstrap Responsive Templates, Iphone Compatible Templates, Smartphone Compatible Templates, Ipad Compatible Templates, Flat Responsive Templates"/>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery-1.11.0.min.js"></script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
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
							 <nav class="top-nav">
								<ul>
									<li class="active"><a class="play-icon popup-with-zoom-anim" href="sign.php"><span> </span>Log in</a></li>
									<li><a class="play-icon popup-with-zoom-anim" href="signup.php">Sign up</a></li>
								</ul>
							</nav>
							<div class="clearfix"> </div>
						</div>
				</div>
			<!---pop-up-box---->
					  <script type="text/javascript" src="js/modernizr.custom.min.js"></script>    
					<link href="css/popup-box.css" rel="stylesheet" type="text/css" media="all"/>
					<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
								
		<!--End-header-->
		<div class="navgation">
					<div class="menu">
                         <a class="toggleMenu" href="#"><img src="images/menu-icon.png" alt="" /> </a>
							<ul class="nav" id="nav">
							<li><a href="index.php">Home</a></li>
							<li><a href="market.php">Market</a></li>
							<li><a href="forum2.php">Forum</a></li>
							<li><a href="articles.php">Articles</a></li>
							<li><a href="contact.php" class="active">Contact</a></li>
							</ul>
                            <!----start-top-nav-script---->
		                     <script type="text/javascript" src="js/responsive-nav.js"></script>
							<script type="text/javascript">
							jQuery(document).ready(function($) {
								$(".scroll").click(function(event){		
									event.preventDefault();
									$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
								});
							});
							</script>
							<!----//End-top-nav-script---->
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
		<!--contact-starts-->
		<div class="contact">
			<div class="container">
				<div class="contact-top">
					<h3>CONTACT US</h3>
					<P>We are here to serve you better. So, feel free to reach us through the following details and be rest assured we are working always to make agriculture enjoyable for you!</P>
				</div>
				<div class="contact-bottom">
					<div class="contact-bottom-top">
						<div class="col-md-8 contact-top-left">
							<img src="images/strt.jpg" height="400px" width="700px">
						</div>
						<div class="col-md-4 contact-top-left">
							<div class="contact-top-one">
								<h4>ADDRESS:</h4>
									<h6>Agroxy Forum
									<span>Enugu State,</span>
										Nigeria.
									</h6>
							</div>
							<div class="contact-top-one">
								<h4>PHONES:</h4>
									<p>Telephone: +23481 7811 2035<br>
												  +23480 6774 7297
									</p>
							</div>
							<div class="contact-top-one">
								<h4>E-MAIL:</h4>
								<p><a href="mailto:agroxyforum@gmail.com">agroxyforum@gmail.com</a></p>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="contact-bottom-bottom">
						<h3>MISCELLANEOUS INFORMATION:</h3>
						<p>This forum was borne out of the need to see that proper information about agricultural produce are shared among farmer and all lovers of agriculture. You can drop your suggestions with us below:</p>
						<form action="admin.php" method="post">
							<div class="contact-text">
								<input type="text" name="fname" placeholder="Enter your first name" required/>
								<input type="text" name="second" placeholder="Enter your second name" required/>
								<input type="email" name="emailID" style="padding:8px; width:350px" placeholder="Enter your email address" required/>
							</div>
							<div class="contact-textarea">
								<textarea name="report" placeholder="Please, enter your message here!" required></textarea>
							</div>
							<div class="contact-but">
								<input type="submit" name="reportSubmit" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--contact-end-->
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