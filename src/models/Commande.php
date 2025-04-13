<?php
class Commande
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT c.*, u.username as user_name 
                 FROM commande c 
                 LEFT JOIN users u ON c.user_id = u.id 
                 ORDER BY c.date_comm DESC";
        return $this->db->query($query)->fetchAll();
    }

    public function getById($id)
    {
        $query = "SELECT c.*, u.username as user_name 
                 FROM commande c 
                 LEFT JOIN users u ON c.user_id = u.id 
                 WHERE c.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getDetails($commande_id)
    {
        $query = "SELECT cd.*, f.name as food_name, f.price 
                 FROM commande_details cd 
                 JOIN food f ON cd.food_id = f.id 
                 WHERE cd.commande_id = :commande_id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['commande_id' => $commande_id]);
        return $stmt->fetchAll();
    }

    public function updateStatus($id, $status)
    {
        $query = "UPDATE commande SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            'id' => $id,
            'status' => $status
        ]);
    }

    public function delete($id)
    {
        $this->db->beginTransaction();
        try {
            $query = "DELETE FROM commande_details WHERE commande_id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['id' => $id]);

            $query = "DELETE FROM commande WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->execute(['id' => $id]);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}