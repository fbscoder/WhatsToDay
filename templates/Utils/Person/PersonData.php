<?php

namespace App\Controller\Utils\Person;

class PersonData
{
    public $ID;
    public $TOKEN;

    public function __construct($ID = null, $TOKEN = null)
    {
        $this->ID = $ID;
        $this->TOKEN = $TOKEN;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function setTOKEN($TOKEN)
    {
        $this->TOKEN = $TOKEN;
    }

}