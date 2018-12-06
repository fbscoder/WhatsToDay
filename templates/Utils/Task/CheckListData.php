<?php
/**
 * Created by PhpStorm.
 * User: Marcell
 * Date: 27.11.2018
 * Time: 12:15
 */

namespace App\Controller\Utils\Task;


use App\Controller\Utils\Task\CheckData;

class CheckListData
{
    public $name;
    public $check;

    /**
     * CheckListData constructor.
     * @param $name
     * @param $check
     */
    public function __construct($name = "", $check = null)
    {
        $this->name = $name;
        $this->check = $check;
    }


}