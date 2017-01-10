<?php

class Controller_Portfolio extends Controller
{

    function __construct()
    {
        $this->model = new Model_Portfolio();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        /*$data = array (0 => array (
        'id' => '1', 0 => '1',
        'login' => 'MyDark',
        1 => 'MyDark',
        'password' => 'password',
        2 => 'password',
        'email' => 'agressortm@gmail.com',
        3 => 'agressortm@gmail.com',
        'reg_date' => '2017-01-10 06:54:56',
        4 => '2017-01-10 06:54:56'))
        */
        $this->view->generate('portfolio_viewer.php', 'template_viewer.php', $data);
    }
}
