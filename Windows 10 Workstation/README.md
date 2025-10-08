# Windows 10 Workstation

Files for Windows 10 Workstation Scenario.

## Scenario

Standard employee workstation computer that has insecurely left RDP enabled and exploitable, with a pre-planted sticky keys backdoor.


## Setup

Set up Windows 10 VM. Enable RDP without NLA, and create a sticky keys backdoor for cmd. Turn off Tamper Protection. Turn off firewall. Install reverse shell. Add hackerman user

## Exploitation

Connect with RDP, and use sticky keys backdoor to gain initial access.
