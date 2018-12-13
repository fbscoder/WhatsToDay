<?php
/**
 * Created by PhpStorm.
 * User: Marcell
 * Date: 27.11.2018
 * Time: 12:15
 */

namespace App\Controller\Utils\Task;

class CheckListData
{
    public $name;
    public $check;
    public $checkListId;
    /**
     * CheckListData constructor.
     * @param string $name Trello checklist Name
     * @param $check CheckData object
     */
    public function __construct($name = "", $check = null, $checkListId = '')
    {
        $this->name = $name;
        $this->check = $check;
        $this->checkListId = $checkListId;
    }


}