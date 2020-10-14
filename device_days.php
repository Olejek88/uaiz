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
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>

</tr></table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="700px">
<?
 $query = 'SELECT * FROM devices WHERE device='.$_GET["id"];
 $y = mysql_query ($query,$i);
 if ($y) $uo = mysql_fetch_row ($y);
 print '<table width=600px cellpadding=1 cellspacing=1 bgcolor=#ffffff align=center>
 <tr><td width=600 valign=top>
 <table width=600 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>
 <tr class="BlockHeaderLeftRight" style="height:18px"><td bgcolor="#1881b6" align=center>дата</td>';
 $query = 'SELECT * FROM channels WHERE opr=1 AND device='.$_GET["id"];
// echo $query;
 if ($e) $e = mysql_query ($query,$i); $cnt=0;
 while ($ui = mysql_fetch_row ($e))
	{ 
	 print '<td bgcolor="#1881b6" align="center">'.$ui[15].'</td>';
	 $chan[$cnt]=$ui[0]; $name[$cnt]=$ui[1]; $prm[$cnt]=$ui[9];
	 $cnt++;
	}
 print '</tr>';
 $max=$cnt;

 $today=getdate();
 if ($_GET["year"]=='') $ye=$today["year"];
 else $ye=$_GET["year"];
 if ($_GET["month"]=='') $mn=$today["mon"];
 else $mn=$_GET["month"];
 $qnt=100;
 $dy=31;
 if (!checkdate ($mn,31,$ye)) { $dy=30; }
 if (!checkdate ($mn,30,$ye)) { $dy=29; }
 if (!checkdate ($mn,29,$ye)) { $dy=28; }

 if ($_GET["month"]=='')
 	 $tm=$dy=$today["mday"]-1;
 else	 $tm=$dy=$today["mday"]=$dy;

 for ($tn=0; $tn<=$qnt; $tn++)
    {	 
     $date1=sprintf ("%d%02d%02d000000",$ye,$mn,$tm);
     $dat[$tn]=sprintf ("%d-%02d-%02d 00:00:00",$ye,$mn,$tm);
     $tm--;
     if ($tm==0)
	{
	 $mn--;
	 if ($mn==0) { $mn=12; $ye--; }
	 $dy=31;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }
	 $tm=$dy;
	}
     $cn++;
    }

 $query = 'SELECT * FROM data WHERE type=2 AND device='.$_GET["id"];
 if ($a = mysql_query ($query,$i))
 while ($uy = mysql_fetch_row ($a))
	{          	
	 for ($tn=1; $tn<=$qnt; $tn++)
	     if ($uy[2]==$dat[$tn]) $x=$tn;
	 for ($t=0; $t<=$max; $t++) 		
	     if ($uy[9]==$chan[$t]) $data[$t][$x]=number_format($uy[3],3);
      }
	

 $mysql_db_name = "scenter2"; 
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);

 for ($tn=0; $tn<=$qnt; $tn++) 
 if ($data[0][$tn] || $data[1][$tn])
	{
	 print '<tr><td align=center bgcolor="#1881b6"><font style="font-family: Verdana; font-size: 11px; color:white">'.$dat[$tn].'</font></td>';
	 for ($t=0; $t<=$max; $t++)
		 print '<td align=center bgcolor=#ffffff class="simple">'.$data[$t][$tn].'</td>';
	 print '</td></tr>';
	}
print '</table></td>';
print '</td><td valign="top">';

print '<table width=1000 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>';
for ($t=0; $t<=$max; $t++)
	print '<tr><td class="simple"><img src="charts/barplots22.php?type=2&chan='.$chan[$t].'&x=1000&y=250&name='.$name[$t].'&prm='.$prm[$t].'" width="1000" height="250"></td></tr>';
print '</table>';
?>

</td>
</tr>
</table>
</body></html>