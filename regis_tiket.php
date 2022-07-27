<?php 
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli ('localhost','root','','login_e-tiket');
    if($conn->connect_error){
        die('Connection failed : '.$conn->connect_error);
    }else{
        if($stmt = $conn->prepare("insert into register (email,password)
        value(?,?)")){
        $stmt->bind_param("ss",$email,$password);
        $stmt->execute();
            echo "<script>alert('User berhasil ditambahkan'); window.location='login.html'</script>";
            
        exit;
        }
        
    }
?>