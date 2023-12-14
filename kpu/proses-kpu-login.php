<?php
error_reporting(1);
include "client-kpu-login.php";

if ($_POST['aksi'] == 'login') {
    $data = array(
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "aksi" => $_POST['aksi']
    );

    $data2 = $abc->login($data);
//    var_dump($abc);
    if ($data2) {
        // setcookie('jwt', $data2->jwt, time() + 3600);
   
        setcookie('email', $data2->name, time() + 3600);
        //domisili
        setcookie('name', $data2->domisili, time() + 3600);
        // setcookie('id_voter', $data2->id_voter, time() + 3600);

        //create session
        session_start();
        $_SESSION['email'] = $data2->email;
        $_SESSION['name'] = $data2->name;
        // $_SESSION['domisili'] = $data2->domisili;
        
        //print data2
        // var_dump($data2->id_voter);
        header('location:dashboard-kpu.php');
    } 
    elseif($_POST['aksi'] == 'edit-jadwal'){

        $data = array(
          
            "masa" => $_POST['waktu'],
            "tanggal" => $_POST['aksi']
        );
        // $data2 = $abc->edit_jadwal($data);
       
        var_dump($data2);
            // header('location:lihat-jadwal.php');
        


    }
    
    else {
        header('location:index.php');
    }
}
?>
