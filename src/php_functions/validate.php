<?php
    $host = '127.0.0.1';
    $s_user = 'root';
    $s_password = 'root';
    $s_database = 'web_dev';
    $conn = new mysqli($host,$s_user,$s_password,$s_database);
    
    function user_exist($user,$table,$conn){
        if ($conn->connect_error){
            die("Connection Error: " .$conn->connect_error);
        }
        $query = "SELECT * FROM $table WHERE Username = '$user'";
        $result = $conn->query($query);
        if ($result->num_rows > 0){
            $user_exist = true;
        }else{
            $user_exist = false;
        }
        return $user_exist;
    }
?>