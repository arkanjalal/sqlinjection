
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Form</title>
</head>
<body>
	<h2>Sign Up Form</h2>
	<form action="signup.php" method="post" enctype="multipart/form-data">
		<label>Name:</label><br>
		<input type="text" name="name" required><br>

		<label>Email:</label><br>
		<input type="email" name="email" required><br>

		<label>Password:</label><br>
		<input type="password" name="password" required><br>

		<label>Gender:</label><br>
		<input type="radio" name="gender" value="male" checked> Male<br>
		<input type="radio" name="gender" value="female"> Female<br>
		<input type="radio" name="gender" value="other"> Other<br><br>

		<label>Profile Image:</label><br>
		<input type="file" name="image" accept="image/*" required><br>

		<input type="checkbox" name="rememberme"> Remember Me<br><br>

		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>

<?php
if(isset($_POST['submit'])){
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$gender = $_POST['gender'];
	$rememberme = isset($_POST['rememberme']);

	// Validate name
	if(empty($name)){
		$error = "Please enter your name.";
	}

	// Validate email
	if(empty($email)){
		$error = "Please enter your email.";
	}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error = "Please enter a valid email address.";
	}

	// Validate password
	if(empty($password)){
		$error = "Please enter your password.";
	}elseif(strlen($password) < 6){
		$error = "Your password must be at least 6 characters long.";
	}

	// Validate gender
	if(empty($gender)){
		$error = "Please select your gender.";
	}

	// Validate image
	if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
		$image = $_FILES['image'];
		$size = $image['size'];
		if($size > 1048576){ // 1 MB in bytes
			$error = "Your profile image must be less than 1 MB.";
		}
	}else{
		$error = "Please upload your profile image.";
	}

	if(!isset($error)){
		// Process the form data
		// ...
		echo "Thank you for signing up!";
	}else{
		echo $error;
	}
}
?>
<?php 
$host="localhost";
$username ="root" ;
$password ="";
$dbname ="arkan";

$conn2 = mysqli_connect($host,$username,$password,$dbname);

//  if(!$conn2){
//    die('connection failed:'.mysqli_connect_error()) ;
// }

if(isset($_POST['submit'])){
	
    $fileName=$_FILES['image']['name'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $q="insert into users set user_name='$userName', email='$email', password='$hash', gender='$gender', file_name='$fileName'";
    $sql = "insert into users set name=?, email=?, password=?, gender=?, file_name=?";
    $sql = mysqli_prepare($conn2,$sql);
    mysqli_stmt_bind_param($sql ,"sssss",$name,$email,$hash,$gender,$fileName);
    mysqli_stmt_execute($sql );
    
}
?>