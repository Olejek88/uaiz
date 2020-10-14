<td align="left" valign="top" width="200">
<table id="Table1" border="0" cellpadding="0" cellspacing="0" width="200">
	<tbody><tr>
	<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="21"><img src="files/icons_login.gif" height="17" hspace="1" vspace="1" width="20"></td>
	<td class="BlockHeaderLeftRight" height="20" width="178">&nbsp;<span id="IndicesLbl">Узлы учета</span></td>
	<td class="vdots" width="1"></td></tr>
	<tr style="font-family: Verdana; font-size: xx-small; color: #006995"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=register">Все узлы</a></td></tr>
	<tr><td colspan="3" style="height:5px"></td></tr>
	<?php
	 $query = 'SELECT * FROM uzels';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{	 
		 print '<tr style="font-family: Verdana; font-size: xx-small; color: #006995"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=register&id='.$ui[0].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$ui[1].'</a></td></tr>
			<tr><td colspan="3" style="height:5px"></td></tr>';
	         $ui = mysql_fetch_row ($e);
		}
	?>
</table></td>
<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">
<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="top">
<div id="maincontent" >
<table border="0" cellpadding="0" cellspacing="1" width="99%">
<tbody><tr style="font-family: Verdana; font-size: 12px; background-color: #006995; color:#ffffff; font-weight:bold"><td align="center">Журнал аварий и событий</td></tr>
<tr><td>
<table border="0" cellpadding="1" cellspacing="1" width="1050" bgcolor="#006995">
<tbody><tr>
<td>
<?php
 $query = 'SELECT * FROM uzels WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 if ($ui) $device=$ui[5];
 
 if ($_GET["id"]!='') $query = 'SELECT * FROM register WHERE device='.$device.' AND date>20110601000000 ORDER BY date DESC LIMIT 1000';
 else $query = 'SELECT * FROM register WHERE date>20110601000000 ORDER BY date DESC LIMIT 1000';
 $e = mysql_query ($query,$i);
 print '<tr>';
 print '<td class="BlockHeaderLeftRight" align="center">Время</td>';
 print '<td class="BlockHeaderLeftRight" align="center">Устройство</td>';
 print '<td class="BlockHeaderLeftRight" align="center">Канал</td>';
 print '<td class="BlockHeaderLeftRight" align="center">Тип события</td>';
 print '<td class="BlockHeaderLeftRight" align="center">Описание</td>';
 print '<td class="BlockHeaderLeftRight" align="center">Значение</td>';
 print '</tr>'; 
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 $query='SELECT * FROM devices WHERE device='.$ui[1];
	 $e2 = mysql_query ($query,$i);
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 if ($uo) $dev=$uo[1];
	 $query='SELECT * FROM channels WHERE id='.$ui[7];
	 $e2 = mysql_query ($query,$i);
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 if ($uo) $chan=$uo[1];

	 print '<tr style="font-family: Verdana; font-size: 11px; background-color:#ffffff">';
	 print '<td class="BlockHeaderLeftRight" align="center">'.$ui[5].'</td>';
      	 print '<td style="padding-left:2px; padding-right:2px">'.$dev.' ['.$ui[1].']</td>';
      	 print '<td style="padding-left:2px; padding-right:2px">'.$chan.'</td>';
      	 if ($ui[2]=='1') print '<td style="padding-left:2px; padding-right:2px; background-color:#aaeeaa">информация</td>';
      	 if ($ui[2]=='2') print '<td style="padding-left:2px; padding-right:2px; background-color:#33dddd; align:center">предупреждение</td>';
      	 if ($ui[2]=='3' || $ui[2]=='0') print '<td style="padding-left:2px; padding-right:2px; background-color:#aa0000; align:center">ошибка</td>';
      	 print '<td style="padding-left:2px; padding-right:2px">'.$ui[3].'</td>';
      	 print '<td style="padding-left:2px; padding-right:2px">'.$ui[4].'</td>';
	 print '</tr>';
 	 $ui = mysql_fetch_row ($e);
	}
?>
</tbody></table>
</td></tr></tbody></table>
</td></tr>
</tbody></table>
<br><br><br>
</div>