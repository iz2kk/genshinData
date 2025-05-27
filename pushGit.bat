@echo off
set mydate=%date%
set mytime=%time%
echo on

git add *
git commit -m "z-%mydate% %mytime%"
git push izi js
pause.