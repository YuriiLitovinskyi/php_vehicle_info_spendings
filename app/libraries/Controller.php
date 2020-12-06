<?php
/*
    * Base controller
    * Loads the models and views
*/

class Controller
{
    // Load model
    public function model($model)
    {
        if (file_exists('../app/models/' . $model . '.php')) {
            // Require model file
            require_once '../app/models/' . $model . '.php';

            // Instantiate model
            return new $model();
        } else {
            // Model does not exist
            die('Model ' . $model . ' does not exist');
        }
    }

    // Load view
    public function view($view, $data = [])
    {
        // Check for view file
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            die('View ' . $view . ' does not exist');
        }
    }
}
