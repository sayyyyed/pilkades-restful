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


if ($_SERVER['REQUEST_METHOD'] == 'GET' and ($_GET['aksi']=='tampil-kades')) {
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
}


elseif ($_SERVER['REQUEST_METHOD'] == 'GET' and ($_GET['aksi']=='tampil-voter')) {
    // $jwt = $_GET['jwt'];

    try {
        // decode jwt
        // $decoded = JWT::decode($jwt, $key, array('HS256'));

        $data = $abc->tampil_semua_voter();
        http_response_code(200);
        echo json_encode($data);

    } catch (Exception $e) {
        // set response code
        http_response_code(401);

        echo json_encode(array("message" => "2 Access denied"));
    }
}
elseif ($_SERVER['REQUEST_METHOD'] == 'GET' and ($_GET['aksi']=='tampil-jadwal')) {
    // $jwt = $_GET['jwt'];

    try {
        // decode jwt
        // $decoded = JWT::decode($jwt, $key, array('HS256'));

        $data = $abc->tampil_semua_jadwal();
        http_response_code(200);
        echo json_encode($data);

    } catch (Exception $e) {
        // set response code
        http_response_code(401);

        echo json_encode(array("message" => "2 Access denied"));
    }
}

elseif ($_SERVER['REQUEST_METHOD'] == 'GET' and ($_GET['aksi']=='hasil')) {
    // $jwt = $_GET['jwt'];

    try {
        // decode jwt
        // $decoded = JWT::decode($jwt, $key, array('HS256'));

        $data = $abc->hasil_pilkades();
        http_response_code(200);
        echo json_encode($data);

    } catch (Exception $e) {
        // set response code
        http_response_code(401);

        echo json_encode(array("message" => "2 Access denied"));
    }
}

//create get SUARA
elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // $jwt = $_GET['jwt'];

    try {
        // decode jwt
        // $decoded = JWT::decode($jwt, $key, array('HS256'));

        if ($_GET['aksi'] == 'tampil' && isset($_GET['nik'])) {
            $nik = filter($_GET['nik']);
            $data = $abc->tampil_suara($nik);
        } else {
            // menampilkan semua data
            $data = $abc->hasil_pilkades();
            // set response code

        }
        http_response_code(200);
        echo json_encode($data);

    } catch (Exception $e) {
        // set response code
        http_response_code(401);

        echo json_encode(array("message" => "2 Access denied"));
    }
}




else { // error jika tanpa jwt
    // set response code
    http_response_code(401);
    echo json_encode(array("message" => "Access denied"));
}


unset($abc, $postdata, $data, $data2, $token, $key, $issued_at, $expiration_time, $issuer, $jwt, $decoded, $nik, $name, $aksi, $e);
?>