@echo off
title HostNetwork / Side Master
cls
:menu
echo ==================================
echo =   Welcome to the HostNetwork   =
echo ==================================
echo -     Write the network name     -
echo ----------------------------------
SET /P ssid=Waiting answer: 
echo.

echo ----------------------------------
echo -     Write the network key      -
echo ----------------------------------
SET /P key=Waiting answer: 
echo.

echo ----------------------------------
echo -         Crating network        -
echo ----------------------------------
netsh wlan set hostednetwork mode=allow ssid="%ssid%" key="%key%"
echo.

echo ----------------------------------
echo -        Starting network        -
echo ----------------------------------
netsh wlan start hostednetwork
echo.
goto NetworkCreate

:NetworkCreate
cls
echo.
echo         ==================================
echo         =       HostNetwork running      =
echo         ==================================
echo         =         Crendentials.          =
echo         ==================================
echo         - SSID: %ssid% 
echo         - PASSWORD: %key%
echo         ==================================
echo         =          Type Security         =
echo         ==================================
echo         -            WPA2/PSK            -
echo         ----------------------------------
echo.
pause
echo.
echo    =============================================
echo    = (1) Stop HostNetwork, (2) Stop and Finish =
echo    =============================================
SET /P  option=Waiting answer: 

if %option% EQU 1 goto StopHN
if %option% EQU 2 goto FinishHN

:StopHN
echo ----------------------------------
echo -       Stoping HostNetwork      -
echo ----------------------------------
netsh wlan stop hostednetwork
echo.

echo ----------------------------------
echo -       HostNetwork Stoped       -
echo ----------------------------------
pause
goto menu

:FinishHN
echo.
echo ----------------------------------
echo -       Stoping HostNetwork      -
echo ----------------------------------
netsh wlan stop hostednetwork
echo.
echo ----------------------------------
echo -       HostNetwork Stoped       -
echo ----------------------------------
echo.
echo ----------------------------------
echo -   Press some key to Finish     -
echo ----------------------------------
pause>nul
exit