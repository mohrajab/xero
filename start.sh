#!/bin/sh

# create storage folders structure
cd /var/www/storage
mkdir -p app/public
mkdir -p framework/cache
mkdir -p framework/sessions
mkdir -p framework/testing
mkdir -p framework/views

chmod -R 777 /var/www/storage


# get files from remote server and add it to volume
wget  -O /var/www/public/uploads.zip "http://fleet.toyota.com.sa/uploads.zip"
unzip /var/www/public/uploads.zip
