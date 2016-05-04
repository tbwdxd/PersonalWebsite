<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php 
$lo_str = "bcabcef";
$char_str = 'abc';
$c = "abc";

$result = 0;
$a = strlen ($char_str);
for ($i = 0; $i < strlen ($lo_str); $i++)
{
	$b = substr ( $lo_str, $i, $a);
	if ( $char_str === $c)
	{
		$result ++;
	}
}
	echo $result ;


?>
</body>
</html>