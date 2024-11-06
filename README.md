# WANNA GO - WEB

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
 
##### 3. Go to website in browser by url bellow:  
[localhost:8080](http://localhost:8080/)

