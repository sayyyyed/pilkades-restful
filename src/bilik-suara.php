<?php
error_reporting(1);
// include "client-voter.php";
include "client-kades.php";
if (!isset($_COOKIE['jwt'])) {
    // Jika tidak ada cookie, redirect ke index.php atau halaman login
    header('location: index.php'); // Sesuaikan dengan halaman login atau index
    exit(); // Pastikan untuk keluar dari skrip setelah melakukan redirect
} else {
    $data = array("jwt" => $_COOKIE['jwt'], "nik" => $_COOKIE['nik'], "domisili" => $_COOKIE['domisili'],"id_voter"=> $_COOKIE['id_voter']);
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

    include 'sidebar-voter.php';
    ?>


    <div class="p-8 sm:ml-64 ">
        <br><br>
        <h3
            class=" text-center mb-4 mt-5 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-2xl dark:text-white">
            Pilih Calon Kepala Desa Sesuka Anda</h3>

    <br>
        

            <!-- here -->
            <?php
$no = 1;
$data2 = $abc->cek_suara($data);

if ($data2) {
    
    $data3 = $abc->tampil_data_kades_id($data2);
    
    $nama = $data3[0]->nama;
    $domisili = $data3[0]->domisili;
    $foto = $data3[0]->foto;
    //id kades
    $id_kades = $data3[0]->id_kades;
    // var_dump($data3[0]->nama);
    // The query returned results
    // Process $data2 as needed
    
        ?>
         <form action="proses-kades.php" method="POST"> 
        <ul class="grid w-full gap-6 md:grid-cols-3" id="techList">
        <li>
        <input type="checkbox" id="react-option" value="React" class="hidden peer">
        <label for="react-option"
            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-blue-800">
            <div class="flex items-center">
                <img class="w-20 rounded-lg sm:rounded-none sm:rounded-l-lg mr-5"
                    src="<?= $foto ?>"
                    alt="">
                <div>
                    <div class="w-full text-2xl font-semibold"><?= $nama ?> </div>
                    <div class="w-full text-sm">Calon Kades <?= $domisili ?></div>
                </div>

            </div>
        </label>
        </ul>
    </li>
    <br><br><br>
    <h3
            class="mb-4 mt-5 text-lg tracking-tight leading-none text-gray-900 md:text-1xl lg:text-1xl dark:text-white">
            Anda sudah memilih <?= $nama ?></h3>
            <!-- input hidden -->
            <form action="proses-kades.php" method="POST"> 
            <input type="hidden" name="aksi" value="batal" />
            <input type="hidden" name="nik"id="nik" value="<?=$data['nik']?>"/>
                   
                    
            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Batalkan Pilihan</button>
            </form>  
    <?php
    }
else {
    // The query did not return any results
    $no = 1;
                    $data4 = $abc->tampil_data_kades($data);

                //    var_dump($data4);
                   
    ?>
    
    <ul class="grid w-full gap-6 md:grid-cols-3" id="techList">
        <?php
    foreach ($data4 as $r) {?>
    <li>
        <form action="proses-kades.php" method="POST">
        <input type="checkbox" id="<?= $r->id_kades ?>" value="<?= $r->id_kades ?>" class="hidden peer" name="checkboxName">
        <label for=<?= $r->id_kades ?>
            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 peer-checked:bg-blue-600 hover:text-white-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-blue-800">
            <div class="flex items-center">
                <img class="w-28 h-28 rounded-lg sm:rounded-none sm:rounded-l-lg mr-5"
                    src=<?= $r->foto ?>
                    alt="">
                <div>
                    <div class="w-full text-2xl font-semibold"><?= $r->nama ?> </div>
                    <div class="w-full text-sm">Calon Kades <?= $r->domisili ?></div>
                    <input type="hidden" name="aksi" value="pilih" />
                    <input type="hidden" name="nik"id="nik" value="<?=$data['nik']?>"/>
                    <input type="hidden" name="id_voter"id="id_voter" value="<?=$data['id_voter'] ?>"/>
                    <input type="hidden" name="id_kades"id="id_kades" value="<?= $r->id_kades ?>"/>
                    <input type="hidden" name="domisili"id="domisili" value="<?= $r->domisili ?>"/>
                    
                    <br>
                    <button type="submit"
            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Pilih Kades
            </button>



                </div>

            </div>
        </label>
        </form>  
    </li>
    <?php   } ?>
    </ul>
    <br><br>
      
  
  
    <?php
        $no++;
                  
}
?>
         
           


        
     
</div>

        <script>
            // Get all checkboxes and add event listener
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    // Unselect other checkboxes
                    checkboxes.forEach(otherCheckbox => {
                        if (otherCheckbox !== this) {
                            otherCheckbox.checked = false;
                        }
                    });
                });
            });
        </script>

        </ul>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

</body>

</html>