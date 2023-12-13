<?php
error_reporting(1);
include "client-kpu.php";


if ($_POST['aksi'] == 'login') {
    $data = array(
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "aksi" => $_POST['aksi']
    );

    $data2 = $abc->login($data);

    if ($data2 && isset($data2->jwt)) {
        setcookie('jwt', $data2->jwt, time() + 3600);
   
        setcookie('email', $data2->name, time() + 3600);
        //domisili
        setcookie('name', $data2->domisili, time() + 3600);
        // setcookie('id_voter', $data2->id_voter, time() + 3600);
        
        //print data2
        // var_dump($data2->id_voter);
        header('location:dashboard-kpu.php');
    } else {
        header('location:index.php');
    }
}

elseif ($_POST['aksi'] == 'tambah') {
    
    $data = array(
        "nik" => $_POST['nik'],
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "domisili" => $_POST['domisili'],
        
        "password" => $_POST['password'],
        "aksi" => $_POST['aksi']
    );

    $abc->tambah_data($data);
    // var_dump($_POST);

    // var_dump($data);
    header('location:index.php');
    
} elseif ($_POST['aksi'] == 'ubah') {
    $data = array(
        "id_voter" => $_POST['id_voter'],
        "nik" => $_POST['nik'],
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "domisili" => $_POST['domisili'],
        "password" => $_POST['password'],
        "aksi" => $_POST['aksi']
    );
    // var_dump($data);
    // var_dump($_POST['password']);
    $abc->ubah_data($data);
    header('location:dashboard-voter.php');
} elseif ($_GET['aksi'] == 'hapus') {
    $data = array(
        "nik" => $_GET['nik'],
        "aksi" => $_GET['aksi']
    );

    $abc->hapus_data($data);
    header('location:dashboard-voter.php');
} elseif ($_GET['aksi'] == 'logout') {
    setcookie('jwt', $data2->jwt, time() - 3600);
    setcookie('nik', $data2->nik, time() - 3600);
    setcookie('name', $data2->name, time() - 3600);
    //domisili
    setcookie('domisili', $data2->domisili, time() - 3600);
    setcookie('id_voter', $data2->id_voter, time() - 3600);
    header('location:index.php');
}
?>
