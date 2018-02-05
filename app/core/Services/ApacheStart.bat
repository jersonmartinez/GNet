@echo off
cd /D %~dp0
echo Apache 2 is starting ...

%HOMEDRIVE%\xampp\apache\bin\httpd.exe

if errorlevel 255 goto finish
if errorlevel 1 goto error
goto finish

:error
echo.
echo Apache konnte nicht gestartet werden
echo Apache could not be started
pause

:finish