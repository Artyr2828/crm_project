CRM Система обработки заявок (Тестовое задание)
Мини-CRM для сбора и обработки заявок с сайта через универсальный виджет.

Технологический стек
Framework: Laravel 12.x
PHP: 8.4.x
Database: MySQL 8.0+
Frontend: Tailwind CSS (через CDN), AJAX (Fetch API)

Основные пакеты:
spatie/laravel-medialibrary — для работы с вложениями к заявкам.
spatie/laravel-permission — для управления ролями (Админ/Менеджер).

Основные возможности
Клиентский виджет (/widget):
Асинхронная отправка формы (AJAX).
Валидация телефона в формате E.164.
Загрузка файлов (скриншоты/документы).
Панель управления (/admin):
Фильтрация заявок по Email, телефону, дате и текущему статусу.
Статистика заявок (за последние 24 часа, неделю, месяц).
Возможность смены статуса заявки.

Архитектура:
Использование Service Layer для бизнес-логики.
FormRequests для строгой валидации входящих данных.
API Resources для стандартизации ответов сервера.

Инструкция по установке
1. Клонирование репозитория и установка зависимостей:

Bash
git clone https://github.com/Artyr2828/crm_project.git
cd crm_project
composer install
2. Настройка файла окружения:

Bash
cp .env.example .env
php artisan key:generate
В файле .env укажите доступы к вашей локальной базе данных MySQL:

Фрагмент кода
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=название_вашей_базы
DB_USERNAME=ваш_логин
DB_PASSWORD=ваш_пароль
3. Создание базы данных и наполнение данными:

Bash
# Сначала создайте пустую БД в MySQL (например, через phpMyAdmin или консоль)
php artisan migrate --seed
php artisan storage:link
4. Запуск сервера:

Bash
php artisan serve
Доступы
Админка: http://localhost:8000/admin

Логин: admin@example.com
Пароль: admin123

Виджет: http://localhost:8000/widget
