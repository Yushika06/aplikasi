# User Roles

-   1 > Normal
-   2 > Admin
-   3 > Blocked

# Setup

```
composer update
```

```
php artisan migrate:fresh
or
php artisan migrate:refresh
```

```
php artisan key:generate
```

# Env

change the .env.example to .env

```
# Env Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_mysql_username
DB_PASSWORD=your_mysql_password
```

# Navbar (layouts.app)

```
Role 1 > Tidak ada Navbar Dashboard - Admin
Role 2 > Ada Navbar Dashboard - Admin
```
