<p align="center"><a href="http://143.110.240.163" target="_blank"><img src="http://143.110.240.163/images/burger-image.png" width="100"></a></p>

<h2 align="center">Self-Serve-Menu</h2>

"Self Serve Menu" is a digitalized food menu system where any restaurant or a cafe can signup and create an account freely to publish their food menus.

---
### System requirement

- Ubuntu 20.04
- Docker
- Docker compose

### Environment setting up

1. Install software packages
`sudo apt update`
install few required packages
`sudo apt install apt-transport-https ca-certificates curl software-properties-common`
install docker
`sudo apt-get install docker-ce`
enable and start docker engine
for more information please visit [docker installation](https://docs.docker.com/get-docker)

2. Download the source code repository
`git clone https://github.com/sandaruwanbandara/sep-project.git`

3. Update configuration file
copy the sample environment file
`cp .env.example .env`
update the below reqruied configurations as necessary
    ```
    APP_NAME=application_name
    APP_ENV=local
    APP_KEY=
    APP_DEBUG=true
    APP_URL=http://localhost

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=example_app
    DB_USERNAME=root
    DB_PASSWORD=

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=usernameemail
    MAIL_PASSWORD="password"
    MAIL_ENCRYPTION=TLS
    MAIL_FROM_ADDRESS=no-reply@ssm.com
    MAIL_FROM_NAME="${APP_NAME}"
    ```
    refer laravel's environment configurations for more [here](https://laravel.com/docs/9.x/configuration#environment-configuration)

4. Install Composer
download the php composer package manager using below commands
`curl -sS https://getcomposer.org/installer | php`
`sudo mv composer.phar /usr/local/bin/composer`
`sudo chmod +x /usr/local/bin/composer`
visit [compose documentation](https://getcomposer.org/) for more info

5. Install packages using composer
Navigate to the root directory of the source code and execute below command to setup required packages.
`composer install`
provide super user permission whenever required.

6. Build and start the containers
Use below commands to build docker containers and start application.
    ```
    cd sep-project
    ./vendor/bin/sail up -d
    ```
    Laravel sail is used to spin up the environment. Visit [sail documentation](https://laravel.com/docs/9.x/sail) for additional features.

7. Install npm packages
Application frontend depends on some node packages. Use below command to install those
    ```
    cd sep-project
    ./vendor/bin/sail npm install
    ./vendor/bin/sail npm run dev # if development environment
    ./vendor/bin/sail npm run prod # if production environment
    ```
    provide super user permission whenever required.

8. Database migration
To configure the database use below commands once the application containers are up and running
`./vendor/bin/sail php artisan migrate`

Once all the configurations are done the application will be running on the configured URL or IP address.

---

> This application has been developed using Laravel 9.X framework hence the [Laravel documentation](https://laravel.com/docs) can be refered to install and configure the application. Also for any troubleshooting.

<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="200"></a>
