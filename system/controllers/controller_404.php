<?php

class Controller_404 extends Controller
{

    function action_index()
    {
        $this->view->generate('404_viewer.php', 'template_viewer.php');
    }

}
