<?php
	error_reporting(0);
	session_start();
	$userOn = $_SESSION["farmer"];
	require('connections.php');
	require('func.php');

	$obj = new threadDisplay();
	$obj->setDB($serverName,$serverDatabase,$serverUsername,$serverPassword);
	$obj->getDB();
	$f_items = $obj->fetchItems();
	$stock = $obj->fetchingStock();

?>


<!DOCTYPE html>
<html>
<head>
<title>Agroxy Forum | Market</title>
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
				<?php if($userOn){ ?>
					<div class= "col-md-offset-9">
						  
							<a class="play-icon popup-with-zoom-anim" href="#small-dialog1"><input type="submit" class="btn btn-warning" value="Add Stock" width="30px"/></a>
						 
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
							<centre><h2>STOCK FORM</h2></centre><br/>
							<label style="margin-left:5px"><b>Select Item: </b></label>
							<select name="stock_items" class="form-control">
								<div >
									<?php
										foreach ($f_items as $data) 
										{ ?>
											<option>
											<?php echo $data["farmer_item"]."<br>"; ?>
											</option>
									<?php } ?>
								</div>

								</select> <br/>
							<label><b>Price per Kg </b></label><br/>
							<input type="text" name="unitPrice" class="form-control" placeholder="Enter price DIGIT here" /><br/>

							<label><b>Total Quantity in Kg </b></label><br/>
							<input type="text" name="quantity" class="form-control" placeholder="How much quantity do you have in stock" /><br/>
							<input type="submit" value="POST" name="stock_submit"/>
							
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
			
		<!--starts-blog-->
		<div class="blog">
			<div class="container">
				<div class="blog-main">
					<div class="col-md-8 blog-main-left">
						<h3>MARKET ANALYSIS</h3><br/>


						<div class="blg">

								<table style="width:100%">
								    		<tr style='padding:15px'>
								    			<th style='padding:15px'>ITEM</th>
								    			<th style='padding:15px'>UNIT PRICE</th>
								    			<th style='padding:15px'>QUANTITY SUPPLIED</th>
								    			<th style='padding:15px'>SELLER</th>
								    		</tr>
								   
			 							<?php

									    foreach($stock as $rows){
									    
									    $id = $rows["stk_id"];
									    
									    echo   "<tr style='padding:15px'>
									    			<td style='padding:15px'>".$rows["item"]."</td>
									    			<td style='padding:15px'>".$rows["unit_price"]."</td>
									    			<td style='padding:15px'>".$rows["stk_qty"]."</td>
									    			<td style='padding:15px'>".$rows["stk_owner"]."</td>
									    		</tr>";
						
											if($rows["stk_owner"] == $userOn)
											{
									    		echo "<tr style='padding:5px'>
									    			<td style='padding:5px'>
									    			<a href='thread.php?u=$id'><input type='submit' class='btn btn-warning ' value='Update' id='update'></a>
									    				
									    			</td>
							    				</tr>";
							    			}
							    			else
							    			{
							    				echo "<tr style='padding:5px'>
										    			<td style='padding:5px'>
															<a href='thread.php?o=$id'><input type='submit' class='btn btn-warning' value='Order' id='order'></a>
										    			</td>
			    									</tr>";
							    			}
			    				} ?>
			    			</table>
			    				
							<div class="clearfix"> </div>
						</div>
					</div>

					<div class="col-md-4 blog-main-left">
						<hr/>
								<br/>
									<centre><b><h2>CHECK EQUILIBRIUM PRICE</h2></b></centre><br/>
									<?php
										if(($_SERVER['REQUEST_METHOD']=='POST') && isset($_POST['equilib']))
										{	
											$itemSelected = $_POST['pitems'];
											$obj->equiPrice($itemSelected);	
									   } 
									?>
									<hr/>
									
									<form action="" method="post">
									<label ><b>Select Item: </b></label>
									<select name="pitems" class="form-control">
										<div >
											<?php
												foreach ($f_items as $data) 
												{ ?>
													<option>
													<?php echo $data["farmer_item"]."<br>"; ?>
													</option>
											<?php } ?>
										</div>

										</select> <br/>

									<input type="submit" class="btn btn-warning pull-right" value="CHECK" name="equilib"/>
								</form>
								<div class="clearfix"> </div>
							<hr/>
								<centre><b><h2>CHECK SLUTSKY IDENTITY</h2></b></centre><br/>
								<?php
								if(($_SERVER['REQUEST_METHOD'] == "POST") && isset($_POST['slutsky']))
								{
									$slSelect = $_POST['slutSelect'];

									$slutID = $obj->slutsky($slSelect,$userOn);

								}

								
								?>
								<hr/>
								<form action="" method="POST">
									<label ><b>Select Item: </b></label>
									<select name="slutSelect" class="form-control">
										<div >
											<?php
												foreach ($f_items as $data) 
												{ ?>
													<option>
													<?php echo $data["farmer_item"]."<br>"; ?>
													</option>
											<?php } ?>
										</div>

										</select> <br/>
									
									<input type="submit" class="btn btn-warning pull-right" value="CHECK" name="slutsky"/>
								</form>
								<div class="clearfix"> </div>
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
  		header('location:buyer.php');
  	}
  ?>
</body>
</html>