# Straszik !

## Description

Ce site à été créé dans le cadre du projet 2, d'une classe PHP (Promo Remote septembre 2023) de la Wild Code School.
Il a pour but d'accroître la notoriété d'un groupe de rock Alsacien, de fidéliser ses fans, de présenter leurs discographies, leurs dernières actualités,
ainsi leurs nombreux goodies en vente lors leurs concerts. 

## Steps

1. Clone the repo from Github.
2. Run `composer install`.
3. Create _config/db.php_ from _config/db.php.dist_ file and add your DB parameters. Don't delete the _.dist_ file, it must be kept.

```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PASSWORD', 'php_p2_straszik');
```

4. Import _database.sql_ in your SQL server, you can do it manually or use the _migration.php_ script which will import a _database.sql_ file.
5. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
6. Go to `localhost:8000` with your favorite browser.
7. From this starter kit, create your own web application.

## Compte admin et utilisateur !

Administrateur
Email : admin@admin.fr
mot de passe : admin

Utilisateur
Email : user@user.fr
mot de passe : user

