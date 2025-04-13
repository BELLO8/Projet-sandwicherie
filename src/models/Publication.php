<?php

class Publication
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM publications ORDER BY created_at DESC";
        return $this->db->query($query)->fetchAll();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM publications WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($title, $description, $image)
    {
        $query = "INSERT INTO publications (title, description, image, created_at) 
                 VALUES (:title, :description, :image, NOW())";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'title' => $title,
            'description' => $description,
            'image' => $image
        ]);
    }

    public function update($id, $title, $description, $image = null)
    {
        $query = "UPDATE publications SET title = :title, description = :description";
        $params = ['id' => $id, 'title' => $title, 'description' => $description];

        if ($image) {
            $query .= ", image = :image";
            $params['image'] = $image;
        }

        $query .= " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $query = "DELETE FROM publications WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}