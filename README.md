# onix-laravel-internship-final
Фінальний проєкт з Laravel інтернатури в Onix

### Про проєкт
Проєкт являє собою звичайний інтернет-магазин в контексті API

### Інструменти для запуску проєкту
Для того, щоб запустити проєкт, вам знадобиться:
1. Composer >= **2.3.7**
2. Docker >= **20.10.18**
3. Docker Compose >= **1.29.2**

### Як запустити проєкт?
Для того, щоб запустити проєкт, вам потрібно:
1. Клонувати репозиторій:

   `git clone https://github.com/shavlenkov/onix-laravel-internship-final.git`
2. З файлу .env.example зробити файл .env
3. Внести необхідні зміни конфігурації до файлу .env:
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

```
STRIPE_KEY=
STRIPE_SECRET=
CASHIER_CURRENCY=usd
PAYMENT_ID=
```
4. Перейти до папки onix-laravel-internship-final: 

    `cd onix-laravel-internship-final`
5. Встановити всі залежності за допомогою Composer:

    `composer install`
6. Запустити контейнери за допомогою Docker Compose:

   `docker-compose up -d`
7. Підключитися до контейнера:

   `docker exec -it onix-laravel-internship-final_laravel.test_1 bash`
   1. Дати коректні права доступу до папки storage і bootstrap:
   
      `chmod -R 777 ./storage ./bootstrap`
   2. Згенерувати App Key:
   
      `php artisan key:generate`
   3. Запустити міграції:
   
      `php artisan migrate`
   4. Створити Symbolic Link:
   
      `php artisan storage:link`
