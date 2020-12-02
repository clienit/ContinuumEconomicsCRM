## About Installation

- clone: git clone https://github.com/clienit/ContinuumEconomicsCRM.git
- run: cd ContinuumEconomicsCRM/
- run: composer install
- run: npm install
- run: npm run dev
- Create you database for MySQL
- Create your .env file under your project directory from .env.example
- Configure database connection parameters in .env file
- run: php artisan key:generate
- run: php artisan migrate
- run: php artisan db:seed
- run: php artisan storage:link
- run: php artisan serve

## Testing

- Enable `extension=pdo_sqlite` and `extension=gd2` in php.ini file
- run: php artisan test
