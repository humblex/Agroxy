<?php

class threadDisplay{

	private $threadID;
	private $farmerID;
	private $thID;

	private $serverName;
	private $serverUsername;
	private $serverDatabase;
	private $serverPassword;


	public function setDB($serverName,$serverDatabase,$serverUsername,$serverPassword)
	{
	$this->serverName = $serverName;
	$this->serverDatabase=$serverDatabase;
	$this->serverUsername=$serverUsername;
	$this->serverPassword=$serverPassword;
	}

	public function getDB(){

		return $this->serverName;
		return $this->serverDatabase;
		return $this->serverUsername;
		return $this->serverPassword;
	}

	public function fetchingthread(){

		$this->getDB();
		$connection = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);
	    $execute_thread = $connection->prepare("SELECT * FROM thread ORDER BY thread_id DESC");
	    $execute_thread->execute();
	    
	    $farmerArray = $this->fetchingFarmer();


	    while($rows = $execute_thread->fetch(PDO::FETCH_ASSOC)){
	    
	    $identity = $rows["thread_id"];
	    echo "<div class='col-md-12'><p><h4><b>".$rows["thread_header"]."</b></h4></p> <p>by ";
			    foreach($farmerArray as $value){
			    	if($rows["farmer"] == $value["farmer_id"])
			    	{
			    		echo $value["username"];
			    	}
			    }
			    echo " on ".$rows["thread_time"]."</p>";
			    echo "<p>".$rows["thread_content"]."</p>
			  </div>";
			    echo "   <div class='row' >
							<div class='col-md-8'>
			    				<a href='commentpage.php?v=$identity'><input type='submit' style='margin-left:15px' class='btn btn-warning pull-right' value='COMMENT' id='comment'></a>
			    			</div>";
	    		echo"</div>";
	    echo "<hr>";

	    }

	}

	public function retrieveFromUrl($v){
	 $this->thID =$v;	
	 return $this->thID;
	}

	public function fetchingFarmer()
	{
		$this->getDB();
		$conn = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);
	    
		$execute_farmer =$conn->prepare("SELECT * FROM farmers");
		$execute_farmer->execute();

	    return $execute_farmer->fetchAll();
	}

	public function fetchComment(){

		$this->getDB();
		$connect = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

		$execute_comment =$connect->prepare("SELECT * FROM comment");
		$execute_comment->execute();

		return $execute_comment->fetchAll();
	}

	public function fetchReply(){

		$this->getDB();
		$cont = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

		$exe_reply =$cont->prepare("SELECT * FROM reply ORDER BY reply_id DESC");
		$exe_reply->execute();

		return $exe_reply->fetchAll();
	}

	public function fetchCategory(){

		$this->getDB();
		$conct = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

		$execute_category =$conct->prepare("SELECT * FROM category");
		$execute_category->execute();

		return $execute_category->fetchAll();
	}

	public function threadAll(){
		$this->getDB();
		$connector = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);
	    
		$threader =$connector->prepare("SELECT * FROM thread");
		$threader->execute();

	    return $threader->fetchAll();
	}

	public function signDetails($sname,$fname,$oname,$email,$phone,$user,$pass,$cpass,$locate,$state)
	{
		$this->getDB();
		$cons = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);
		if($pass == $cpass)
		{
			
				$signFarmer = $cons->prepare("INSERT INTO farmers(surname,firstname,othernames,email,phone_number,username,password,farm_location,state)
				VALUES('$sname','$fname','$oname','$email','$phone','$user','$pass','$locate','$state')");

				$signFarmer->execute();
				header('location:login.php');
			
		}
	}

	public function login ($user,$pass) 
	{
		$loginFarmer = $this->fetchingFarmer();

        foreach ($loginFarmer as $farmUser) {
        	if(($farmUser["username"] == $user) && ($farmUser["password"] == $pass))
        	{
        			$farmer_session = $farmUser['username'];
	 				$farmer_id = $farmUser['farmer_id'];
	 				$_SESSION["farmer"] = $farmer_session;
	 				$_SESSION["farm_id"] = $farmer_id;
        		
        			header('location:forum2.php');
        	}
        }
         
    }
    public function adminLogin ($user,$pass) 
	{
		$this->getDB();
		$connect = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

		$execute_admin =$connect->prepare("SELECT * FROM admin");
		$execute_admin->execute();

		$loginAdmin = $execute_admin->fetchAll();

        foreach ($loginAdmin as $admin) {
        	if(($admin["username"] == $user) && ($admin["password"] == $pass))
        	{
        			$admin_session = $admin['username'];
	 				$admin_id = $admin['adminId'];
	 				$_SESSION["admin"] = $admin_session;
	 				$_SESSION["admId"] = $admin_id;
        		
        			header('location:admin.php');
        	}
        }
         
    }

    public function storeComment($user,$comtime,$content,$topic)
    {
    	$this->getDB();
    	$comcon = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

    	$commentStore = $comcon->prepare("INSERT INTO comment(username,comment_time,comment,thread)
    		VALUES('$user','$comtime','$content','$topic')");
    	$commentStore->execute();
    }

     public function storeThread($cat,$thread_h,$thread_c,$thread_t,$thread_user)
    {
    	$this->getDB();
    	$thrCon = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

    	$threadStore = $thrCon->prepare("INSERT INTO thread(category,thread_header,thread_content,thread_time,farmer) VALUES ('$cat','$thread_h','$thread_c','$thread_t','$thread_user')");
    	$threadStore->execute();
    }

    public function fetchingComment($topic_id){

		$this->getDB();
		#$this->getThread();
		$connects = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);
	    $execute_comment = $connects->prepare("SELECT * FROM comment WHERE thread ='$topic_id' ORDER BY comment_id DESC");
	    $execute_comment->execute();
	    
	    
	    while($datac = $execute_comment->fetch(PDO::FETCH_ASSOC))
	    {
	    
	    		$ident = $datac["comment_id"];
	    		
			    echo "<div class='col-md-12'><p><b><h5>".$datac["username"]." </h5></b>commented on ".$datac["comment_time"]."</p>";
			    echo "<p>".$datac["comment"]."</p>
			  </div>";
			    //echo "<div><span id='$identity'></span>";
			    echo "   <div class='row' >
							<div class='col-md-8'>
			    				<a href='replypage.php?c=$ident'><input type='submit' style='margin-left:15px' class='btn btn-warning pull-right' value='REPLY' id='reply'></a>
			    			</div>";
	    		echo"</div>";
	    echo "<hr>";

	    }

	 }

	public function storeReply($com_id,$reptime,$repContent,$repUser)
    {
    	$this->getDB();
    	$repcon = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

    	$replyStore = $repcon->prepare("INSERT INTO reply(comment,reply_date,reply_content,username)
    		VALUES('$com_id','$reptime','$repContent','$repUser')");
    	$replyStore->execute();
    }


	    public function fetchingReply($comm_id){

		$this->getDB();
		#$this->getThread();
		$connect = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);
	    $execute_reply = $connect->prepare("SELECT * FROM comment WHERE comment_id ='$comm_id' ");
	    $execute_reply->execute();
	    
	    
	    while($rep = $execute_reply->fetch(PDO::FETCH_ASSOC)){
	    
			    echo "<div class='col-md-12'><p><b><h5>".$rep["username"]." </h5></b>commented on ".$rep["comment_time"]."</p>";
			    echo "<p>".$rep["comment"]."</p>
			  </div>";
			  
	    echo "<hr>";

	    }


		
	}
	public function userReport($fname,$sname,$email,$report)
    {
    	$this->getDB();
    	$reptcon = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

    	$reportStore = $reptcon->prepare("INSERT INTO complaint(firstname,secondname,emailAddress,message)
    		VALUES('$fname','$sname','$email','$report')");
    	$reportStore->execute();
    }

	 //forum function ends


	//Market functions starts here
	public function stockPurchase($pItem,$pPrice,$pSupplied,$pDemanded,$pFrom,$pUser,$pDate)
    {
    	$this->getDB();
    	$purchCon = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

    	$sPurchase = $purchCon->prepare("INSERT INTO purchase(item,pur_unit_price,qty_supplied,qty_demanded,seller_user,buyer_user,purch_date)
    		VALUES('$pItem','$pPrice','$pSupplied','$pDemanded','$pFrom','$pUser','$pDate')");
    	$sPurchase->execute();
    }

	public function storeStock($itm,$price,$quant,$stkUser,$stk_time)
    {
    	$this->getDB();
    	$repcon = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

    	$sItem = $repcon->prepare("INSERT INTO stock(item,unit_price,stk_qty,stk_owner,stk_date)
    		VALUES('$itm','$price','$quant','$stkUser','$stk_time')");
    	$sItem->execute();
    }

    public function updateStock($u_ident,$iPrice,$quanty,$upDate)
    {
    	$this->getDB();
    	$upcon = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

    	$upItem = $upcon->prepare("UPDATE stock SET unit_price='$iPrice', stk_qty='$quanty', stk_date='$upDate'
    								WHERE stk_id='$u_ident' ");
    		
    	$upItem->execute();
    }

// removes stock from DB
    public function deleteStock($d_ident)
    {
    	$this->getDB();
    	$delCon = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

    	$deleteItem = $delCon->prepare("DELETE FROM stock WHERE stk_id='$d_ident' ");
    		
    	$deleteItem->execute();

    }


	public function fetchItems()
	{

		$this->getDB();
		$connect = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);
		$execute_items = $connect->prepare("SELECT * FROM items ORDER BY farmer_item ASC");
		$execute_items->execute();

		return $execute_items->fetchAll();
	}


	public function fetchingStock()
	{

		$this->getDB();
		$connection = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);
	    $exe_stock = $connection->prepare("SELECT * FROM stock ORDER BY item,unit_price ASC");
	    $exe_stock->execute();

	    return $exe_stock->fetchAll();

	}
	public function fetchStock($itm)
	{

		$this->getDB();
		$connections = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);
	    $exec_stock = $connections->prepare("SELECT * FROM stock WHERE item ='$itm' ");
	    $exec_stock->execute();

	    return $exec_stock->fetchAll();

	}

	public function highestProduce($item)
	{
		error_reporting(0);
		$this->getDB();
		$fact = $this->fetchStock($item);

		$highestArray = array();
		$owners = array();


		$factCount = count($fact);
		$countQty = 0;
		$max = 0;
		$index =0;
		$check = 0;

		if($factCount>1)
		{
				foreach ($fact as $value) 
				{
					if($value["item"] == $item)
					{
						$countQty = 0;
						$check++;
						for ($i=0; $i < $factCount ; $i++) 
						{ 
							if($value["stk_owner"] == $fact[$i]["stk_owner"]) 
							{	

								$person = $value["stk_owner"];

								$countQty = $countQty + $fact[$i]["stk_qty"];
								$highestArray[$check] = $countQty;
								$owners[$check] = $person;

								unset($fact[$i]);
							}

						}
					}
				}
				
				$max = $highestArray[0];
				for ($j=0; $j < $check; $j++) 
				{ 
					for ($k=1; $k < $check-1; $k++) 
					{ 
						if($highestArray[$k]>$max)
						{
							$max = $highestArray[$k];
							$index = $k;
						}

					}
				}
				echo "The <b>highest producer</b> of <b>$item</b> is: ".$owners[$index]."<br/>";
				echo "The <b>quantity</b> ".$owners[$index]." produces is ".$highestArray[$index];
			}
			else if($factCount==1)
			{
				echo "The <b>highest producer</b> of <b>$item</b> is: ".$fact[0]["stk_owner"]."<br/>";
				echo "The <b>quantity</b> ".$fact[0]["stk_owner"]." produces is ".$fact[0]["stk_qty"];
			}
			else
			{
				echo "<div class='alert alert-warning'>Records Not Sufficient!</div>";
			}
	}
	//t
	public function equi($item)
	{
		$this->getDB();
		$econ = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

		$econ_exe = $econ->prepare("SELECT pur_unit_price,qty_supplied,qty_demanded FROM purchase WHERE item ='$item' ORDER BY pur_unit_price ASC");
		$econ_exe->execute();

		return $econ_exe->fetchAll();
	}

	
	public function samePrice($priceArray)
	{
		$count = count($priceArray);
	
		$sumDemand = 0;
		$sumSupply = 0;

		if($count>1)
		{
			for ($i=0; $i < $count ; $i++) 
			{ 	
				for($j= $i+1; $j < $count; $j++)
				{
					if($priceArray[$i]['pur_unit_price'] == $priceArray[$j]['pur_unit_price'])
					{
						$sumDemand = $sumDemand + $priceArray[$j]['qty_demanded'];
						$sumSupply = $sumSupply + $priceArray[$j]['qty_supplied'];

						$priceArray[$i]['qty_demanded'] = $priceArray[$i]['qty_demanded'] + $sumDemand;
						$priceArray[$i]['qty_supplied'] = $priceArray[$i]['qty_supplied'] + $sumSupply;

						unset($priceArray[$j]);

						$sumSupply = 0;
						$sumDemand = 0;

					}
				}

			}

		return $priceArray;
		}

	}

	public function equiPrice($itemSelect)
	{
		$priceAr = $this->equi($itemSelect);
		$priceArr1 = $this->samePrice($priceAr);

		$counter = count($priceArr1);


		if($counter>1)
		{
				$QtyD = current($priceArr1);
				$Qd1 = $QtyD['qty_demanded'];
				$Qs1 = $QtyD['qty_supplied'];
				$p1	 = $QtyD['pur_unit_price'];

				$QtyS = next($priceArr1);
				$Qd2 = $QtyS['qty_demanded'];
				$Qs2 = $QtyS['qty_supplied'];
				$p2	 = $QtyS['pur_unit_price'];

				if ($p1==$p2) {
					echo "<div class ='alert alert-warning'>Record Not Sufficient!</div>";
				}
				else
				{
					$demandSlope = ($Qd2-$Qd1)/($p2-$p1);
					$supplySlope = ($Qs2-$Qs1)/($p2-$p1);

					$demandIntercept = $Qd1+($demandSlope*$p1);
					$supplyIntercept = $Qs1-($supplySlope*$p1);

					$sumIntercept = $demandIntercept - ($supplyIntercept);
					$sumSlope = $supplySlope + ($demandSlope);

					$equilibrium = $sumIntercept/$sumSlope;
					echo "<label><b>Current Equilibrium Price for $itemSelect is:</b></label><br/>";
					echo "N".round($equilibrium, 2);
				}
			}
			else
			{
				echo "<div class ='alert alert-warning'>Record Not Sufficient!</div>";
			}
			
	}

	public function slutsky($item,$user)
	{
		$this->getDB();
		$scon = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

		$itemP = $scon->prepare("SELECT pur_unit_price,qty_supplied,qty_demanded FROM purchase WHERE item ='$item' AND seller_user ='$user' ");
		$itemP->execute();

		$itemPrices = $itemP->fetchAll();

		$count = count($itemPrices);

		if($count>1)
		{
			for ($i=0; $i < $count ; $i++) 
			{ 	
				for($j= $i+1; $j < $count-1; $j++)
				{
					if($itemPrices[$i]['pur_unit_price'] == $itemPrices[$j]['pur_unit_price'])
					{
						unset($itemPrices[$j]);

					}
				}

			}
			$old = current($itemPrices);
			$oldQty = $old['qty_demanded'];
			$oldPrice	 = $old['pur_unit_price'];

			$new = next($itemPrices);
			$newQty = $new['qty_demanded'];
			$newPrice	 = $new['pur_unit_price'];

			$oldPower = $oldQty * $oldPrice;
			$changePower = $oldQty *($newPrice - $oldPrice);
			$newPower = $oldPower + $changePower;

			/*derivedQty is function of the new price and new purchasing power that was just determined(newPower).
				that is D(Pnew,Mnew)=>newPower/newPower
			*/
			$derivedQty = $newPower/$newPrice;
			$subEffect = $derivedQty - $oldQty; // oldQty is D(Pold, Mold)

			/*To determine the income effect, we check value when income is constant which is Pnew
			derivedQty1 is D(Pnew,Mold)
			derivedQty is D(Pnew, Mnew)
			*/
			$derivedQty1 = $oldPower/$newPrice;
			$incomeEffect = $derivedQty1 - $derivedQty;

			$slutIdentity = $subEffect + $incomeEffect;

			echo"The effects of price change of $item from <b>N$oldPrice</b> to <b>N$newPrice</b>: <br/>";
			echo "<b>Substitution effect:</b> $subEffect <br/>";
			echo "<b>Income effect:</b> $incomeEffect<br/>";

			echo"Overall effect of the change in price is <b>$slutIdentity</b>";
		}
		else
		{
			echo "<div class ='alert alert-warning'>Record Not Sufficient!</div>";
		}
	}

	public function equiRange($item,$start,$end)
		{	
/*			echo $start."<br/>";
			echo $end."<br/>";
*/
			$this->getDB();
			$conns = new PDO("mysql:host=$this->serverName;dbname=$this->serverDatabase",$this->serverUsername,$this->serverPassword);

			$range_exe = $conns->prepare("SELECT pur_unit_price,qty_supplied,qty_demanded,purch_date FROM purchase WHERE item='$item' ORDER BY pur_unit_price ASC");
			$range_exe->execute();

			$rangeArray = $range_exe->fetchAll();

			
			$countRange = count($rangeArray);

			for ($i=0; $i < $countRange; $i++) { 
				if(($rangeArray[$i]["purch_date"]<=$start) && ($rangeArray[$i]["purch_date"]>=$end))
				{
					unset($rangeArray[$i]);
				}
				else
				{
					
				}
			}

			$rangeSame = $this->samePrice($rangeArray);

			$counter = count($rangeSame);
			if($counter>1)
			{

				
				$QtyD = current($rangeSame);
				$Qd1 = $QtyD['qty_demanded'];
				$Qs1 = $QtyD['qty_supplied'];
				$p1	 = $QtyD['pur_unit_price'];

				$QtyS = next($rangeSame);
				$Qd2 = $QtyS['qty_demanded'];
				$Qs2 = $QtyS['qty_supplied'];
				$p2	 = $QtyS['pur_unit_price'];

				if ($p1==$p2) {
					echo "<div class ='alert alert-warning'>Record Not Sufficient!</div>";
				}
				else
				{
					$demandSlope = ($Qd2-$Qd1)/($p2-$p1);
					$supplySlope = ($Qs2-$Qs1)/($p2-$p1);

					$demandIntercept = $Qd1+($demandSlope*$p1);
					$supplyIntercept = $Qs1-($supplySlope*$p1);

					$sumIntercept = $demandIntercept - ($supplyIntercept);
					$sumSlope = $supplySlope + ($demandSlope);

					$equilibrium = $sumIntercept/$sumSlope;
					echo "<label>The Equilibrium Price of $item between $start and $end is: </label><br/>";
					echo "N".round($equilibrium, 2);
				}


				
			}
			else
			{
				echo "<div class ='alert alert-warning'>Record Not Sufficient!</div>";
			}
			
		}

}

?>