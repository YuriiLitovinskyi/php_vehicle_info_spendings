<?php
class Vehicles extends Controller
{
    public function __construct()
    {
        // If not logged in, redirect
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        // Check Expiration
        if (checkSessionExpire()) {
            session_destroy();
            redirect('users/login');
        }

        // Load models
        $this->vehicleModel = $this->model('Vehicle');
        $this->userModel = $this->model('User');
        $this->spendingModel = $this->model('Spending');
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
            } else if (strlen($data['name']) < 3 || strlen($data['name']) > 40) {
                $data['name_error'] = 'Length must be between 3 and 40 symbols';
            }

            if (empty($data['producing_country'])) {
                $data['producing_country_error'] = 'Please enter vehicle producing country';
            } else if (strlen($data['producing_country']) < 3 || strlen($data['producing_country']) > 40) {
                $data['producing_country_error'] = 'Length must be between 3 and 40 symbols';
            }

            if (empty($data['year_production'])) {
                $data['year_production_error'] = 'Please enter vehicle year production';
            } else if (!is_numeric($data['year_production'])) {
                $data['year_production_error'] = 'Value must be a number';
            } else if ($data['year_production'] < 1900 || $data['year_production'] > 3000) {
                $data['year_production_error'] = 'Value must be greate then 1900 and less then 3000';
            }

            if (empty($data['car_mileage'])) {
                $data['car_mileage_error'] = 'Please enter current vehicle mileage';
            } else if (!is_numeric($data['car_mileage'])) {
                $data['car_mileage_error'] = 'Value must be a number';
            } else if ($data['car_mileage'] < 0 || $data['car_mileage'] > 999999999) {
                $data['car_mileage_error'] = 'Value must be greate then 0 and less then 999999999';
            }

            if (empty($data['fuel'])) {
                $data['fuel_error'] = 'Please choose fuel type';
            } else if ($data['fuel'] != 'Gasoline' && $data['fuel'] != 'Diesel' && $data['fuel'] != 'Gas' &&  $data['fuel'] != 'Other') {
                $data['fuel_error'] = 'Invalid value. Please choose correct fuel type';
            }

            if (empty($data['transmission'])) {
                $data['transmission_error'] = 'Please choose transmission type';
            } else if ($data['transmission'] != 'Manual' && $data['transmission'] != 'Automatic' && $data['transmission'] != 'Continuously Variable' && $data['transmission'] != 'Other') {
                $data['transmission_error'] = 'Invalid value. Please choose correct transmission type';
            }

            $configVehType = array('Sedan', 'Hatchback', 'Station Wagon', 'Sport Car', 'Minivan', 'Convertible', 'Sport-utility', 'Pichup', 'Other');

            if (empty($data['configuration'])) {
                $data['configuration_error'] = 'Please choose body type';
            } else if (!in_array($data['configuration'], $configVehType)) {
                $data['configuration_error'] = 'Invalid value. Please choose configuration type';
            }

            if (strlen($data['vin_number']) > 40) {
                $data['vin_number_error'] = 'Value must be less then 40 symbols';
            }

            if (strlen($data['engine_capacity']) > 30) {
                $data['engine_capacity_error'] = 'Value must be less then 30 symbols';
            }

            if (strlen($data['color']) > 40) {
                $data['color_error'] = 'Value must be less then 40 symbols';
            }

            if (strlen($data['vehicle_mass']) > 30) {
                $data['vehicle_mass_error'] = 'Value must be less then 30 symbols';
            }

            if (strlen($data['maximum_mass']) > 30) {
                $data['maximum_mass_error'] = 'Value must be less then 30 symbols';
            }

