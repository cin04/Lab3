
<?php

$servername = "it330servercastro.mysql.database.azure.com";
$username = "Cindy@it330servercastro";
$password = "Castro1234";
$dbname = "it330db";

$Rollno='';
$fname="";
$lname="";
$address="";
$email="";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//connect to mysql database
	try{

		$conn = mysqli_connect($servername,$username,$password,$dbname);
	}catch(mysqli_sql_Exeception $ex){
		echo "error in connecting";
	}

//get data
function getdata(){

	$data=array();
	$data[0]=$_POST['Rollno'];
	$data[1]=$_POST['fname'];
	$data[2]=$_POST['lname'];
	$data[3]=$_POST['address'];
	$data[4]=$_POST['email'];

	return $data;
}
//search
	
	if (isset($_POST['search'])) {
		# code...
		$info = getData();
		$search_query="SELECT * FROM `idusnew` WHERE Rollno = '$info[0]'";
		$search_result=mysqli_query($conn,$search_query);
			if ($search_result) {
				# code...
				if (mysqli_num_rows($search_result)) {
					# code...
					while ($rows = mysqli_fetch_array($search_result)) {
						# code...
						$Rollno = $rows['Rollno'];
						$fname = $rows['fname'];
						$lname = $rows['lname'];
						$address = $rows['address'];
						$email = $rows['email'];
						
					}
				}else{
					echo "no data are available";
				}
			}else{
				echo "result error";
			}

	}

// insert
	if (isset($_POST['insert'])) {
		# code...
		$info = getData();
		$insert_query="INSERT INTO `idusnew`( `fname`, `lname`, `address`, `email`) VALUES ('$info[1]','$info[2]','$info[3]','$info[4]')";
			try{
				$insert_result=mysqli_query($conn,$insert_query);
				if ($insert_query) {
					# code...
					if (mysqli_affected_rows($conn)>0) {
						# code...
						echo("data inserted successfully!");
					}else{
						echo "data are not inserted";
					}
				}
			}catch(Exception $ex){
				echo "error inserted",$ex->getMessage();
			}
	}

//delete
	if (isset($_POST['delete'])) {
		# code...
		$info = getData();
		$delete_query ="DELETE FROM `idusnew` WHERE Rollno = '$info[0]'";
		try{
			$delete_result = mysqli_query($conn,$delete_query);
			if ($delete_result) {
				# code...
				if(mysqli_affected_rows($conn)>0){
					echo "date deleted";
				}else{
					echo "data not deleted";
				}
			}
		}catch(Exception $ex){
			echo "error in delete".$ex->getMessage();
		}
		
	}

	//edit
	if (isset($_POST['update'])) {
		# code...
		$info = getdata(); 
		$update_query= "UPDATE `idusnew` SET `fname`='$info[1]',`lname`='$info[2]',`address`='$info[3]',`email`='$info[4]' WHERE Rollno ='$info[0]'";
		try{
			$update_result = mysqli_query($conn,$update_query);
			if ($update_result) {
				# code...
				if (mysqli_affected_rows($conn)>0) {
					# code...
					echo "data updated";
				}else{
					echo "data not updated";
				}
			}
		}catch(Exception $ex){
			echo "error in update".$ex->getMessage();
		}
	}
?>




<html>
<body>

<form method="post" action="idusnew.php">
	<input type="number" name="Rollno" placeholder="Roll No" value="<?php echo ($Rollno);?>"><br><br>
	<input type="text" name="fname" placeholder="First Name" value="<?php echo ($fname);?>"><br><br>
	<input type="text" name="lname" placeholder="Last Name" value="<?php echo ($lname);?>"><br><br>
	<input type="text" name="address" placeholder="Address" value="<?php echo ($address);?>"><br><br>
	<input type="text" name="email" placeholder="Email@email.com" value="<?php echo ($email);?>"><br><br>

	<div>
		<input type="submit" name="insert" value="Add">
		<input type="submit" name="update"	value="Update">
		<input type="submit" name="delete" value="Delete">
		<input type="submit" name="search" value="Find">
		
	</div>
</form>


</body>
</html>