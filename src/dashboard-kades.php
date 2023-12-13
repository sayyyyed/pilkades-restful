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


       
            <div class="flex items-center justify-center flex-col">
                <!-- Center vertically and display items in columns -->



            </div>

            <div id="voter"
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8 grid gap-4 gap-y-2 text-sm grid-cols-2 lg:grid-cols-2">


                    <div class="w-full sm:w-1/2 p-6 space-y-4 md:space-y-6 sm:p-8">

                        <form class="space-y-4 md:space-y-6" action="proses-kades.php" method="POST">
                            <input type="hidden" name="aksi" value="ubah" />
                            <input type="hidden" name="id_kades" value="<?= $r[0]->id_kades ?>" />
                            <div>
                                <label for="text" 
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                    NIK</label>
                                <input type="text" name="nik" id="nik" readonly="true"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Nomor Induk Kependudukan" required="" value="<?= $r[0]->nik ?>"  >
                            </div>
                            <div>
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Lengkap</label>
                                <input type="nama" name="nama" id="nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Nama sesuai KTP" value="<?= $r[0]->nama ?>" required="">
                            </div>
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="name@mail.com" required="" value="<?= $r[0]->email ?>">
                            </div>
                            
                                <label for="domisili"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Domisili</label>
                                <input type="domisili" name="domisili" id="domisili"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="name@mail.com" readonly="true" value="<?= $r[0]->domisili ?>">
                            <div>
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    value="<?= $r[0]->password ?>">
                            </div>

                            <button type="submit"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ubah Data</button>

                    </div>
                    <div class="ml-4 relative bg-contain bg-center flex flex-col sm:p-8">
                        <h3
                            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Foto Kandidat
                        </h3>
                        <br>
                        <img id="profile-image" name="profile-image"
                            class="w-60 h-60 object-contain items-center rounded-3xl"
                            src=<?= $r[0]->foto ?>
                            alt="">
                        <br>
                        <div>
                            <label for="img" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Online
                                Image</label>
                            <input type="text" name="foto" id="foto"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Masukkan Link Foto" value ="<?= $r[0]->foto ?>" onchange="updateProfileImage()">
                        </div>
                    </div>
                    </form>

                    <script>
                        function updateProfileImage() {
                            const profileImage = document.getElementById('profile-image');
                            const imgInput = document.getElementById('foto');

                            if (imgInput.value.trim() !== '') {
                                // Update the profile image source with the URL from the input
                                profileImage.src = imgInput.value.trim();
                            }
                        }
                    </script>


                </div>
            </div>
            <br><br>
            <p class="text-white flex items-center justify-center flex-col text-sm font-light">Sistem Pilkades Online © - 2023 </p>
        



    </div>
    <!-- content -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

</body>

</html>