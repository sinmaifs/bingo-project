# 台彩 Bingo!Bingo! Analytics.

Not finished yet!3

# Create sql.inc.php

```php
$host = "localhost";
$dbuser = ""; //DB Account
$dbpass = ""; //DB Password
$dbname = ""; //DB NAME

$link = mysqli_connect($host,$dbuser,$dbpass, $dbname);
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

mysqli_set_charset($link, "utf8");
header("Content-Type:text/html; charset=utf-8");
date_default_timezone_set('Asia/Taipei');
```

# Edit update.php

```php
$d = "20220510"; // YYYYMMDD date for today
```

# Demo

https://jsmv.blog/bingo/
