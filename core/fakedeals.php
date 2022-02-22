<?
session_start();
require('../config/config.php');
require('./classes/Faker.php');
require('./classes/Requests.php');

$count = $_POST['countDeals'];
$start = strtotime($_POST['start']);
$end = strtotime($_POST['end']);

$rq = new Requests;
$arParams = [
    "order"=>["SORT"=> "ASC"],
    "filter"=> ["ENTITY_ID"=> "DEAL_STAGE"]
];
$res = $rq->makeRq($arParams, 'crm.status.list.json');
$stageList = $res->result;
$stageCount = count($stageList);

$rq = new Requests;
$arParams = [
    "order"=>["ID"=> "ASC" ],
    "filter"=>[">ID"=>"0"],
    "select"=>[ "ID"]
];
$res = $rq->makeRq($arParams, 'crm.company.list.json');

$companyList = $res->result;
$companyCount = count($companyList);

for($i=1; $i<=$count; $i++){
    $dateEnd = NULL;
    $summ = rand(100000, 1000000);
    $stage = rand(0, $stageCount-1);
    $company = rand(0, $companyCount-1);

    if($stageList[$stage]->EXTRA->SEMANTICS === 'process'){
        $dateStart = rand($start, $end);
        $dateStart = date("Y-m-d",$dateStart);
    }else{
        $dateEnd = rand($start, $end);
        $dateStart = $dateEnd - 100000;

        $dateEnd = date("Y-m-d",$dateEnd);
        $dateStart = date("Y-m-d",$dateStart);
    }

    
    $arParams = [
        "fields"=>[
            "TITLE"=> "FakeDeals#".$i, 
            "TYPE_ID"=> "GOODS", 
            "STAGE_ID"=> $stageList[$stage]->STATUS_ID, 					
            "COMPANY_ID"=> $companyList[$company]->ID,
            "OPENED"=> "Y", 
            "ASSIGNED_BY_ID"=> 1, 
            "CURRENCY_ID"=> "RUB", 
            "OPPORTUNITY"=> $summ,
            "CATEGORY_ID"=> 0,
            "BEGINDATE"=> $dateStart,
        ],
        "params"=>[
            "REGISTER_SONET_EVENT"=> "N"
        ]
    ];

     $rq = new Requests;
     $res = $rq->makeRq($arParams, 'crm.deal.add');
     $dealID = $res->result;

     if($stageList[$stage]->EXTRA->SEMANTICS != 'process'){
        $dateStart = rand($start, $end);
        $dateStart = date("Y-m-d",$dateStart);

        $arParams = [
            "id"=>$dealID,
            "fields"=>[
                "CLOSEDATE"=>$dateEnd
            ],
            "params"=>[
                "REGISTER_SONET_EVENT"=> "N"
            ]
        ];

        $rq = new Requests;
        $res = $rq->makeRq($arParams, 'crm.deal.update');
    }
}

echo("<h5>Успешно</h5>");