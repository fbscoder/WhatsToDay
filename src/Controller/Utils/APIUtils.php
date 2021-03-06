<?php

namespace App\Controller\Utils;

use App\Controller\Utils\Task\CheckData;
use App\Controller\Utils\Task\CheckListData;
use App\Controller\Utils\Task\TaskData;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Trello\Client;

/**
 * @property Client client
 */
class APIUtils
{
    /**
     * Finish the Trello card
     * @param integer $cardId Trello card id
     */
    public static function setTaskToFinish($cardId)
    {
        $client = APIUtils::getClient();
        $card = $client->api("cards")->show($cardId);
        $card["dueComplete"] = 1;
        $client->api("cards")->update($cardId, $card);

    }

    /**
     * Get the Trello api client
     * @return Client Trello api client
     */
    private static function getClient()
    {
        $client = new Client();
        $person = $_SESSION["PersonData"];
        $client->authenticate('aa8b7e7e0a878b7f8e6d805c78ff2526', $person->TOKEN, Client::AUTH_URL_CLIENT_ID);

        return $client;
    }

    /**
     * Get all cards from tomorrow form a board
     * @param integer $board Trello board id
     * @return array array Trello card list
     * @throws \Exception
     */
    public static function getBoardTasksTomorrow($board)
    {
        $datetime = new DateTime('tomorrow');
        $datetime = $datetime->format('Ymd');
        return APIUtils::getTaskList($board, $datetime);
    }

    /**
     * Get all cards from a board
     * @param integer $board Trllo board id
     * @param DateTime $dateToCheck Date to check
     * @return array array Trello card list
     */
    private static function getTaskList($board, $dateToCheck)
    {
        $client = APIUtils::getClient();
        $taskList = [];
        $cards = null;
        $admin_boolean = false;
        $userID = $client->api("token")->getMember($_SESSION["PersonData"]->TOKEN);
        foreach ($client->api("boards")->members()->filter($board, "admins") as $admin) {
            if ($userID["id"] == $admin["id"]) {
                $admin_boolean = true;
                break;
            }
        }
        if ($admin_boolean) {
            $cards = $client->api("boards")->cards()->all($board);
        } else {
            $cards = $client->api("member")->cards()->all($userID["id"]);
        }

        foreach ($cards as $card) {
            if ($card["idBoard"] == $board) {
                $endDate = $card["due"];
                if ($dateToCheck == date('Ymd', strtotime($endDate)) && !$card["dueComplete"]) {
                    $taskData = null;
                    $title = $card["name"];
                    $description = $card["desc"];
                    $cardId = $card["id"];

                    $memberList = [];
                    if ($admin_boolean) {
                        foreach ($card["idMembers"] as $memberId) {
                            //echo "<pre>";
                            //print_r($card["idMembers"]);
                            //  echo $client->api("member")->show($memberId)["fullName"];
                            $memberList[] = $client->api("member")->show($memberId)["fullName"];

                        }
                    }

                    $checkListData = [];
                    foreach ($checkList = $client->api("cards")->checklists()->all($card["id"]) as $checkList) {
                        $checkListName = $checkList["name"];
                        $checkData = [];
                        foreach ($client->api("checklists")->items()->all($checkList["id"]) as $checkItem) {
                            $isChecked = true;
                            if ($checkItem["state"] == "incomplete") {
                                $isChecked = false;
                            }
                            $checkName = $checkItem["name"];
                            $checkData[] = new CheckData($checkName, $isChecked, $checkItem['id']);
                        }
                        $checkListData[] = new CheckListData($checkListName, $checkData, $checkList['id']);
                    }
                    if ($taskData == null && $checkListData == [])
                        $taskData = new TaskData($cardId, $title, $description, null, $memberList);
                    else {
                        $taskData = new TaskData($cardId, $title, $description, $checkListData, $memberList);
                    }
                    foreach ($card['labels'] as $i => $label) {
                        unset($label['id']);
                        unset($label['idBoard']);
                        $taskData->setLabels($label);
                    }
                    $taskList[] = $taskData;
                }
            }
        };

        return $taskList;
    }

    /**
     * Get all cards from today form a board
     * @param integer $board Trello board id
     * @return array Trello card list
     */
    public
    static function getBoardTasksToday($board)
    {
        return APIUtils::getTaskList($board, date('Ymd'));
    }

    /**
     * Count a card list
     * @param array $taskList card list to count
     * @return integer int get counted Cards
     */
    public
    static function getCountedTasks($taskList)
    {
        return count($taskList);
    }

    /**
     * Get all Trello boards from a user
     * @return array mixed all boards from a user
     */
    public
    static function getBoards()
    {
        $client = APIUtils::getClient();
        $boards = $client->api("member")->boards()->all();
        return $boards;
    }

    /**
     * @Route("/setCheckListItemCompleted")
     */

    public
    function setCheckListItemCompleted()
    {
        $client = APIUtils::getClient();
        $params['name'] = $_POST['checkItemName'];
        $params['state'] = $_POST['state'];
        $client->api('checklist')->items()->update($_POST['checkListId'], $_POST['checkListItemId'], $params);
        $checkList = $client->api("checklists")->items()->all($_POST['checkListId']);
        foreach ($checkList as $item) {
            if ($item['name'] == $_POST['checkItemName']) {
                return new Response($item['id']);
            }
        }
        return new Response('Form funktioniert');

    }
}


