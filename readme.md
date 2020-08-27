# Tasker

### Зависимоси
* [php v.7.1.3](https://www.php.net/releases/index.php)   


### Установка
 ```bash
 composer install
 ```

### Настройки соединения с БД
Отредактируйте файл `config.php`
```php
define("DB_HOST", "localhost");
define("DB_USER", "gurezkiy");
define("DB_PASSWORD", "LYRragTKJoCT85Xa");
define("DB_TABLE","tasker");
define('DB_PORT',3306);
define("TABLE_ROW_LIMIT", 3);
```

### Импорт БД
```
mysql -u имя_пользователя -p tasker < tasker.sql
```