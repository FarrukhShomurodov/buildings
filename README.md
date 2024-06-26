<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Описание
9 этажные дома

## Содержание
- [Установка](#установка)
- [API Маршруты](#APIМаршруты)

## Установка
Пошаговая инструкция по установке вашего проекта:
1. composer install
2. php artisan key:generate
3. php artisan migrate
4. php artisan db:seed
5. php artisan storage:link

# Config .env
1. FILESYSTEM_DISK=public

# API Маршруты

## Маршруты, доступные только аутентифицированным пользователям

## Аутентификация

- **GET** `/login` - Показать форму входа.
- **POST** `/login` - Вход пользователя.

### Управление Пользователями

- **POST** `/logout` - Выход аутентифицированного пользователя (middleware: `auth`, `admin`).
- **GET** `/` - Отобразить список пользователей (middleware: `auth`, `admin`).

### Дома

- **GET** `/houses` - Получить список всех домов (middleware: `auth`, `admin`).
- **GET** `/houses/create` - Показать форму для создания нового дома (middleware: `auth`, `admin`).
- **POST** `/houses` - Сохранить новый дом в базе данных (middleware: `auth`, `admin`).
- **GET** `/houses/{house}` - Отобразить конкретный дом (middleware: `auth`, `admin`).
- **GET** `/houses/{house}/edit` - Показать форму для редактирования конкретного дома (middleware: `auth`, `admin`).
- **PUT** `/houses/{house}` - Обновить конкретный дом в базе данных (middleware: `auth`, `admin`).
- **DELETE** `/houses/{house}` - Удалить конкретный дом из базы данных (middleware: `auth`, `admin`).

### Этажи

- **GET** `/floors` - Получить список всех этажей (middleware: `auth`, `admin`).
- **GET** `/floors/create` - Показать форму для создания нового этажа (middleware: `auth`, `admin`).
- **POST** `/floors` - Сохранить новый этаж в базе данных (middleware: `auth`, `admin`).
- **GET** `/floors/{floor}` - Отобразить конкретный этаж (middleware: `auth`, `admin`).
- **GET** `/floors/{floor}/edit` - Показать форму для редактирования конкретного этажа (middleware: `auth`, `admin`).
- **PUT** `/floors/{floor}` - Обновить конкретный этаж в базе данных (middleware: `auth`, `admin`).
- **DELETE** `/floors/{floor}` - Удалить конкретный этаж из базы данных (middleware: `auth`, `admin`).
- **GET** `/floors-by-house/{house}` - Получить этажи для конкретного дома (middleware: `auth`, `admin`).

### Квартиры

- **GET** `/apartments` - Получить список всех квартир (middleware: `auth`, `admin`).
- **GET** `/apartments/create` - Показать форму для создания новой квартиры (middleware: `auth`, `admin`).
- **POST** `/apartments` - Сохранить новую квартиру в базе данных (middleware: `auth`, `admin`).
- **GET** `/apartments/{apartment}` - Отобразить конкретную квартиру (middleware: `auth`, `admin`).
- **GET** `/apartments/{apartment}/edit` - Показать форму для редактирования конкретной квартиры (middleware: `auth`, `admin`).
- **PUT** `/apartments/{apartment}` - Обновить конкретную квартиру в базе данных (middleware: `auth`, `admin`).
- **DELETE** `/apartments/{apartment}` - Удалить конкретную квартиру из базы данных (middleware: `auth`, `admin`).
- **DELETE** `/delete/photos_url/{photoPath}/{apartment}` - Удалить конкретное фото из квартиры (middleware: `auth`, `admin`).

## Middleware

- **auth** - Обеспечивает аутентификацию пользователя.
- **admin** - Обеспечивает привилегии администратора.
