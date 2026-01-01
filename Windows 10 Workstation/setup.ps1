$authorizedAdmins = @(
    "alex",
    "jordan",
    "taylor",
    "chris",
    "morgan"
)

$authorizedUsers = @(
    "jamie",
    "casey",
    "riley",
    "sam",
    "drew",
    "cameron",
    "avery",
    "parker",
    "quinn",
    "logan",
    "ryan",
    "blake",
    "jesse",
    "devon",
    "robin",
    "lee",
    "shawn",
    "reese",
    "terry"
)

$adminPassword = ConvertTo-SecureString 'Pa$$w0rd10securepassword' -AsPlainText -Force
$userPassword = ConvertTo-SecureString "password" -AsPlainText -Force


# create authorized administrators
foreach ($admin in $authorizedAdmins) {
    New-LocalUser -Name $admin -Password $adminPassword
    Add-LocalGroupMember -Group "Administrators" -Member $admin -ErrorAction SilentlyContinue
}

# create authorized users
foreach ($user in $authorizedUsers) {
    New-LocalUser -Name $user -Password $userPassword
    Add-LocalGroupMember -Group "Users" -Member $user -ErrorAction SilentlyContinue
    # add to remote management users to allow connection
    Add-LocalGroupMember -Group "Remote Management Users" -Member $user -ErrorAction SilentlyContinue
}

# enable winRM
Start-Service WinRM
Set-Service WinRM -StartupType Automatic
Set-NetConnectionProfile -NetworkCategory Private
Enable-PSRemoting -Force

# insecure impersonate client after authentication for all users enabled
secedit /export /cfg C:\secpol.cfg

(Get-Content C:\secpol.cfg) -replace `
'SeImpersonatePrivilege = .*', `
'SeImpersonatePrivilege = *S-1-5-32-544,*S-1-5-32-545' `
| Set-Content C:\secpol.cfg

secedit /configure /db secedit.sdb /cfg C:\secpol.cfg /areas USER_RIGHTS

gpupdate /force

# add exclusion for whole filesystem for "testing"
Add-MpPreference -ExclusionPath "C:\"
