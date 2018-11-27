<?php
/**
 * Created by PhpStorm.
 * User: Marcell
 * Date: 27.11.2018
 * Time: 12:14
 */

namespace App\Controller\Utils\Task;


class TaskData
{
    public $title;
    public $description;
    public $checkListData;

    /**
     * TaskData constructor.
     * @param $title
     * @param $description
     * @param $checkListData
     */
    public function __construct($title = "", $description = "", $checkListData = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->checkListData = $checkListData;
    }

}