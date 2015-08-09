# Minetest Bower


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