<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Полимерные полы</title>
    <link rel="stylesheet" href="../main.css">
    <link rel="icon" href="../img/Favicon.png" type="image/svg+xml">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $phone = strip_tags(trim($_POST["phone"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $floor = strip_tags(trim($_POST["floor"]));

    // Сообщение об отправке заявки
    $message = "";
    
    // Флаг ошибки
    $error = 0;

    // Проверка на заполненность полей
    if (!isset($name) || empty($name) || 
        !isset($phone) || empty($phone) || 
        !isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        !isset($floor) || empty($floor))
    {
        // Если поля пусты или email невалиден, то возвращаем ошибку
        http_response_code(400);
        $message = "Ошибка отправки. Пожалуйста, заполните все поля и убедитесь, что email введен корректно.";
        $error = 1; // Произошла ошибка
    }

    // Если все поля заполнены, отправить письмо на почту менеджера
    if ($error == 0){
        // Адрес, на который будет отправлено письмо
        $recipient = "flexfloor@yandex.ru";
    
        // Тема письма
        $subject = "Новый заказ от $name";
    
        // Содержимое письма
        $email_content = "Имя: $name\n";
        $email_content .= "Телефон: $phone\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Тип пола: $floor\n";
    
        // Заголовки письма
        $email_headers = "From: $name <$email>";
    
        // Отправка письма
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Если письмо успешно отправлено
            http_response_code(200);
            $message = "Спасибо! Ваша заявка была отправлена менеджеру.";
        } else {
            // Если при отправке письма возникла ошибка
            http_response_code(500);
            $message = "Ой! Что-то пошло не так, и мы не смогли отправить вашу заявку.";
        }
    }


} else {
    // Если форма не отправлена методом POST, возвращаем ошибку
    http_response_code(403);
    $message = "Ошибка. Произошла ошибка с вашим запросом.";
}
?>


<body>
    <header>
        <div class="header2">
            <a href="../index.html" id="hed">
                <img class="header__logo" src="../img/Logot.jpg" alt="logo">
            </a>
        </div>
        <div class="contacts">
            <h5>Время работы:</h5>
            <span>Пн-Вс:09:00 - 21:00</span>

        </div>
        <div class="button">
            <a href="tel:74959999999">+79179156716</a>
            <a href="tel:74959999999">+79606906142</a>
            <a href="../floorabout.html">Примеры работ</a>
            <a href="../about.html">О нас</a>
            <a href="../contacts.html">Контакты</a>
        </div>

    </header>
    <section class="about" style="min-height:50vh">
        <div class="about__info">
            
            <br>
            <h2><?php echo $message; ?></h2>
            <br>
            
            <!--
            <span>Занимаемся полимерным покрытием более 20-лет</span>
            <p>Основательные полы, для основательного бизнеса</p> 
            -->
        </div>
        
        <div  class="about__images">
            <img class="about__image">
        </div>
    </section>
 

<footer>
    <div class="footer__container">
        <div class="footer__group">
            <h3>Позвонить нам:</h3>
            <div class="footer__links">
            <a href="tel:74959999999">+79179156716</a>
            <a href="tel:74959999999">+79606906142</a>
            </div>
        </div>
        <div class="footer__group2">
            <h3>Решения для вас:</h3>
            <div class="footer__links2">
              <a href="../epoxy.html">Эпоксидные</a>
              <a href="../Acrylic.html">Акриловые</a>
              <a href="../polyurethane.html">Полиуретановые</a>
            </div>
          </div>
          <div class="footer__group3">
            <h3>О нас</h3>
            <div class="footer__links3">
                <a href="../contacts.html">Контакты</a>
                <a href="#">Вакансии</a>
                <a href="#">Основание компании</a>
            </div>
          </div>
    </div>
    <div class="footer__copyright">Floor©2024</div>
</footer>

</body>
</html>