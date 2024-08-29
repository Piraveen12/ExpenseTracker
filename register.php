<?php
$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$c_pass=$_POST['c_pass'];
$submit=$_POST['submit'];

if (!empty($name) || !empty($email) || !empty($pass) || !empty($c_pass) || !empty($submit))
{
$host = "localhost";
$dbUsername = "root";
$dbPassword ="";
$dbname="register";

$conn = new mysqli($host, $dbUsername, $dbPassword , $dbname);
if (mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
}
else{
    $SELECT = "SELECT email From register Where email = ? Limit 1";
    $INSERT ="INSERT Into register (name,email,pass,c_pass,submit) values(?, ?, ?, ?, ?)"


    $stmt = conn->prepare($SELECT);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;


    if ($rnum==0){
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssssii", $name, $email, $pass, $c_pass, $submit);
        $stmt->execute();
        echo "New record inserted successfully";
    }
    else{
        echo "Someone already register using this email";
    
    }
    $stmt->close();
    $conn->close();
}
} else {
    echo "All Field are required";
    die();
}

?>