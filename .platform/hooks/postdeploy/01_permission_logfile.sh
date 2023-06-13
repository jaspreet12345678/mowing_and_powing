#!/usr/bin/bash
ech "Giving Permissions"
sudo touch /var/app/current/storage/logs/laravel.log
sudo chown webapp:webapp /var/app/current/storage/logs/laravel.log
sudo chmod -R 755 /var/app/current/storage
sudo chmod -R 755 /var/app/current/vendor
sudo chmod -R 777 /var/app/current/bootstrap/cache

