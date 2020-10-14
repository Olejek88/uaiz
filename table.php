<div id="maincontent" style="border-width: 2px;  border-style: solid;  border-color: #5d6d2f;">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody><tr>
<td>

<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr><td>
<table border="0" cellpadding="2" cellspacing="0">
<tbody><tr><td>
<ul id="navigation"> 
<?php
print '<li><a href="map.php" '; if ($_GET["type"]=='') print 'class="sel"'; print '><span>Все точки учета</span></a></li>';
print '<li><a href="map.php?raion=1" '; if ($_GET["type"]=='1') print 'class="sel"'; print '><span>Газ</span></a></li>';
print '<li><a href="map.php?raion=2" '; if ($_GET["type"]=='2') print 'class="sel"'; print '><span>Пар</span></a></li>';
print '<li><a href="map.php?raion=3" '; if ($_GET["type"]=='3') print 'class="sel"'; print '><span>Электричество</span></a></li>';
print '<li><a href="map.php?raion=4" '; if ($_GET["type"]=='4') print 'class="sel"'; print '><span>Температура воздуха</span></a></li>';
print '<li><a href="map.php?raion=5" '; if ($_GET["type"]=='5') print 'class="sel"'; print '><span>Тепло</span></a></li>';
?>
</ul>
<div id="border"></div>
</td></tr>
</tbody></table>
</td></tr>
		
