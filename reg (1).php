<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Login Form</title>
  <link rel="stylesheet" href="reg.css">
</head>
<body>
  <div class="wrapper">
    <form action="home.html" method="post">
      <h1>Login</h1>
      <div class="input-box">
        <input type="text" placeholder="Email id" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt' ></i>
      </div>
      <div class="remember-forgot">
        <label><input type="checkbox">Remember Me</label>
        <a href="#">Forgot Password</a>
      </div>
      <button type="submit" class="btn">Login</button>
      <div class="register-link">
        <p>Dont have an account? <a href="sign.php">Sign Up</a></p>
      </div>
    </form>
  </div>
  <?php  
if(isset($_POST["submit"]))
{    
if(!empty($_POST['user']) && !empty($_POST['password'])) {  
    $user=$_POST['user'];  
    $pass=$_POST['password'];  
  
    $_con = mysqli_connect('localhost','root','root','reg') or die(mysqli_error());  
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
  
    // Select the database
    mysqli_select_db($_con, 'reg') or die("cannot select DB");  
  
    // Execute query
    $query=mysqli_query($_con, "SELECT * FROM faculty WHERE user='".$user."' AND password='".$password."'");  
    // Check if query executed successfully
    if($query) {
        $numrows=mysqli_num_rows($query);  
        if($numrows!=0)  
        {  
            while($row=mysqli_fetch_assoc($query))  
            {  
                $dbuser=$row['user'];  
                $dbpassword=$row['password'];  
            }  

            if($user == $dbuser && $password == $dbpassword)  
            {  
                session_start();  
                $_SESSION['sess_user']=$user;  

                /* Redirect browser */  
                header("Location: pp.html");  
            }  
        } else {  
            echo "Invalid username or password!";  
        }
    } else {
        echo "Error executing query: " . mysqli_error($_con);
    }
  
} else {  
    echo "All fields are required!";  
}  
}  
?>
</body>  
</html>