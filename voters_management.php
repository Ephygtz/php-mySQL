<!-- <?php //header reload function 
	function reload(){
		header("location: voters_management.php");
	}
?> -->
<?php  
	//1. Create a database connection
	$server = "localhost";
	$dbuser = "Chiloba";
	$dbpass = "chilobae";
	$dbname = "IEBC_voters";
	$conn = mysqli_connect($server, $dbuser, $dbpass, $dbname);
	// Test if connection occured.
	if(!$conn){
		die("Database connection failed: " . mysqli_connect_error());
	} else {
		echo "<b>Connection Succesful</b> <br />";
	}
?>

<?php  
	//2.  Perform a Database Query
	$query = "SELECT * FROM voters_management";
	$result = mysqli_query($conn, $query);
	//Test if there was a query error
	if(!$result){
		die("Database query failed: " . mysqli_error());
	} else {
		echo "<b>Query succesful</b> <br />";
	}
	//var_dump(mysqli_fetch_assoc($result));
?>


<!DOCTYPE html>
<html>
<head>
	<title>IEBC voter's management system</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<style type="text/css">
		#edit {
			color: purple;
			background-color: yellow;
		}
		#del {
			color: orange;
			background-color: red;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="jumbotron text-center">
			<h1>IEBC Voters Management System</h1>
			<h3 class="text-info">PHP/mySQL CRUD operations</h3> 
		</div>
	</div>
	<!-- Section to collect DATA from user/voter -->
	<div class="container-fluid bg-info">
		<h3 class="text-center text-danger">Post DATA to the DB</h3>
		<form method="POST" action="voters_management.php">
			<div class="row" align="center">
				<div class="col-md-6"> <!-- Float this section left -->
				<div class="form-group">
					<label>Name:
						<input type="text" name="name" class="form-control" placeholder="Enter Your Full Names" required>
					</label>
				</div>
				<div class="form-group">
					<label>ID:
						<input type="number" name="id" class="form-control" placeholder="Enter Your ID No." required>
					</label>
				</div>
				<div class="form-group">
					<label>County:
						<input type="text" name="county" class="form-control" placeholder="Enter Your County Locatio" required>
					</label>
				</div>
				</div>
				<div class="col-md-6"><!-- Float to right -->
					<div class="form-group">
					<label>Date:
						<input type="date" name="date" class="form-control" required>
					</label>
				</div>
				<div class="form-group">
					<label>Polling Station:
						<input type="text" name="polling" class="form-control" placeholder="Enter Your Polling Station" required>
					</label>
				</div>
				<input type="submit" name="submit" value="Submit Data" class="btn btn-warning btn-lg">
				</div>
				
			</div>
			
		</form>
	</div> 

	<!-- Section to display data from DB -->
	<div class="container-fluid bg-success">
		<h4 class="text-center text-danger">Read/Retrieve from the mySQL Database</h4>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>ID</th>
					<th>County</th>
					<th>Date</th>
					<th>Polling Station</th>
					<th id="del">Delete</th>
					<th id="edit">Update</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				//3. Use the returned data (If any)
				//Iterate the array result and use the data in the table
				while($row=mysqli_fetch_assoc($result)){
					// var_dump($row);
					// echo "<hr>";
					echo "<tr>
							<td>$row[No]</td> 
							<td>$row[Name]</td> 
							<td>$row[ID]</td> 
							<td>$row[County]</td> 
							<td>$row[Date]</td> 
							<td>$row[Polling_station]</td> 
							<td> <a href='voters_management.php?del_id=$row[No]' class='btn btn-danger'>Delete</a></td> 
							<td> <a href='#' class='btn btn-warning'>Edit</a></td> 
						</tr>";
				}
				?>
			</tbody>
		</table>
	</div>
	<br><br><br><br><br><br><br><br><br>
</body>
</html>

<?php  
	//Process user input and push data to the DB
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$ID = $_POST['id'];
		$county = $_POST['county'];
		$date = $_POST['date'];
		$polling_station = $_POST['polling'];
		//Push data to the da
		$insert = "INSERT INTO voters_management (Name, ID, County, Date, Polling_station) VALUES ('$name', '$ID', '$county', '$date', '$polling_station')";
		// Run your Query
		if(mysqli_query($conn, $insert)){
			//Reload page if query succesful
			echo "Insert Succesful"; ?> 
			<!-- Close tag p reload using JS -->
			<script> window.location = "voters_management.php";</script> <?php
			//If you get a header error, wrap 
			// header("location: voters_management.php")
			// reload();
		} else {
			die("Query failed " . mysqli_error($conn));
		}
	}

?>

<?php  
	//Delete a perticular row by assigning a GET variable to each unique No. field
	if(isset($_GET['del_id'])){
		//SQL delete syntax/query
		$query_del = "DELETE FROM voters_management WHERE No = '$_GET[del_id]' ";
		//Run Query
		if(mysqli_query($conn, $query_del)){
			//Reload page if query succesful
			echo "Delete Succesful"; ?>
			<script> 
				// Reload self
				window.location = "voters_management.php"; 
			</script>
			<?php 
		} else {
			die("Delete failed: " . mysqli_error($conn));
		}
	}
?>