# Tech steps
> Для развертывания ctfn необходим vps сервер.

1. Скачайте папку `/contracts/`из репозитория.
2. Задеплойте `/contracts/CtfnAdmin.sol` из репозитория в тестовую и основную сети BNB
3. Загрузите файлы директории `/src/` на vps-сервер
4. Настройте домен на открытие `/frontend/web/index.php`
5. Настройте поддомен admin для открытия `/backend/web/index.php`

## Настройка конфигурационного файла /frontend/config/main.php
6. В ключе `homeUrl` укажите прямую ссылку на домен: https://example.com
7. В ключе `db` укажите настройки для подключения к базе данных
8. в ключе `reCaptcha` укажите api ключи от Google Captcha v3 

## Настройка конфигурационного файла /frontend/config/main-local.php
9. В ключе `cookieValidationKey` укажите рандомную строку md5().

## Настройка конфигурационного файла /backend/config/main.php
10. В ключе `homeUrl` укажите прямую ссылку на поддомен: https://admin.example.com
11. В ключе `db` настройки для подключения к базе данных

## Настройка конфигурационного файла /backend/config/params.php
12. В adminEmail укажите email адрес администратора

## Настройка конфигурационного файла /backend/config/main-local.php
13. В ключе `cookieValidationKey` укажите рандомную строку `md5()`.

## Настройка конфигурационного файла /common/config/params.php
14. в ключе `adminEmail` укажите email адрес администратора
15. в ключе `adminName` укажите имя администратора
16. в ключе `senderEmail` укажите адрес отправителя email
17. в ключе `senderName` укажите имя отправителя email
18. в ключе `site` укажите сайт: example.com
19. в ключе `site` укажите сайт: example.com
20. в ключе `homeUrl` укажите прямую ссылку на домен (как в frontend main.php)
21. в ключе `adminUrl` укажите прямую ссылку на поддомен (как в backend main.php)
22. в ключе `cert_salt` укажите рандомную строку длиной не менее 6 символов
23. Опционально.  Вы можете указать настройки для postman указав следующие ключи.

'postman_ip' => '', 'postman_passwd' => '', 'postman_login' => '', 'postman_domain' => '',

## Настройка файла /frontend/web/js/adminctfnpromainnet.js
24. Укажите `CONTRACT_ADDRESS` от задеплоенного контракта в основной сети

## Настройка файла /frontend/web/js/adminctfnprotestnet.js
25. Укажите `CONTRACT_ADDRESS` от задеплоенного контракта в тестовой сети
