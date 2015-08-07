# Slim Bower Server

This is a PHP based implementation of a [bower-server](https://github.com/twitter/bower-server) used by the excellent package manager [Bower](https://github.com/twitter/bower).

It's built using:

- [Slim PHP Framework](https://github.com/codeguy/Slim)
- [PHPActiveRecord](https://github.com/kla/php-activerecord)

and currently configured OTB to use sqlite (Why? see below)


### Overview

The original aim of this project was to get a server up running as fast as possible to evaluate the usage of Bower where I currently work for managing code dependencies between projects.

Since we already had an existing development PHP server available it made sense to use this rather than setting up a new VM with node.js, DB etc. If you've worked in corporate environments before you'll understand why.

It currently uses an sqlite database, but due to **PHPActiveRecord** being used it's very easy to switch to another database (see app/config.php).

### Installation

Installation will vary depending upon your server configuration, but the basics are detailed below.

#### Checkout

```
> git clone https://github.com/indieisaconcept/slim-bower-server.git myproject
> cd myproject
> rm -rf .git (should you wish to add to your own version control)
```

#### Dependencies

Dependencies are managed using Composer.

```
> curl -s https://getcomposer.org/installer | php
> php composer.phar install
```

### Usage

Ensure you update your .bowerrc either at a global or project level to use your custom server endpoint.

```
{
	...
	"endpoint": 'http://some.host.com.au'
	…
}
```

#### Create package

    curl http://some.host.com.au/packages -v -F 'name=jquery' -F 'url=git://github.com/jquery/jquery.git'

#### Find package

    curl http://some.host.com.au/packages/jquery
      {"name":"jquery","url":"git://github.com/jquery/jquery.git"}

#### Search package

    curl http://some.host.com.au/packages/search/jquery
      [{"name":"jquery","url":"git://github.com/jquery/jquery.git"}, {"name":"jquery-ui","url":"git://github.com/jquery/jquery-ui.git"}]