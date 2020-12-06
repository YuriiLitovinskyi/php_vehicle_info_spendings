<?php
class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {

        $data = [
            'title' => 'Vehicle info'
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About App',
            'description' => 'App to track main info about your vehicle'
        ];
        $this->view('pages/about', $data);
    }
}
