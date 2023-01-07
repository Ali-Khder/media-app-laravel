# Laravel

## Download
### Setup the comploser from this link: https://getcomposer.org/download/

### setup xampp or any provider to turn on apache and MYSQL from link: https://www.apachefriends.org/

### - In project path
```
comopser update
```
### - migrate database tables after make DB with name (mediaAppDB), you can change the name from .env file
``````
php artisan migrate
``````
### - run project (notice that this port needs to be equale with url in VueJs project)
``````
php artisan serve --host=0.0.0.0 --port=3030
``````

# Note
The url configuration with nodejs is in (app\Services\GifService) with (providerUrl) variable

