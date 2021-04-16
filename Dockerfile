FROM michelalbonico/atlas-utfpr
WORKDIR /var/www/app
RUN rm -Rf /var/www/app/* && wget https://github.com/ricardodesouza1/atlas-digital/archive/refs/heads/main.zip &&\ 
	unzip main.zip && cp -Rf atlas-digital-main/web/* /var/www/app/ && \
	cp -f atlas-digital-main/banco_dados/bd_atlas.sql /var/www/app/ &&\
	chmod -R 777 * && chown -R www-data:www-data /var/www/app/
