<?php

namespace App\Controller\Utils;

use App\Controller\Utils\Task\CheckData;
use App\Controller\Utils\Task\CheckListData;
use App\Controller\Utils\Task\TaskData;
use DateTime;
use Trello\Client;

/**
 * @property Client client
 */
class APIUtils
{
    public static function setTaskToFinish($cardId)
    {
        $client = APIUtils::getClient();
        $card = $client->api("cards")->show($cardId);
        $card["dueComplete"] = 1;
        $client->api("cards")->update($cardId, $card);

    }

    private static function getClient()
    {
        $client = new Client();
        $person = $_SESSION["PersonData"];
        $client->authenticate('aa8b7e7e0a878b7f8e6d805c78ff2526', $person->TOKEN, Client::AUTH_URL_CLIENT_ID);
        //$client->authenticate('aa8b7e7e0a878b7f8e6d805c78ff2526', 'ec0c8c9c53c3931330d1186a26ff4038127862bcb8d4fd4455189b1e5f96a0f2', Client::AUTH_URL_CLIENT_ID);
        //$client->authenticate('aa8b7e7e0a878b7f8e6d805c78ff2526', '90dec1d14cd5336ba006af1bd79829c1a6ed45480130c3a40fb7fccf3d1927e4', Client::AUTH_URL_CLIENT_ID);

        return $client;
    }

    public static function test()
    {
        $client = APIUtils::getClient();

    }

    public
    static function getBoardTasksTomorrow($board)
    {
        $datetime = new DateTime('tomorrow');
        $datetime = $datetime->format('Ymd');
        return APIUtils::getTaskList($board, $datetime);
    }

    private static function getTaskList($board, $dateToCheck)
    {
        $client = APIUtils::getClient();
        $taskList = [];
        foreach ($client->api("boards")->cards()->all($board) as $card) {
            $endDate = $card["due"];
            if ($dateToCheck == date('Ymd', strtotime($endDate)) && !$card["dueComplete"]) {
                $taskData = null;
                $title = $card["name"];
                $description = $card["desc"];
                $cardId = $card["id"];
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
                        $checkData[] = new CheckData($checkName, $isChecked);
                    }
                    $checkListData[] = new CheckListData($checkListName, $checkData);
                }
                if ($taskData == null && $checkListData == [])
                    $taskData = new TaskData($cardId, $title, $description, null);
                else {
                    $taskData = new TaskData($cardId, $title, $description, $checkListData);
                }
                $taskList[] = $taskData;
            }
        };
        return $taskList;
    }

    static function getBoardTasksToday($board)
    {
        return APIUtils::getTaskList($board, date('Ymd'));
    }

    public
    static function getCountedTasks($taskList)
    {
        return count($taskList);
    }

    public
    static function getBoards()
    {
        $client = APIUtils::getClient();
        $boards = $client->api("member")->boards()->all();
        return $boards;
    }
}


