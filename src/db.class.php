<?php
class DB
{

    private $host = 'localhost';
    private $database = 'resto';
    private $user = 'root';
    private $password = '';
    public $db;

    public function __construct($host = null, $database = null, $user = null, $password = null)
    {
        if ($host != null) {
            $this->host = $host;
            $this->database = $database;
            $this->user = $user;
            $this->password = $password;
        }
        try {
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->user, $this->password, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'

            ));
        } catch (PDOException $e) {
            die('impossible de se connecter a la base de donnee !');
        }
    }
    public function select($sql, $data = array())
    {
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }


    public function query($sql, $data = array())
    {
        $req = $this->db->prepare($sql);
        $req->execute($data);
    }

    public function count($sql)
    {
        return $req = (int)$this->db->query($sql)->fetch(PDO::FETCH_NUM)[0];
    }
}