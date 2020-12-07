<?php
class Vehicle 
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUsersVehicles($user_id)
    {        
        
        $this->db->query('SELECT *,
            vehicle_info.id as vehicleId,
            vehicle_info.name as vehicleName,
            vehicle_info.created_at as vehicleCreated,
            users.id as userId,
            users.name as userName
            FROM vehicle_info
            INNER JOIN users
            ON vehicle_info.user_id = users.id
            WHERE users.id = :user_id
            ORDER BY vehicle_info.created_at DESC
        ');  // all users vehicles


        // Bind values       
         $this->db->bind(':user_id', $user_id);

        $results = $this->db->resultSet();

        return $results;
    }
}