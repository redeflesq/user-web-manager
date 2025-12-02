# User Management Web Application

## EN Project Description

This project is a **web-based user management system** with an admin panel.

### Workflow

1. **Application Initialization**  
   - The `Application` object initializes sessions, CSRF protection, translator, renderer, and database connection.  
   - If the database or tables do not exist, `Migration` creates `admins` and `users` tables.

2. **Admin Authentication**  
   - At the first launch, a default administrator account is created, as well as a regular user, for example.
   - Admin logs in via `/auth/login`.  
   - Upon successful login, session variables are set to identify the admin.

3. **User Management**  
   - View the list of users (`/user/listUsers`) with pagination and sorting.  
   - Add or edit users via the form (`/user/form`).  
   - Delete users via the confirmation page (`/user/delete`).  
   - All operations are protected by CSRF tokens.

4. **Multi-language Support**  
   - The system supports multiple languages.  
   - Language can be selected via the GET parameter `?lang=xx` or in the URL segment (`/en/user/listUsers`).

5. **Routing**  
   - Requests are handled by the `Router` class, which determines the controller, action, and optional ID.  
   - Non-existent pages show a 404 error.

### Quick Installation Guide

1. **Copy Files**  
   - Copy the project to your web server root folder, e.g., `/var/www/html/project`.  

2. **Database Configuration**  
   - Open `config.php` and set your MySQL parameters:  
   ```
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'my_database');
   define('DB_USER', 'root');
   define('DB_PASS', 'password');
   define('DB_CHARSET', 'utf8mb4');
   ```  
   - Optionally, change default admin credentials:  
   ```
   define('DEFAULT_ADMIN_NAME', 'admin');
   define('DEFAULT_ADMIN_PASS', 'admin');
   ```

3. **Running the Application**  
   - Open your browser and navigate to the project URL (e.g., `http://localhost/`).  
   - Tables will be created automatically if they do not exist.  
   - Admin login page is `/auth/login`.

4. **Additional**  
   - Add new languages in `/lang`.  
   - Change users per page in `constants.php`:  
   ```
   define('USERS_PER_PAGE', 10);
   ```
   
---

## 🇷🇺 Описание проекта

Проект представляет собой **веб-интерфейс для управления пользователями** с административной панелью.

### Последовательность работы

1. **Инициализация приложения**  
   - Создаётся объект `Application`, который инициализирует сессии, CSRF-защиту, переводчик, рендерер и подключение к базе данных.  
   - Если база или таблицы ещё не созданы, выполняется миграция (`Migration`) — создаются таблицы `admins` и `users`.

2. **Авторизация администратора**  
   - При первом запуске создаётся администратор с логином и паролем по умолчанию, а так же пользователь для примера.  
   - Администратор входит через страницу `/auth/login`.  
   - После успешного входа устанавливаются сессионные переменные для идентификации администратора.

3. **Работа с пользователями**  
   - Просмотр списка пользователей (`/user/listUsers`) с пагинацией и сортировкой.  
   - Добавление и редактирование пользователей через форму (`/user/form`).  
   - Удаление пользователей через страницу подтверждения (`/user/delete`).  
   - Для всех операций используется CSRF-защита.

4. **Международная поддержка**  
   - Система поддерживает несколько языков.  
   - Язык можно выбрать через GET-параметр `?lang=xx` или через URL сегмент (`/en/user/listUsers`).

5. **Маршрутизация**  
   - Все запросы обрабатываются классом `Router`, который определяет контроллер, действие и опциональный идентификатор.  
   - Для несуществующих страниц отображается 404.

### Краткое руководство по установке

1. **Копирование файлов**  
   - Скопируйте проект в корневую папку веб-сервера, например `/var/www/html/project`.  

2. **Настройка соединения с базой**  
   - Откройте `config.php` и укажите параметры MySQL:  
   ```
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'my_database');
   define('DB_USER', 'root');
   define('DB_PASS', 'password');
   define('DB_CHARSET', 'utf8mb4');
   ```  
   - По желанию, можно изменить дефолтного администратора:  
   ```
   define('DEFAULT_ADMIN_NAME', 'admin');
   define('DEFAULT_ADMIN_PASS', 'admin');
   ```

3. **Запуск приложения**  
   - Откройте браузер и перейдите на URL проекта (например, `http://localhost/`).  
   - Если таблицы ещё не созданы, они будут созданы автоматически.  
   - Авторизация доступна через `/auth/login`.

4. **Дополнительно**  
   - Новые языки можно добавить в `/lang`.  
   - Количество пользователей на странице настраивается в `constants.php`:  
   ```
   define('USERS_PER_PAGE', 10);
   ```