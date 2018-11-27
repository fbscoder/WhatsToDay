<?php

namespace App\Controller\Utils;

class PersonData{
    public $ID;
    public $API_KEY;
    public $TOKEN;

    public function __construct($ID = null, $API_KEY = null, $TOKEN = null)
    {
        $this->ID = $ID;
        $this->API_KEY = $API_KEY;
        $this->TOKEN = $TOKEN;
    }

    public function setID($ID)
    {
        $this->ID = $ID;
    }

    public function setAPI_KEY($API_KEY)
    {
        $this->API_KEY = $API_KEY;
    }

    public function setTOKEN($TOKEN)
    {
        $this->TOKEN = $TOKEN;
    }

}