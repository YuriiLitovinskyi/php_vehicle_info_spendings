<?php
class Spending
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getVehicleSpendings($vehicle_id, $offset, $spendingsRowsPerPage)
    {
        $this->db->query('SELECT * FROM spendings WHERE vehicle_id = :vehicle_id ORDER BY spendings.id DESC LIMIT :spendingsRowsPerPage OFFSET :offset');

        $this->db->bind(':vehicle_id', $vehicle_id);
        $this->db->bind(':offset', intval($offset));
        $this->db->bind(':spendingsRowsPerPage', intval($spendingsRowsPerPage));

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
            vehicle_id,
            user_id
            ) VALUES (
                :name, 
                :price,
                :comments, 
                :vehicle_id,
                :user_id
                )
        ');

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':comments', $data['comments']);
        $this->db->bind(':vehicle_id', $data['vehicle_id']);
        $this->db->bind(':user_id', $data['user_id']);

        // Execute insert query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editSpending($data)
    {
        $this->db->query('UPDATE spendings SET 
            name = :name, 
            price = :price, 
            comments = :comments           
            WHERE
            id = :id            
        ');

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':comments', $data['comments']);

        // Execute insert query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getSpendingById($id)
    {
        $this->db->query('SELECT * FROM spendings WHERE id = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function deleteSpending($id)
    {
        $this->db->query('DELETE from spendings WHERE id = :id');

        $this->db->bind(':id', $id);

        // Execute delete query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAllUserSpendings($user_id)
    {
        $this->db->query('DELETE from spendings WHERE user_id = :user_id');

        $this->db->bind(':user_id', $user_id);

        // Execute delete query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAllVehicleSpendings($vehicle_id)
    {
        $this->db->query('DELETE from spendings WHERE vehicle_id = :vehicle_id');

        $this->db->bind(':vehicle_id', $vehicle_id);

        // Execute delete query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getNumberOfSpendingsRows($vehicle_id)
    {
        $this->db->query('SELECT COUNT(*) AS total_spend_rows FROM spendings WHERE vehicle_id = :vehicle_id');

        $this->db->bind(':vehicle_id', $vehicle_id);

        $numOfRows = $this->db->resultSet();
        //$count = $this->db->rowCount();

        return $numOfRows;
    }
}
