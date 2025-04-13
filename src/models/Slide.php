<?php

class Slide
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM slides ORDER BY position ASC";
        return $this->db->query($query)->fetchAll();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM slides WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($title, $description, $image, $position)
    {
        $query = "INSERT INTO slides (title, description, image, position) 
                 VALUES (:title, :description, :image, :position)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'title' => $title,
            'description' => $description,
            'image' => $image,
            'position' => $position
        ]);
    }

    public function update($id, $title, $description, $image = null, $position)
    {
        $query = "UPDATE slides SET title = :title, description = :description, 
                 position = :position";
        $params = [
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'position' => $position
        ];

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
        $query = "DELETE FROM slides WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    public function updatePositions($positions)
    {
        $this->db->beginTransaction();
        try {
            foreach ($positions as $id => $position) {
                $query = "UPDATE slides SET position = :position WHERE id = :id";
                $stmt = $this->db->prepare($query);
                $stmt->execute([
                    'id' => $id,
                    'position' => $position
                ]);
            }
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}