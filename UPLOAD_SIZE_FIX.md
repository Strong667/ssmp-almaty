# Исправление ошибки 413 (Content Too Large)

## Что было сделано:

1. Добавлены настройки в `public/.htaccess` для Apache
2. Создан файл `public/.user.ini` для PHP-FPM

## Что нужно сделать дополнительно:

### 1. Если используется Nginx:

Нужно добавить `client_max_body_size` в конфигурацию Nginx для вашего сайта.

Найдите конфигурационный файл вашего сайта (обычно в `/etc/nginx/sites-available/`) и добавьте в блок `server`:

```nginx
server {
    # ... другие настройки ...
    
    client_max_body_size 50M;
    
    # ... остальные настройки ...
}
```

Затем перезагрузите Nginx:
```bash
sudo nginx -t  # Проверка конфигурации
sudo systemctl reload nginx
```

### 2. Перезапустите PHP-FPM:

```bash
sudo systemctl restart php8.4-fpm
# или
sudo systemctl restart php-fpm
```

### 3. Проверьте текущие настройки PHP:

```bash
php -i | grep -E "upload_max_filesize|post_max_size"
```

После перезапуска PHP-FPM и Nginx (если используется), лимиты должны быть увеличены до 50MB.

