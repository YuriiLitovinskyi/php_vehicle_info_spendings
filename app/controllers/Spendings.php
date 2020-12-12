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

    public function show($vehicle_id, $pageNumber = 1)
    {
        $vehicle = $this->vehicleModel->getVehicleById($vehicle_id);

        $totalVehicleSpendings = $this->spendingModel->calculateTotalSpendings($vehicle_id);

        // Pagination
        // Number of rows, which belong to vehicle
        $numberOfSpendingsRows = $this->spendingModel->getNumberOfSpendingsRows($vehicle_id);

        // Nember of spendings items per page
        $spendingsRowsPerPage = 10;

        // Total pages number of spendings for particular vehicle
        $totalPages = ceil((int)$numberOfSpendingsRows[0]->total_spend_rows / $spendingsRowsPerPage);

        // Set current page
        if (isset($pageNumber) && is_numeric($pageNumber)) {
            $currentPage = (int)$pageNumber;
        } else {
            $currentPage = 1;
        }

        // validate current page
        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }
        if ($currentPage < 1) {
            $currentPage = 1;
        }

        // the offset of the list, based on current page 
        $offset = ($currentPage - 1) * $spendingsRowsPerPage;

        // Get vehicle spendings
        $vehicleSpendings = $this->spendingModel->getVehicleSpendings($vehicle_id, $offset, $spendingsRowsPerPage);

        $data = [
            'vehicle_spendings' => $vehicleSpendings,
            'vehicle' => $vehicle,
            'total_vehicle_spendings' => $totalVehicleSpendings,
            'current_page' => $currentPage,
            'total_pages' => $totalPages
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
                'user_id' => $_SESSION['user_id'],
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
            if (empty($data['name_error']) && empty($data['price_error']) && empty($data['comments_error'])) {
                // Validated
                if ($this->spendingModel->addSpending($data)) {
                    flash('spendings_message', 'New item was added successfully');
                    redirect('spendings/show/' . $vehicle_id);
                } else {
                    flash('spendings_message', 'Error! Could not add new item to spendings! Please try again', 'alert alert-danger');
                    redirect('spendings/show/' . $vehicle_id);
                    //die('Error! Could not add new item to spendings!');
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
                'vehicle_id' => $vehicle_id,
                'user_id' => $_SESSION['user_id']
            ];

            $this->view('spendings/add', $data);
        }
    }

    public function edit($id, $vehicle_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
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
            if (empty($data['name_error']) && empty($data['price_error']) && empty($data['comments_error'])) {
                // Validated
                if ($this->spendingModel->editSpending($data)) {
                    flash('spendings_message', 'Item was updated successfully', 'alert alert-primary');
                    redirect('spendings/show/' . $vehicle_id);
                } else {
                    flash('spendings_message', 'Error! Could not update item! Please try again', 'alert alert-danger');
                    redirect('spendings/show/' . $vehicle_id);
                    //die('Error! Could not edit current item!');
                }
            } else {
                // Load view with errors
                $this->view('spendings/edit', $data);
            }
        } else {
            // Get existing Spending item from model
            $item = $this->spendingModel->getSpendingById($id);

            $data = [
                'id' => $id,
                'name' => $item->name,
                'comments' => $item->comments,
                'price' => $item->price,
                'name_error' => '',
                'comments_error' => '',
                'price_error' => '',
                'vehicle_id' => $vehicle_id
            ];

            $this->view('spendings/edit', $data);
        }
    }

    public function delete($id, $vehicle_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get existing Vehicle from model
            $item = $this->spendingModel->getSpendingById($id);

            if ($this->spendingModel->deleteSpending($id)) {
                flash('spendings_message', 'Item was removed successfully', 'alert alert-info');
                redirect('spendings/show/' . $vehicle_id);
            } else {
                flash('spendings_message', 'Error! Could not delete item! Please try again', 'alert alert-danger');
                redirect('spendings/show/' . $vehicle_id);
                //die('Error! Could not delete spending item!');
            }
        } else {
            redirect('spendings/show/' . $vehicle_id);
        }
    }
}
