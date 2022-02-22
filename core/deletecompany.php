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
    $res = $rq->makeRq($arParams, 'crm.company.list.json');

    $companyList = $res->result;

    foreach($companyList as $company){
        $arParams = [
            "id"=> $company->ID
        ];
        $res = $rq->makeRq($arParams, 'crm.company.delete');
    }
}
while(count($companyList)>0);

do{
    $arParams = [
        "order"=>["ID"=> "ASC" ],
        "filter"=>[">ID"=>"0"],
        "select"=>[ "ID"]
    ];
    $res = $rq->makeRq($arParams, 'crm.contact.list.json');

    $contactList = $res->result;

    foreach($contactList as $contact){
        $arParams = [
            "id"=> $contact->ID
        ];
        $res = $rq->makeRq($arParams, 'crm.contact.delete');
    }
}
while(count($contactList)>0);

echo("<h5>Успешно</h5>");