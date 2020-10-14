<td align="left" valign="top" width="200">
<table id="Table1" border="0" cellpadding="0" cellspacing="0" width="200">
	<tbody><tr>
	<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="21"><img src="files/icons_login.gif" height="17" hspace="1" vspace="1" width="20"></td>
	<td class="BlockHeaderLeftRight" height="20" width="178">&nbsp;<span id="IndicesLbl">Узлы учета</span></td>
	<td class="vdots" width="1"></td></tr>
	<tr><td colspan="3" style="height:5px"></td></tr>
	<?php
	 $query = 'SELECT * FROM uzels';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{	 
		 print '<tr style="font-family: Verdana; font-size: xx-small; color: #006995"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=channels&id='.$ui[0].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$ui[1].'</a></td></tr>
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
<tbody><tr style="font-family: Verdana; font-size: 12px; background-color: #006995; color:#ffffff; font-weight:bold"><td align="center">Узлы учета</td></tr>
<tr><td>
<table border="0" cellpadding="1" cellspacing="1" width="1050" bgcolor="#006995">
<tbody><tr>
<?php
 $query = 'SELECT * FROM uzels';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 print '<td class="BlockHeaderLeftRight" align="center">№</td>';
 print '<td class="BlockHeaderLeftRight" align="center">Узел учета</td>';
 print '<td class="BlockHeaderLeftRight" align="center">Описание</td>';
 print '<td class="BlockHeaderLeftRight" align="center">Мнемосхема</td>';
 print '<td class="BlockHeaderLeftRight" align="center">ЭСМ</td>';
 print '<td class="BlockHeaderLeftRight" align="center">Контроллеры</td>';

 print '</tr>'; 
 if ($e) $ui = mysql_fetch_row ($e); $cn=1;
 while ($ui)
	{	 
	 $ecm1=$ui[4]; $ecm2=$ui[4]; $device=$ui[5]; $esm=''; $dev='';
	 $query = 'SELECT COUNT(id) FROM channels WHERE device='.$ui[5];
	 $e2 = mysql_query ($query,$i);
	 if ($e) $ui2 = mysql_fetch_row ($e2);
	 if ($ui2) { $cntchan=$ui2[0]; }
	 $query = 'SELECT * FROM ecm WHERE id='.$ecm1.' OR id='.$ecm2;
	 $e2 = mysql_query ($query,$i);
	 if ($e2) $ui2 = mysql_fetch_row ($e2);
	 while ($ui2) { $esm.=$ui2[1].' '; $esmdesc.=$ui2[2].' | '; $ui2 = mysql_fetch_row ($e2); }
	 $query = 'SELECT * FROM devices WHERE type=11 AND object='.$ui[0];
	 $e2 = mysql_query ($query,$i);
	 if ($e2) $ui2 = mysql_fetch_row ($e2);
	 while ($ui2) { $dev.=$ui2[1].' '; $ui2 = mysql_fetch_row ($e2); }
	 
	 print '<tr style="font-family: Verdana; font-size: 9px; background-color:#ffffff">';
	 print '<td class="BlockHeaderLeftRight" align="center">'.$cn.'</td>';
      	 print '<td style="padding-left:2px; padding-right:2px"><a href="index.php?sel=uzels&id='.$ui[0].'">'.$ui[1].'</a></td>';
      	 print '<td style="padding-left:2px; padding-right:2px">'.$ui[2].'</td>';
      	 if ($ui[3]!='') print '<td style="padding-left:2px; padding-right:2px"><a href="index.php?sel=uzels_mnem&id='.$ui[0].'">мнемосхема</a></td>';
      	 else print '<td style="padding-left:2px; padding-right:2px"></td>';
      	 if ($ui[4]) print '<td style="padding-left:2px; padding-right:2px"><a href="index.php?sel=ecm&id='.$ui[4].'">'.$esm.'</a></td>';
      	 else print '<td style="padding-left:2px; padding-right:2px"></td>';
      	 print '<td style="padding-left:2px; padding-right:2px">'.$dev.'</td>';
	
	 print '</tr>';
 	 $ui = mysql_fetch_row ($e); $cn++;
	}
?>
</tbody></table>
</td></tr></tbody></table>
</td></tr>
</tbody></table>
<br><br><br>
</div>