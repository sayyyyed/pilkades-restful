<?php
error_reporting(1);

include_once 'core.php';
// require __DIR__ . '/vendor/autoload.php';
include_once 'lib/part2/BeforeValidException.php';
include_once 'lib/part2/src/ExpiredException.php';
include_once 'lib/part2/src/SignatureInvalidException.php';
include_once 'lib/part2/JWT.php';
include_once 'lib/part2/JWK.php';

use Firebase\JWT\JWT;

include_once "Database.php";

$abc = new Database();

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Content-Type: application/json; charset=UTF-8");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 3600'); // cache selama 1 jam
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET,POST,OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

$postdata = file_get_contents("php://input");
$data = json_decode($postdata);

function filter($data)
{
    $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
    return $data;
    unset($data);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' and $data->aksi == 'tambah') {
    // CREATE TABLE cakades (
    //     id_kades VARCHAR(255) PRIMARY KEY,
    //     email VARCHAR(255),
    //     nik VARCHAR(255),
    //     nama VARCHAR(255),
    //     domisili VARCHAR(255),
    //     password VARCHAR(255),
    //     visi VARCHAR(255), -- Sesuaikan dengan tipe data yang mendukung teks panjang (misalnya TEXT, LONGTEXT, dll.)
    //     foto VARCHAR(255)
    //    
    //     FOREIGN KEY (domisili) REFERENCES desa(domisili)
    // );


    // $jwt = $data->jwt;
    $aksi = $data->aksi;
    // $id_voter = $data->id_voter;
    
    $nik = $data->nik;
    $nama = $data->nama;
    $email = $data->email;
    $domisili = $data->domisili;
    $password = $data->password;
    $foto = $data->foto;


    // decode jwt
    try {
        // JWT::decode($jwt, $key, array('HS256'));

        // Inisialisasi objek untuk interaksi dengan database (misalnya $abc)
        // Pastikan untuk mengganti $abc dengan objek yang sesuai dengan implementasi Anda

        if ($aksi == 'tambah') {
            $data2 = array(
                'aksi' => $aksi,
                // 'id_voter' => $id_voter,
               
                'nik' => $nik,
                'nama' => $nama,
                'email' => $email,
                'domisili' => $domisili,
                'password' => $password,
                'foto' => $foto


            );
            $abc->tambah_data_kades($data2);
        } 
        // set response code
        http_response_code(200);
        echo json_encode($data2);

        // jika decode gagal, berarti jwt tidak valid
    } catch (Exception $e) {
        // set response code
        http_response_code(401);
        echo json_encode(
            array(
                "message" => "Access denied"
            )
        );
    }
}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST' and $data->aksi == 'pilih') {

    $aksi = $data->aksi;
    $nik = $data->nik;
    $id_voter = $data->id_voter;
    $id_kades = $data->id_kades;
    $domisili = $data->domisili;
    

    try {
        // JWT::decode($jwt, $key, array('HS256'));

        // Inisialisasi objek untuk interaksi dengan database (misalnya $abc)
        // Pastikan untuk mengganti $abc dengan objek yang sesuai dengan implementasi Anda

        if ($aksi == 'pilih') {
            $data2 = array(
                'aksi' => $aksi,
                // 'id_voter' => $id_voter,
               
                'nik' => $nik,
                'id_voter' => $id_voter,
                'id_kades' => $id_kades,
                'domisili' => $domisili,
                
            );
            $abc->pilih_kades($data2);
           
        }
        
        // set response code
        http_response_code(200);
        echo json_encode($data2);

        

        // jika decode gagal, berarti jwt tidak valid
    } catch (Exception $e) {
        // set response code
        http_response_code(401);
        echo json_encode(
            array(
                "message" => "Access denied"
            )
        );
    }

}
elseif ($_SERVER['REQUEST_METHOD'] == 'POST' and $data->aksi == 'batal') {

    $aksi = $data->aksi;
    $nik = $data->nik;
    // var_dump($nik);
    

    try {
        // JWT::decode($jwt, $key, array('HS256'));

        // Inisialisasi objek untuk interaksi dengan database (misalnya $abc)
        // Pastikan untuk mengganti $abc dengan objek yang sesuai dengan implementasi Anda

        if ($aksi == 'batal') {
            $data2 = array(
                'aksi' => $aksi,
                // 'id_voter' => $id_voter,
               
                'nik' => $nik,
                
                
            );
            $abc->hapus_kades($data2);
            
           
        }
        
        // set response code
        http_response_code(200);
        echo json_encode($data2);

        

        // jika decode gagal, berarti jwt tidak valid
    } catch (Exception $e) {
        // set response code
        http_response_code(401);
        echo json_encode(
            array(
                "message" => "Access denied"
            )
        );
    }

}

