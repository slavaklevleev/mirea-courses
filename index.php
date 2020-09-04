<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Курсы подготовки к ЕГЭ 2020</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://unpkg.com/imask"></script>
    <link rel="stylesheet" type="text/css" href="/styles.css">
</head>

<body>
    <h1>Предварительная заявка на очные подготовительные курсы</h1>
    <div class="form-area">
        <form id="form" name="form" onsubmit="sendInfo(); return false;">
            <div class="form-group" id="text">
                <label for="fio">ФИО учащегося <small class="text-muted">(обязательно)</small></label>
                <input type="text" id="fio" name="fio" required>
            </div>
            <div class="form-group" id="text">
                <label for="fio_parent">ФИО родителя <small class="text-muted">(обязательно)</small></label>
                <input type="text" id="fio_parent" name="fio_parent" required>
            </div>
            <div class="form-group" id="text">
                <label for="tel">Контактный телефон: <small class="text-muted">(обязательно)</small></label>
                <input type="tel" id="tel" name="tel" required>
            </div>
            <div class="form-group" id="text">
                <label for="email">Email: <small class="text-muted">(обязательно)</small></label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Класс обучения:</label>
                <br>
                <input type="radio" name="class" id="class_9" value="9">
                <label for="class_9">9 класс</label><br>

                <input type="radio" name="class" id="class_10" value="10">
                <label for="class_10">10 класс</label><br>

                <input type="radio" name="class" id="class_11" value="11" checked="">
                <label for="class_11">11 класс</label><br>

                <input type="radio" name="class" id="class_college" value="college">
                <label for="class_college">Колледж</label>
            </div>

            <p>Предметы (Можно выбрать любое кол-во предметов):</p>
            <div class="form-check form-group" id="numberSubj">
                <label class="form-check-label">
                    <input type="checkbox" name="subject" class="form-check-input" id="select_rus" value="rus">
                    Русский язык
                </label><br>

                <label class="form-check-label">
                    <input type="checkbox" name="subject" class="form-check-input" id="select_math" value="math" data-right="1">
                    Математика
                </label><br>

                <label class="form-check-label">
                    <input type="checkbox" name="subject" class="form-check-input" id="select_phys" value="phys" data-right="1">
                    Физика
                </label><br>

                <label class="form-check-label">
                    <input type="checkbox" name="subject" class="form-check-input" id="select_chem" value="chem" data-right="1">
                    Химия
                </label><br>

                <label class="form-check-label">
                    <input type="checkbox" name="subject" class="form-check-input" id="select_it" value="it">
                    Информатика
                </label>
            </div>

            <div class="agreement form-group visible" id="newsContainer">
                <label>Хотите ли вы получать от нас информационную рассылку?</label>
                <br>
                <input type="radio" name="news" id="news_yes" value="1" checked="">
                <label for="news_yes">да, хочу</label>&nbsp;&nbsp;
                <input type="radio" name="news" id="news_no" value="0">
                <label for="news_no">нет, не хочу</label>
            </div>

            <div class="agreement form-group form-check visible">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="agreement" onchange="agreementFunc(this.checked); return false;">
                    <small class="text-muted">Я даю согласие на&nbsp;<a href="http://www.priem.mirea.ru/agreement" target="_blank">обработку моих данных и&nbsp;перевод их в&nbsp;категорию общедоступных</a><span id="andMessangingAgreement"> и&nbsp;прошу, <a href="http://www.priem.mirea.ru/message-agreement" target="_blank">по взаимной договоренности сторон</a>, направлять мне информационные сообщения</span>.</small>
                </label>
            </div>

            <input type="submit" id="submit" value="Зарегистрироваться" disabled="true">
        </form>
    </div>
</body>

<script>
    var phoneMask = IMask(
        document.getElementById('tel'), {
            mask: '+{7} (000) 000-00-00'
        });

    function agreementFunc(checked) {
        if (checked) {
            document.getElementById("submit").disabled = false;
        } else {
            document.getElementById("submit").disabled = true;
        }
    }

    function sendInfo() {
        let formData = new FormData(document.forms.form);

        var selected = new Array();
        var chks = document.getElementById("numberSubj").getElementsByTagName("INPUT");

        for (var i = 0; i < chks.length; i++) {
            if (chks[i].checked) {
                selected.push(chks[i].value);
            }
        }

        if (selected.length > 0) {
            formData.set("subject", selected);
        } else {
            alert("Выбери хотя бы один предмет!")
            return false;
        }

        let ajax = new XMLHttpRequest();

        let json = JSON.stringify({
            fio: formData.get('fio'),
            fio_parent: formData.get('fio_parent'),
            tel: formData.get('tel'),
            email: formData.get('email'),
            class: formData.get('class'),
            subject: formData.get('subject'),
            news: formData.get('news'),
        });

        ajax.open("POST", "data.php", true);
        ajax.setRequestHeader('Content-type', 'application/json');
        ajax.send(json);

        ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (ajax.responseText == "ok") {
                    alert("Ваши данные отправлены!");
                } else {
                    alert("Произошла ошибка, попробуйте обновить страницу.");
                }
            }
        }

    }
</script>

</html>