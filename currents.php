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
<table style="border: 1px solid White; background-color: rgb(250, 252, 251); font-family: Rod; width: 100%; border-collapse: collapse;" align="Center" border="0" cellpadding="4" cellspacing="0">
<tbody><tr style="color: Black; background-color: rgb(229, 238, 244); font-family: Verdana; font-size: xx-small; font-weight: bold;" align="center">
<td>Узел учета</td><td>Параметр</td><td>Время чтения</td><td align="center">Текущее</td><td align="center">Часовое</td><td align="center">Суточное</td><td align="center">Ед.Из.</td><td style="width: 10px;">&nbsp;</td></tr>
<?php
 $query = 'SELECT * FROM devices WHERE type=11 OR type=12';
 $a = mysql_query ($query,$i);
 if ($a) $uy = mysql_fetch_row ($a);			 
 while ($uy)
	{
	 $query = 'SELECT * FROM channels WHERE opr=1 AND device='.$uy[11];
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{
		 $current=$hour=$day=$time=$time2=$time3='-'; $del=0;
		 $query = 'SELECT * FROM data WHERE device='.$uy[11].' AND channel='.$ui[0].' ORDER BY date DESC LIMIT 100';
		 $r = mysql_query ($query,$i);
		 if ($r) $uy2 = mysql_fetch_row ($r);
		 while ($uy2)
			{			 
			 if ($uy2[1]==0 && $current=='-') { $current=$uy2[3]; $time=$uy2[2]; }
			 if ($uy2[1]==1 && $hour=='-') { $hour=$uy2[3]; $time2=$uy2[2]; }
			 else { $hour2=$uy2[3]; if ($hour2!=0) $del=($hour-$hour2)*100/$hour2; else $del=0; }
			 if ($uy2[1]==2 && $day=='-') { $day=$uy2[3]; $time3=$uy2[2]; }
			 $uy2 = mysql_fetch_row ($r);
			}
		 print '
		 <tr style="color: Black; background-color: White; font-family: Verdana; font-size: xx-small;">
		 <td><a target="_top" href="index.php?sel=device&id='.$uy[11].'">'.$uy[1].'</a></td>
		 <td><a target="_top" href="index.php?sel=channel&id='.$ui[0].'">'.$ui[1].'</a></td>
		 <td>'.$time.'</td>';
		 if ($current!='-') print '<td align="center">'.number_format($current,3).'</td>';
		 else print '<td align="center"></td>';
		 if ($hour!='-') print '<td align="center">'.number_format($hour,3).' ['.$time2.']</td>';
		 else print '<td align="center"></td>';
		 if ($day!='-') print '<td align="center">'.number_format($day,3).' ['.$time3.']</td>';
		 else print '<td align="center"></td>';
		 print '<td align="right"><span id="Market1_ctl02_lblPrice" style="color: rgb(0, 128, 0);"></span></td>';
		 if ($del>0) print '<td align="left"><img id="Market1_ctl02_imgInd" src="files/u.gif" style="border-width: 0px;"></td>';
		 if ($del<0) print '<td align="left"><img id="Market1_ctl02_imgInd" src="files/d.gif" style="border-width: 0px;"></td>';
		 if ($del==0) print '<td align="left"><img id="Market1_ctl02_imgInd" src="files/n.gif" style="border-width: 0px;"></td>';
		 print '</tr>';
		 $ui = mysql_fetch_row ($e);
		}
	 $uy = mysql_fetch_row ($a);
	}
?>
<tr style="background-color: rgb(229, 238, 244); font-family: Arial; font-size: 7pt; height: 20px;">
<td colspan="4" align="right">Данные на <?php print $time; ?></td></tr>
</tbody></table>&nbsp;</form>
</body></html>