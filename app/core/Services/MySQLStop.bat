@echo off
cd /D %~dp0
echo Mysql shutdowm ...
%HOMEDRIVE%\xampp\apache\bin\pv -f -k mysqld.exe -q

if not exist %HOMEDRIVE%\xampp\mysql\data\%computername%.pid GOTO exit
echo Delete %computername%.pid ...
del %HOMEDRIVE%\xampp\mysql\data\%computername%.pid

:exit
