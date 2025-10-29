<?php

class DB
{
    private $host;
    private $database;
    private $user;
    private $password;
    public $db;

    public function __construct()
    {
        // Lecture des variables d'environnement
        $this->host = getenv('DB_HOST') ?: 'localhost';
        $this->database = getenv('DB_DATABASE') ?: 'resto';
        $this->user = getenv('DB_USERNAME') ?: 'root';
        $this->password = getenv('DB_PASSWORD') ?: '';

        try {
            $this->db = new PDO(
                "mysql:host={$this->host};dbname={$this->database};charset=utf8",
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                ]
            );
        } catch (PDOException $e) {
            // Gestion de l'erreur selon le mode debug
            if (getenv('APP_DEBUG') === 'true') {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            } else {
                die("Impossible de se connecter à la base de données !");
            }
        }
    }

    // SELECT → retourne plusieurs lignes
    public function select($sql, $data = [])
    {
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return $req->fetchAll();
    }

    // INSERT / UPDATE / DELETE → exécution simple
    public function query($sql, $data = [])
    {
        $req = $this->db->prepare($sql);
        return $req->execute($data);
    }

    // COUNT → retourne un entier
    public function count($sql, $data = [])
    {
        $req = $this->db->prepare($sql);
        $req->execute($data);
        return (int) $req->fetchColumn();
    }

    // Retourne l'ID de la dernière insertion
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }
}
