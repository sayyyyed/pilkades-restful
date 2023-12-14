<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
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
<body>

    <!-- haedar -->

    <?php
include "E:\PROJECT LAWRENCE\pilkades-restful\kpu\client-kpu-login.php";
$data2 = $abc->tampil_semua_jadwal($data);
$dbTimestampkades = strtotime($data2[0]->tanggal);
$dbTimestampmulai = strtotime($data2[1]->tanggal);
$dbTimestampstop = strtotime($data2[2]->tanggal);

// echo $dbTimestampkades;
// echo $dbTimestampmulai;
// echo $dbTimestampstop;

    // Get the current timestamp
    $currentTimestamp = time();

    // Compare the timestamps
    // if ($currentTimestamp < $dbTimestamp) {
       
    // } else {
        
    // }

    

        ?>
    <!-- content -->
    <section class="h-screen relative flex items-center justify-center bg-white dark:bg-gray-900 bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')] dark:bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern-dark.svg')]">
        <div class="bg-gradient-to-b from-blue-50 to-transparent dark:from-blue-900 w-full h-full absolute top-0 left-0 z-0"></div>
    
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 z-10 relative">
            <?php
             if ($dbTimestampkades > $currentTimestamp) {
                
                ?>
                <a href="register-kades.php" class="inline-flex justify-between items-center py-1 px-1 pe-4 mb-7 text-sm text-blue-700 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-800">
                <span class="text-xs bg-blue-600 rounded-full text-white px-4 py-1.5 me-3">Telah dibuka</span>
                <span class="text-sm font-medium">Pendaftaran Kepala Desa</span>
                <svg class="w-2.5 h-2.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
            </a>
            <?php
             }
            ?>
                
            

            <a href="login-kades.php" class="inline-flex justify-between items-center py-1 px-1 pe-4 mb-7 text-sm text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300 hover:bg-green-200 dark:hover:bg-green-800">
                <span class="text-xs bg-green-600 rounded-full text-white px-4 py-1.5 me-3">Login</span>
                <span class="text-sm font-medium">Bakal Calon Kepala Desa</span>
                <svg class="w-2.5 h-2.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
            </a>
            
            
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Pilkades Online Kecamatan Istanbul</h1>
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-200">Situs ini digunakan sebagai sarana pengganti TPS. Menghemat Anggaran plus mewujudkan pemilu yang Langsung, Umum, Berdaulat, Jujur, dan Adil untuk desa</p>
            <div class="flex flex-wrap items-center justify-center"> <!-- Assuming the parent container is a flex container and buttons are meant to be horizontally aligned -->
                
                    <?php
             if ($dbTimestampstop > $currentTimestamp && $dbTimestampmulai < $currentTimestamp) {
                
                ?>
                <a href="login.php" class="mr-5 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
                    Masuk Akun Pemilih
            <?php
             }
            ?>
                <a href="register.php" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                   Daftar Sekarang
                    
                </a>
            </div>
            
            <br><br><br><br>
            <div class="flex items-center justify-center flex-col"> <!-- Center vertically and display items in columns -->
                <div class="flex items-center mb-3"> <!-- Center horizontally -->
                    <img src="https://upload.wikimedia.org/wikipedia/commons/e/ef/Logo_Kota_Malang_color.png" class="mr-5 h-6 sm:h-9" alt="Flowbite Logo" />
                    <div class="flex flex-col"> <!-- Center horizontally and vertically for the text div -->
                        <span class="text-x4 whitespace-nowrap dark:text-white">Pemerintah</span>
                        <span class="text-x4 font-extrabold whitespace-nowrap dark:text-white">Kota Malang</span>
                    </div>
                </div>
            
                
            </div>
            
            
            
        </div>
    </section>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
   
</body>
</html>