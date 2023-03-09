1. Установить зависимости - composer install
2. Настроить подулючение к бд
3. Настроить файловую систему - php artisan storage:link
4. Настроить URL к файлу
    Заходите tinker - php artisan tinker
    и выполняете команду - echo asset('storage/file.txt');
5. Запускаете миграции с сидами - php artisan migrate --seed
6. Запускаете проект - php artisan serve
