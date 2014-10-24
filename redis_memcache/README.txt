$ wget http://download.redis.io/releases/redis-2.8.13.tar.gz
$ tar xzf redis-2.8.13.tar.gz
$ cd redis-2.8.13
$ make

kill `cat /var/run/redis.pid`

启动服务器
src/redis-server /usr/src/redis-2.8.13/redis.conf &
src/redis-server
客户问连接
src/redis-cli


redis主从配置  
配置master的ip地址和redis-server的端口。
slaveof <masterip> <port>
src/redis-server /usr/src/redis-2.8.13/redis.conf &


//安装redis扩展
 wget https://github.com/nicolasff/phpredis/archive/2.2.4.tar.gz 836
 tar xzvf 2.2.4.tar.gz
 cd phpredis-2.2.4/
 /Data/apps/php/bin/phpize
 ./configure --with-php-config=/Data/apps/php/bin/php-config
 make
 make install
 、、查看redis.so是否生成
 cd /Data/apps/php/lib/php/extensions/no-debug-non-zts-20100525/
//在php.ini中添加extension = redis.so


服务器启动memcached 默认端口是11211
/Data/apps/libs/bin/memcached

windows 客户机安装扩展

相关包在网盘能找到
PHP Version 5.4.7
Compiler	MSVC9 (Visual C++ 2008)
安装的是
phpredis_5.4_vc9_ts

php.ini配置（注意先后顺序）
extension=php_igbinary.dll
extension=php_redis.dll
extension=php_memcache.dll
重启apache

现在应该在phpinfo中能看到 Redis Version 


1, redis配置文件常用选项说明
daemonize no 
说明：是否把redis-server启动在后台，默认是“否”。若改成yes，会生成一个pid文件。

pidfile /var/run/redis.pid
说明：redis-server的pid文件。
port 6379
说明：redis-server的端口号

dbfilename dump.rdb
说明：数据库文件的位置，最好添加绝对路径，若不添加时在启动用户的home目录下。
slaveof <masterip> <masterport>
说明：设置主从服务器的主服务器的地址和端口。例如：slaveof 192.168.1.1 6379

loglevel verbose
说明：日志级别，有四种，debug,verbose,notice,warning。

logfile stdout
说明：日志的输出文件，默认是标准输出。例如：logfile /tmp/redis.log
