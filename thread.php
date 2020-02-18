<?php
	session_start();
	require('connections.php');
	require('func.php');

	$post_farmer = $_SESSION["farm_id"];
	$post_user = $_SESSION["farmer"];

	$obj = new threadDisplay();
	$obj->setDB($serverName,$serverDatabase,$serverUsername,$serverPassword);
	$obj->getDB();

	$farmer_sale = $obj->fetchingFarmer();
	$f_items = $obj->fetchItems();
	$category = $obj->fetchCategory();
	$thread = $obj->threadAll();
	$stock = $obj->fetchingStock();

//posting a thread
	if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['post_submit']))
	{
		if(isset($_POST['post_title']) && isset($_POST['post_category']) && isset($_POST['post_content']))
		{

			$post_cat = $_POST['post_category'];
			$post_head = strip_tags($_POST['post_title']);
			$post_body = strip_tags($_POST['post_content']);
			$thread_date = date('d M Y H:i:s');

			foreach ($category as $column) 
			{
				if($column['category_name'] ==$post_cat)
				{
					$post_cat_ref = $column['category_id'];
				}
			}
				$obj->storeThread($post_cat_ref,$post_head,$post_body,$thread_date,$post_farmer);
		 		header("Refresh: 1; url=forum2.php");
		}
		else
		{
		}

	}

//storing the stock
	if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['stock_submit']))
	{
		if(isset($_POST['stock_items']) && isset($_POST['unitPrice']) && isset($_POST['quantity']))
		{

			$select_item = $_POST['stock_items'];
			$itemPrice = strip_tags($_POST['unitPrice']);
			$qty = strip_tags($_POST['quantity']);
			$sDate = date('D M Y H:i:s');

				$obj->storeStock($select_item,$itemPrice,$qty,$post_user,$sDate);
		 		header("Refresh: 1; url=market.php");
		}
		else
		{
		}

	}

//updating the stock
	if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['update_submit']))
	{
		if(isset($_POST['utPrice']) && isset($_POST['quant']))
		{
			$upd_ident = $_POST['upID'];
			$itmPrice = strip_tags($_POST['utPrice']);
			$qnty = strip_tags($_POST['quant']);
			$uDate = date('d M Y H:i:s');

				$obj->updateStock($upd_ident,$itmPrice,$qnty,$uDate);
		 		header("Refresh: 1; url=market.php");
		}
		else
		{
		}

	}

//ordering a stock
	if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['order_submit']))
	{
		if(isset($_POST['orderQty']))
		{
			$pur_Item = $_POST['orderedItem'];
			$pur_Price = $_POST['odPrice'];
			$pur_Supply = $_POST['orderSupplied'];
			$pur_Quantity = strip_tags($_POST['orderQty']);
			$pur_From = $_POST['orderFrom'];
			$pur_Date = date('d M Y H:i:s');
			$pur_By = $post_user;

			$obj->stockPurchase($pur_Item,$pur_Price,$pur_Supply,$pur_Quantity,$pur_From,$pur_By,$pur_Date);
		 		header("Refresh: 1; url=market.php");
		}
		else
		{
		}

	}


	if(isset($_GET["u"]))
	{	
		$checkmate = 0;
		$updateID = $obj->retrieveFromUrl($_GET["u"]);
		foreach($stock as $datcheck)
		{
			if(($datcheck["stk_id"] == $updateID) && ($post_user == $datcheck["stk_owner"]))
			{	
				$checkmate = 1;
								
		?>

				<!DOCTYPE html>
				<html>
				<head>
				<title>Agroxy Forum | Forum</title>
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
										<form action="thread.php" method="post">

											<br/>
											<centre><h2>STOCK UPDATE FORM</h2></centre><br/>
											<?php
											foreach($stock as $dat)
											{
												if($dat["stk_id"] == $updateID )
												{	$stk_item = $dat["item"];
													echo "<label><b>Items </b></label><br/>
													<input type='text' name='itPrice' placeholder='$stk_item' class= 'form-control' value='$stk_item' disabled/><br/>";
												}
											}
											?>
											<input type="hidden" name="upID" class= "form-control" value="<?php echo $updateID;?>" />

											<label><b>Price per Kg </b></label><br/>
											<input type="text" name="utPrice" class= "form-control" placeholder="Enter new price DIGITs" /><br/>

											<label><b>Total Quantity in Kg </b></label><br/>
											<input type="text" name="quant" class="form-control" placeholder="Enter the new quantity for the item" /><br/>
											<input type="submit" value="UPDATE" class="btn btn-warning" name="update_submit"/>
											
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
	<?php 
			}
		}
		if($checkmate == 0)
		{
			//echo "<div class='alert alert-warning'> Oops! You can't update somebody else's stock.</div>";
				header('location:market.php');
		}	
	}

//delete stock view
	if(isset($_GET["d"]))
	{	
		$checkmate = 0;
		$deleteID = $obj->retrieveFromUrl($_GET["d"]);
		foreach($stock as $datcheck)
		{
			if(($datcheck["stk_id"] == $deleteID) && ($post_user == $datcheck["stk_owner"]))
			{	
				$checkmate = 1;
								
		?>

				<!DOCTYPE html>
				<html>
				<head>
				<title>Agroxy Forum | Forum</title>
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
										<form action="thread.php" method="post">

											<br/>
											<centre><h2>DELETE STOCK</h2></centre><br/><br/>
											<input type="hidden" name="delID" class= "form-control" value="<?php echo $deleteID;?>" />

											<b>Are you sure you want to delete this stock?</b> <br/>
											<input type="submit" value="YES" class="btn btn-danger" name="delete_submit"/>
											<input type="submit" value="NO" class="btn btn-success" name="no_submit"/>
											
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
	<?php 
			}
		}
		if($checkmate == 0)
		{
				header('location:market.php');
		}	
	}
	

	if(isset($_GET["o"]) && ($post_user))
	{
		$checkmate1 = 0;
		$orderID = $obj->retrieveFromUrl($_GET["o"]);
		foreach($stock as $dtcheck)
		{
			if(($dtcheck["stk_id"] == $orderID) && ($post_user != $dtcheck["stk_owner"]))
			{
				$checkmate1 = 1;
?>

				<!DOCTYPE html>
				<html>
				<head>
				<title>Agroxy Forum | Forum</title>
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
										<form action="thread.php" method="post">

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
											<input type="text" name="orderQty" class= "form-control" placeholder="Enter how much quantity you need" /><br/>
											
											<input type="submit" value="ORDER" class="btn btn-warning" name="order_submit"/>
											
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
	<?php 	}
		}

  		if($checkmate1 == 0)
		{
			//echo "<div class='alert alert-warning'> Oops! You can't update somebody else's stock.</div>";
				header('location:market.php');
		}	
	} 

	if(isset($_GET["o"]) && !($post_user))
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
										<form action="thread.php" method="post">

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
	<?php 	}
		}

  		if($checkmate1 == 0)
		{
				header('location:buyer.php');
		}	
	} 
?>



