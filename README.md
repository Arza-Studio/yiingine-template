# Yiingine template
The Yiingine template is a basic website that showcases all the features of the [Yiingine](https://github.com/Arza-Studio/yiingine), a fexible content management
system built upon the very popular [Yii2](https://github.com/yiisoft/yii2), [composer](https://getcomposer.org/) and [bootstrap](http://getbootstrap.com/).

## Installation

### 1. Download the project

[Download](https://github.com/Arza-Studio/yiingine-template/archive/master.zip) a version of the project and extract it in a folder.

### 2. Get Composer

If you do not already have Composer installed, you may do so by following the instructions at
[getcomposer.org](https://getcomposer.org/download/).

On Windows, download and run [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe).

Please refer to the [Composer Documentation](https://getcomposer.org/doc/) if you encounter any
problems or want to learn more about Composer usage.

If you had Composer already installed before, make sure you use an up to date version. You can update Composer
by running `composer self-update`.

With Composer installed, run the following command from within the project's folder:

```bash
php composer.phar global require "fxp/composer-asset-plugin:~1.1.1"
```

The command installs the [composer asset plugin](https://github.com/francoispluchino/composer-asset-plugin/)
which allows managing bower and npm package dependencies through Composer. You only need to run this command
once for all.

### 3. Install dependencies

To install dependencies run the following command from within the project's folder:

```bash
php composer.phar install
```

This will download all dependencies and put them under the `vendor` folder.

> Note: During the installation Composer may ask for your Github login credentials. This is normal because Composer 
> needs to get enough API rate-limit to retrieve the dependent package information from Github. For more details, 
> please refer to the [Composer documentation](https://getcomposer.org/doc/articles/troubleshooting.md#api-rate-limit-and-oauth-tokens).

### 4. Set up the configuration file

> Note: for more information on how to configure Yii applications, see [the documentation](http://www.yiiframework.com/doc-2.0/guide-concept-configurations.html).

1. Modify the `config/web.php` file by entering a secret key for the `cookieValidationKey` configuration item::

  ```php
  // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
  'cookieValidationKey' => 'insertYourValidationKey',
  ```
2. Copy the `config/db.example.php` file to `config/db.php` and enter you database's credentials under the `local` section. For more information on how to set up databases with Yii, please see the [documentation](http://www.yiiframework.com/doc-2.0/guide-concept-configurations.html).

### 5. Deploy the database schema

In order to deploy the basic database schema for the project run this command from within the application's folder:

```bash
./yii migrate
```

This will create all the tables needed by the project and populate them with some demo data.

### 6. You're done! Test you application

The installation is done! To test it, you can either configure you own web server or use PHP's built in web server. Go to the `web` directory and run this command:

```bash
php -S localhost:8000 index-demo.php
```

A demo web server will be created on port 8080. If port 8080 is occupied, use a different one, such as 8888. Then, you can use your browser to access the applicaiton by entering this URL:

```
http://localhost:8080/
```

Have fun!

## Directory structure

```
assets/              web assets
commands/            console commands
config/              the site's configuration files
controllers/         the site's controllers
mail/                view files for e-mails
themes/              themes available to the site
views/               views used by the site
web/                 web accessible folder
```

## Requirements

Since the Yiingine template is entirely built upon Yii 2.0, its requirements are that Yii, which for the moment are simply PHP 5.4.
