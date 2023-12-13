<?php
error_reporting(1);
// include "client-voter.php";
include "client-kades.php";

if (!isset($_COOKIE['jwt'])) {
    // Jika tidak ada cookie, redirect ke index.php atau halaman login
    header('location: index.php'); // Sesuaikan dengan halaman login atau index
    exit(); // Pastikan untuk keluar dari skrip setelah melakukan redirect
} else {
    $data = array("jwt" => $_COOKIE['jwt'], "nik" => $_COOKIE['nik'], "id_kades" => $_COOKIE['id_kades']);

    $r = $abc->tampil_data_kades_id2($data);
    // var_dump($r);
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

    include 'sidebar-kades.php';
    ?>


    <div class="p-6 sm:ml-64 ">
        <br><br>
        <h3
            class=" text-center mb-4 mt-5 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-2xl dark:text-white">
            Data Calon Kepala Desa</h3>
            <br>
        
<form action="proses-kades.php" method="POST">
<input type="hidden" name="aksi" value="misi" />
<input type="hidden" name="id_kades" value="<?= $r[0]->id_kades ?>" />

   <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
       <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
           <label for="visi" class="sr-only">Your comment</label>
           <textarea id="visi" name="visi" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Visi misi..." required><?= $r[0]->visi ?></textarea>
       </div>
       <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
           <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
               Kirim Gagasan Anda
           </button>
           
       </div>
   </div>
</form>
<p class="ms-auto text-xs text-gray-500 dark:text-gray-400">Remember, hindari slogan rasis </p>



    </div>
    <!-- content -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

</body>

</html>