<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOD login</title>
    <link rel = "stylesheet" href="hodallstyle.css">

</head>    

<body>
    <div class = "login">
        <h1> HOD Login</h1>
        <form action="web.html" method="post">
            <label>Email id</label>
            <input type = "email" name="" placeholder="example@gmail.com">
            <label>Password</label>
            <input type = "password" name="" placeholder="password" value="password">
            <input type="submit" name="" value="Login">
        </form>
        <p>Don't have account?<a href="hodsignup.php">Signup Here!</a></p>
    </div>
    <div class="sidebar"> 
        <div>
            <ul>
                <li>
                    <div class="logo-text-container">
                        <img src="images/rmkcet1.png" alt="" class="imh1">
                        
                    </div>
                </li>
                <li>
                    <div class="logo-text-container">
                        <img src="images/homelogo1.png" alt="" class="imh">
                        <a href="web.php" class="logo-text">Home</a>
                    </div>
                </li>
                <li>
                    <div class="logo-text-container">
                        <img src="images/back.png" alt="" class="imh">
                        <a href="web.php" class="logo-text">Back</a>
                    </div>
                </li>
            </ul>    
        </div>
    </div>
    <?php  
if(isset($_POST["submit"]))
{    
if(!empty($_POST['email']) && !empty($_POST['password'])) {  
    $email=$_POST['email'];  
    $pass=$_POST['password'];  
  
    $_con = mysqli_connect('localhost','root','root','forms') or die(mysqli_error());  
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
  
    // Select the database
    mysqli_select_db($_con, 'forms') or die("cannot select DB");  
  
    // Execute query
    $query=mysqli_query($_con, "SELECT * FROM hod WHERE email='".$email."' AND password='".$password."'");  
    // Check if query executed successfully
    if($query) {
        $numrows=mysqli_num_rows($query);  
        if($numrows!=0)  
        {  
            while($row=mysqli_fetch_assoc($query))  
            {  
                $dbuser=$row['email'];  
                $dbpassword=$row['password'];  
            }  

            if($email == $dbuser && $password == $dbpassword)  
            {  
                session_start();  
                $_SESSION['sess_user']=$email;  

                /* Redirect browser */  
                header("Location: web.html");  
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