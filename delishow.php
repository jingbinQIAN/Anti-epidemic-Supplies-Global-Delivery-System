<html>
<title>Deliveryman</title>
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
	$time_start = microtime(true);
	$user	= $_POST["acc_num"];
	$pwd	= $_POST["acc_psd"];
	$flag = 0;
	$sql = "SELECT *FROM Deliveryman";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		if($user == $row["id"]){
			$flag = 1;//set the flag equal to one
			if ($pwd == $row["password"]){// password from db record
				$stuName = $row['name'];
				$delicountry = $row['country'];
				//if successfully then put out the sentence
				echo "<center><label></label></center><h2 style='text-align:center'>Dear $stuName, <br> Login successfully!<br></h2>";
				echo "<h2 style='text-align:center'>Here is your all the order in your country!</h2><br>";
				
				$sql2 = "SELECT * FROM Student join Order_info ON Student.account=Order_info.stu_account WHERE Student.country in (SELECT country FROM Deliveryman WHERE id='$user') ORDER BY Order_info.order_id, Order_info.date";
				$result2 = $conn->query($sql2);
				if($result2->num_rows > 0){
					echo "<center><table class='showTable' style='text-align:center'> <tr><th class='thTable'>OrderID</th> <th class='thTable'>StuACCOUNT</th><th class='thTable'>Date</th><th class='thTable'>Address</th><th class='thTable'>PhoneNum</th><th class='thTable'>OrderAmount</th><th class='thTable'>In_delivery</th></tr> ";
				}
			//print the customer table(using the while loop and array)
				while($row = mysqli_fetch_assoc($result2)) {
					echo "<tr> <td name='id' class='tdTable'>" . $row["order_id"]."</td><td class='tdTable'>".$row["stu_account"]."</td> <td class='tdTable'>" . $row["date"]."</td><td class='tdTable'>" . $row["stu_address"]."</td><td class='tdTable'>" . $row["phone_number"]."</td><td class='tdTable'>" . $row["order_amount"]."</td><td class='tdTable'>" . $row["in_delivery"]."</td></tr>";
				}
				echo "</table></center>";
				$conn->close();
				break;
			}else{
				echo "<h2 style='text-align:center'>The Password is incorrect</h2>";
				break;
				
			}
			
		}
	  }
	} else {
		echo "0 results";//if the situatino is been up here, flag turn to 0
	}
	if($flag != 1){//the flag still 1,means the account does not exist
		echo "<h2 style='text-align:center'>This account does not exist</h2>";
	}
	$time_end = microtime(true);
	$time = $time_end - $time_start;
	echo "<style>label::before{ content: 'The display time is ".round($time, 2)."s'; color:white; font-size:20px; text-align:center;}</style>";
	$conn->close();
?>
 </div>
 <div>
	<p style="text-align-last:justify; border-radius:19px;">
	<img src="pic\deli1.jpg" style="border-radius:19px; width:28%;"/>
	<img src="pic\deli2.jpg" style="border-radius:19px; width:31%;"/>
	<img src="pic\deli3.jpg" style="border-radius:19px; width:26%;"/>
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