<?php
class Spendings extends Controller
{
    public function __construct()
    {
        // Load models
        $this->vehicleModel = $this->model('Vehicle');
        $this->userModel = $this->model('User');
        $this->spendingModel = $this->model('Spending');
    }

    public function index()
    {
        redirect('vehicles');
    }

    public function show($vehicle_id) 
    {
        $vehicle = $this->vehicleModel->getVehicleById($vehicle_id);
        // $user = $this->userModel->getUserById($vehicle->user_id);

        // $data= [
        //     'vehicle' => $vehicle,
        //     'user' => $user
        // ];

        // $this->view('vehicles/show', $data);          //calculateTotalSpendings($vehicle_id)

        $totalVehicleSpendings = $this->spendingModel->calculateTotalSpendings($vehicle_id);



        // Get vehicle spendings
        $vehicleSpendings = $this->spendingModel->getVehicleSpendings($vehicle_id);

        $data = [
            'vehicle_spendings' => $vehicleSpendings,
            'vehicle' => $vehicle,
            'total_vehicle_spendings' => $totalVehicleSpendings
        ];        

        $this->view('spendings/show', $data);
    }

    public function add($vehicle_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'comments' => trim($_POST['comments']),
                'price' => trim($_POST['price']),
                'vehicle_id' => $vehicle_id,               
                'name_error' => '',
                'comments_error' => '',
                'price_error' => ''  
            ];

            // Validate input values
            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter name of the item';
            }

            if (empty($data['price'])) {
                $data['price_error'] = 'Please enter price of the item';
            }

            if (empty($data['comments'])) {
                $data['comments_error'] = 'Please leave some comments about the item';
            }          

            // Make sure no errors
            if (empty($data['name_error'])   && empty($data['price_error']) && empty($data['comments_error'])) {                                       
                // Validated
                if ($this->spendingModel->addSpending($data)) {
                    flash('spendings_message', 'New item was added successfully!');
                    redirect('spendings/show/' . $vehicle_id);
                } else {
                    die('Error! Could not add new item to spendings!');
                }
                
            } else {
                // Load view with errors
                $this->view('spendings/add', $data);
            }

        } else {
            $data = [
                'name' => '',
                'comments' => '',
                'price' => '',                             
                'name_error' => '',
                'comments_error' => '',
                'price_error' => '',
                'vehicle_id' => $vehicle_id 
            ];
    
            $this->view('spendings/add', $data);
        }
    }
}