FROM vulnerables/web-dvwa:latest

RUN php_ini=$(php -r "echo php_ini_loaded_file();") && \
    echo "display_errors = Off" >> $php_ini && \
    echo "log_errors = On" >> $php_ini && \
    echo "error_log = /var/log/apache2/php_errors.log" >> $php_ini

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=5s --start-period=60s --retries=3 \
  CMD curl -f http://localhost/login.php || exit 1

CMD ["/main.sh"]
