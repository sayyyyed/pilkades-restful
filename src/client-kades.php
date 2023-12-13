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

    public function tampil_semua_data_kades()
    {
        $client = curl_init($this->url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;
        unset($nik, $client, $response, $data);
       
    }

    // public function tampil_semua_data($nik)
    // {
    //     $client = curl_init($this->url . '?nik=' . $nik);
    //     curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
    //     $response = curl_exec($client);
    //     curl_close($client);
    //     $data = json_decode($response);
    //     return $data;
    //     unset($nik, $client, $response, $data);
       
    // }
    public function tampil_data_kades($data)
    {
        $domisili = $this->filter($data['domisili']);
        
        $client = curl_init($this->url . '?aksi=tampil&domisili=' . $data['domisili'] . '&jwt=' . $data['jwt'] . '&nik=' . $data['nik'] . '&id_kades=' . $data['id_kades'] . '&email=' . $data['email'] . '&nama=' . $data['nama'] . '&password=' . $data['password'] . '&visi=' . $data['visi'] . '&foto=' . $data['foto']);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;
        unset($nik, $client, $response, $data);
       
    }

        public function tampil_data_kades_id($data)
        {
            $nik = $this->filter($data->id_kades);
            
            $client = curl_init($this->url . '?aksi=tampil-id&nik=' . $data->nik . '&id_kades=' . $data->id_kades . '&email=' . $data->email . '&nama=' . $data->nama . '&password=' .  $data->password  . '&visi=' .  $data->visi  . '&foto=' .  $data->foto );
            curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($client);
            // var_dump($data);
            curl_close($client);
            $data = json_decode($response);
            return $data;
            unset($nik, $client, $response, $data);
        
        }

        public function tampil_data_kades_id2($data)
        {
            $nik = $this->filter($data['id_kades']);
            
            $client = curl_init($this->url . '?aksi=tampil-id2' . '&nik=' . $data->nik . '&id_kades=' . $data['id_kades']);
            // var_dump($client);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($client);
            // var_dump($data);
            curl_close($client);
            $data = json_decode($response);
            return $data;
            unset($nik, $client, $response, $data);
        
        }

    public function cek_suara($data)
    {
        $nik = $this->filter($data['nik']);
        

        //tabel suara memiliki kolom nik id voter, id kades, domisili, tanggal vote
        // cek nik in suara table
        $client = curl_init($this->url . '?aksi=cek&nik=' . $nik);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($client);
        curl_close($client);
        $data = json_decode($response);
        return $data;
        unset($nik, $client, $response, $data);
       
    }

    public function tambah_data_kades($data)
    {
        $data = '{"nik":"' . $data['nik'] . '",
                  "nama":"' . $data['nama'] . '",
                    "email":"' . $data['email'] . '",
                    "domisili":"' . $data['domisili'] . '",
                    "password":"' . $data['password'] . '",
                    "foto":"' . $data['foto'] . '",
                 
                  "aksi":"' . $data['aksi'] . '"
                }';

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($c);
        // var_dump($response);
        curl_close($c);
        unset($data, $c, $response);
    }

public function pilih_kades($data){

    $data = '{"nik":"' . $data['nik'] . '",
        "id_voter":"' . $data['id_voter'] . '",
          "id_kades":"' . $data['id_kades'] . '",
          "domisili":"' . $data['domisili'] . '",
        "aksi":"' . $data['aksi'] . '"
      }';
      $c = curl_init();
      curl_setopt($c, CURLOPT_URL, $this->url);
      curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($c, CURLOPT_POST, true);
      curl_setopt($c, CURLOPT_POSTFIELDS, $data);
      $response = curl_exec($c);
    //   var_dump($response);
      curl_close($c);
      unset($data, $c, $response);
}

public function hapus_kades($data) {
    $data = '{"nik":"' . $data['nik'] . '",
       
        "aksi":"' . $data['aksi'] . '"
      }';
      $c = curl_init();
      curl_setopt($c, CURLOPT_URL, $this->url);
      curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($c, CURLOPT_POST, true);
      curl_setopt($c, CURLOPT_POSTFIELDS, $data);
      $response = curl_exec($c);
    //   var_dump($response);
      curl_close($c);
      unset($data, $c, $response);
}
public function ubah_data($data)
{
    $data = '{ "id_kades":"' . $data['id_kades'] . '",
              "nik":"' . $data['nik'] . '",
              "nama":"' . $data['nama'] . '",
                "email":"' . $data['email'] . '",
                "domisili":"' . $data['domisili'] . '",
                "password":"' . $data['password'] . '",
                "foto":"' . $data['foto'] . '",

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

public function visi_kades($data)
{
    $data = '{ "id_kades":"' . $data['id_kades'] . '",
              "nik":"' . $data['nik'] . '",
              "visi":"' . $data['visi'] . '",
               
              "aksi":"' . $data['aksi'] . '"
            }';


    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $this->url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($c);
    // var_dump($data); 
    curl_close($c);
    unset($data, $c, $response);
}


    public function __destruct()
    {
        unset($this->url);
    }





}
$url = 'http://localhost/pilkades-restful/server/server-kades.php';
$abc = new Client($url);