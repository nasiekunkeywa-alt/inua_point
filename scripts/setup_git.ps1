<#
PowerShell helper to stage, commit and push to current branch safely.
Usage:
  .\scripts\setup_git.ps1 -Message "Your commit message"
#>
[CmdletBinding()]
param(
    [Parameter(Mandatory=$true)][string]$Message
)

function Abort($msg) {
    Write-Host "ERROR: $msg" -ForegroundColor Red
    exit 1
}

# Ensure we're in project root (script assumes run from repo root)
if (-not (Test-Path .git)) {
    Abort "This script must be run from the repository root containing .git"
}

# Show remote and branch
Write-Host "Git remote:" -ForegroundColor Cyan
git remote -v

Write-Host "Current branch:" -ForegroundColor Cyan
$branch = git rev-parse --abbrev-ref HEAD
Write-Host $branch

# Stage all changes
Write-Host "Staging changes..." -ForegroundColor Yellow
git add -A
if ($LASTEXITCODE -ne 0) { Abort "git add failed" }

# Commit
Write-Host "Committing: $Message" -ForegroundColor Yellow
git commit -m "$Message"
if ($LASTEXITCODE -ne 0) { Write-Host "No changes to commit or commit failed." -ForegroundColor Yellow }

# Push
Write-Host "Pushing to origin/$branch" -ForegroundColor Yellow
git push origin $branch
if ($LASTEXITCODE -ne 0) { Abort "git push failed" }

Write-Host "Done. Remote and branch verified above." -ForegroundColor Green
