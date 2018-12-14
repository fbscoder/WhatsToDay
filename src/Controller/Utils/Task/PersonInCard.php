<?php
/**
 * Created by PhpStorm.
 * User: Marcell
 * Date: 14.12.2018
 * Time: 09:34
 */

namespace App\Controller\Utils\Task;


class PersonInCard
{
    public $name;

    /**
     * PersonInCard constructor.
     * @param String $name
     */
    public function __construct($name = null)
    {
        $this->name = $name;
    }
}