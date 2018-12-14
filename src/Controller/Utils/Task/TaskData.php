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
    public $labels;

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

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Trello|null
     */
    public function getCheckListData(): ?Trello
    {
        return $this->checkListData;
    }

    /**
     * @param Trello|null $checkListData
     */
    public function setCheckListData(?Trello $checkListData): void
    {
        $this->checkListData = $checkListData;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLabels()
    {
        return $this->labels;
    }

    /**
     * @param mixed $labels
     */
    public function setLabels($labels): void
    {
        $this->labels[] = $labels;
    }



}