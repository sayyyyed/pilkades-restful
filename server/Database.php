<?php
class Database
{
private $host="localhost"; 
private $dbname="pilkades";
private $user="root";
private $password="";
private $port="3306";
private $conn;

// function yang pertama kali di-load saat class dipanggil
public function __construct()
   {
      // koneksi database
      try {
         $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8", $this->user, $this->password);
         $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
         echo "Koneksi Gagal";
         exit(); // keluar dari skrip jika koneksi gagal
      }
   }

public function login($data)
{   
    $query = $this->conn->prepare("select * from voter where nik=? and password=?");
    $query->execute(array($data['nik'], $data['password']));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}

public function login_kades($data)
{   
    $query = $this->conn->prepare("select * from cakades where nik=? and password=?");
    $query->execute(array($data['nik'], $data['password']));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}

public function login_kpu($data)
{   
    $query = $this->conn->prepare("select * from kpu where email=? and password=?");
    $query->execute(array($data['email'], $data['password']));
    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}

//tampil data desa
// CREATE TABLE desa (
//     id_desa VARCHAR(255) PRIMARY KEY,
//     nama_desa VARCHAR(255) UNIQUE
// );

public function tampil_semua_data_desa()
{  
    $query = $this->conn->prepare("select id_desa, nama_desa from desa");
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}

public function tampil_semua_data_kades()
{  
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
    
    $query = $this->conn->prepare("select id_kades, email, nik, nama, domisili, password, visi, foto from cakades");
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}

public function hasil_pilkades()
{  

    $query = $this->conn->prepare("select * from suara");
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}

public function tampil_voter($nik)
{   
    // $query = $this->conn->prepare("select id_barang, nama_barang, stok_barang, harga_satuan from barang order by id_barang");
    //     $query->execute();

    //     $data = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $query->closeCursor();

    //     // Unset $data before returning.
    //     unset($data);

    $query = $this->conn->prepare("select id_voter, nik,email, name, domisili, password from voter where nik=?");
    $query->execute(array($nik));
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}

public function tampil_suara($nik)
{  
    $query = $this->conn->prepare("SELECT * from suara where nik=?");
    $query->execute(array($nik));
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}

public function tampil_jadwal($masa)
{  
    $query = $this->conn->prepare("SELECT * from jadwal where masa=?");
    $query->execute(array($masa));
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}

public function tampil_semua_jadwal()
{  

    $query = $this->conn->prepare("SELECT * from jadwal");
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}

public function ubah_jadwal($data)
{   
    $query = $this->conn->prepare("update cakades set tanggal=? where masa=?");
    $query->execute(array ($data['tanggal'], $data['masa']));
   
    $query->closeCursor();
    unset($data);
}

public function tampil_kades_dom($domisili)
{   
    // $query = $this->conn->prepare("select id_barang, nama_barang, stok_barang, harga_satuan from barang order by id_barang");
    //     $query->execute();

    //     $data = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $query->closeCursor();

    //     // Unset $data before returning.
    //     unset($data);

    $query = $this->conn->prepare("select id_kades, email, nik, nama, domisili, password, visi, foto from cakades where domisili=?");
    $query->execute(array($domisili));
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}

public function pilih_kades($data)
{   
    $query = $this->conn->prepare("INSERT INTO suara (nik, id_voter, id_kades, domisili, tanggal_vote) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
    $query->execute(array($data['nik'], $data['id_voter'], $data['id_kades'], $data['domisili']));
    $query->closeCursor();
    unset($data);
}

public function hapus_kades($data)
{   
    // delete suara based on nik
    $query = $this->conn->prepare(' DELETE FROM suara WHERE nik = ?');
    $query->execute(array($data['nik']));
   
    $query->closeCursor();
    unset($data);
}



public function tampil_kades_id($id_kadees)
{   
    // $query = $this->conn->prepare("select id_barang, nama_barang, stok_barang, harga_satuan from barang order by id_barang");
    //     $query->execute();

    //     $data = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $query->closeCursor();

    //     // Unset $data before returning.
    //     unset($data);

    $query = $this->conn->prepare("select id_kades, email, nik, nama, domisili, password, visi, foto from cakades where id_kades=?");
    $query->execute(array($id_kadees));
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}

public function tampil_kades_nik($nik)
{   
    // $query = $this->conn->prepare("select id_barang, nama_barang, stok_barang, harga_satuan from barang order by id_barang");
    //     $query->execute();

    //     $data = $query->fetchAll(PDO::FETCH_ASSOC);
    //     $query->closeCursor();

    //     // Unset $data before returning.
    //     unset($data);

    $query = $this->conn->prepare("select id_kades, email, nik, nama, domisili, password, visi, foto from cakades where nik=?");
    $query->execute(array($nik));
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}

public function tampil_semua_voter()
{   
    // $query = $this->conn->prepare("select id_barang, nama_barang, stok_barang, harga_satuan from barang where id_barang=?");
    // $query->execute(array($id_barang));

    // $data = $query->fetch(PDO::FETCH_ASSOC);

    // $query->closeCursor();
    // // Unset $id_barang and $data before returning.
    // unset($id_barang, $data);

    $query = $this->conn->prepare("select id_voter, nik, name, domisili, password from voter order by id_voter");
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    return $data;
    $query->closeCursor();
    unset($data);
}


public function tambah_data_voter($data)
{  
    // CREATE TABLE voter (
    //     id_voter VARCHAR(255) PRIMARY KEY,
    //     nik VARCHAR(255),
    //     name VARCHAR(255),
    //     domisili VARCHAR(255),
    //     password VARCHAR(255),
    //     FOREIGN KEY (id_desa) REFERENCES desa(id_desa)
    // );

        $query = $this->conn->prepare("INSERT INTO voter (nik, name,email, domisili, password) VALUES (?, ?, ?, ?, ?)");
        $query->execute(array($data['nik'], $data['name'],$data['email'], $data['domisili'], $data['password']));
        $query->closeCursor();

        unset($data);
    }

    public function tambah_data_kades($data)
{  
    // CREATE TABLE voter (
    //     id_voter VARCHAR(255) PRIMARY KEY,
    //     nik VARCHAR(255),
    //     name VARCHAR(255),
    //     domisili VARCHAR(255),
    //     password VARCHAR(255),
    //     FOREIGN KEY (id_desa) REFERENCES desa(id_desa)
    // );
        $visi= " ";
        $query = $this->conn->prepare("INSERT INTO cakades (email, nik,nama, domisili, password, visi, foto) VALUES (?, ?, ?, ?, ? , ?, ?)");
        $query->execute(array( $data['email'], $data['nik'],$data['nama'], $data['domisili'], $data['password'], $visi, $data['foto']));
        $query->closeCursor();

        unset($data);
    }

    public function ubah_data_voter($data)
{   
    // $query = $this->conn->prepare("update barang set nama_barang=?, stok_barang=?, harga_satuan=? where id_barang=?");
    // $query->execute(array($data['nama_barang'], $data['stok_barang'], $data['harga_satuan'], $data['id_barang']));
    // $query->closeCursor();
    // unset($data);

    $query = $this->conn->prepare("update voter set nik=?, name=?, email=?, domisili=?, password=? where id_voter=?");
    $query->execute(array($data['nik'], $data['name'], $data['email'], $data['domisili'], $data['password'], $data['id_voter']));
    $query->closeCursor();
    unset($data);
}

public function ubah_data_kades($data)
{   
    $query = $this->conn->prepare("update cakades set nik=?, nama=?, email=?, domisili=?, foto=?, password=? where id_kades=?");
    $query->execute(array ($data['nik'], $data['nama'], $data['email'], $data['domisili'], $data['foto'], $data['password'], $data['id_kades']));
   
    $query->closeCursor();
    unset($data);
}

public function visi_kades($data)
{   
    $query = $this->conn->prepare("update cakades set visi=? where id_kades=?");
    $query->execute(array ($data['visi'], $data['id_kades']));
   
    $query->closeCursor();
    unset($data);
}

    public function cek_suara($nik){

        $query = $this->conn->prepare("select * from suara where nik=?");
        $query->execute(array($nik));
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
        $query->closeCursor();
        unset($data);
    }

// public function hapus_data($id_barang)
// {
//     $query = $this->conn->prepare("delete from barang where id_barang=?");
//     $query->execute(array($id_barang));
//     $query->closeCursor();
//     unset($id_barang);
// }
}
?>
