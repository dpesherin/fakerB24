<?
session_start();
require('../config/config.php');
require('./classes/General.php');


if($_GET['code']){

    $general = new General;
    $res = $general->getToken();
    setcookie("access_token", $res->access_token, time() +3600, '/');
    header("Location: ../index.php");

}else{

    $general = new General;
    $res = $general->getCode();
    
}

?>

