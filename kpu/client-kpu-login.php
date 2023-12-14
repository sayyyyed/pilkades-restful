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
            "email":"' . $data['email'] . '",            
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
    public function tampil_semua_jadwal($data)
    {
        $domisili = $this->filter($data['aksi']);
        
        $client = curl_init($this->url . '?aksi=' . $data['aksi'] . '&jwt=' . $data['jwt']);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;
        unset($nik, $client, $response, $data);
       
    }





}
$url = 'http://192.168.56.8/kpu-log/server/server-kpu-login.php';
$abc = new Client($url);