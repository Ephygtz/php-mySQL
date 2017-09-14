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
							<td>$row[County]</td> 
						</tr>";
				}
				?>
			</tbody>
		</table>
	</div>
	
</body>
</html>