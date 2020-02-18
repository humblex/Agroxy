<?php
	session_start();
	$userOn = $_SESSION["farmer"];
require("connections.php");
require("func.php");

$obj = new threadDisplay();
$obj->setDB($serverName,$serverDatabase,$serverUsername,$serverPassword);
$obj->getDB();
$category = $obj->fetchCategory();
?>

<!DOCTYPE html>
<html>
<head>
<title>Agroxy Forum | Forum</title>
<meta name="keywords" content="Bootstrap Responsive Templates, Iphone Compatible Templates, Smartphone Compatible Templates, Ipad Compatible Templates, Flat Responsive Templates"/>
<meta name="viewport" content="width=device-width, initial-scale=1">	
<script src="js/jquery-1.11.0.min.js"></script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
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
									<li class="active"><a  href="logout.php">Log out</a></li>
								</ul>
							</nav>
						
						</div>
				</div>			



		<div class="navgation">
					<div class="menu">
                         <a class="toggleMenu" href="#"><img src="images/menu-icon.png" alt="" /> </a>
							<ul class="nav" id="nav">
							<li><a href="index.php">Home</a></li>
							<li><a href="market.php">Market</a></li>
							<li><a href="forum2.php" class="active">Forum</a></li>
							<li><a href="articles.php">Articles</a></li>
							<li><a href="contact.php">Contact</a></li>
							</ul>
					</div>
					<div class="search2">
					  <form>
						 <input type="text"  name= "search" value="Search.."/>
						 <input type="submit" value="">
					  </form>
					</div>
					<div class="clearfix"> </div>
		<?php if($userOn){ ?>
					<div class= "col-md-offset-9">
						  
							<a class="play-icon popup-with-zoom-anim" href="#small-dialog1"><input type="submit" class="btn btn-warning" value="Post thread" width="30px"/></a>
						 
						</div>
		</div>
		
		</div>

		<!---pop-up-box---->
					  <script type="text/javascript" src="js/modernizr.custom.min.js"></script>    
					<link href="css/popup-box.css" rel="stylesheet" type="text/css" media="all"/>
					<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
					<!---//pop-up-box---->
				

					<div id="small-dialog1" class="mfp-hide">
						
						<form action="thread.php" method="post">

							<br/>
							<centre><h2>CREATE TOPIC</h2></centre><br/>

							<input type="text" name="post_title" class= "form-control" placeholder="Enter the title for your post" /><br/>

							<select name="post_category" class= "form-control">
								<div >
									<?php
										foreach ($category as $data) 
										{ ?>
											<option>
											<?php echo $data['category_name']."<br>"; ?>
											</option>
									<?php } ?>
								</div>

								</select> <br/>
							
							<textarea name="post_content" rows="10" placeholder="Enter your post here!" class= "form-control"></textarea><br/>
							<input type="submit" value="POST" name="post_submit"/>
							
						</form>
					</div>		
				 <script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							excluded: ':disabled',
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});
																						
						});
				</script>
		<!--End-header-->

		<!--starts-forum-->
		<div class="blog">
			<div class="container">
				<div class="blog-main">
					<div class="col-md-8 blog-main-left">
						<h3>FORUM</h3>
						<div class="blg">
						<?php
							$obj->fetchingthread();
						?>
							<div class="clearfix"> </div>
						</div>
					</div>

					<div class="col-md-4 blog-main-left">
						<h3>CATEGORIES</h3>
						<div class="ctgry">
						<ul>
							<li><a href="crop.php">Crops</a></li>
							<li><a href="livestock.php">Livestock</a></li>
							<li><a href="tools.php">Machinery And Equipment</a></li>
							<li><a href="strategy.php">Commodity Marketing</a></li>
							<li><a href="mgt.php">Farm Management</a></li>
							<li><a href="rural.php">Rural Issues</a></li>
						</ul>
						</div>
						<div class="archives">
							<h3>MOST POPULAR THREAD</h3>
						<ul>
							<li><a href="#">November,2013</a></li>
							<li><a href="#">May,2013</a></li>
							<li><a href="#">April,2013</a></li>
							<li><a href="#">June,2013</a></li>
							<li><a href="#">August,2013</a></li>
							<li><a href="#">January,2013</a></li>
						</ul>
						</div>
						<div class="search">
							<h3>SEARCH</h3>
							<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" />
							<input type="submit" value="Search" />
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>

			</div>
		</div>
		<!--end-blog-->
		 <div class="footer">
                         <div class="container">
                                    <div class="footer-text">
										<p>DESIGN BY <a href="contact.php">Agwu Ajah Chukwu</a></p>
										<p>CopyRight <a href="contact.php">Agroxy Forum</a> @2017</p>
									</div>
                         </div>
					<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
     </div>
  <?php
  	}
  	else
  	{
  		header('location:login.php');
  	}
  ?>
</body>
</html>