<?php
// Пишем функцию регистрации

$users = "pages/user.txt";
function register($name, $pass, $email)
{
    //Валидация данных
    $name = trim(htmlspecialchars($name));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));

    if ($name == '' || $pass == '' || $email == '') {
        echo "<h3><span style='color: red;'>Заполните все обязательные поля</span></h3>";
        return false;
    }
    if (strlen($name) < 3 || strlen($name) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
        echo "<h3><span style='color: red;'>Длина введенного имени и пароля должна быть не менее 3 и не более 30 символов</span></h3>";
        return false;
    }


    // Проверка логина на уникальность

    global $users;
    $file = fopen($users, mode: 'a+');
    while ($line = fgets($file, length: 128)) {
        $readname = substr($line, 0, strpos($line, needle: ":"));
        if ($readname == $name) {
            echo "<h3><span style='color: red;'>Такой логин уже существует</span></h3>";
            return false;
        }
    }

    // Запись данных о пользователе
    $line = $name . ':' . md5($pass) . ':' . $email . "\r\n";
    fputs($file, $line);
    fclose($file);
    return true;
}

// Пишем функцию авторизации

function login($login, $password)
{
    $login = trim(htmlspecialchars($login));
    $password = trim(htmlspecialchars($password));

    // Валидация данных

    if ($login == '' || $password == '') {
        echo "<h3><span style='color: red;'>Не все поля заполнены!</span></h3>";
        return false;
    }
    if (strlen($login) < 3 || strlen($login) > 30 || strlen($password) < 3 || strlen($password) > 30) {
        echo "<h3><span style='color: red;'>Введенные данные должны содержать не менее 3 и не более 30 символов!</span></h3>";
        return false;
    }

    global $users;
    $file = fopen($users, 'r');
    while ($line = fgets($file, length: 128)) {
        $data = explode(':', $line);
        //var_dump($data);
        if ($login == $data[0] && md5($password) == $data[1]) {
            fclose($file);
            return true;
        }
    }
    
    return false;
    
}
