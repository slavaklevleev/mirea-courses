<?php

function returnError($reason) {
    http_response_code(400);
    echo $reason;
    exit;
}

//Подключение к базе данных
$db = mysqli_connect('localhost', 'root', '1234', 'test');
if (!$db) {
    echo "Ошибка при подключении к базе данных" . mysqli_connect_error();
    exit;
}

//Получение данных из запроса
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload, true);

//Обработка данных
if (isset($object['fio'])) $fio = mysqli_real_escape_string($db, $object['fio']);
else returnError("Не указаны ФИО");

if (isset($object['fio_parent'])) $fio_parent = mysqli_real_escape_string($db, $object['fio_parent']);
else returnError("Не указаны ФИО родителя");

if (isset($object['tel'])) $tel = mysqli_real_escape_string($db, $object['tel']);
else returnError("Не указан телефон");

if (isset($object['email'])) $email = mysqli_real_escape_string($db, $object['email']);
else returnError("Не указан email");

if (isset($object['class'])) $class = mysqli_real_escape_string($db, $object['class']);
else returnError("Не указан класс");

if (isset($object['subject'])) $subject = mysqli_real_escape_string($db, $object['subject']);
else returnError("Не указан предмет");

if (isset($object['news'])) $news = mysqli_real_escape_string($db, $object['news']);
else $news = 0;

//Запрос в базу данных
$query = "INSERT INTO `clients`(`student`, `parent`, `tel`, `email`, `class`, `subject`, `newsletter_agree`) VALUES ('$fio','$fio_parent','$tel','$email','$class','$subject','$news')";
$result = mysqli_query($db, $query);
//or die("Ошибка при авторизации" . mysqli_error($db));

if ($result) {
    echo "ok";
} else {
    http_response_code(400);
    echo mysqli_error($db);
}