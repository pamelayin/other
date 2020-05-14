<?php 

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'tutorial') or die(mysqli_error($mysqli));

$update = false;
$name = '';
$location = '';
$id = 0;

// if save button is pressed
if (isset($_POST['save'])) {
	$name = $_POST['name'];
	$location = $_POST['location'];


	$mysqli->query("INSERT INTO data (name, location) VALUES ('$name', '$location')") or 
			die($mysqli->error);

	$_SESSION['message'] = "Record has been saved!";
	$_SESSION['msg_type'] = "success";

	header("location: php_tutorial.php");
}

if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";

	header("location: php_tutorial.php");
}

if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
	if ($result->num_rows) {
		$row = $result->fetch_array();
		$name = $row['name'];
		$location = $row['location'];
	}
}

if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$location = $_POST['location'];

	$mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error());

	$_SESSION['message'] = "Record has been updated!";
	$_SESSION['msg_type'] = "warning";

	header('location: php_tutorial.php');
}
?>