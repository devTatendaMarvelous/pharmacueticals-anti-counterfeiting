FROM centos:7

USER root

RUN yum -y update \
    && yum -y install epel-release yum-utils \
    && yum -y install http://rpms.remirepo.net/enterprise/remi-release-7.rpm \
    && yum-config-manager --enable remi-php81 \
    && yum -y install php php-common php-opcache php-cli php-dom php-gd php-curl php-mysqlnd php-pgsql php-mbstring php-zip php-pdo php-imagick \
    && yum -y install httpd unzip \
    && yum clean all

#Install composer
WORKDIR /tmp
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer


#Install app
WORKDIR /var/www/html

#Copy files
ADD . /var/www/html
RUN mv .env.prod .env

ADD  httpd.conf /etc/httpd/conf/httpd.conf
ADD  welcome.conf /etc/httpd/conf.d/welcome.conf

RUN composer install --no-dev

RUN php artisan storage:link

EXPOSE 80

ENTRYPOINT ["/usr/sbin/httpd","-D","FOREGROUND"]

