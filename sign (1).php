<span style="font-family: verdana, geneva, sans-serif;">
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="sign.css" />
  </head>
  <body>
    <div class="signup-box">
      <h1>Sign Up</h1>
      <form action="" method="POST">
          <label>First Name</label>
          <input type="text" name="first_name" />
          </br>
          </br>
          <label>Last Name</label>
          <input type="text" name="last_name" />
          </br>
          </br>
          <label>User</label>
          <input type="text" name="user" />
          </br>
          </br>
          <label>Password</label>
          <input type="password" name="password" />
          </br>
          </br>
          <button type="submit" class="btn">Register</button>
          <div class="para-2">
             <p>Already have an account? <a href="reg.php">Login here</a></p>
          </div>
      </form>
    </div>
    <?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = mysqli_connect('localhost', 'root', 'root', 'reg');
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user = $_POST['user'];
    $password = $_POST['password'];

    // SQL query to insert data into students table
    $sql = "INSERT INTO `faculty` (`first_name`, `last_name`, `user`, `password`) VALUES ('$first_name', '$last_name', '$user', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>
</body>
</html>
</span>