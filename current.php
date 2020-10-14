<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
?>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=Windows-1251">
<link href="files/GulfBaseStyle.css" type="text/css" rel="stylesheet">
</head>
<body bottommargin="0" leftmargin="0" topmargin="0" rightmargin="0">
<?php
 $query = 'SELECT SUM(value) FROM data WHERE type=5 AND prm=14';
 $a = mysql_query ($query,$i);
 if ($a) $uy = mysql_fetch_row ($a);			 
 if ($uy) $elec=$uy[0];	 
 $query = 'SELECT SUM(value) FROM data WHERE type=5 AND prm=11 AND source=2';
 $a = mysql_query ($query,$i);
 if ($a) $uy = mysql_fetch_row ($a);			 
 if ($uy) $gas=$uy[0];	 
 $query = 'SELECT SUM(value) FROM data WHERE type=5 AND prm=12 AND source=0';
 $a = mysql_query ($query,$i);
 if ($a) $uy = mysql_fetch_row ($a);			 
 if ($uy) $voda=$uy[0];	 
 $query = 'SELECT date FROM data WHERE type=0 ORDER BY date DESC';
 $a = mysql_query ($query,$i);
 if ($a) $uy = mysql_fetch_row ($a);			 
 if ($uy) $time=$uy[0];	 
?>

<form name="Form1" method="post" action="Indices.aspx?sid=5" id="Form1">
<table id="Market1" style="border: 1px solid White; background-color: rgb(250, 252, 251); font-family: Rod; width: 100%; border-collapse: collapse;" align="Center" border="0" cellpadding="4" cellspacing="0">
<tbody><tr style="color: Black; background-color: rgb(229, 238, 244); font-family: Verdana; font-size: xx-small; font-weight: bold;" align="center">
<td>Параметр</td><td align="center">Значение</td><td align="center">Ед.Из.</td><td style="width: 10px;">&nbsp;</td></tr>
<tr style="color: Black; background-color: White; font-family: Verdana; font-size: xx-small;">
<td><a target="_top" href="index.php?sel=channels2&type=1">Электричество </a></td>
<td align="center"><?php print number_format($elec,2); ?></td>
<td align="right"><span id="Market1_ctl02_lblPrice" style="color: rgb(0, 128, 0);">кВт</span></td>
<td align="left"><img id="Market1_ctl02_imgInd" src="files/u.gif" style="border-width: 0px;"></td>
</tr>
<tr style="color: Black; background-color: White; font-family: Verdana; font-size: xx-small;">
<td><a target="_top" href="index.php?sel=channels2&type=3">Газ</a></td>
<td align="center"><?php print number_format($gas,2); ?></td>
<td align="right"><span id="Market1_ctl04_lblPrice">м3</span></td>
<td align="left"><img id="Market1_ctl04_imgInd" src="files/n.gif" style="border-width: 0px;"></td>
</tr>
<tr style="color: Black; background-color: White; font-family: Verdana; font-size: xx-small;">
<td><a target="_top" href="index.php?sel=channels2&type=2">Вода</a></td>
<td align="center"><?php print number_format($voda,2); ?></td>
<td align="right"><span id="Market1_ctl05_lblPrice">м3</span></td>
<td align="left"><img id="Market1_ctl05_imgInd" src="files/n.gif" style="border-width: 0px;"></td>
</tr>
<tr style="background-color: rgb(229, 238, 244); font-family: Arial; font-size: 7pt; height: 20px;">
<td colspan="4" align="right">Данные на <?php print $time; ?></td></tr>
</tbody></table>&nbsp;</form>
</body></html>