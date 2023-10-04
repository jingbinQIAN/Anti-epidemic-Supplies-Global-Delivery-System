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

	$user	= $_POST["acc_num"];
	$pwd	= $_POST["acc_psd"];
	$flag = 0;
	$sql = "SELECT *FROM Student";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		if($user == $row["account"]){
			$flag = 1;//set the flag equal to one
			if ($pwd == $row["password"]){// password from db record
				ListData($conn, $user, $row);
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

	$conn->close();
	
	function ListData($conn, $user, $row){
		$stuName = $row['stu_name'];
		$var=$row["account"];
		echo "<h2 style='text-align:center'>Dear $stuName, <br> Login successfully!<br><a href='changePassword.php?new=$var'>Do you want to change password?</a></h2>";
		echo "<h2 style='text-align:center'>Here is your applied order list!</h2><br>";
		$sql2 = "SELECT * FROM Order_info where stu_account='$user' ";
		$result2 = $conn->query($sql2);
		if($result2->num_rows > 0){
			echo "<center><table class='showTable' style='text-align:center'> <tr><th class='thTable'>OrderID</th> <th class='thTable'>StuACCOUNT</th><th class='thTable'>Date</th><th class='thTable'>Address</th><th class='thTable'>PhoneNum</th><th class='thTable'>OrderAmount</th><th class='thTable'>In_delivery</th><th class='thTable'>Delete Order</th></tr> ";
		}
		
		while($row = mysqli_fetch_assoc($result2)) {
			$var=$row["order_id"];
			echo "<tr> <td name='id' class='tdTable'>" . $row["order_id"]."</td><td class='tdTable'>".$row["stu_account"]."</td> <td class='tdTable'>" . $row["date"]."</td><td class='tdTable'>" . $row["stu_address"]."</td><td class='tdTable'>" . $row["phone_number"]."</td><td class='tdTable'>" . $row["order_amount"]."</td><td class='tdTable'>".$row["in_delivery"]."</td><td class='tdTable'><a href='deleteOrder.php?new=$var' > Delete</a></td></tr>";
		}
		echo "</table></center>";
		$conn->close();
		echo "<div>
			 <h2 style='text-align:center'>Apply for a NEW order<br>(If you want to apply more please input your information)</h2>
			 <h3 class = 'hint'>
			 <form action='apply.php' method='post'>
			   <label>Student Name</label><br>
			   <input type='text' id='stuname' name='stuname' style='font-size: 20px; border-radius: 19px' value='$stuName' ><br><br>
			   <label>Account</label><br>
			   <input type='text' id='saccount' name='saccount' style='font-size: 20px; border-radius: 19px' value='$user' ><br><br>
			   <label>Address</label><br>
			   <input type='text' id='sadd' name='sadd' style='font-size: 20px; border-radius: 19px' value=''><br><br>
			   <label>Amount(How many you want)</label><br>
			   <input type='number' id='samount' name='samount' style='font-size: 20px; border-radius: 19px' min ='1' max = '10' value=''><br><br>
			   <label>Phone Number</label><br>
			   <input type='number' id='sphone' name='sphone' style='font-size: 20px; border-radius: 19px' value=''><br><br>
			   <input type='submit' style='font-size: 30px; border-radius: 19px; color:mediumseagreen' name='submit' value='Apply'>
			</form>
			</h3>
			 </div>
			 <div><h2 style='text-align:center;' ><a href='Unsubscribe.php?new=$user' style='color:red' >Unsubscribe your account</a></h2></div>";
		
	}
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