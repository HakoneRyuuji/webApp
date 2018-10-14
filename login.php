<?php
    $username= $_POST['username'];
    $password=$_POST['password'];

 if(!empty($username) ||!empty($password)){
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="datauser";

    //create connection
    $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()){
        die('Connect Error('.mysql_connect_errno().')'.mysqli_connect_error());
    }else{
     
        $query="select * from users where username='$username' and password='$password'";
        $result = mysqli_query($conn,$query);
        if (mysqli_num_rows($result) == 1) {
            //Pass
            echo" connect successful";
            echo "<script> window.open('a.html','_self')</script>";
        } else {
            //Fail
            echo"fail";
        }
    }

}
else{
    echo"All field are required";
    die();
}

?>