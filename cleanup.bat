@echo off
setlocal

rem Set the path to the folder you want to clean
set "TARGET=web\assets"

rem  Change to that folder
pushd "%TARGET%" || (echo Folder not found & exit /b)

rem  Loop through all directories in this folder (not files)
for /d %%D in (*) do (
    echo Deleting folder: %%D
    rd /s /q "%%D"
)

popd

if exist runtime/cache rmdir /s /q "runtime/cache/"
if exist runtime/debug rmdir /s /q "runtime/debug/"

endlocal

echo finished
pause
