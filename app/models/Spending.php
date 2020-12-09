<?php
class Spending
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getVehicleSpendings($vehicle_id)
    {
        $this->db->query('SELECT * FROM spendings WHERE vehicle_id = :vehicle_id');

        $this->db->bind(':vehicle_id', $vehicle_id);

        $results = $this->db->resultSet();

        return $results;
    }

    public function calculateTotalSpendings($vehicle_id)
    {
        $this->db->query('SELECT SUM(price) AS total FROM spendings WHERE vehicle_id = :vehicle_id');

        $this->db->bind(':vehicle_id', $vehicle_id);

        $results = $this->db->resultSet();

        return $results;
    }

    public function addSpending($data)
    {
        $this->db->query('INSERT INTO spendings (
            name, 
            price, 
            comments,            
            vehicle_id
            ) VALUES (
                :name, 
                :price,
                :comments, 
                :vehicle_id
                )
        ');

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':comments', $data['comments']);
        $this->db->bind(':vehicle_id', $data['vehicle_id']);     

        // Execute insert query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}