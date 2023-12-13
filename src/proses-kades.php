<?php
include "client-kades.php";
// IF POST AKSI 'pilih'
if ($_POST['aksi'] == 'login') {
    $data = array(
        "nik" => $_POST['nik'],
        "password" => $_POST['password'],
        "aksi" => $_POST['aksi']
    );

    $data2 = $abc->login($data);

    if ($data2 && isset($data2->jwt)) {
        setcookie('jwt', $data2->jwt, time() + 3600);
        setcookie('nik', $data2->nik, time() + 3600);
        setcookie('name', $data2->name, time() + 3600);
        //domisili
        // setcookie('domisili', $data2->domisili, time() + 3600);
        setcookie('id_kades', $data2->id_kades, time() + 3600);
        
        //print data2
        // var_dump($data);
        header('location:dashboard-kades.php');
    } else {
        header('location:login-kades.php');
    }
}
elseif ($_POST['aksi'] == 'pilih') {
    // var_dump($_POST);
    
    $data = array(
        "nik" => $_POST['nik'],
        "id_voter" => $_POST['id_voter'],
        "id_kades" => $_POST['id_kades'],
       "domisili"=> $_POST['domisili'],
       //aksi
       'aksi'=> $_POST['aksi'],
        
    );

    $abc->pilih_kades($data);
    header('location:bilik-suara.php');
    // var_dump($abc);
}

elseif ($_POST['aksi'] == 'batal') {
    // var_dump($_POST);
    
    $data = array(
        "nik" => $_POST['nik'],
        
       'aksi'=> $_POST['aksi'],
        
    );

    $abc->hapus_kades($data);
    header('location:bilik-suara.php');
    
}

elseif ($_POST['aksi'] == 'tambah') {
    
    $data = array(
        "nik" => $_POST['nik'],
        "nama" => $_POST['nama'],
        "email" => $_POST['email'],
        "domisili" => $_POST['domisili'],
        
        "password" => $_POST['password'],
        "aksi" => $_POST['aksi'],
        "foto" => $_POST['foto']
    );

    $abc->tambah_data_kades($data);
    // var_dump($_POST);

    // var_dump($data);
    header('location:index.php');
    
}
elseif ($_POST['aksi'] == 'ubah') {
    $data = array(
        "id_kades" => $_POST['id_kades'],
        "nik" => $_POST['nik'],
        "nama" => $_POST['nama'],
        "email" => $_POST['email'],
        "domisili" => $_POST['domisili'],
        "password" => $_POST['password'],
        "foto" => $_POST['foto'],
        "aksi" => $_POST['aksi']
    );

    // var_dump($_POST['password']);
    $abc->ubah_data($data);
//    var_dump($data);

    header('location:dashboard-kades.php');
}

elseif ($_POST['aksi'] == 'misi') {
    $data = array(
        "id_kades" => $_POST['id_kades'],
        "visi" => $_POST['visi'],
        "aksi" => $_POST['aksi'],
        
    );

    // var_dump($_POST['password']);
    $abc->visi_kades($data);
//    var_dump($data);

    header('location:visi-kades.php');
}

elseif ($_GET['aksi'] == 'logout') {
    setcookie('jwt', $data2->jwt, time() - 3600);
    setcookie('nik', $data2->nik, time() - 3600);
    setcookie('name', $data2->name, time() - 3600);
    //domisili
    // setcookie('domisili', $data2->domisili, time() + 3600);
    setcookie('id_kades', $data2->id_kades, time() - 3600);
    header('location:index.php');
}