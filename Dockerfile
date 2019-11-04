FROM phpstorm/php-71-apache-xdebug-26
RUN sudo a2enmod rewrite && sudo service apache2 restart
