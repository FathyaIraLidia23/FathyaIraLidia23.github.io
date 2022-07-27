<?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    $con = new mysqli("localhost","root","","login_e-tiket");
    if($con->connect_error){
        die("Failed to connect : ".$con->connect_error);
    }else{
        $stmt = $con->prepare("select * from register where email = ?");
        $stmt->bind_param("s",$email );
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0){
            $data = $stmt_result->fetch_assoc();
            if( $data['password'] == $password){

                echo "<script>alert('Berhasil Login'); window.location='coba.php'</script>";

                exit; 
            }else{
                echo "<script>alert('Username atau Password yang Anda Masukkan Salah'; window.location='login.html')</script>";
                
            }
        }else{
            echo "<script>alert('Username atau Password yang Anda Masukkan Salah'; window.location='login.html';)</script>";
        }
    }
?>