<?php
error_reporting(1);
// include "client-voter.php";
include "client-voter.php";

if (!isset($_COOKIE['jwt'])) {
    // Jika tidak ada cookie, redirect ke index.php atau halaman login
    header('location: index.php'); // Sesuaikan dengan halaman login atau index
    exit(); // Pastikan untuk keluar dari skrip setelah melakukan redirect
} else {
    $data = array("jwt" => $_COOKIE['jwt'], "nik" => $_COOKIE['nik'], "domisili" => $_COOKIE['domisili'], "id_voter" => $_COOKIE['id_voter']);
    // var_dump($data['id_voter']);
    $r = $abc->tampil_data($data);

}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="dark:bg-gray-900">

    <?php

    include 'sidebar-voter.php';
    ?>


    <div class="p-6 sm:ml-64 ">
        <br>
        <h3
            class=" text-center mb-4 mt-5 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-2xl dark:text-white">
            Data Pemilih Pilkades</h3>
        <form method="POST" action="proses-voter.php">
            <input type="hidden" name="aksi" value="ubah" />
            <input type="hidden" name="id_voter" value="<?= $r[0]->id_voter ?>" />
            <div class="mb-6">
                <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor NIK</label>
                <input type="number" name="nik" id="nik" disable
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Nomor Induk Kependudukan" value="<?= $r[0]->nik ?>" required />
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                    Lengkap</label>
                <input type="text" name="name" id="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Nama Sesuai KTP" required value="<?= $r[0]->name ?>" />
            </div>
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                    address</label>
                <input type="email" name="email" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="john.doe@company.com" required value="<?= $r[0]->email ?>" />
            </div>

            <label for="domisili" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Domisili</label>
            <input type="text" name="domisili" id="domisili" readonly="true"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="name@mail.com" value="<?= $r[0]->domisili ?>">
                <br>
            <div class="mb-6">
                <label for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="•••••••••" required value="<?= $r[0]->password ?>">
            </div>


            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit
                Data</button>
        </form>


        <!-- content -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

</body>

</html>