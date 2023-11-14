echo off

C:\xampp\mysql\bin\mysqldump.exe -hlocalhost -uroot -p123456 clinica > E:\respaldos\clinica_%Date:~6,4%%Date:~3,2%%Date:~0,2%.sql

exit
