## Test IGaming Application 

This Project was made using Laravel Sail further commands will require `sail`

In case if Sail is not configured in system path use `./vendor/bin/sail` command instead of `sail`

### Steps to install 
1. `cp .env.example .env`
2. `sail up -d --build`
3. `sail composer install`
4. `sail npm install`
5. `sail artisan migrate`
6. `sail npm run dev`
