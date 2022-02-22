<?
    session_start();
    require("./config/config.php");
    require("./core/classes/Requests.php");
    require("./core/classes/Faker.php");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <title>Portal Faker</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="">ПЕРВЫЙ БИТ DataFaker</a>
        <?
        if(!$_COOKIE["access_token"]){
            echo('<a class="btn btn-outline-success me-2" type="button" href="core/auth.php">Авторизоваться</a>');
        }
        ?>
    </div>
    </nav>

        
        <div class="content">
        <?
        if(!$_COOKIE["access_token"]){
            echo('
            <div class="msg">
            <h1 class="session">Сессия истекла</h1>
            <h3 class="session">Необходимо авторизоваться</h3>
            </div>');
        }else{
            ?>
            <div class="card col-lg-3">
                <div id="spinnerUsers">
                    <div class="spinner-border" style="width: 5rem; height: 5rem; color:white" role="status"></div>
                </div>
                <h3>Создать пользователей</h3>
                <form method="post" id="fakeUser">
                    <input id="usersCount"class="col-lg-10" type="text" name="count" placeholder="Кол-во пользователей max 50">
                    <input class="col-lg-10" type="submit" value="Создать пользователей">
                </form>
                <div id="resultUsers" class="result">
                    
                </div>
            </div>

            <div class="card col-lg-3">
                <div id="spinnerCompanys">
                    <div class="spinner-border" style="width: 5rem; height: 5rem; color:white" role="status"></div>
                </div>
                <h3>Создать Компании</h3>
                <form method="post" id="fakeCompany">
                    <input id="companyCount"class="col-lg-10" type="text" name="countCompany" placeholder="Кол-во Компаний max 100">
                    <input class="col-lg-10" type="submit" value="Создать Компании">
                </form>
                <button class="delete col-lg-10" id="deleteCompanys">Удалить все компании</button>
                <div id="resultCompany" class="result">
                    
                </div>
            </div>

            <div class="card col-lg-3">
                <div id="spinnerDeals">
                    <div class="spinner-border" style="width: 5rem; height: 5rem; color:white" role="status"></div>
                </div>
                <h3>Создать Сделки</h3>
                <form method="post" id="fakeDeals">
                    <input id="dealsCount" class="col-lg-10" type="text" name="countDeals" placeholder="Кол-во Сделок max 100">
                    <label for="start">Введите дату начала</label>
                    <input type="date" class="col-lg-10" name="start" id="start">
                    <label for="end">Введите дату окончания</label>
                    <input type="date" class="col-lg-10" name="end" id="end">
                    <input class="col-lg-10" type="submit" value="Создать Сделки">
                </form>
                <button class="delete col-lg-10" id="deleteDeals">Удалить все Сделки</button>
                <div id="resultDeals" class="result col-lg-10">
                    
                </div>
            </div>
            
            
        <?
        }
        ?>
        </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/app.js"></script>
</html>

    