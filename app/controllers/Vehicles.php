<?php
class Vehicles extends Controller
{
    public function __construct()
    {
        // If not logged in, redirect
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        // Load models
        $this->vehicleModel = $this->model('Vehicle');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        // Get users vehicles
        $vehicles = $this->vehicleModel->getUsersVehicles($_SESSION['user_id']);

        $data = [
            'vehicles' => $vehicles
        ];

        $this->view('vehicles/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'car_mileage' => trim($_POST['car_mileage']),
                'fuel' => trim($_POST['fuel']),
                'year_production' => trim($_POST['year_production']),
                'transmission' => trim($_POST['transmission']),
                'configuration' => trim($_POST['configuration']),
                'vin_number' => trim($_POST['vin_number']),
                'engine_capacity' => trim($_POST['engine_capacity']),
                'color' => trim($_POST['color']),
                'producing_country' => trim($_POST['producing_country']),
                'vehicle_mass' => trim($_POST['vehicle_mass']),
                'maximum_mass' => trim($_POST['maximum_mass']),
                'user_id' => $_SESSION['user_id'],
                'name_error' => '',
                'car_mileage_error' => '',
                'fuel_error' => '',
                'year_production_error' => '',
                'transmission_error' => '',
                'configuration_error' => '',
                'vin_number_error' => '',
                'engine_capacity_error' => '',
                'color_error' => '',
                'producing_country_error' => '',
                'vehicle_mass_error' => '',
                'maximum_mass_error' => ''
            ];

            // Validate input values
            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter vehicle name';
            }

            if (empty($data['producing_country'])) {
                $data['producing_country_error'] = 'Please enter vehicle producing country';
            }

            if (empty($data['year_production'])) {
                $data['year_production_error'] = 'Please enter vehicle year production';
            }

            if (empty($data['car_mileage'])) {
                $data['car_mileage_error'] = 'Please enter current vehicle mileage';
            }

            if (empty($data['fuel'])) {
                $data['fuel_error'] = 'Please choose fuel type';
            }

            if (empty($data['transmission'])) {
                $data['transmission_error'] = 'Please choose transmission type';
            }

            if (empty($data['configuration'])) {
                $data['configuration_error'] = 'Please choose body type';
            }

            // Make sure no errors
            if (empty($data['name_error']) 
                && empty($data['producing_country_error']) 
                && empty($data['year_production_error']) 
                && empty($data['car_mileage_error']) 
                && empty($data['fuel_error']) 
                && empty($data['configuration_error'])) {  
                    
                    // Validated
                    if ($this->vehicleModel->addVehicle($data)) {
                        flash('vehicle_message', 'Your new vehicle was added successfully!');
                        redirect('vehicles');
                    } else {
                        die('Error! Could not add new vehicle!');
                    }
                
            } else {
                // Load view with errors
                $this->view('vehicles/add', $data);
            }

        } else {
            $data = [
                'name' => '',
                'car_mileage' => '',
                'fuel' => '',
                'year_production' => '',
                'transmission' => '',
                'configuration' => '',
                'vin_number' => '',
                'engine_capacity' => '',
                'color' => '',
                'producing_country' => '',
                'vehicle_mass' => '',
                'maximum_mass' => ''
            ];
    
            $this->view('vehicles/add', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'car_mileage' => trim($_POST['car_mileage']),
                'fuel' => trim($_POST['fuel']),
                'year_production' => trim($_POST['year_production']),
                'transmission' => trim($_POST['transmission']),
                'configuration' => trim($_POST['configuration']),
                'vin_number' => trim($_POST['vin_number']),
                'engine_capacity' => trim($_POST['engine_capacity']),
                'color' => trim($_POST['color']),
                'producing_country' => trim($_POST['producing_country']),
                'vehicle_mass' => trim($_POST['vehicle_mass']),
                'maximum_mass' => trim($_POST['maximum_mass']),
                'user_id' => $_SESSION['user_id'],
                'name_error' => '',
                'car_mileage_error' => '',
                'fuel_error' => '',
                'year_production_error' => '',
                'transmission_error' => '',
                'configuration_error' => '',
                'vin_number_error' => '',
                'engine_capacity_error' => '',
                'color_error' => '',
                'producing_country_error' => '',
                'vehicle_mass_error' => '',
                'maximum_mass_error' => ''
            ];

            // Validate input values
            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter vehicle name';
            }

            if (empty($data['producing_country'])) {
                $data['producing_country_error'] = 'Please enter vehicle producing country';
            }

            if (empty($data['year_production'])) {
                $data['year_production_error'] = 'Please enter vehicle year production';
            }

            if (empty($data['car_mileage'])) {
                $data['car_mileage_error'] = 'Please enter current vehicle mileage';
            }

            if (empty($data['fuel'])) {
                $data['fuel_error'] = 'Please choose fuel type';
            }

            if (empty($data['transmission'])) {
                $data['transmission_error'] = 'Please choose transmission type';
            }

            if (empty($data['configuration'])) {
                $data['configuration_error'] = 'Please choose body type';
            }

            // Make sure no errors
            if (empty($data['name_error']) 
                && empty($data['producing_country_error']) 
                && empty($data['year_production_error']) 
                && empty($data['car_mileage_error']) 
                && empty($data['fuel_error']) 
                && empty($data['configuration_error'])) {  
                    
                    // Validated
                    if ($this->vehicleModel->updateVehicle($data)) {
                        flash('vehicle_message', 'Vehicle info was updated successfully!');
                        redirect('vehicles/show/' . $data['id']);
                    } else {
                        die('Error! Could not edit vehicle!');
                    }
                
            } else {
                // Load view with errors
                $this->view('vehicles/edit', $data);
            }

        } else {
            // Get existing Vehicle from model
            $vehicle = $this->vehicleModel->getVehicleById($id);

            // Check for owner
            if ($vehicle->user_id != $_SESSION['user_id']) {
                // If not vehicle owner - redirect
                redirect('vehicles');
            }

            $data = [
                'id' => $id,
                'name' => $vehicle->name,
                'car_mileage' =>  $vehicle->car_mileage,
                'fuel' =>  $vehicle->fuel,
                'year_production' =>  $vehicle->year_production,
                'transmission' =>  $vehicle->transmission,
                'configuration' =>  $vehicle->configuration,
                'vin_number' =>  $vehicle->vin_number,
                'engine_capacity' =>  $vehicle->engine_capacity,
                'color' =>  $vehicle->color,
                'producing_country' =>  $vehicle->producing_country,
                'vehicle_mass' =>  $vehicle->vehicle_mass,
                'maximum_mass' =>  $vehicle->maximum_mass
            ];
    
            $this->view('vehicles/edit', $data);
        }
    }

    public function show($id) 
    {
        $vehicle = $this->vehicleModel->getVehicleById($id);
        $user = $this->userModel->getUserById($vehicle->user_id);

        $data= [
            'vehicle' => $vehicle,
            'user' => $user
        ];

        $this->view('vehicles/show', $data);
    }

    public function delete($id)
    {     
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              // Get existing Vehicle from model
            $vehicle = $this->vehicleModel->getVehicleById($id);

            // Check for owner
            if ($vehicle->user_id != $_SESSION['user_id']) {
                // If not vehicle owner - redirect
                redirect('vehicles');
            }
            
            if ($this->vehicleModel->deleteVehicle($id)) {
                flash('vehicle_message', 'Vehicle was removed successfully!');
                redirect('vehicles');
            } else {
                die('Error! Could not delete vehicle!');
            }
        } else {
            redirect('vehicles');
        }
    }
}