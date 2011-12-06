Project Description
===================

This is an implementation of the Spring Framework PetClinic demo application.  It uses The Php Symfony 2.0 framework.

1) Prerequisites
----------------

* Php 5.3 most recent version.
* Webserver - Apache 2.x 
* MySQL 5.x

Before you begin, make sure that your local system is properly configured
for Symfony. To do this, execute the following:

    php app/check.php

If you get any warnings or recommendations, fix these now before moving on.

2) Install aditional Php libraries
----------------------------------

Some additional libraries are require for the application.  If you're using the distribution version
of the php tools (pecl, pear) you'll need sudo - we typically compile our own php for testing.

### a) Install MySQL PDO driver 

    pecl install PDO_MYSQL
    
As per instructions in the install you should add "extension=pdo_mysql.so" to your php.ini

### b) Install PhpUnit

This library is for running tests so you could skip if you no intention of running the test suite.

    pear config-set auto_discover 1
    pear install pear.phpunit.de/PHPUnit
    
### c) Install Symfony dependencies

First copy the app/config/parameters.ini.dist file to app/config/parameters.ini
From the project home directory:

    php bin/vendors install
    
3) Configure apache
-------------------

You should add something like this to the apache configuration file httpd.conf

    Alias /petclinic/ $APP_HOME/SymfonyPetClinic/web/
    <Directory "$APP_HOME/SymfonyPetClinic/web" >
      AllowOverride All
      Allow from All
    </Directory>
    
The application .htaccess file has been configured to use htttp://localhost/petclinic/app_dev.php for the development
environment.
    
    
4) Setup and populate database
------------------------------

First go to http://localhost/petclinic/app_dev.php and click on configure button.
Follow the instructions to configure the mysql database connection for the application.  

### a) First create the database you just configured:

    php app/console doctrine:database:create
    
### b) Create the database tables:
    
    php app/console doctrine:schema:create
    
### c) Then populate the PetClinic database using this command:

    php app/console petclinic:populate

This can take a while depending on how many pet owners and vets are requested.


5) Learn about Symfony!
-----------------------

If you'd like to know more about Symfony 2.0:

A great way to start learning Symfony is via the [Quick Tour](http://symfony.com/doc/current/quick_tour/the_big_picture.html),
which will take you through all the basic features of Symfony2 and the test
pages that are available in the standard edition.

Once you're feeling good, you can move onto reading the official
[Symfony2 book](http://symfony.com/doc/current/).

