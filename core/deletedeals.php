<?
session_start();
require('../config/config.php');
require('./classes/Requests.php');
do{
    $rq = new Requests;
    $arParams = [
        "order"=>["ID"=> "ASC" ],
        "filter"=>[">ID"=>"0"],
        "select"=>[ "ID"]
    ];
    $res = $rq->makeRq($arParams, 'crm.deal.list.json');

    $dealList = $res->result;

    foreach($dealList as $deal){
        $rq = new Requests;
        $arParams = [
            "id"=> $deal->ID
        ];
        $res = $rq->makeRq($arParams, 'crm.deal.delete');
    }
}
while(count($dealList)>0);
echo("<h5>Успешно</h5>");