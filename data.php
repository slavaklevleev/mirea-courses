<?php

//Подключение к базе данных
$db = mysqli_connect('localhost', 'admin', 'qwer1234', 'mirea-courses');
if (!$db) {
    echo "Ошибка при подключении к базе данных" . mysqli_connect_error();
    exit;
}

//Получение данных из запроса
$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload, true);

//Обработка данных
$fio = mysqli_real_escape_string($db, $object['fio']);
$fio_parent = mysqli_real_escape_string($db, $object['fio_parent']);
$tel = mysqli_real_escape_string($db, $object['tel']);
$email = mysqli_real_escape_string($db, $object['email']);
$class = mysqli_real_escape_string($db, $object['class']);
$subject = mysqli_real_escape_string($db, $object['subject']);
$news = mysqli_real_escape_string($db, $object['news']);

//Запрос в базу данных
$query = "INSERT INTO `clients`(`student`, `parent`, `tel`, `email`, `class`, `subject`, `newsletter_agree`) VALUES ('$fio','$fio_parent','$tel','$email','$class','$subject','$news')";
$result = mysqli_query($db, $query);
//or die("Ошибка при авторизации" . mysqli_error($db));

if ($result) {
    echo "ok";
} else {
    echo "not okay";
}