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
<tbody><tr style="font-family: Verdana; font-size: 12px; background-color: #006995; color:#ffffff; font-weight:bold"><td align="center">Каналы измерения</td></tr>
<tr><td>
<table border="0" cellpadding="1" cellspacing="1" width="1050" bgcolor="#006995">
<tbody><tr>
<td>
<?php
 $query = 'SELECT * FROM uzels WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 if ($ui) $device=$ui[5];
 
 if ($_GET["id"]!='') $query = 'SELECT * FROM channels WHERE device='.$device;
 else $query = 'SELECT * FROM channels';
 $e = mysql_query ($query,$i);
 print '<tr>';
 if ($e)
 for ($j=0; $j<mysql_num_fields($e); $j++)
 if ($j!=3 && $j!=4 && $j!=5 && $j!=6 && $j!=7 && $j!=8)
	{
	 print '<td class="BlockHeaderLeftRight" align="center">'.mysql_field_name ($e, $j).'</td>';
	}
 print '</tr>'; 
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 print '<tr style="font-family: Verdana; font-size: 11px; background-color:#ffffff">';
	 print '<td class="BlockHeaderLeftRight" align="center">'.$ui[0].'</td>';
	 for ($j=1; $j<mysql_num_fields($e); $j++)
	 if ($j!=3 && $j!=4 && $j!=5 && $j!=6 && $j!=7 && $j!=8)
	      {
		if ($j>10) $ui[$j]=substr($ui[$j],0,16);
	     	print '<td style="padding-left:2px; padding-right:2px">'.$ui[$j].'</td>';
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