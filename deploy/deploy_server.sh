#!/bin/bash
sudo cp -fr deploy/usr/local/nginx/conf/config.d/virtual.conf /usr/local/nginx/conf/config.d/
sudo mkdir /usr/local/nginx/snippets
sudo cp -fr deploy/usr/local/nginx/snippets/letsencrypt.conf /usr/local/nginx/snippets
sudo cp -fr deploy/usr/local/nginx/snippets/ssl.conf /usr/local/nginx/snippets