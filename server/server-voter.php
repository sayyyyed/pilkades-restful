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
    // $jwt = $data->jwt;
    $aksi = $data->aksi;
    // $id_voter = $data->id_voter;
    $nik = $data->nik;
    $name = $data->name;
    $email = $data->email;
    $domisili = $data->domisili;
    $password = $data->password;


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
                'name' => $name,
                'email' => $email,
                'domisili' => $domisili,
                'password' => $password
            );
            $abc->tambah_data_voter($data2);
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
    // $jwt = $data->jwt;
    $aksi = $data->aksi;
    $id_voter = $data->id_voter;
    $nik = $data->nik;
    $name = $data->name;
    $email = $data->email;
    $domisili = $data->domisili;
    $password = $data->password;

    // decode jwt
    try {
        // JWT::decode($jwt, $key, array('HS256'));

        // Inisialisasi objek untuk interaksi dengan database (misalnya $abc)
        // Pastikan untuk mengganti $abc dengan objek yang sesuai dengan implementasi Anda

        if ($aksi == 'ubah') {
            $data2 = array(
                'aksi' => $aksi,
                'id_voter' => $id_voter,
                'nik' => $nik,
                'name' => $name,
                'email' => $email,
                'domisili' => $domisili,
                'password' => $password
            );
            $abc->ubah_data_voter($data2);
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
elseif ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($data->nik) and isset($data->password)) {
    $data2['nik'] = $data->nik;
    $data2['password'] = $data->password;
    $data2['id_voter'] = $data->id_voter;
    $data2['domisili'] = $data->domisili;





    $data3 = $abc->login($data2);

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
                "domisili" => $data3['domisili'],
                "id_voter" => $data3['id_voter']


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
                "domisili" => $data3['domisili'],

                "id_voter" => $data3['id_voter'],

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
    $jwt = $_GET['jwt'];

    try {
        // decode jwt
        $decoded = JWT::decode($jwt, $key, array('HS256'));

        if ($_GET['aksi'] == 'tampil' && isset($_GET['nik'])) {
            $nik = filter($_GET['nik']);
            $data = $abc->tampil_voter($nik);
        } else {
            // menampilkan semua data
            $data = $abc->tampil_semua_voter();
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