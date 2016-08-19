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

Setup:

```
sudo apt-get install postgresql-client
wget -O- https://toolbelt.heroku.com/install-ubuntu.sh | sh
heroku login
```

Deploy:

```
git push heroku master
```

Run migrations:

```
heroku run php /app/yii migrate/up --interactive=0
```

Bash:

```
heroku run bash
```

Bash with vim

```
heroku vim
```

View logs:

```
heroku logs --tail
```

Connect to database:

```
heroku pg:psql
```

Database commands:

```
\dt # list tables
\d+ package # describe package table
DELETE FROM package WHERE name='modname'; # delete a package
```

More info:

https://devcenter.heroku.com/articles/getting-started-with-php


## Application Commands

Update all packages from git repositories:

```
heroku run php /app/yii package/update
```

Import mods from MTPM:

```
heroku run php /app/yii package/import-mtpm
```



## Resources

* [Homepage](https://minetest-bower.herokuapp.com/)
* [Project](https://github.com/cornernote/minetest-bower)
* [Forum](https://forum.minetest.net/viewtopic.php?t=13012)
* [Support](https://github.com/cornernote/minetest-bower/issues)
