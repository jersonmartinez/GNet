@echo off
title StartService / Side Master
start %HOMEDRIVE%\xampp\xampp-control.exe
start /B HostNetwork.bat
ping -n 5 0.0.0.0 > nul
start /B StartMySQL.bat
pause>nul
exit