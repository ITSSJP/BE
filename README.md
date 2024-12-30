
## Install Guide

##### 1. Set up the project:  
```
# install composer
https://getcomposer.org/download/

#install xampp

#install php (ver >= 8.1.9)

# Clone code
git clone https://github.com/ITSSJP/BE.git

# Go to folder
cd BE

# Copy env
cp .env.example .env

# Edit .env data

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

# Run composer
composer install

# Update Composer
composer update

# Generate key
php artisan key:generate

# Install npm
npm i

#run npm for blade
npm run build

#fake data dictionary
 php artisan db:seed --class=DictionaryWordsSeeder
```

##### 3. Go to website in browser by url bellow:  
```
# If using Docker
[localhost:8080](http://localhost:8080/)

# If not using Docker
localhost:8000

```

### 4.Toastr Notifications
```
# Install
composer require yoeunes/toastr

# After installation, publish the assets using:
php artisan flasher:install
```
