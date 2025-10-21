@echo off
REM Setup script for Windows (cmd.exe)
REM Usage: Run from project root: setup.bat

echo === Composer install ===
composer install --no-interaction --optimize-autoloader
IF ERRORLEVEL 1 (
  echo Composer install failed. Exiting.
  pause
  exit /b 1
)

echo.
echo === NPM install ===
npm install --no-audit --no-fund
IF ERRORLEVEL 1 (
  echo npm install failed. Exiting.
  pause
  exit /b 1
)

echo.
echo === Ensure APP_KEY ===
FOR /F "usebackq tokens=*" %%A IN (`php -r "echo env('APP_KEY');"`) DO SET APP_KEY_VALUE=%%A
IF "%APP_KEY_VALUE%"=="" (
  echo APP_KEY is missing. Generating...
  php artisan key:generate
) ELSE (
  echo APP_KEY already set. Leaving unchanged.
)

echo.
echo === Run migrations ===
php artisan migrate --force
IF ERRORLEVEL 1 (
  echo Migrations failed. Exiting.
  pause
  exit /b 1
)

echo.
set /p RUN_SEED="Run database seeders now? (y/N): "
IF /I "%RUN_SEED%"=="Y" (
  echo Running db:seed...
  php artisan db:seed
) ELSE (
  echo Skipping db:seed.
)

echo.
echo === Start local dev server ===
echo To start the Laravel dev server run:
echo     php artisan serve
echo Or start Vite in watch mode:
echo     npm run dev

echo Setup complete.
pause
