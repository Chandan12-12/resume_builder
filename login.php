<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'userinfotech';
$res=false;
$conn = mysqli_connect($host, $user, $pass, $db);

if(mysqli_connect_error()){
    die('you got error while server connection'. mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD']=='POST'){
     $username =$_POST['user'];
     $password =$_POST['pass'];

     $sql="SELECT `username` , `password` FROM `userinfo` WHERE `username`='$username' ";
     $result=mysqli_query($conn,$sql);
     if(mysqli_num_rows($result)==0 ){
        die("user does not exists");
     }
     
     $row=mysqli_fetch_assoc( $result);

     //verifying password 
     if(password_verify($password,$row['password'])){
     $res=true;
     session_start();
     $_SESSION["username"]=$username;
     $_SESSION["logedin"]=true;
          header("location:welcome.php");

     }
    else
    { die ( "either username wrong or password");}}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>login in to resume buider</title>
</head>
<body>
    <header>
        <nav class="navbar">
        <a href="homepage.php" class="headeranchor" target ="_blank"><strong>HOME</strong></a>
            <a href="newregistration.php" class="headeranchor" target ="_blank">new registration</a>
            <a href="login.php" class ="headeranchor" target ="_main">login</a>
            <a href="welcome.php" class ="headeranchor" target ="_main">Myaccount</a>
        </nav>
    </header>

<main>

<h2>LOGIN PAGE </h2>
<div class="container">
<form action="login.php" method="post">



<br>

<label for="user">enter username
    <input type="text" id="user" name="user"required>
</label>

<label for="pass"> enter password
    <input type="password" id="pass" name="pass" required>
</label> <br>


    <input type="submit" value="submit" id="sub" name="sub">
</label>

</form>
<img src="https://images.unsplash.com/photo-1454166155302-ef4863c27e70?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fGNhcnRvb24lMjB3aXRoJTIwcGVuY2lsfGVufDB8fDB8fHww" alt="image" class="image">
</div>
  
</main>
</body>
</html>