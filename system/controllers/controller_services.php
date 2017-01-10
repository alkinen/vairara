<?php

class Controller_Services extends Controller
{

    function action_index()
    {
        $this->view->generate('services_viewer.php', 'template_viewer.php');
    }
}
