
## Install Guide
##### 1. Setup follow steps below:
```

# Clone code
git clone https://github.com/ITSSJP/BE.git

# Go to folder
cd BE

# Copy env
cp .env.example .env

# Edit .env data


# Create docker network
docker network create --driver=bridge --attachable itss-be

# Run docker
docker compose up --build -d

# Enter docker container
docker exec -it itss-be-app bash

# Run composer inside docker container
composer install

# Generate key
php artisan key:generate

```
##### 2. Set up the project without using Docker:  
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

# Run composer inside docker container
composer install

# Generate key
php artisan key:generate
```

##### 3. Go to website in browser by url bellow:  
# If not using Docker
[localhost:8080](http://localhost:8080/)

# If not using Docker
localhost:8000