<tr><td>
<table border="0" cellpadding="0" cellspacing="5" width="100%">
<tbody>
<tr><td valign="top">
<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
<tr bgcolor="#476a94"><td colspan=6 align=center><font color="white">Точка учета / ЭСМ</font></td><td colspan=5 align=center><font color="white">Состояние агрегатов</font></td><td colspan=10 align=center><font color="white">Расходы</font></td></tr>
<tr bgcolor="#476a94">
<td align="center"><font color="white">S</font></td>
<td align="center"><font color="white">Узел учета</font></td>
<td align="center"><font color="white">T</font></td>
<td align="center"><font color="white">Дата связи</font></td>
<td align="center"><font color="white">Обмены</font></td>
<td align="center"><font color="white">Прибор учета</font></td>
<td align="center"><font color="white">Tпод</font></td>
<td align="center"><font color="white">Tобр</font></td>
<td align="center"><font color="white">Vпод</font></td>
<td align="center"><font color="white">Vобр</font></td>
<td align="center"><font color="white">Qпод</font></td>
<td align="center"><font color="white">Qобр</font></td>
<td align="center"><font color="white">Qпот</font></td>
<td align="center"><font color="white">Pпр</font></td>
<td align="center"><font color="white">Pобр</font></td>
<td align="center"><font color="white">Vхвс</font></td>
<td align="center"><font color="white">Pхвс</font></td>
</tr>
<?php
 if ($_GET["type"]=='') $query = 'SELECT * FROM objects';
 else $query = 'SELECT * FROM objects WHERE type='.$_GET["type"];

 if ($_GET["raion"]=='') $query = 'SELECT * FROM objects';
 else $query = 'SELECT * FROM objects WHERE nstruts='.$_GET["raion"];

 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 $tpod=$tobr=$vpod=$vobr=$qpod=$qobr=$qpot=$vgvs=$vhvs=$qpot=$p1=$p2=-1;
	 $dat='-';
	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);

	 $query = 'SELECT * FROM data WHERE type=0 AND value>0 AND device='.$uo[11].' ORDER BY date DESC';
	 $y = mysql_query ($query,$i);
	 if ($y) $uy = mysql_fetch_row ($y);
	 while ($uy)
		{
		 if ($uy[8]==4 && $uy[6]==0 && !$tpod) $tpod=$uy[3];
		 if ($uy[8]==4 && $uy[6]==1 && !$tobr) $tobr=$uy[3];
		 if ($uy[8]==11 && $uy[6]==0 && !$vpod) $vpod=$uy[3];
		 if ($uy[8]==11 && $uy[6]==1 && !$vobr) $vobr=$uy[3];
		 if ($uy[8]==13 && $uy[6]==10 && !$qpod) $qpod=$uy[3];
		 if ($uy[8]==13 && $uy[6]==11 && !$qobr) $qobr=$uy[3];
		 if ($uy[8]==13 && $uy[6]==2 && !$qpot) $qpot=$uy[3];
		 if ($uy[8]==12 && $uy[6]==5 && !$vgvs) $vgvs=$uy[3];
		 if ($uy[8]==12 && $uy[6]==6 && !$vhvs) $vhvs=$uy[3];
		 if ($uy[8]==16 && $uy[6]==10 && !$phvs) $phvs=$uy[3];
		 if ($uy[8]==16 && $uy[6]==0 && !$vgvs) $p1=$uy[3];
		 if ($uy[8]==16 && $uy[6]==1 && !$vhvs) $p2=$uy[3];
		 if ($dat=='-') $dat=$uy[2];
		 $uy = mysql_fetch_row ($y);
		}	 	 
	 print '<tr id="row'.$ui[0].'" bgcolor="#ffffff" Onmouseover="this.className=\'normalActive\'; cursor:pointer" Onmouseout="this.className=\'normal\'" class="normal">';
	 if ($uo[12]==0) print '<td align="center"><img src="files/status2.gif"></td>';
	 if ($uo[12]==1) print '<td align="center"><img src="files/status1.gif"></td>';
	 if ($uo[12]==2) print '<td align="center"><img src="files/status3.gif"></td>';
	 if ($uo[12]==3) print '<td align="center"><img src="files/status4.gif"></td>';
	 print '<td align="center"><a href="index.php?sel=object&id='.$ui[0].'" style="text-decoration:none"><b>'.$ui[1].'</b></a></td>';
	 if ($uo[4]==2) print '<td align="center"><img src="files/gsm.jpg"></td>';
	 if ($uo[4]==1) print '<td align="center"><img src="files/network.jpg"></td>';
	 if ($uo[4]==3) print '<td align="center"><img src="files/wireless.jpg"></td>';
	 if ($uo[4]==4) print '<td align="center"><img src="files/hand.jpg"></td>';
	 if ($uo[4]==0) print '<td align="center"></td>';
	 print '<td align="center">'.$dat.'</td>';
	 if ($uo[12]==0)  print '<td align="center"><img src="rate/0.gif"></td>';
	 if ($uo[12]==1)  print '<td align="center"><img src="rate/5.gif"></td>';
	 if ($uo[12]==2) print '<td align="center"><img src="rate/'.rand(0,5).'.gif"></td>';
	 if ($uo[12]==1 || $uo[12]==2) 
		{
		 print '<td align="center">'.$uo[1].'</td>';
		 if ($tpod) print '<td align="center">'.number_format($tpod,3).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($tobr) print '<td align="center">'.number_format($tobr,3).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($vpod) print '<td align="center">'.number_format($vpod,5).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($vobr) print '<td align="center">'.number_format($vobr,5).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($qpod) print '<td align="center">'.number_format($qpod,5).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($qobr) print '<td align="center">'.number_format($qobr,5).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($qpot) print '<td align="center">'.number_format($qpot,5).'</td>';
		 else if ($qpod>0) print '<td align="center" bgcolor="#eeeeee">'.number_format($qpod-$qobr,5).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';

		 if ($p1) print '<td align="center">'.number_format($p1,5).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($p2) print '<td align="center">'.number_format($p2,5).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($vhvs>0) print '<td align="center">'.number_format($vhvs,5).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($phvs) print '<td align="center">'.number_format($phvs,5).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		}
	 else  print '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	 print '</tr>';	 	 	 
	 $ui = mysql_fetch_row ($e);	 
	}
