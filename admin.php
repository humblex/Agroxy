<?php
error_reporting(0);
	session_start();
	$adminSess = $_SESSION["admin"];	
	require('facts.php');

	$object = new threadDisplay();
  	$object->setDB($serverName,$serverDatabase,$serverUsername,$serverPassword);
	$object->getDB();
	$farm_items = $object->fetchItems();
	

	 if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['reportSubmit']))
	 {
	 	if(isset($_POST['fname']) && isset($_POST['second']) && isset($_POST['emailID']) && isset($_POST['report']))
	 	{
	 		$first = strip_tags($_POST['fname']);
	 		$secnd = strip_tags($_POST['second']);
	 		$eml = strip_tags($_POST['emailID']);
	 		$rept = strip_tags($_POST['report']);
	 		
	 		$object->userReport($first,$secnd,$eml,$rept);

	 		echo "Report Sent Successfully!";
            header('Refresh: 2; url=contact.php');
	 		

	 	}
	 	else 
	 	{	
            header('Refresh: 2; url=contact.php');
        }
	}

?>
<!DOCTYPE html>
<html>
<head>
<title>Agroxy Forum | Market</title>
<meta name="keywords" content="Bootstrap Responsive Templates, Iphone Compatible Templates, Smartphone Compatible Templates, Ipad Compatible Templates, Flat Responsive Templates"/>
<meta name="viewport" content="width=device-width, initial-scale=1">	
<!--<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
--><script src="js/jquery-1.11.0.min.js"></script>
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
							<li><a href="buyer.php" class="active">Market</a></li>
							<li><a href="forum2.php" >Forum</a></li>
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
		
			</div>
		
	</div>
			<!--starts-blog-->
		<div class="blog">
			<center><?php
						echo "<h2>Welcome "."<b>".$adminSess."</b> to your dashboard!</h2>";
					?></center>
			<br/>
			<div class="container">
				<div class="blog-main">
					
					<div class="col-md-8 blog-main-left">
						<h3>MARKET FACTS</h3><br/>

						<div class="blg">	

								<h4><b>CHECK PERIODIC EQUILIBRIUM</h4></b><br/>
								<?php
									if(!(isset($_POST['rangeSubmit'])))
									{
										echo "<div class='alert alert-warning'>
											<p><h4>To capture records for your choice of end date, choose the next day</p>
											<p><b>For instance</b>, if end date was to be 5th, choose 6th instead.</h4></p>
										</div>";
									}
								
									if(($_SERVER['REQUEST_METHOD'] == "POST") && isset($_POST['rangeSubmit'])) 
								    {
										if (isset($_POST['item']) && isset($_POST['startDate']) && isset($_POST['endDate'])) 
										{
											$select = $_POST['item'];
											$strt = strip_tags($_POST['startDate']);	
											$end = strip_tags($_POST['endDate']);

											$chngStrt = date('d M Y H:i:s',strtotime($strt));
											$chngEnd = date('d M Y H:i:s',strtotime($end));



											$object->equiRange($select,$chngStrt,$chngEnd);
											
										}
									}

								?>
							<form action="admin.php" method="post">
								<label><b>Select Item:</b></label><br/>
								<select name="item" class="form-control">
										<div >
											<?php
												foreach ($farm_items as $data) 
												{ ?>
													<option>
													<?php echo $data["farmer_item"]."<br>"; ?>
													</option>
											<?php } ?>
										</div>

										</select> <br/>
								<label><b>Select a starting Date:</b></label><br/>
									<input type="date" class="form-control" name="startDate" required/><br/>
								<label><b>Select a ending Date:</b></label><br/>
									<input type="date" class="form-control" name="endDate" step="1.4" required/><br/>
									<input type="submit" class="btn btn-warning pull-right" name="rangeSubmit" value="CHECK">		    				
							</form>

						</div>
					</div>

					<div class="col-md-4 blog-main-left">
						<h3>MARKET STATISTICS</h3><br/>

						<h4><b>CHECK HIGHEST PRODUCER OF AN ITEM</b></h4><br/>
						<?php
								if(($_SERVER['REQUEST_METHOD'] == "POST") && isset($_POST['prods'])) 
							    {
									if (isset($_POST['sitem'])) 
									{
										$selected = $_POST['sitem'];
										$object->highestProduce($selected);
										
									}
								}
								echo "<hr/>";
							?>
							<form action="admin.php" method="post">
								<label><b>Select Item:</b></label><br/>
								<select name="sitem" class="form-control">
										<div >
											<?php
												foreach ($farm_items as $data) 
												{ ?>
													<option>
													<?php echo $data["farmer_item"]."<br>"; ?>
													</option>
											<?php } ?>
										</div>

										</select> <br/>
					
									<input type="submit" class="btn btn-warning pull-right" name="prods" value="CHECK">		    				
							</form>
							
								<div class="clearfix"> </div>
							
							<div class="clearfix"> </div>
							<!-- <div> -->
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
					<a href="" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
     	</div>
</body>
</html>