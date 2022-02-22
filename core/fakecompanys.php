<?
session_start();
require('../config/config.php');
require('./classes/Faker.php');
require('./classes/Requests.php');

$count = $_POST['countCompany'];
$fake = new Faker;
$fakeCompany = $fake->fakeCompany($count);

echo("<h5>Успешно</h5>");