# Minetest Bower

This application uses [Yii2 Framework](http://www.yiiframework.com/) and is hosted on [Heroku](https://heroku.com/).


## Installing

Install minetest-bower:

```
git clone git@github.com:cornernote/minetest-bower.git
```

Install composer:

```
curl -s http://getcomposer.org/installer | php
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


## Resources

* [Homepage](https://minetest-bower.herokuapp.com/)
* [Project](https://github.com/cornernote/minetest-bower)
* [Forum](https://forum.minetest.net/viewtopic.php?t=13012)
* [Support](https://github.com/cornernote/minetest-bower/issues)
