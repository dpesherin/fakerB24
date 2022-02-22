<?
session_start();
require('../config/config.php');
require('./classes/Faker.php');
require('./classes/Requests.php');

if(!$_POST['count']){
    $count= '2';
}else{
    $count = $_POST['count'];
}

$fake = new Faker;
$fakeUser = $fake->fakeUser($count);


foreach($fakeUser as $user){
    $rq = new Requests;
    $arParams = [
        "LAST_NAME"=>$user["LastName"],
        "NAME"=>$user["FirstName"],
        "SECOND_NAME"=>$user["FatherName"],
        "PERSONAL_BIRTHDAY"=>$user["DateOfBirth"],
        "PERSONAL_PHONE"=>$user["Phone"],
        "EMAIL"=>$user["Email"],
        "UF_DEPARTMENT"=>1
    ];
    $res = $rq->makeRq($arParams, 'user.add.json');
    
    
}

echo("<h5>Успешно</h5>");