?>
</tbody></table>
<table cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
<tr><td valign=top><table>
<tr bgcolor="#476a94">
<td align="center"><font color="white">S</font></td>
<td align="center"><font color="white">Комментарий</font></td>
</tr>
<tr><td align="center"><img src="files/status1.gif"></td>
<td align="center"><font">Узел отвечает</font></td></tr>
<tr><td align="center"><img src="files/status2.gif"></td>
<td align="center"><font>Узел не отвечает</font></td></tr>
<tr><td align="center"><img src="files/status4.gif"></td>
<td align="center"><font>Узел учета в процессе подключения</font></td></tr>
<tr><td align="center"><img src="files/status3.gif"></td>
<td align="center"><font>Получены предупреждения по узлу учета</font></td></tr>
</table>
</td><td  valign=top>
<table cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
<tr bgcolor="#476a94">
<td align="center"><font color="white">S</font></td>
<td align="center"><font color="white">Комментарий</font></td>
</tr>
<tr><td align="center"><img src="files/gsm.jpg"></td>
<td align="center"><font">Прибор подключен через сеть GSM/GPRS</font></td></tr>
<tr><td align="center"><img src="files/network.jpg"></td>
<td align="center"><font>Сеть Ethernet</font></td></tr>
<tr><td align="center"><img src="files/wireless.jpg"></td>
<td align="center"><font>Беспрводная сеть</font></td></tr>
<tr><td align="center"><img src="files/hand.jpg"></td>
<td align="center"><font>Ввод данных из других источников</font></td></tr>
</table></td></tr></table>
</tbody></table>
</td></tr></tbody></table>
</td></tr>
</tbody></table>
<br><br><br>
<br><br><br><br><br>
</div>

<div style="position: absolute; top:0; left:0;">
 <?php
 if ($_GET["type"]=='') $query = 'SELECT * FROM objects';
 else $query = 'SELECT * FROM objects WHERE type='.$_GET["type"];
 if ($_GET["raion"]=='') $query = 'SELECT * FROM objects';
 else $query = 'SELECT * FROM objects WHERE nstruts='.$_GET["raion"];


 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);
	 if ($_GET["raion"]=='') { $x=$ui[4]; $y=$ui[5]; }
	 else  { $x=$ui[7]; $y=$ui[8]; }

	 print '<style type="text/css"> 
		   #rightcol'.$ui[0].' {
		    position: absolute;
		    left: '.$x.'px;
		    top: '.$y.'px;
		    width: 30px; }
		   #inf'.$ui[0].' {
		    position: absolute;
		    left: 0px;
		    top: 600px;
		    width: 350px; 
		    visibility:hidden;
		    z-index: 10;
	 	    border-width: 2px;  border-style: dashed;  border-color: #5d6d2f;
			}
		   #infs'.$ui[0].' {
		    position: absolute;
		    left: 170px;
		    top: 110px; }
		</style>';
	 if ($uo[12]==1 || $uo[12]==2) print '<div id="rightcol'.$ui[0].'" Onmouseout="document.getElementById(\'inf'.$ui[0].'\').style.visibility=\'hidden\'" Onmouseover="document.getElementById(\'inf'.$ui[0].'\').style.visibility=\'visible\'"><a href="index.php?sel=object&id='.$ui[0].'"><img border=0 src="pict/green_flag2.gif"></a></div>';
	 else print '<div id="rightcol'.$ui[0].'" Onmouseout="document.getElementById(\'inf'.$ui[0].'\').style.visibility=\'hidden\'" Onmouseover="document.getElementById(\'inf'.$ui[0].'\').style.visibility=\'visible\'"><a href="index.php?sel=object&id='.$ui[0].'"><img border=0 src="pict/red_flag2.gif"></a></div>';
	 $ui = mysql_fetch_row ($e);
	}
?>
<?php
 if ($_GET["type"]=='') $query = 'SELECT * FROM objects';
 else $query = 'SELECT * FROM objects WHERE type='.$_GET["type"];
 if ($_GET["raion"]=='') $query = 'SELECT * FROM objects';
 else $query = 'SELECT * FROM objects WHERE nstruts='.$_GET["raion"];

 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);

	 print '<div id="inf'.$ui[0].'">';
	 print '<img src="pict/'.$ui[0].'_resize.jpg">'; 
	 if ($uo[12]<2) print '<div id="infs'.$ui[0].'"><a href="index.php?sel=object&id='.$ui[0].'"><img border=0 src="pict/green_flag.gif"></a></div>';
	 print '<div id="infs'.$ui[0].'"><a href="index.php?sel=object&id='.$ui[0].'"><img border=0 src="pict/red_flag.gif"></a></div>';
	 print '</div>';
	 $ui = mysql_fetch_row ($e);
	}
?>
</div>

