<?php
	require('connections.php');
	require('func.php');


	$obj = new threadDisplay();
	$obj->setDB($serverName,$serverDatabase,$serverUsername,$serverPassword);
	$obj->getDB();

	$farmer_sale = $obj->fetchingFarmer();
	$f_items = $obj->fetchItems();
	$category = $obj->fetchCategory();
	$thread = $obj->threadAll();
	$stock = $obj->fetchingStock();


//ordering by a non-user
	if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['buyer_submit']))
	{
		if(isset($_POST['buyerQty']) && isset($_POST['buyer']))
		{
			$purch_Item = $_POST['orderedItem'];
			$purch_Price = $_POST['odPrice'];
			$purch_Supply = $_POST['orderSupplied'];
			$purch_Quantity = strip_tags($_POST['buyerQty']);
			$purch_From = $_POST['orderFrom'];
			$purch_Date = date('d M Y H:i:s');
			$purch_By = strip_tags($_POST['buyer']);

			$obj->stockPurchase($purch_Item,$purch_Price,$purch_Supply,$purch_Quantity,$purch_From,$purch_By,$purch_Date);
		 		header("Refresh: 1; url=buyer.php");
		}
		else
		{
		}

	}


if(isset($_GET["o"]))
	{
		$checkmate1 = 0;
		$orderID = $obj->retrieveFromUrl($_GET["o"]);
		foreach($stock as $dtcheck)
		{
			if($dtcheck["stk_id"] == $orderID)
			{
				$checkmate1 = 1;
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
										<li class="active"><a  href="signup.php">Sign UP</a></li>
									</ul>
								</nav>
							
							</div>
					</div>			



			<div class="navgation">
						<div class="menu">
	                         <a class="toggleMenu" href="#"><img src="images/menu-icon.png" alt="" /> </a>
								<ul class="nav" id="nav">
								<li><a href="index.php">Home</a></li>
								<li><a href="market.php" class="active">Market</a></li>
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
		<!--End-header-->
				
			<!--starts-blog-->
			<div class="blog">
				<div class="container">
					<div class="blog-main">
						<div class="col-md-8 blog-main-left">
							<form action="buyerThread.php" method="post">

								<br/>
								<centre><h2>PLACE ORDER HERE</h2></centre><br/>

								<?php
								foreach($stock as $data)
								{
									if($data["stk_id"] == $orderID )
									{	$order_item = $data["item"];
										$order_price = $data["unit_price"];
										$order_from = $data["stk_owner"];
										$order_supply = $data["stk_qty"];
										foreach ($farmer_sale as $owner) 
										{
											if($owner["username"] == $data["stk_owner"])
											{
												$user = $owner["username"];
												$phone = $owner["phone_number"];
												$email = $owner["email"];
												$location = $owner["farm_location"];
												$state = $owner["state"];

												echo "<label><b><h3> $user's Contact:</h3></b></label><br/>
													<label><b>Phone Number: </b></label>$phone<br/>
													<label><b>Email Address: </b></label>$email<br/>
													<label><b>Farm Location: </b></label>$location<br/>
													<label><b>State: </b></label>$state<br/><hr>";
											}
										}
										echo "<label><b>Item: </b></label><br/>
										<input type='text' class= 'form-control' value='$order_item' disabled/><br/>
										<label>Price per Kg:</b></label><br/>
										<input type='text' class= 'form-control' value='$order_price' disabled/><br/>
										<label><b>Quantity Supplied:</b></label><br/>
										<input type='text' class= 'form-control' value='$order_supply' disabled/><br/>
										";
									}
								}
								?>
								<input type="hidden" name="orderedItem" class= "form-control" value="<?php echo $order_item;?>" />
								<input type="hidden" name="odPrice" class= "form-control" value="<?php echo $order_price;?> "/>
								<input type="hidden" name="orderSupplied" class= "form-control" value="<?php echo $order_supply;?>"/>
								<input type="hidden" name="orderFrom" class= "form-control" value="<?php echo $order_from;?>"/>

								<label><b>Quantity needed in Kg </b></label><br/>
								<input type="text" name="buyerQty" class= "form-control" placeholder="Enter how much quantity you need" /><br/>

								<label><b>Buyer's Name</b></label><br/>
								<input type="text" name="buyer" class= "form-control" placeholder="Please, enter a name you can always use later" /><br/>
								
								<input type="submit" value="ORDER" class="btn btn-warning" name="buyer_submit"/>
								
							</form>

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
	<?php }

  }

  if($checkmate1 == 0)
		{
			//echo "<div class='alert alert-warning'> Oops! You can't update somebody else's stock.</div>";
				header('location:buyer.php');
		}	
} 
?>



