<?php
$username= $_POST['username'];
$password=$_POST['password'];
$email =$_POST['email'];

if(!empty($username) ||!empty($password)||!empty($email)){
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="datausers";

    //create connection
    $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

    if(mysqli_connect_error()){
        die('Connect Error('.mysql_connect_errno().')'.mysqli_connect_error());
    }else{
        $SELECT = "SELECT email From users Where email = ? Limit 1";
        $INSERT = "INSERT Into users (username, password, email) values(?, ?, ?)";
        //Prepare statement
       
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        if ($rnum==0) {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sss", $username, $password, $email);
        $stmt->execute();
        echo "New record inserted sucessfully";
        echo "<script> window.open('you.php','_self')</script>";
        } else {
        echo "Someone already register using this email";
        }
        $stmt->close();
        $conn->close();
    }
    
}else {
    echo"All field are required";
    die();
}







?>