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

	$user	= $_POST["acc_num"];
	$pwd	= $_POST["acc_psd"];
	$flag = 0;
	$sql = "SELECT *FROM Manufacture";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		if($user == $row["account"]){
			$flag = 1;//set the flag equal to one
			if ($pwd == $row["password"]){// password from db record
				$comName = $row['company_name'];
				//if successfully then put out the sentence
				echo "<h2 style='text-align:center'>Dear $comName, <br> Login successfully!<br></h2>";
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
?>

<h1 class= "logfunction" style="text-align: center">Manufacture Input</h1>


<h3 class = "hint">
 <form action="ManufactureInsert.php" method="post">
   <label>Manufacture Name</label><br>
   <input type="text" id="stuname" name="stuname" style="font-size: 20px; border-radius: 19px" value="<?php echo "$comName"; ?>"><br><br>
   <label>Account</label><br>
   <input type="text" id="saccount" name="saccount" style="font-size: 20px; border-radius: 19px" value="<?php echo "$user"; ?>"><br><br>
   <label>Amount(How many you want to donate)</label><br>
   <input type="number" id="samount" name="samount" style="font-size: 20px; border-radius: 19px" min ="1" value=""><br><br>
   <input type="submit" style="font-size: 30px; border-radius: 19px; color:mediumseagreen" name="submit" value="Submit">
</form>
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