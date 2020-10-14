<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
 //echo $_POST['name'].' | '.$_POST['pass'];
 if($_POST['name'] && $_POST['pass'])
    {
     $query='SELECT id,pass,name,login FROM users WHERE login=\''.mysql_real_escape_string($_POST['name']).'\' LIMIT 1';
     # Р’С‹С‚Р°СЃРєРёРІР°РµРј РёР· Р‘Р” Р·Р°РїРёСЃСЊ, Сѓ РєРѕС‚РѕСЂРѕР№ Р»РѕРіРёРЅ СЂР°РІРЅСЏРµС‚СЊСЃСЏ РІРІРµРґРµРЅРЅРѕРјСѓ 
     $quer = mysql_query ($query,$i);
     $data = mysql_fetch_assoc($quer);
     echo $data['pass'].' | '.$_POST['pass'];
     if($data['pass'] == $_POST['pass'])
    	{
    	 $query='UPDATE users SET ip="'.$_SERVER['REMOTE_ADDR'].'" WHERE id="'.$data['id'].'"';
	 mysql_query ($query,$i);
         echo $query;
	 setcookie("id", $data['id'], time()+60*60*24*30); 
	 setcookie("name", $data['name'], time()+60*60*24*30);
	 print '<script> window.location.href="index.php" </script>';
	 $query = 'INSERT INTO registers SET who="'.$data['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="user login success"';
	 mysql_query ($query,$i);
         echo $query;
	}
     else  
        {
    	 $query='INSERT INTO registers SET who="'.$data['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="user login failed with pass '.$_POST["pass"].'"';
	 mysql_query ($query,$i);
         echo $query;
        }
    }
if ($_GET["action"]=='logout')
    {
     setcookie("id", "", time() - 3600);
     setcookie("name", "", time() - 3600);
   }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=Windows-1251">
<title>Южноуральский Арматурно-Изоляторный Завод</title>
<link href="/favicon.ico" rel="shortcut icon">
<meta content="JavaScript" name="vs_defaultClientScript">
<script language="JavaScript" src="files/JSUtils.js" type="text/javascript"></script>
<link href="files/BaseStyle.css" type="text/css" rel="stylesheet">
<script language="JavaScript" src="files/JScript.js" type="text/javascript"></script>
<link href="files/pop_style.css" type="text/css" rel="stylesheet">
<link href="files/StockMarkets.css" type="text/css" rel="stylesheet">
</head>

<body bottommargin="0" leftmargin="0" topmargin="0" rightmargin="0">

<?php
if (!$_GET["print"])
print '<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr><td>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody><tr>
	<td width="264"><img src="files/header.gif" height="50" width="264"></td>
	<td rowspan="2" background="files/header_rep.gif" valign="middle">
	<table border="0" height="50" width="100%">
	<tbody><tr><td valign="middle"></td><td align="right" valign="bottom"></td></tr></tbody></table>
	</td></tr></tbody></table>
	</td></tr>
	<tr> 
	<td class="LeftBorderThik" height="20">
	<table id="Table1" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody><tr>
	<td bgcolor="#006995">
		<script src="files/milonic_src.js" type="text/javascript"></script>
		<style>.milonic{visibility:hidden;position:absolute}</style>
		<script type="text/javascript" src="files/mmenudom.js"></script>
		<script>function $9(ap){return _f}</script>
		<script src="files/menu_data.js" type="text/javascript"></script>		
	</td><td bgcolor="#006995">
        <a href="'.$_SERVER['REQUEST_URI'].'&print=1"><img border="0" src="files/prin2.gif"></a></td></tr>
	<tr>
	<td bgcolor="#deecf5">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody><tr>
	<td nowrap="nowrap" valign="middle"></td>
	<td height="5" valign="middle" width="100%"></td>
	</tr></tbody></table>
	</td></tr></tbody></table>
</td></tr></tbody></table>';
?>

<table cellpadding="0" cellspacing="0" width="100%" border=0>
<tbody><tr><td colspan="3">
<?php
 if ($_GET["menu"]=='' && $_GET["sel"]=='') include("main.php");
 else { $file=$_GET["sel"].'.php'; include $file; }
?>
</td></tr></table></td></tr>
<tr><td colspan="3">

<?php
if (!$_GET["print"]) print '
<tr>
<td colspan="3" align="center" valign="top">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td style="font-size: 8pt; font-family: Verdana;" align="center">
<hr size="1" color="#000066">
<table id="Table1" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td align="center"><img src="files/spacer_003.gif" height="31" width="137"></td>
<td style="font-size: 8pt; font-family: Verdana;" align="center"><a href="http://aiz.ru">
Copyright &copy;</a> 2010-2012, Южноуральский Арматурно-Изоляторный Завод.
<br>
<a href="http://aiz.ru" target="_blank">Сайт предприятия</a> | 
<a href="index.php?sel=about" target="_blank">Информация о системе</a>
<font size="1" face="Verdana">Интерфейс оптимизирован под разрешение в 1280 x 1024 или выше, браузер Firefox и небольшой размер шрифта</font></td>
<td align="center" nowrap="nowrap" valign="middle"><a href="" title="" target="_blank"><img style="border: medium none ;" src="files/aiz.jpg" alt="ЮУАИЗ"></a><img src="files/spacer_003.gif" height="31" width="50"></td>
</tr>
</tbody></table>
<br>
</td></tr>
</tbody></table>';
?>
</td>
</tr> 
</tbody></table>

<div id="SummaryDiv" style="border: 1px solid black; display: none; width: 113px; position: absolute; height: 20px; background-color: rgb(255, 255, 204);" ms_positioning="FlowLayout">
<table border="0" cellpadding="2" height="38" width="111">
<tbody><tr><td class="blacktext" nowrap="nowrap">Current</td><td class="blackText" id="tdSummary1"></td></tr>
<tr><td class="blacktext" nowrap="nowrap">Net Change</td><td class="blackText" id="tdSummary2"></td></tr>
</tbody></table>
</div>
</body></html>
