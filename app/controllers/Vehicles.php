<?php
class Vehicles extends Controller
{
    public function __construct()
    {
        // If not logged in, redirect
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->vehicleModel = $this->model('Vehicle');
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
                $data['fuel_error'] = 'Please enter fuel type';
            }

            // Make sure no errors
            if (empty($data['name_error']) && empty($data['car_mileage'])) {
                //
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
}