elseif ($_SERVER['REQUEST_METHOD'] == 'POST' and $data->aksi == 'ubah') {
  
    $aksi = $data->aksi;
    $id_kades = $data->id_kades;
    $nik = $data->nik;
    $nama = $data->nama;
    $email = $data->email;
    $domisili = $data->domisili;
    $foto = $data->foto;
    $password = $data->password;
    // var_dump($data);

    try {
       

        if ($aksi == 'ubah') {
            $data2 = array(
                'aksi' => $aksi,
                'id_kades' => $id_kades,
                'nik' => $nik,
                'nama' => $nama,
                'email' => $email,
                'domisili' => $domisili,
                'foto' => $foto,
                'password' => $password
            );
            $abc->ubah_data_kades($data2);
            var_dump($abc);
        } 
 
        http_response_code(200);
        echo json_encode($data2);

   
    } catch (Exception $e) {

        http_response_code(401);
        echo json_encode(
            array(
                "message" => "Accesssss denied"
            )
        );
    }
}

elseif ($_SERVER['REQUEST_METHOD'] == 'POST' and $data->aksi == 'misi') {
  
    $aksi = $data->aksi;
    $id_kades = $data->id_kades;
    $visi = $data->visi;
   
    // var_dump($data);

    try {
       

        if ($aksi == 'misi') {
            $data2 = array(
                'aksi' => $aksi,
                'id_kades' => $id_kades,
                'visi' => $visi,
                
            );
            $abc->visi_kades($data2);
            var_dump($abc);
        } 
 
        http_response_code(200);
        echo json_encode($data2);

   
    } catch (Exception $e) {

        http_response_code(401);
        echo json_encode(
            array(
                "message" => "Accesssss denied"
            )
        );
    }
} 

elseif ($_SERVER['REQUEST_METHOD'] == 'GET' and ($_GET['aksi']=='cek') ) {
    // $jwt = $data->jwt;
    $aksi = $data->aksi;
    // $id_voter = $data->id_voter;
    $nik = $data->nik;
    
    try {
        if ($_GET['aksi'] == 'cek' && isset($_GET['nik'])) {
            $nik = filter($_GET['nik']);
            $data = $abc->cek_suara($nik);
            // var_dump($data);
        }
        http_response_code(200);
        echo json_encode($data);

}

    //catch
    catch (Exception $e) {
        // set response code
        http_response_code(401);
        echo json_encode(
            array(
                "message" => "Access denied"
            )
        );
    }
} 
elseif ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($data->nik) and isset($data->password)) {
    $data2['nik'] = $data->nik;
    $data2['password'] = $data->password;
    $data2['id_kades'] = $data->id_voter;




    $data3 = $abc->login_kades($data2);

    // cek login pengguna
    if ($data3) {
        // generate json web token (jwt)
        $token = array(
            "iat" => $issued_at,
            "exp" => $expiration_time,
            "iss" => $issuer,
            "data" => array(
                "nik" => $data2['nik'],
                "password" => $data3['password'],
                "id_kades" => $data3['id_kades']


            )
        );
        // set response code
        http_response_code(200);
        // generate jwt
        $jwt = JWT::encode($token, $key);
        echo json_encode(
            array(
                "message" => "Login sukses",
                "nik" => $data2['nik'],
                "password" => $data3['password'],
                "id_kades" => $data3['id_kades'],

                "jwt" => $jwt
            )
        );
    } else { // login gagal 
        // set response code
        http_response_code(401);
        echo json_encode(array("message" => "Login gagal"));
    }
}
//create get
elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // $jwt = $_GET['jwt'];

    try {
        // decode jwt
        // $decoded = JWT::decode($jwt, $key, array('HS256'));

        if ($_GET['aksi'] == 'tampil' && isset($_GET['domisili'])) {
            $domisili = filter($_GET['domisili']);
            $data = $abc->tampil_kades_dom($domisili);
        }
        
        elseif ($_GET['aksi'] == 'tampil-id' && isset($_GET['id_kades'])) {
            $id_kades = filter($_GET['id_kades']);
           
            $data = $abc->tampil_kades_id($id_kades);
        }
        elseif ($_GET['aksi'] == 'tampil-id2' && isset($_GET['id_kades'])) {
            $id_kades = filter($_GET['id_kades']);
           
            $data = $abc->tampil_kades_id($id_kades);
        }
        else {
            // menampilkan semua data
            $data = $abc->tampil_semua_data_kades();
            // set response code

        }
        http_response_code(200);
        echo json_encode($data);

    } catch (Exception $e) {
        // set response code
        http_response_code(401);

        echo json_encode(array("message" => "2 Access denied"));
    }
} else { // error jika tanpa jwt
    // set response code
    http_response_code(401);
    echo json_encode(array("message" => "Access denied"));
}
unset($abc, $postdata, $data, $data2, $token, $key, $issued_at, $expiration_time, $issuer, $jwt, $decoded, $nik, $name, $aksi, $e);
?>