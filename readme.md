# Rovercity.ru (Symfony 4)
## Минимальные требования:
- PHP 7.2  и выше
- MySQL 5.6 и выше

## Установка:

- Склонировать репозиторий
- Скопировать БД с основного сайта
- В корневой дирректории проекта создать файл ".env.local". В файл добавить следующие строки:
```
APP_ENV=dev
DATABASE_URL=mysql://user:password@127.0.0.1:3306/db_name
```
- Заменить **user**, **password**, **db_name** данными для подключения к локально БД
- В корневой папке проекта через терминал выполнить:
```
composer install
```
## Полезные советы:
- После внесения любых изменений в файлы .php и .twig на production-сайте, нужно чистить кэш. Для этого нужно по SSH войти в корневую папку проекта и выполнить команду:
```
php bin/console cache:clear
```
- Комментарии в файлах .twig делать таким образом:
```
{# Текст комментария #}
```
- [Подробнее про шаблонизатор Twig](https://twig.symfony.com/doc/2.x/)