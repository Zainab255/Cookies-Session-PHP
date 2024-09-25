<?php
    if(isset($_POST['login'])){
         
        session_start();
        include('conn.php');

        $db_name = 'session';
     
        $username=$_POST['username'];
        $password=$_POST['password'];
     
        $query=mysqli_query($conn,"select * from user where user_name='$username' && user_password='$password'");
     
        if (mysqli_num_rows($query) == 0){
            $_SESSION['message']="Login Failed. User not Found!";
            header('location:index.php');
        }
        else{
            $row=mysqli_fetch_array($query);
             
            if (isset($_POST['remember'])){
                //set up cookie
                setcookie("user", $row['user_name'], time() + (86400 * 30)); 
                setcookie("pass", $row['user_password'], time() + (86400 * 30)); 
            }
             
            $_SESSION['id']=$row['user_id'];
            header('location:success.php');
        }
    }
    else{
        header('location:index.php');
        $_SESSION['message']="Please Login!";
    }
?>