# Windows 10 Workstation

Files for Windows 10 Workstation Scenario.

## Scenario

Standard employee workstation computer has WinRM enabled, but with weak user passwords and SEImpersonate token insecurely enabled for all users.

## Setup

Set up Windows 10 VM. Run `setupOS.ps1` with administrator permissions.

## Exploitation

Connect with WinRM through an insecure user account, and use WinRM GodPotato exploit to create administrator level account. Login with this account to perform malicious actions listed in `attackerActions.ps1`. Turn off Tamper Protection and Realtime Protection by enabling RDP through WinRM and logging in with the unauthorized account.
