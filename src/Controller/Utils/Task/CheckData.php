<?php
/**
 * Created by PhpStorm.
 * User: Marcell
 * Date: 27.11.2018
 * Time: 12:15
 */

namespace App\Controller\Utils\Task;


class CheckData
{
    public $name;
    public $isChecked;
    public $itemId;
    /**
     * CheckData constructor.
     * @param string $name Trello checkBox title
     * @param bool $isChecked true | false
     */
    public function __construct($name = "", $isChecked = false, $itemId = "")
    {
        $this->name = $name;
        $this->isChecked = $isChecked;
        $this->itemId = $itemId;
    }

}