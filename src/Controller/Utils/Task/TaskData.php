<?php
/**
 * Created by PhpStorm.
 * User: Marcell
 * Date: 27.11.2018
 * Time: 12:14
 */

namespace App\Controller\Utils\Task;


use App\Controller\Utils\Person\PersonData;

class TaskData
{
    public $title;
    public $description;
    public $checkListData;
    public $id;
    public $personInCard;

    /**
     * TaskData constructor.
     * @param null $id Trello card id
     * @param string $title Trello card title
     * @param string $description Trello card description
     * @param CheckListData[] $checkListData Trello checklist list
     * @param PersonData[] $personInCard all person that are attached to the card
     */
    public function __construct($id = null, $title = "", $description = "", $checkListData = null, $personInCard = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->checkListData = $checkListData;
        $this->personInCard = $personInCard;
    }

}