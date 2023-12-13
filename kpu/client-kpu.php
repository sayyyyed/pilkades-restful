<?php
error_reporting(1);
class Client
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
        unset($url);
    }
    public function filter($data)
    {
        $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
        return $data;
        unset($data);
    }

    public function login($data)
    {
    
        $data = '{
            "nik":"' . $data['nik'] . '",
            
      
            "password":"' . $data['password'] . '",
            "aksi":"' . $data['aksi'] . '"
        }';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        $data2 = json_decode($response);
        return $data2;
        unset($data, $data2, $c, $response);
    }

    public function tampil_semua_data($nik)
    {
        $client = curl_init($this->url . '?nik=' . $nik);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;
        unset($nik, $client, $response, $data);
       
    }
    public function tampil_data($data)
    {
        $nik = $this->filter($data['nik']);
        // CREATE TABLE voter (
    //     id_voter VARCHAR(255) PRIMARY KEY,
    //     nik VARCHAR(255),
    //     name VARCHAR(255),
    //     domisili VARCHAR(255),
    //     password VARCHAR(255),
    //     FOREIGN KEY (domisili) REFERENCES desa(domisili)
    // );
        $client = curl_init($this->url . '?aksi=tampil&nik=' . $data['nik'] . '&jwt=' . $data['jwt'] .  '&name=' . $data['name'] . '&domisili=' . $data['domisili'] . '&password=' . $data['password']);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;
        unset($nik, $client, $response, $data);
       
    }

    public function tambah_data($data)
    {
        $data = '{"nik":"' . $data['nik'] . '",
                  "name":"' . $data['name'] . '",
                    "email":"' . $data['email'] . '",
                    "domisili":"' . $data['domisili'] . '",
                    "password":"' . $data['password'] . '",
                 
                  "aksi":"' . $data['aksi'] . '"
                }';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        var_dump($response);
        curl_close($c);
        unset($data, $c, $response);
    }

    //ubah data

    public function ubah_data($data)
    {
        $data = '{ "id_voter":"' . $data['id_voter'] . '",
                  "nik":"' . $data['nik'] . '",
                  "name":"' . $data['name'] . '",
                    "email":"' . $data['email'] . '",
                    "domisili":"' . $data['domisili'] . '",
                    "password":"' . $data['password'] . '",
                  
                  "aksi":"' . $data['aksi'] . '"
                }';


        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        curl_close($c);
        unset($data, $c, $response);
    }
    public function __destruct()
    {
        unset($this->url);
    }





}
$url = 'http://localhost/pilkades-restful/server/server-kpu.php';
$abc = new Client($url);