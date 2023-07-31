FROM andrerodrigue5/apache2-php8.1

RUN sed -i '/^\s*;*\s*extension\s*=\s*mysqli/s/^;\s*//' /etc/php/8.1/apache2/php.ini


EXPOSE 80 443