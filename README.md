# Laravel_shop 

Интернет-магазин автозапчастей на PHP.

## О Laravel

Laravel — это веб-фреймворк с выразительным и элегантным синтаксисом. Laravel упрощает разработку, устраняя рутинные задачи, common для многих веб-проектов.

- [Простой и быстрый роутинг](https://laravel.com/docs/routing).
- [Мощный контейнер внедрения зависимостей](https://laravel.com/docs/container).
- Выразительный, интуитивно понятный [ORM для работы с базой данных Eloquent](https://laravel.com/docs/eloquent).
- [Агностические к БД миграции схемы](https://laravel.com/docs/migrations).
- [Надежная обработка фоновых заданий через очереди](https://laravel.com/docs/queues).

## Требования к системе

Перед установкой убедитесь, что установлено следующее ПО:

*   **PHP** ^8.1 (рекомендуется 8.2 или выше)
*   **Composer** (Последняя версия)
*   **База данных** (MySQL 5.7+, PostgreSQL, SQLite, SQL Server)
*   **Web-сервер** (Apache, Nginx) или встроенный сервер PHP для разработки

## Установка и настройка проекта

Следуйте этим шагам, чтобы развернуть проект локально:

1.  **Клонируйте репозиторий**
    ```bash
    git clone https://github.com/keskiyo/Laravel_shop.git
    cd Laravel_shop
    ```

2.  **Установите PHP-зависимости через Composer**
    ```bash
    composer install
    ```

3.  **Установите NPM-зависимости (если есть)**
    ```bash
    npm install
    ```

4.  **Создайте файл окружения**
    Скопируйте файл `.env.example` в `.env`.
    ```bash
    cp .env.example .env
    ```
    Сгенерируйте ключ приложения.
    ```bash
    php artisan key:generate
    ```

5.  **Настройте базу данных**
    Создайте базу данных (например, `your_db_name`) в вашей СУБД (phpMyAdmin, MySQL Workbench, командной строке).
    Откройте файл `.env` и настройте подключение к БД:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_db_name
    DB_USERNAME=your_db_username
    DB_PASSWORD=your_db_password
    ```

6.  **Запустите миграции базы данных (и сидеры, если есть)**
    Это создаст необходимые таблицы в вашей базе данных.
    ```bash
    php artisan migrate
    ```
    (Опционально) Заполните базу данных тестовыми данными:
    ```bash
    php artisan db:seed
    # или
    php artisan migrate --seed
    ```

7.  **(Опционально) Соберите фронтенд-ассеты**
    Для запуска в режиме разработки с "горячей перезагрузкой":
    ```bash
    npm run dev
    ```

## Запуск приложения

Запустите встроенный сервер разработки Laravel:
```bash
php artisan serve

