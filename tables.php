<td align="left" valign="top" width="200">
<table id="Table1" border="0" cellpadding="0" cellspacing="0" width="200">
	<tbody><tr>
	<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="21"><img src="files/icons_login.gif" height="17" hspace="1" vspace="1" width="20"></td>
	<td class="BlockHeaderLeftRight" height="20" width="178">&nbsp;<span id="IndicesLbl">Технические параметры</span></td>
	<td class="vdots" width="1"></td></tr>
	<tr style="font-family: Verdana; font-size: xx-small;"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=tables&mn=channels" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">Каналы измерения</a></td></tr>
	<tr><td colspan="3" style="height:5px"></td></tr>
	<tr style="font-family: Verdana; font-size: xx-small;"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=tables&mn=edizm" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">Единицы измерения</a></td></tr>
	<tr><td colspan="3" style="height:5px"></td></tr>
	<tr style="font-family: Verdana; font-size: xx-small;"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=tables&mn=devicetype" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">Типы устройств</a></td></tr>
	<tr><td colspan="3" style="height:5px"></td></tr>
	<tr style="font-family: Verdana; font-size: xx-small;"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=tables&mn=protocols" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">Протоколы обмена</a></td></tr>
	<tr><td colspan="3" style="height:5px"></td></tr>
	<tr style="font-family: Verdana; font-size: xx-small;"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=tables&mn=var2" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">Измеряемые параметры</a></td></tr>
	<tr><td colspan="3" style="height:5px"></td></tr>
</table></td>
<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">
<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="top">
<div id="maincontent" >
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody><tr>
<td>
<table border="0" cellpadding="1" cellspacing="2" width="780">
<tbody><tr>
<td>
<?php
 if ($_GET["mn"]!='') $query = 'SELECT * FROM '.$_GET["mn"];
 else $query = 'SELECT * FROM channels';
 $e = mysql_query ($query,$i);
 print '<tr>';
 if ($e)
 for ($j=0; $j<mysql_num_fields($e); $j++)
	{
	 print '<td class="BlockHeaderLeftRight" align="center">'.mysql_field_name ($e, $j).'</td>';
	}
 print '</tr>'; 
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 print '<tr style="font-family: Verdana; font-size: 11px;">';
	 print '<td class="BlockHeaderLeftRight" align="center">'.$ui[0].'</td>';
	 for ($j=1; $j<mysql_num_fields($e); $j++)
	      {
	     	print '<td>'.$ui[$j].'</td>';
	      }
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