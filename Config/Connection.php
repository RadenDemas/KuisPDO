<?php
class Connection
{
    private $_serverName = "localhost";
    private $_userName = "root";
    private $_password = "";
    private $_dbName = "kuis";

    public $Con;

    public function __construct(){
        try {
            $this->Con = new PDO("mysql:host=$this->_serverName;dbname=$this->_dbName",
                $this->_userName,
                $this->_password);
            $this->Con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Koneksi Gagal: " . $e->getMessage());
        }
    }
}