<?php

class Model_Portfolio extends Model
{

    public function get_data()
    {
        return $this->selectFunction('localhost', 'lessons', 'root', '', 'utf-8');

    }

}
