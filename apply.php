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
<h1 class= "logfunction" style="text-align: center">Student Login</h1>

<?php 
	include 'connectDB.php';
	
	//post the data from the html
	$sname = $_POST["stuname"];
	$sacc = $_POST["saccount"];
	$sadd = $_POST["sadd"];
	$amount = $_POST["samount"];
	$phoneN = $_POST["sphone"];
	$inforID = "o".rand(70000000,99999999);
	$date = date("Y/m/d");
	$sql = "INSERT INTO Order_info (order_id, stu_account, date, stu_address, phone_number, order_amount, in_delivery) VALUES ('$inforID', '$sacc', '$date', '$sadd', '$phoneN','$amount', 'T')";
	
	//insert to the database
	mysqli_query($conn, $sql);
	echo "<h2 style='text-align:center'>Dear $sname,<p style='text-align:center'> Apply successfully!</p> <p style='text-align:center'>Here is your new apply list.</p></h2>";
	
	$sql2 = "SELECT * FROM Order_info where stu_account = '$sacc' ";
	$result2 = $conn->query($sql2);
	if($result2->num_rows > 0){
		echo "<center><table class='showTable' style='text-align:center'> <tr><th class='thTable'>OrderID</th> <th class='thTable'>StuACCOUNT</th><th class='thTable'>Date</th><th class='thTable'>Address</th><th class='thTable'>PhoneNum</th><th class='thTable'>OrderAmount</th><th class='thTable'>In_delivery</th></tr> ";
	}
		//print the order table(using the while loop and array)
	while($row = mysqli_fetch_assoc($result2)) {
		echo "<tr> <td name='id' class='tdTable'>" . $row["order_id"]."</td><td class='tdTable'>".$row["stu_account"]."</td> <td class='tdTable'>" . $row["date"]."</td><td class='tdTable'>" . $row["stu_address"]."</td><td class='tdTable'>" . $row["phone_number"]."</td><td class='tdTable'>" . $row["order_amount"]."</td><td class='tdTable'>" . $row["in_delivery"]."</td></tr>";
	}
	echo "</table></center>";
	
	$conn->close();
?>
 </div>
 <div>
	<p style="text-align-last:justify; border-radius:19px;">
	<img src="pic\stu1.png" style="border-radius:19px; width:31%;"/>
	<img src="pic\stu2.png" style="border-radius:19px; width:27%;"/>
	<img src="pic\stu3.jpg" style="border-radius:19px; width:27%;"/>
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