<?php

class Controller_Contacts extends Controller
{

    function action_index()
    {
        $this->view->generate('contacts_viewer.php', 'template_viewer.php');
    }
}
