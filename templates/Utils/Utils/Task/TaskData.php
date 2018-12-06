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
    public $id;

    /**
     * TaskData constructor.
     * @param null $id
     * @param string $title
     * @param string $description
     * @param $checkListData
     */
    public function __construct($id = null, $title = "", $description = "", $checkListData = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->checkListData = $checkListData;
    }

}