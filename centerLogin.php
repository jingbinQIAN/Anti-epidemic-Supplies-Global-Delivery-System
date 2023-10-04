<html>
<title> login page</title>
<head>

<link rel="stylesheet" type="text/css" href="delivery.css">

</head>
<body>
		<h1 id="alltitle"><img src="pic\logo.png" width="100" height="95" class ="logo">Anti-epidemic Supplies<br>Global Delivery</h1>
        <h3 id="lognavigation">
		Navigation &nbsp &nbsp &nbsp &nbsp 
                <a href="http://stuweb.uic.edu.cn/q030026117/DBMS%20project/Homepage.html"class="noLine"  >Home Page</a>  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                <a href="http://stuweb.uic.edu.cn/q030026117/DBMS%20project/offerlogin.html" class="noLine" >Supplier</a> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				<a href="http://stuweb.uic.edu.cn/q030026117/DBMS%20project/DeliCenterLOGIN.html" class="noLine" >Delivery Center</a> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                <a href="http://stuweb.uic.edu.cn/q030026117/DBMS%20project/Deliveryman.html" class="noLine" >Deliveryman</a> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                <a href="http://stuweb.uic.edu.cn/q030026117/DBMS%20project/student.html" class="noLine" >Student</a>
				
        </h3>
<div class = "Tip">
<?php
	include 'connectDB.php';
	//connect to the database
	//post the value from the html
	
	$time_start = microtime(true);
	
	$account = $_POST["cen_num"];
	$psd = $_POST["cen_psd"];
	
	


	$sql1 = "SELECT *FROM Delivery_center WHERE account='$account'";
	$result1 = $conn->query($sql1);
	//this is to test whether the manager's name is right or not
	if($result1->num_rows > 0){
		//this is to test whether the password is right or not
		$sql2 = "SELECT *FROM Delivery_center WHERE password='$psd' ";
		$result2 = $conn->query($sql2);
		//if the password is right, then print the welcome saying and the customer value
		if($result2->num_rows > 0){
			$row = mysqli_fetch_assoc($result2);
		   echo "<center><label></label></center><h2 style='text-align:center'>Delivery_center: $account, ".$row[location].",<p>database server connected successfully.</p> <p>Here is all the data.<p>  </h2>";
	       ListData($conn, $account);
		} else {
			echo "<h2 style='text-align:center'>Sorry, your password is wrong</h2>";
		}
	}
	//If his/her name is wrong, then print "not have this manager"
    else {
		echo "<h2 style='text-align:center'>Not have this account.</h2>";
	}
	
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	echo "<style>label::before{ content: 'The display time is ".round($time, 2)."s'; color:white; font-size:20px; text-align:center;}</style>";
	
	
	function ListData($conn, $account){
		$sql = "SELECT * FROM Student join Order_info ON Student.account=Order_info.stu_account WHERE Student.country in (SELECT location FROM Delivery_center WHERE account='$account') ORDER BY Order_info.order_id, Order_info.date";
		$result = $conn->query($sql);
		$sql2 = "SELECT SUM(order_amount) FROM Student join Order_info ON Student.account=Order_info.stu_account WHERE Student.country in (SELECT location FROM Delivery_center WHERE account='$account') ORDER BY Order_info.order_id, Order_info.date";
		$result2 = $conn->query($sql2);
		$sum = 0;
		if($result2->num_rows > 0){
			$row = mysqli_fetch_assoc($result2);
			$orderAmount = $row["SUM(order_amount)"];
		}
		$sql3 = "SELECT COUNT(id) FROM Deliveryman WHERE country in (SELECT location FROM Delivery_center WHERE account='$account')";
		$result3 = $conn->query($sql3);
		$deliveryMan = 0;
		if($result3->num_rows > 0){
			$row = mysqli_fetch_assoc($result3);
			$deliveryMan = $row["COUNT(id)"];
		}
		$sql5 = "SELECT SUM(amount) FROM Warehouse";
		$result5 = $conn->query($sql5);
		$inventory = 0;
		if($result5->num_rows > 0){
			$row = mysqli_fetch_assoc($result5);
			$inventory = $row["SUM(amount)"];
		}
		echo "<h2 style='text-align:center'>The total order amount is: <b style='color:yellow'>$orderAmount</b>.</h2>";
		echo "<h2 style='text-align:center'>The number of delivery men: <b style='color:yellow'>$deliveryMan</b>.</h2>";
		echo "<h2 style='text-align:center'>The total inventory is: <b style='color:yellow'>$inventory</b>.</h2>";
		if($result->num_rows > 0){
			echo "<center><table class='showTable'><tr><th colspan=7 style='color:white; font-size:30px'>Order Information Table</th></tr><tr> <th class='thTable'>Order ID</th> <th class='thTable'>Student Account</th> <th class='thTable'>Order Number</th> <th class='thTable'>Phone Number</th> <th class='thTable'>Date</th> <th class='thTable'>Address</th><th class='thTable'>Country</th></tr> ";
		}
		
		//print the customer table(using the while loop and array)
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr> <td class='tdTable'>".$row["order_id"]."</td> <td class='tdTable'>" . $row["stu_account"]."</td><td class='tdTable'>" . $row["order_amount"]."</td><td class='tdTable'>". $row["phone_number"]."</td><td class='tdTable'>".$row["date"]."</td><td class='tdTable'>".$row["stu_address"]."</td><td class='tdTable'>".$row["country"]."</td></tr>";
			//use the link to pass value to another php and delete the user
		}
		echo "</table></center>";
		$sql4 = "SELECT * FROM Deliveryman WHERE country in (SELECT location FROM Delivery_center WHERE account='$account') ORDER BY id";
		$result4 = $conn->query($sql4);
		if($result4->num_rows > 0){
			echo "<center><table class='showTable'><tr><th colspan=4 style='color:white; font-size:30px'>Delivery Man Table</th></tr><tr> <th class='thTable'>ID</th> <th class='thTable'>Name</th> <th class='thTable'>Phone</th><th class='thTable'>Country</th></tr> ";
		}
		
		//print the customer table(using the while loop and array)
		while($row = mysqli_fetch_assoc($result4)) {
			echo "<tr> <td class='tdTable'>".$row["id"]."</td> <td class='tdTable'>" . $row["name"]."</td><td class='tdTable'>" . $row["phone"]."</td><td class='tdTable'>". $row["country"]."</td></tr>";
			//use the link to pass value to another php and delete the user
		}
		echo "</table></center>";
		
		$sql6 = "SELECT * FROM Warehouse";
		$result6 = $conn->query($sql6);
		if($result6->num_rows > 0){
			echo "<center><table class='showTable'><tr><th colspan=4 style='color:white; font-size:30px'>Warehouse Information</th></tr><tr> <th class='thTable'>Product ID</th> <th class='thTable'>Date</th> <th class='thTable'>Amount</th><th class='thTable'>Status</th></tr> ";
		}
		
		//print the customer table(using the while loop and array)
		while($row = mysqli_fetch_assoc($result6)) {
			echo "<tr> <td class='tdTable'>".$row["product_ID"]."</td> <td class='tdTable'>" . $row["date"]."</td><td class='tdTable'>" . $row["amount"]."</td><td class='tdTable'>". $row["status"]."</td></tr>";
			//use the link to pass value to another php and delete the user
		}
		echo "</table></center>";
		
		
		$conn->close();
		return;
	}
?>
<div>
	<p style="text-align-last:justify; border-radius:19px;">
	<img src="pic\DeliC1.png" style="border-radius:19px; width:32%;"/>
	<img src="pic\DeliC2.png" style="border-radius:19px; width:30%;"/>
	<img src="pic\DeliC3.png" style="border-radius:19px; width:25.75%;"/>
	</p>
</div>
<div class="Tip2">
	<br>
    <p style="font-size:30px; font-weight:bold">About us</p>
    <p style="font-size:25px;">We are voluntary to provide this system, if you have any problems, feel free to contact us!</p> <p>Email:q030026117@mail.uic.edu.cn  Address:<a href="https://cn.bing.com/maps?osid=381f6da2-9e07-4db1-8be9-8b441349f32c&cp=mqr3rztfv17j&lvl=16&imgid=853c4098-044c-4b6d-b5df-bfc7caee942c&v=2&sV=2&form=S00027" style="color: yellow"  >UIC</a></p>
	<p>Copyright © 2021 ourDBMS Org. All rights reserved</p>
</div>
</body>
</html>