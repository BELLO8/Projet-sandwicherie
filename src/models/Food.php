<?php
class Food
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT f.*, c.name as category_name 
                 FROM food f 
                 LEFT JOIN categories c ON f.category_id = c.id 
                 ORDER BY f.created_at DESC";
        return $this->db->query($query)->fetchAll();
    }

    public function getById($id)
    {
        $query = "SELECT f.*, c.name as category_name 
                 FROM food f 
                 LEFT JOIN categories c ON f.category_id = c.id 
                 WHERE f.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($name, $description, $price, $image, $category_id)
    {
        $query = "INSERT INTO food (name, description, price, image, category_id, created_at) 
                 VALUES (:name, :description, :price, :image, :category_id, NOW())";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image' => $image,
            'category_id' => $category_id
        ]);
    }

    public function update($id, $name, $description, $price, $image = null, $category_id)
    {
        $query = "UPDATE food SET name = :name, description = :description, 
                 price = :price, category_id = :category_id";
        $params = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $category_id
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
        $query = "DELETE FROM food WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}