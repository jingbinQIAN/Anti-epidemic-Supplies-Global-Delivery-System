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
<h1 class= "logfunction" style="text-align: center">Donar Register</h1>

<h3 class = "hint">
<?php 
	include 'connectDB.php';
	
	//post the data from the html
	$sname = $_POST["s_name"];
	$psd = $_POST["s_psd"];
	$phone_number = $_POST["phone_number"];
	$industry = $_POST["industry"];
	$accountnum = rand(1000,9999);
	$account = "s0000".$accountnum;
	$sql = "INSERT INTO Donar (account, name, passward, industry, phone_number) VALUES ('$account', '$sname', '$psd', '$industry', '$phone_number')";
	
	//insert to the database
	mysqli_query($conn, $sql);
	echo "<h2 style='text-align:center'>Dear $sname,<p style='text-align:center'> Regist successfully!</p> <p style='text-align:center'>You account number is $account.</p> <p style='text-align:center'>Please remember it.</p></h2>";
	
	
	$conn->close();
?>
</h3>
 </div>
<div>
	<p style="text-align-last:justify; border-radius:19px;">
	<img src="pic\promask.jpg" style="border-radius:19px; width:30%;"/>
	<img src="pic\promask2.jpeg" style="border-radius:19px; width:28%;"/>
	<img src="pic\promask3.jpg" style="border-radius:19px; width:26%;"/>
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