            // Make sure no errors
            if (
                empty($data['name_error'])
                && empty($data['producing_country_error'])
                && empty($data['year_production_error'])
                && empty($data['car_mileage_error'])
                && empty($data['fuel_error'])
                && empty($data['configuration_error'])
                && empty($data['vin_number_error'])
                && empty($data['engine_capacity_error'])
                && empty($data['color_error'])
                && empty($data['vehicle_mass_error'])
                && empty($data['maximum_mass_error'])
            ) {

                // Validated
                if ($this->vehicleModel->addVehicle($data)) {
                    flash('vehicle_message', 'Your new vehicle was added successfully');
                    redirect('vehicles');
                } else {
                    flash('vehicle_message', 'Error! Could not add new vehicle! Please try again', 'alert alert-danger');
                    redirect('vehicles');
                    //die('Error! Could not add new vehicle!');
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
            } else if (strlen($data['name']) < 3 || strlen($data['name']) > 40) {
                $data['name_error'] = 'Length must be between 3 and 40 symbols';
            }

            if (empty($data['producing_country'])) {
                $data['producing_country_error'] = 'Please enter vehicle producing country';
            } else if (strlen($data['producing_country']) < 3 || strlen($data['producing_country']) > 40) {
                $data['producing_country_error'] = 'Length must be between 3 and 40 symbols';
            }

            if (empty($data['year_production'])) {
                $data['year_production_error'] = 'Please enter vehicle year production';
            } else if (!is_numeric($data['year_production'])) {
                $data['year_production_error'] = 'Value must be a number';
            } else if ($data['year_production'] < 1900 || $data['year_production'] > 3000) {
                $data['year_production_error'] = 'Value must be greate then 1900 and less then 3000';
            }

            if (empty($data['car_mileage'])) {
                $data['car_mileage_error'] = 'Please enter current vehicle mileage';
            } else if (!is_numeric($data['car_mileage'])) {
                $data['car_mileage_error'] = 'Value must be a number';
            } else if ($data['car_mileage'] < 0 || $data['car_mileage'] > 999999999) {
                $data['car_mileage_error'] = 'Value must be greate then 0 and less then 999999999';
            }

            if (empty($data['fuel'])) {
                $data['fuel_error'] = 'Please choose fuel type';
            } else if ($data['fuel'] != 'Gasoline' && $data['fuel'] != 'Diesel' && $data['fuel'] != 'Gas' &&  $data['fuel'] != 'Other') {
                $data['fuel_error'] = 'Invalid value. Please choose correct fuel type';
            }

            if (empty($data['transmission'])) {
                $data['transmission_error'] = 'Please choose transmission type';
            } else if ($data['transmission'] != 'Manual' && $data['transmission'] != 'Automatic' && $data['transmission'] != 'Continuously Variable' && $data['transmission'] != 'Other') {
                $data['transmission_error'] = 'Invalid value. Please choose correct transmission type';
            }

            $configVehType = array('Sedan', 'Hatchback', 'Station Wagon', 'Sport Car', 'Minivan', 'Convertible', 'Sport-utility', 'Pichup', 'Other');

            if (empty($data['configuration'])) {
                $data['configuration_error'] = 'Please choose body type';
            } else if (!in_array($data['configuration'], $configVehType)) {
                $data['configuration_error'] = 'Invalid value. Please choose configuration type';
            }

            if (strlen($data['vin_number']) > 40) {
                $data['vin_number_error'] = 'Value must be less then 40 symbols';
            }

            if (strlen($data['engine_capacity']) > 30) {
                $data['engine_capacity_error'] = 'Value must be less then 30 symbols';
            }

            if (strlen($data['color']) > 40) {
                $data['color_error'] = 'Value must be less then 40 symbols';
            }

            if (strlen($data['vehicle_mass']) > 30) {
                $data['vehicle_mass_error'] = 'Value must be less then 30 symbols';
            }

            if (strlen($data['maximum_mass']) > 30) {
                $data['maximum_mass_error'] = 'Value must be less then 30 symbols';
            }

            // Make sure no errors
            if (
                empty($data['name_error'])
                && empty($data['producing_country_error'])
                && empty($data['year_production_error'])
                && empty($data['car_mileage_error'])
                && empty($data['fuel_error'])
                && empty($data['configuration_error'])
                && empty($data['vin_number_error'])
                && empty($data['engine_capacity_error'])
                && empty($data['color_error'])
                && empty($data['vehicle_mass_error'])
                && empty($data['maximum_mass_error'])
            ) {

                // Validated
                if ($this->vehicleModel->updateVehicle($data)) {
                    flash('vehicle_message', 'Vehicle info was updated successfully', 'alert alert-primary');
                    redirect('vehicles/show/' . $data['id']);
                } else {
                    flash('vehicle_message', 'Error! Could not update vehicle! Please try again', 'alert alert-danger');
                    redirect('vehicles/show/' . $data['id']);
                    //die('Error! Could not edit vehicle!');
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

        $data = [
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

            if ($this->vehicleModel->deleteVehicle($id) && $this->spendingModel->deleteAllVehicleSpendings($id)) {
                flash('vehicle_message', 'Vehicle was removed successfully', 'alert alert-info');
                redirect('vehicles');
            } else {
                flash('vehicle_message', 'Error! Could not delete vehicle! Please try again', 'alert alert-danger');
                redirect('vehicles');
                //die('Error! Could not delete vehicle!');
            }
        } else {
            redirect('vehicles');
        }
    }
}
