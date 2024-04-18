<!doctype html>  
<html>  
<head>  
<title>Student Login</title>  
<link rel = "stylesheet" href="style.css">
</head>  
<body>  
      
<h3>Login</h3>  

<div class = "login">
        <h1>Student Login</h1>
        <form action="" method = "POST">
            <label>Email id</label>
            <input type = "text" name="user" >
            <label>Password</label>
            <input type = "password" name="pass" value="password">
            <input type="submit" name="submit" value="Login"/>
        </form>
        <p style="text-align: center; padding-top: 20px; font-size: 15px;">Don't have account?<a href="studentsignup.php">Signup Here!</a></p>
</div>
<div>
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
session_start(); // Start the session

if(isset($_POST["submit"])) {    
    if(!empty($_POST['user']) && !empty($_POST['pass'])) {  
        $user = $_POST['user'];  
        $pass = $_POST['pass'];  

        $_con = mysqli_connect('localhost','root','root','form') or die(mysqli_error());  

        // Select the database
        mysqli_select_db($_con, 'form') or die("cannot select DB");  

        // Execute query
        $query = mysqli_query($_con, "SELECT * FROM signup WHERE user='".$user."' AND pass='".$pass."'");  

        // Check if query executed successfully
        if($query) {
            $numrows = mysqli_num_rows($query);  
            if($numrows != 0) {  
                while($row = mysqli_fetch_assoc($query)) {  
                    $dbusername = $row['user'];  
                    $dbpassword = $row['pass'];  
                    $student_name = $row['first_name']; // Fetch student's first name
                }  

                if($user == $dbusername && $pass == $dbpassword) {  
                    $_SESSION['sess_user'] = $student_name;  

                    /* Redirect browser */  
                    header("Location: studentwelcomepage.php");
                    exit(); // Ensure that script stops executing after redirection
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