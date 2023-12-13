<?php
error_reporting(1);
// include "client-voter.php";
// include src/client-kades.php;
include "client-kpu.php";

if (!isset($_COOKIE['jwt'])) {
    // Jika tidak ada cookie, redirect ke index.php atau halaman login
    header('location: index.php'); // Sesuaikan dengan halaman login atau index
    exit(); // Pastikan untuk keluar dari skrip setelah melakukan redirect
} else {
    $data = array("jwt" => $_COOKIE['jwt'], "email" => $_COOKIE['email'],"name"=> $_COOKIE['name'], "aksi" => "tampil-kades");
    // var_dump($data['id_voter']);
    // $r = $abc->tampil_data($data);
    
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
    include "sidebar-kpu.php";
    ?>
    <div class="p-6 sm:ml-64 ">
        <br><br>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Calon Kades Kita</h2>
                    <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Mewujudkan Desa-desa di Kecamatan Istanbul, menjadi Baldatun Toyibatun Wa Robbun GoFood</p>
                </div>

                <div class="grid justify-items-center gap-8 mb-6 lg:mb-16 md:grid-cols-2">

                    <?php
                    $no = 1;
                    $data2 = $abc->tampil_semua_data_kades($data);
                //    var_dump($data2);
                    foreach ($data2 as $r) {
                    ?>
                        <div id="paslon<?= $no ?>" class="w-96 h-full items-center bg-gray-50 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <h4 class="text-center mb-4 mt-5 font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-2xl dark:text-white">
                                Calon Kades No.<?= $no ?>
                            </h4>
                            <a href="#">
                                <img class="w-96 h-96 rounded-lg sm:rounded-none sm:rounded-l-lg" src="<?= $r->foto ?>" alt="Bonnie Avatar">
                            </a>
                            <div class="p-5">
                                <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    <a href="#"><?= $r->nama ?> - <?= $r->domisili ?></a>
                                </h3>
                                <span class="text-gray-500 dark:text-gray-400"><?= $r->name?></span>
                                <p class="mt-3 mb-4 font-light text-gray-500 dark:text-gray-400"><?= $r->visi ?></p>
                            </div>
                        </div>
                    <?php
                        $no++;
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

</body>
</html>