<?php

namespace App\Controller\Utils;

use Trello\Client;
use Trello\Manager;

class APIUtils
{

    public static function test()
    {
        $person = $_SESSION["PersonUtils"];

        $client = new Client();
        echo $person->API_KEY . "<br>";
        echo $person->TOKEN . "<br>";
        echo $person->ID . "<br>";

        //$client->authenticate($person->API_KEY, $person->TOKEN, Client::AUTH_URL_CLIENT_ID);
        $client->authenticate('aa8b7e7e0a878b7f8e6d805c78ff2526', '90dec1d14cd5336ba006af1bd79829c1a6ed45480130c3a40fb7fccf3d1927e4', Client::AUTH_URL_CLIENT_ID);
        //Board array
        $boards = $client->api("member")->boards()->all();
        //List array
        $cardList = $client->api("boards")->lists()->all($boards[0]["id"]);
        //Card array
        $cards = $client->api("lists")->cards()->all($cardList[1]["id"]);
        //CheckList Array for single card
        $checkList = $client->api("cards")->checklists()->all($cards[1]["id"]);

        //Update dueComplete to complete //
        $cards[1]["dueComplete"] = 1;
        $client->api("cards")->update($cards[1]["id"], $cards[1]);
        // !!!!!!! //

        echo "<pre>";
        print_r($cards);
    }

}


