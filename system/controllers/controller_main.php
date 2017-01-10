<?php

class Controller_Main extends Controller
{

    function action_index()
    {
        $this->view->generate('main_viewer.php', 'template_viewer.php');
    }
}