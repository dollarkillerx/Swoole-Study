Install PHP7 and Swool
===
### install php7
- 解压
- configure
- make
- make install

#### 前期准备 安装一大坨东西
```
sudo apt-get install gcc autoconf curl libxml2 libxml2-dev libssl-dev bzip2 libbz2-dev libjpeg-dev  libpng12-dev libfreetype6-dev libgmp-dev libmcrypt-dev libreadline6-dev libsnmp-dev libxslt1-dev libcurl4-openssl-dev
```
新建php用户组和php用户
```
./configure --prefix=/home/work/study/soft/php  安装目录  

vi ~/.bashrc
alias php=/home/work/study/soft/php/bin/php
source ~/.bashrc

or
ln -s .. /usr/local/bin
```

#### 编译安装的坑
- gcc autoconf lib libxml2-dev
- cp 安装文件的php.ini 放到php/etc目录下
```
cp php.ini-development /home/work/study/soft/php/etc/php.ini
```
- php -i | grep php.ini 

### install swoole
```
/home/work/study/soft/php/bin/phpize  生成config
./configure --with-php-config=/home/work/study/soft/php/bin/php-config
make
make instal
vim php.ini
    extension=swoole
```
查询端口号 是否使用
```
netstat -anp | grep 9801
```

