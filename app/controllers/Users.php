<?php
class Users extends Controller
{
    public function __construct()
    {  
        $this->userModel = $this->model('User');
        $this->vehicleModel = $this->model('Vehicle');
        $this->spendingModel = $this->model('Spending');      
    }

    public function index()
    {
        redirect('vehicles');
    }

    public function register()
    {
        // Check for POST form user register
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Validate name
            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter name';
            } else if (strlen($data['name']) < 3) {
                $data['name_error'] = 'Name should contain at least 3 characters';
            } else if (strlen($data['name']) > 50) {
                $data['name_error'] = 'Name can contain maximum 50 characters';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter email';
            } else {
                // Check if email exists in DB
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_error'] = 'Provided email has already been taken. Please try another one';
                }
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            } else if (strlen($data['password']) < 6) {
                $data['password_error'] = 'Password should contain at least 6 characters';
            } else if (strlen($data['password']) > 50) {
                $data['password_error'] = 'Password can contain maximum 50 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Please confirm your password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_error'] = 'Password do not match';
                }
            }

            // Make sure errors are empty
            if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                // Validated

                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if ($this->userModel->register($data)) {
                    // User was registered
                    flash('register_success', 'You are now registered and can log in');  // helper function
                    redirect('users/login');   // helper function
                } else {
                    die('An error occurred! Could not register new user!');
                };
            } else {
                // Load view with errors             
                $this->view('users/register', $data);
            }
        } else {
            //Init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // Check for POST form user login
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => ''
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter email';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            }

            // Check for user/email in db
            if ($this->userModel->findUserByEmail($data['email'])) {
                // User found
            } else {
                // User not found in db
                $data['email_error'] = 'User not found! Please provide correct email';
            }


            // Make sure errors are empty
            if (empty($data['email_error']) && empty($data['password_error'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // Create Session                  
                    $this->createUserSession($loggedInUser);                 
                } else {
                    $data['password_error'] = 'Wrong password! Please try again';

                    // Reload view with error
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors             
                $this->view('users/login', $data);
            }
        } else {
            //Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => ''
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['expire'] = time() + (SESSIONEXPIRE * 24 * 60 * 60 );  // 30 days
        redirect('vehicles');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['expire']);
        session_destroy();
        redirect('users/login');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }    

    public function edit($id)
    {     
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {         
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Init data
            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Validate name
            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter new name';
            } else if (strlen($data['name']) < 3) {
                $data['name_error'] = 'Name should contain at least 3 characters';
            } else if (strlen($data['name']) > 50) {
                $data['name_error'] = 'Name can contain maximum 50 characters';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter new email';
            } else {
                //Check if email exists in DB
                if ($this->userModel->findUserByEmail($data['email']) && $this->userModel->getUserById($id)->email != $data['email']) {
                    $data['email_error'] = 'Provided email has already been taken. Please try another one';
                }
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            } else if (strlen($data['password']) < 6) {
                $data['password_error'] = 'Password should contain at least 6 characters';
            } else if (strlen($data['password']) > 50) {
                $data['password_error'] = 'Password can contain maximum 50 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Please confirm your password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_error'] = 'Password do not match';
                }
            }

            // Make sure errors are empty
            if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                // Validated

                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Update User
                if ($this->userModel->editProfile($data)) {
                    // User was updated
                    $this->logout(); 
                    flash('profile_change', 'Profile was successfully updated. You can log in now with new credentials');  // Not working after logout()  
                } else {
                    die('An error occurred! Could not update user profile info!');
                };               

            } else {
                // Load view with errors             
                $this->view('users/edit', $data);
            }
        } else {
            // Get existing User from model
            $user = $this->userModel->getUserById($id);

            // Check for owner
            if ($user->id != $_SESSION['user_id']) {              
                redirect('vehicles');
            }

            //Init data
            $data = [
                'id' => $id,
                'name' => $user->name,
                'email' => $user->email,
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Load view
            $this->view('users/edit', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get existing User from model
        $user = $this->userModel->getUserById($id);

        // Check for owner
        if ($user->id != $_SESSION['user_id']) {           
            redirect('vehicles');
        }
          
        if ($this->userModel->deleteUserProfile($id) && $this->vehicleModel->deleteAllUserVehicles($id) && $this->spendingModel->deleteAllUserSpendings($id)) {
            $this->logout(); 
            flash('profile_change', 'Your Profile, vehicles and spendings were deleted successfully');  // Not working after logout()  
        } else {
            flash('profile_change', 'Error! Could not delete profile! Please try again', 'alert alert-danger');
            redirect('vehicles');
            //die('Error! Could not delete vehicle!');
        }
    } else {
        redirect('vehicles');
    }
    }
}
