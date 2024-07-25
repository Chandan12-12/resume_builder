<?php 

// DATABASE CREATION DEMO

/*$sqlquery= 'CREATE DATABASE demobase';
$result=mysqli_query($conn,$sqlquery);
if(!$result){
    die('database connection error is as followed by'.mysqli_error($conn));
}*/


//HOW TO CREATE TABLE DEMO

//$sql= 'CREATE TABLE user_table_name (s_no INT (2) AUTO_INCREMENT PRIMARY KEY, emailid VARCHAR(20),phone INT(10), username VARCHAR(20), userpass VARCHAR (10),conpassword VARCHAR(10))';
//$result=mysqli_query($conn,$sql);
//if(!$result){
//    die('table connection error is as followed by'.mysqli_error($conn));
//}


//HOW TO CONNECT MYSQL DEMO

//$host = 'localhost';
//$user = 'root';
//$pass = '';
//$conn = mysqli_connect($host, $user, $pass);
//if(mysqli_connect_error()){
  //  die('you got error while server connection'. mysqli_connect_error());
//}


//NOTE:
//OUR TABLE HAS ALREADY BEEN CREATED BY PHYMYADMIN IN DATABASE userinfotech
// both mysql and database userinfotech being connected

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
    $emailid =$_POST['emailid'];
     $phone =$_POST['phone'];
     $username =$_POST['username'];
     $password =$_POST['pass'];
     $conpassword =$_POST['confirmpass'];


 // TABLE userifo WAS ALREADY CREATED IN DATABASE userinfotech USING PHPMYADMIN

 $sql= "SELECT `username` FROM `userinfo` WHERE `username`='$username'" ;
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>=1){
die("username exits with same name");
}

 if($password == $conpassword){
    
    //using password hashing for security purpose
    $hash=password_hash($password,PASSWORD_DEFAULT);
 $sql="INSERT INTO `userinfo` (`emailid`, `phone`, `username`, `password`, `copassword` ) VALUES( '$emailid','$phone','$username','$hash','$hash')";
 $result= mysqli_query($conn,$sql);

 if($result){
    $res=true;
    if ($res) {
        echo "<div>
                <small>Account created, kindly proceed to login page!</small>
              </div>";
    }
}
else{ 
    die("querry fail due to". mysqli_error($conn));
 }

}
 
 else{
    die ("passwords are not same");
 } 

mysqli_close($conn);

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="newregistration.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>new registration on resume builder</title>
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
        
         <div class="head"> <h3> WELCOME TO RESUME BUILDER </h3>
         </div>
        
        <form action="newregistration.php" method="post" class ="formset">

            <fieldset>

                <legend>
                    <h1>ENTER DETAILS</h1>
                </legend>
                
                    <label for = "emailid"> ENTER EMAIL ID <br>
                        <input type="email" id="emailid" name="emailid" placeholder="xyx@gmail.com" required>
                    </label>

                    <br>

                    <label for = "phone"> ENTER PHONE NUMBER <br>
                        <input type="text" id="phone" name="phone" placeholder="123xxxxx90" minlength="10" maxlength="10" required>
                    </label>

                    <br>
                    
                    <label for = "username"> ENTER USER NAME <br>
                        <input type="text" id="username" name="username" required>
                    </label>

                    <br>
                    
                    <label for = "pass"> CREATE PASSWORD <br>
                        <input type="password" id="pass" name="pass" placeholder="....." required maxlength="10" minlength="5">
                    </label>

                    <br>

                    <label for="confirmpass"> CONFIRM PASSWORD <br>
                        <input type="password" id="confirmpass" placeholder="....." name="confirmpass" required>
                    </label>
                    <small>make sure passwords are same to avoid any error!</small>
                
            </fieldset>

            <label for="sub"> <b>CLICK TO SUBMIT</b></label>
            <input type="submit" value="submit" id="sub" name="sub">
        </form>       
        
    
    </main>
    
</body>
</html>

