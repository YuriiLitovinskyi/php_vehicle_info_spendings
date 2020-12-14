<?php
class Vehicle
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
        //echo 'vehicles constructor';
    }

    public function __destruct()
    {
        $this->db = null;
        //echo 'vehicles destructor';
    }

    public function getUsersVehicles($user_id, $offset, $vehiclesRowsPerPage)
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
            LIMIT :vehiclesRowsPerPage OFFSET :offset
        ');  // all users vehicles


        // Bind values       
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':offset', intval($offset));
        $this->db->bind(':vehiclesRowsPerPage', intval($vehiclesRowsPerPage));

        $results = $this->db->resultSet();

        return $results;
    }

    public function getNumberOfVehiclesRows($user_id)
    {
        $this->db->query('SELECT COUNT(*) AS total_veh_rows FROM vehicle_info WHERE user_id = :user_id');

        $this->db->bind(':user_id', $user_id);

        $numOfRows = $this->db->resultSet();

        return $numOfRows;
    }

    public function addVehicle($data)
    {
        $this->db->query('INSERT INTO vehicle_info (
            name, 
            car_mileage, 
            fuel, 
            year_production, 
            transmission, 
            configuration, 
            vin_number,
            engine_capacity,
            color,
            producing_country,
            vehicle_mass,
            maximum_mass,
            user_id
            ) VALUES (
                :name, 
                :car_mileage, 
                :fuel,
                :year_production, 
                :transmission, 
                :configuration, 
                :vin_number,
                :engine_capacity,
                :color,
                :producing_country,
                :vehicle_mass,
                :maximum_mass,
                :user_id
                )
        ');

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':car_mileage', $data['car_mileage']);
        $this->db->bind(':fuel', $data['fuel']);
        $this->db->bind(':year_production', $data['year_production']);
        $this->db->bind(':transmission', $data['transmission']);
        $this->db->bind(':configuration', $data['configuration']);
        $this->db->bind(':vin_number', $data['vin_number']);
        $this->db->bind(':engine_capacity', $data['engine_capacity']);
        $this->db->bind(':color', $data['color']);
        $this->db->bind(':producing_country', $data['producing_country']);
        $this->db->bind(':vehicle_mass', $data['vehicle_mass']);
        $this->db->bind(':maximum_mass', $data['maximum_mass']);
        $this->db->bind(':user_id', $data['user_id']);

        // Execute insert query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateVehicle($data)
    {
        $this->db->query('UPDATE vehicle_info SET
            name = :name, 
            car_mileage = :car_mileage, 
            fuel = :fuel, 
            year_production = :year_production, 
            transmission = :transmission, 
            configuration = :configuration, 
            vin_number = :vin_number,
            engine_capacity = :engine_capacity,
            color = :color,
            producing_country = :producing_country,
            vehicle_mass = :vehicle_mass,
            maximum_mass = :maximum_mass         
            WHERE id = :id         
        ');

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':car_mileage', $data['car_mileage']);
        $this->db->bind(':fuel', $data['fuel']);
        $this->db->bind(':year_production', $data['year_production']);
        $this->db->bind(':transmission', $data['transmission']);
        $this->db->bind(':configuration', $data['configuration']);
        $this->db->bind(':vin_number', $data['vin_number']);
        $this->db->bind(':engine_capacity', $data['engine_capacity']);
        $this->db->bind(':color', $data['color']);
        $this->db->bind(':producing_country', $data['producing_country']);
        $this->db->bind(':vehicle_mass', $data['vehicle_mass']);
        $this->db->bind(':maximum_mass', $data['maximum_mass']);

        // Execute insert query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getVehicleById($id)
    {
        $this->db->query('SELECT * FROM vehicle_info WHERE id = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function deleteVehicle($id)
    {
        $this->db->query('DELETE from vehicle_info WHERE id = :id');

        $this->db->bind(':id', $id);

        // Execute delete query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAllUserVehicles($user_id)
    {
        $this->db->query('DELETE from vehicle_info WHERE user_id = :user_id');

        $this->db->bind(':user_id', $user_id);

        // Execute delete query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
