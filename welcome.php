<?php
session_start();
if (!isset($_SESSION["logedin"]) || $_SESSION['logedin'] != true) {
    header('location:login.php');
    exit();
}

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'userinfotech';
$conn = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_error()) {
    die('Connection Error: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['emailid'];
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $introduction = $_POST['summary'];
    $education_field = $_POST['num'];
    $pg_start = $_POST['pg_start_date'] ?? '';
    $pg_end = $_POST['pg_end_date'] ?? '';
    $pg_institution = $_POST['pg_institution'] ?? '';
    $pg_description = $_POST['pg_description'] ?? '';
    $ug_start = $_POST['ug_start_date'] ?? '';
    $ug_end = $_POST['ug_end_date'] ?? '';
    $ug_institution = $_POST['ug_institution'] ?? '';
    $ug_description = $_POST['ug_description'] ?? '';
    $twelfth_start = $_POST['12th_start_date'] ?? '';
    $twelfth_end = $_POST['12th_end_date'] ?? '';
    $twelfth_institution = $_POST['12th_institution'] ?? '';
    $twelfth_description = $_POST['12th_description'] ?? '';
    $tenth_start = $_POST['10th_start_date'] ?? '';
    $tenth_end = $_POST['10th_end_date'] ?? '';
    $tenth_institution = $_POST['10th_institution'] ?? '';
    $tenth_description = $_POST['10th_description'] ?? '';
    $other_start = $_POST['other_start_date'] ?? '';
    $other_end = $_POST['other_end_date'] ?? '';
    $other_institution = $_POST['other_institution'] ?? '';
    $other_description = $_POST['other_description'] ?? '';
    $certificate = $_POST['numm'];

    $sql = "INSERT INTO `userresumeinfo` (`emailid`, `phone`, `name`, `introduction`, `education_field`, 
            `pg_start`, `pg_end`, `pg_institution`, `pg_description`, 
            `ug_start`, `ug_end`, `ug_institution`, `ug_description`, 
            `12th_start`, `12th_end`, `12th_institution`, `12th_description`, 
            `10th_start`, `10th_end`, `10th_institution`, `10th_description`, 
            `other_start`, `other_end`, `other_institution`, `other_description`, 
            `certification`) 
            VALUES ('$email', '$phone', '$name', '$introduction', '$education_field', 
                    '$pg_start', '$pg_end', '$pg_institution', '$pg_description', 
                    '$ug_start', '$ug_end', '$ug_institution', '$ug_description', 
                    '$twelfth_start', '$twelfth_end', '$twelfth_institution', '$twelfth_description', 
                    '$tenth_start', '$tenth_end', '$tenth_institution', '$tenth_description', 
                    '$other_start', '$other_end', '$other_institution', '$other_description', 
                    '$certificate')";
    
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "data saved";
    } else {
        die("not saved: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="welcome.css">
    <title>Welcome to Resume Builder</title>
</head>
<body>
<header class="headclass">
    <nav class="navbar">
        <a href="homepage.php" class="headeranchor" target="_blank"><strong>HOME</strong></a>
        <a href="newregistration.php" class="headeranchor" target="_blank">New Registration</a>
        <a href="login.php" class="headeranchor" target="_blank">Login</a>
        <a href="welcome.php" class="headeranchor" target="_main">My Account</a>
    </nav>
    <input type="text" placeholder="Search" id="search" name="search">
</header>
<main>
    <div class="user">
        <?php
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
            echo "<b>Hello, </b>" . $_SESSION['username'] . "!<h3> WELCOME TO <strong>Resume Builder</strong></h3>";
        }
        ?>
    </div>
    <br>
    <div class="head">
        <h1>ENTER DETAILS TO BE FILLED ON YOUR RESUME</h1>
    </div>

    <div class="formset">
    <form action="welcome.php" method="post">
        <label for="emailid">ENTER EMAIL ID <br></label>
        <input type="email" id="emailid" name="emailid" placeholder="xyx@gmail.com" required>
        <br><hr><br>
        <label for="phone">ENTER PHONE NUMBER <br></label>
        <input type="text" id="phone" name="phone" placeholder="123xxxxx90" minlength="10" maxlength="10" required>
        <br><hr><br>
        <label for="name">ENTER NAME <br></label>
        <input type="text" id="name" name="name" required>
        <br><hr><br>
        <label for="summary">Enter a brief introduction about you <br></label>
        <textarea placeholder="Enter something about you in maximum 500 words" rows="6" cols="70" id="summary" name="summary" maxlength="500"></textarea>
        <br><hr><br>
        <label for="num">ENTER THE NUMBER OF EDUCATION FIELDS YOU WANT TO ADD <br></label>
        <input type="number" min="0" max="5" id="num" name="num" required>
        <br><hr><br>
        <label for="edu">ENTER EDUCATION <br></label>
        <small><strong>The same format will be copied to your resume</strong></small><br>
        <select id="edu" name="edu">
            <option value="select">Select</option>
            <option value="pg">Post-Graduation</option>
            <option value="ug">Under-Graduation</option>
            <option value="12th">12th</option>
            <option value="10th">10th</option>
            <option value="other">Other</option>
        </select>
        <br><hr><br>
        <label for="skills">Enter your technical skills</label><small> separated by commas</small><br>
        <input type="text" id="skills" placeholder="C, C++, Python ....." name="skills" required>
        <br><hr><br>
        <label for="numm">Enter your certifications</label><br>
        <small><strong>The same format will be copied to your resume</strong></small><br>
        <textarea id="numm" name="numm" maxlength="255" rows="6" cols="80" placeholder="Enter certificates accordingly"></textarea>
        <br><hr><br>
        <label for="sub" id="subb"><b>CLICK TO SUBMIT</b></label>
        <input type="submit" value="Submit" id="sub" name="sub" class="enter">
    </form>
    </div>
</main>
<script>
    let education = document.getElementById("edu");
    let counter=0;
    let times=document.getElementById("num");
    let count=parseInt(times.value);
   
   
    education.addEventListener("change", function () {
    
        if (education.value !== "select") {

            let eduFieldsContainer = document.createElement("div");

            let labelStartDate = document.createElement("label");
            labelStartDate.innerHTML = "Start Date: ";
            eduFieldsContainer.appendChild(labelStartDate);

            let startDate = document.createElement("input");
            startDate.setAttribute("type", "date");
            startDate.setAttribute("name", education.value + "_start_date");
            eduFieldsContainer.appendChild(startDate);
            eduFieldsContainer.appendChild(document.createElement("br"));

            let labelEndDate = document.createElement("label");
            labelEndDate.innerHTML = "End Date: ";
            eduFieldsContainer.appendChild(labelEndDate);

            let endDate = document.createElement("input");
            endDate.setAttribute("type", "date");
            endDate.setAttribute("name", education.value + "_end_date");
            eduFieldsContainer.appendChild(endDate);
            eduFieldsContainer.appendChild(document.createElement("br"));

            let labelInstitution = document.createElement("label");
            labelInstitution.innerHTML = "Institution Name: ";
            eduFieldsContainer.appendChild(labelInstitution);

            let institutionName = document.createElement("input");
            institutionName.setAttribute("type", "text");
            institutionName.setAttribute("name", education.value + "_institution");
            eduFieldsContainer.appendChild(institutionName);
            eduFieldsContainer.appendChild(document.createElement("br"));

            let labelDescription = document.createElement("label");
            labelDescription.innerHTML = "Description: ";
            eduFieldsContainer.appendChild(labelDescription);

            let description = document.createElement("textarea");
            description.setAttribute("name", education.value + "_description");
            description.setAttribute("rows", "5");
            description.setAttribute("maxlength", "255");
            description.setAttribute("cols", "30");
            eduFieldsContainer.appendChild(description);

            education.after(document.createElement("br"));
            education.after(eduFieldsContainer);
        }
    });
    counter++;
</script>
</body>
</html>
