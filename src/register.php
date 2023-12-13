<?php

include 'client-voter.php';
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

<body>

    <!-- haedar -->


    <!-- content -->
    <section
        class="min-h-screen relative flex items-center justify-center bg-white dark:bg-gray-900 bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')] dark:bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern-dark.svg')]">
        <div
            class="bg-gradient-to-b from-blue-50 to-transparent dark:from-blue-900 w-full h-full absolute top-0 left-0 z-0">
        </div>

        <div class="py-8 px-4 mx-auto max-w-screen-xl  lg:py-16 z-10 relative">
            <div class="flex items-center justify-center flex-col">
                <!-- Center vertically and display items in columns -->

                <div class="flex items-center mb-3"> <!-- Center horizontally -->
                    <img src="https://upload.wikimedia.org/wikipedia/commons/e/ef/Logo_Kota_Malang_color.png"
                        class="mr-5 h-6 sm:h-9" alt="Flowbite Logo" />
                    <div class="flex flex-col"> <!-- Center horizontally and vertically for the text div -->
                        <span class="text-x4 whitespace-nowrap dark:text-white">Pemerintah</span>
                        <span class="text-x4 font-extrabold whitespace-nowrap dark:text-white">Kota Malang</span>
                    </div>
                </div>


            </div>
            <br>

            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Daftar sebagai pemilih
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="proses-voter.php" method="POST">
                        <input type="hidden" name="aksi" value="tambah" />

                        <div>
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                NIK</label>
                            <input type="number" name="nik" id="nik"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Nomor Induk Kependudukan" required="">
                        </div>
                        <div>
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Lengkap</label>
                            <input type="name" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Nama sesuai KTP" required="">
                        </div>
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@mail.com" required="">
                        </div>
                        <label for="domisili" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Desa
                            Domisili</label>
                        <select name="domisili" id="domisili" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <option  value="Jonggo" >Jonggol</option>
                            <option  value="Sumberslamet">Sumberslamet</option>
                            <option  value="Karangsari">Karangsari</option>
                            <option  value="Jerman">Jerman</option>
                        </select>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required="">
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create
                            an account</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Sudah punya akun ? <a href="login.html"
                                class="font-medium text-blue-600 hover:underline dark:text-blue-500">Login disini</a>
                        </p>

                        
                    </form>
                </div>
            </div>
            <br><br>
            <p class="flex items-center justify-center flex-col text-sm font-light">Sistem Pilkades Online © - 2023 </p>
        </div>



        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

</body>

</html>