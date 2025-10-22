<#
PowerShell project setup helper for INUA_POINT
Usage: From repository root run:
  .\scripts\setup_project.ps1
This script is PowerShell-safe and will:
  - Run composer install (non-interactive)
  - Run npm install
  - Ensure .env exists (copy from .env.example only if missing)
  - Generate APP_KEY only if missing
  - Run migrations (force)
  - Optionally run db:seed (prompts)
  - Print versions of PHP, Composer, Node, and npm, and Laravel
Notes:
  - This script will NOT overwrite an existing .env file or APP_KEY.
  - It assumes php, composer, npm and node are on PATH.
#>

function Abort([string]$msg) {
    Write-Host "ERROR: $msg" -ForegroundColor Red
    exit 1
}

# Ensure we're at repo root
if (-not (Test-Path .git)) {
    Abort "Run this from the repository root (directory containing .git)"
}

Write-Host "Starting project setup..." -ForegroundColor Cyan

# Composer install
Write-Host "\n== Composer install ==" -ForegroundColor Yellow
composer install --no-interaction --optimize-autoloader
if ($LASTEXITCODE -ne 0) { Abort "composer install failed (exit code $LASTEXITCODE)" }

# NPM install
Write-Host "\n== NPM install ==" -ForegroundColor Yellow
npm install --no-audit --no-fund
if ($LASTEXITCODE -ne 0) { Abort "npm install failed (exit code $LASTEXITCODE)" }

# Ensure .env exists
Write-Host "\n== Environment file check ==" -ForegroundColor Yellow
if (-not (Test-Path .env)) {
    if (Test-Path .env.example) {
        Copy-Item .env.example .env
        Write-Host ".env created from .env.example" -ForegroundColor Green
    } else {
        Abort ".env not found and .env.example not present. Create .env manually before proceeding."
    }
} else {
    Write-Host ".env already exists — leaving unchanged" -ForegroundColor Green
}

# Check APP_KEY in .env
Write-Host "\n== APP_KEY check ==" -ForegroundColor Yellow
$envContent = Get-Content .env -ErrorAction Stop
$existingKeyLine = $envContent | Where-Object { $_ -match '^APP_KEY=' }
$hasKey = $false
if ($existingKeyLine) {
    $kv = $existingKeyLine -split '='
    if ($kv.Length -ge 2 -and $kv[1].Trim() -ne '') {
        $hasKey = $true
    }
}

if (-not $hasKey) {
    Write-Host "APP_KEY missing — generating..." -ForegroundColor Yellow
    php artisan key:generate
    if ($LASTEXITCODE -ne 0) { Abort "php artisan key:generate failed" }
    Write-Host "APP_KEY generated." -ForegroundColor Green
} else {
    Write-Host "APP_KEY already present — leaving unchanged" -ForegroundColor Green
}

# Run migrations
Write-Host "\n== Migrations ==" -ForegroundColor Yellow
php artisan migrate --force
if ($LASTEXITCODE -ne 0) { Abort "php artisan migrate failed (exit code $LASTEXITCODE)" }
Write-Host "Migrations completed." -ForegroundColor Green

# Prompt to run seeders
$runSeed = Read-Host "Run database seeders now? (y/N)"
if ($runSeed -and $runSeed.ToLower() -eq 'y') {
    Write-Host "Running database seeders..." -ForegroundColor Yellow
    php artisan db:seed
    if ($LASTEXITCODE -ne 0) { Abort "php artisan db:seed failed (exit code $LASTEXITCODE)" }
    Write-Host "Database seeded." -ForegroundColor Green
} else {
    Write-Host "Skipping db:seed." -ForegroundColor Yellow
}

# Display versions
Write-Host "\n== Versions ==" -ForegroundColor Cyan
php -v
composer --version
node -v
npm -v
php artisan --version

Write-Host "\nSetup complete. You can start the dev server with: php artisan serve" -ForegroundColor Green
