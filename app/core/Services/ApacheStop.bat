@echo off
cd /D %~dp0
%HOMEDRIVE%\xampp\apache\bin\pv -f -k httpd.exe -q
if not exist apache\logs\httpd.pid GOTO exit
del apache\logs\httpd.pid

:exit