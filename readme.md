# ![](public/static/admin/images/common/logo.png) Minmax Admin

`Current v4.2.3` `Laravel 8.6.12` `PHP ^7.3|^8.0`

## Project Install

### Initial project

```bash
> composer create-project --prefer-dist minmax/laravel <project-folder> "4.2.*"
```

Before updating you should edit `composer.json` to choose what modules for project using.

```bash
> composer update
> php artisan minmax:init --first
```

### Useful commands

```bash
> composer dump-autoload                # Update class autoload
> php artisan cache:clear               # Clear all cache (Especial language cache)
> php artisan view:clear                # Clear all compiled view files
> php artisan minmax:init               # Do all refresh for project
```

### Site url (Develop only)

```
(your site)                         # Website
(your site)/siteadmin               # Admin Manager
```

## Product your project

### Edit `.env` file for server setting.

1. Change app name for project.
2. Database's connection information.
3. Mailer account information.
4. Analytics view id change.
5. App url change to live domain name.
6. Log channel set to `daily`.
7. Debug switch to `false`.
8. App environment set to `production`.

### Lite composer required.

1. Remove vendor folder.
2. Run `composer update --no-dev`

### Make cache to boost website.

1. `php artisan cache:clear`
2. `php artisan view:clear`
3. `php artisan route:trans:cache`
4. `php artisan config:cache`

If config cache cannot make on live server, please make local and edit `bootstrap\config.php` to change all absolute path to live server path.

### Make sure server url rewrite rule.

Edit .htaccess (Apache) or Nginx server's *.conf setting to fit laravel official document.

## Links

* https://laravel.com/docs/8.x
* https://learnku.com/docs/laravel/8.x/releases

## License

Made by Jeff Chen (Jeffy).

The Minmax Laravel project powered by [MINMAX](https://minmax.tw) company, all rights reserved.
