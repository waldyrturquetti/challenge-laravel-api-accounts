# Project Execution

- You need have Docker in your machine.
- You must git clone a directory on your machine.
- In this directory execute the `commands`.

## Commands for run

- Use Docker’s composer image to mount the directories that you will need for this Laravel project and avoid the overhead of installing Composer globally: 
```
docker run --rm -v $(pwd):/app composer install
```

- Set permissions on the project directory so that it is owned by your non-root user:
```
sudo chown -R $USER:$USER ~/laravel-api-accounts
```

- Use single command to start all of the containers, create the volumes, and set up and connect the networks:
```
docker-compose up -d
```

- The following command will generate a key and copy it to `.env` file, ensuring that user sessions and encrypted data remain secure: 
```
docker-compose exec app php artisan key:generate
```

- To cache these settings into a file, which will boost your application’s load speed run:
```
docker-compose exec app php artisan config:cache
```

# Endpoints

The base url for execute endpoints for this project is `http://localhost`.

Exists 3 enpoints in this project:
- CreateUser: `/api/user`;
- CreateAddress: `/api/address`;
- CreateAccount: `/api/account`;
