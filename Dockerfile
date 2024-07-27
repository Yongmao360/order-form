# 使用官方 PHP 影像
FROM php:7.4-apache

# 複製網站文件到 Apache 的根目錄
COPY . /var/www/html/

# 暴露端口 80
EXPOSE 80
