# Minetest Bower

This application uses [Yii2 Framework](http://www.yiiframework.com/) and is hosted on [Heroku](https://heroku.com/).


## Installing

Install composer:

```
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```

Install dependencies with composer:

```
composer install
```


## Using Heroku

Deploy:

```
git push heroku master
```

Run migrations:

```
heroku run php /app/yii migrate/up --interactive=0
```

View database:

```
heroku pg:psql
```

View logs:

```
heroku logs --tail
```

More info:

https://devcenter.heroku.com/articles/getting-started-with-php