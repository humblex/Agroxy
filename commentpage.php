<?php
session_start();
require("connections.php");
require("func.php");

$object = new threadDisplay();
$object->setDB($serverName,$serverDatabase,$serverUsername,$serverPassword);
$object->getDB();
$threadcomment = $object->threadAll();
$commentArray = $object->fetchComment();
$threadFarmer = $object->fetchingFarmer();

if(isset($_GET["v"])){
	$threader = $object->retrieveFromUrl($_GET["v"]);
}

	foreach($threadcomment as $value)
	{	if($threader == $value["thread_id"])
		{
	  		$threader_main = $value["farmer"];
	   	}
    }
    foreach ($threadFarmer as $key) {
    	if($key["farmer_id"] == $threader_main)
    	{
    		$thread_person = $key["username"];
    	}
    }



?>
<!DOCTYPE html>
<html>
<head>
<title>Agroxy Forum | Comment</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">	
<meta name="keywords" content="Bootstrap Responsive Templates, Iphone Compatible Templates, Smartphone Compatible Templates, Ipad Compatible Templates, Flat Responsive Templates"/>
<script src="js/jquery-1.11.0.min.js"></script>
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
									<li class="active"><a class="play-icon popup-with-zoom-anim" href="logout.php"><span> </span>Log out</a></li>
	
							</nav>
							<div class="clearfix"> </div>
						</div>
				</div>
					<!--End-header-->
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
		<!--starts-blog-->
		<div class="blog">
			<div class="container">
				<div class="blog-main">
					<div class="col-md-8 blog-main-left">
						<h3>FORUM</h3>
						<div class="blg">
							<?php

								foreach ($threadcomment as $val) 
								{
									if($threader == $val["thread_id"])
									{
										echo "<div class='col-md-12'><p><h3><b>".$val["thread_header"]."</b></h3></p> <p>by <b> ".$thread_person." </b>";
											    
											    echo " on <b>".$val["thread_time"]."</b></p>";
											    echo "<p>".$val["thread_content"]."</p>
											  </div><br/>";
									}
									
								}

							?>

						</div>
							
							 <div style="padding-top:10px">
							    <b><h4>PLACE YOUR COMMENT</h4></b>
							    <form action="comment.php" method="post">
							      <div class="form-group">
							        <textarea name="comment" placeholder="Comment Here!" rows="10" cols="60" required="required"></textarea>
							      </div>
							      <div class="form-group">
							        <input type="hidden" name="thrD" value="<?php echo $threader?>"/>
							      </div>
							      <div class="col-md-8">
							        <button type="submit" class="btn btn-primary pull-right" name="send">POST COMMENT</button>
							      </div>
							    </form><br><br/>
							 </div> 
							<div class="comments">
								<h4>ALL COMMENTS</h4>
								
								<?php

								
									$object->fetchingComment($threader);

									/*if(isset($_GET["v"])){
										$threader = $object->retrieveFromUrl($_GET["v"]);

									}
									*/

									?>
							</div>
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
</body>
</html>