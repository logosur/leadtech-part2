FROM httpd:latest

RUN apt-get update && apt-get install procps -y 
RUN apt-get install apache2 libapache2-mod-wsgi-py3 python-dev dnsutils -y
RUN a2enmod rewrite -q
RUN service apache2 restart

COPY ./httpd.conf /usr/local/apache2/conf
COPY ./httpd-vhosts.conf /usr/local/apache2/conf/extra
COPY ./proxy-html.conf /usr/local/apache2/conf/extra

EXPOSE 80


