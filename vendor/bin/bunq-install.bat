@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../bunq/sdk_php/bin/bunq-install
php "%BIN_TARGET%" %*
pause