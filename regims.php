<td align="left" valign="top" width="200">
<table id="Table1" border="0" cellpadding="0" cellspacing="0" width="200">
	<tbody><tr>
	<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="21"><img src="files/icons_featured_co.gif" height="17" hspace="1" vspace="1" width="20"></td>
	<td class="BlockHeaderLeftRight" height="20" width="178">&nbsp;<span id="IndicesLbl">Режимы работы</span></td>
	<td class="vdots" width="1"></td></tr>
	<?php
	 $query = 'SELECT * FROM devicetype';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{	 
		 print '<tr style="font-family: Verdana; font-size: xx-small;"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=regims&id='.$ui[4].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$ui[1].'</a></td></tr>
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
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody><tr>
<td>
<table border="0" cellpadding="0" cellspacing="0" width="780">
<tbody>
<?php

 if ($_GET["id"]) $query = 'SELECT * FROM devicetype WHERE ids='.$_GET["id"];
 else $query = 'SELECT * FROM devicetype WHERE ids>=21 AND ids<=27';
//echo $query;
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 $query = 'SELECT * FROM devices WHERE type='.$ui[4];
	 $y = mysql_query ($query,$i);

	 if ($y) $uo = mysql_fetch_row ($y);
	 while ($uo)
		{
		 print '<tr><td><img src="charts/trend9.php?id='.$uo[11].'&name='.$uo[1].'"></td></tr>';
		 $uo = mysql_fetch_row ($y);
		}
         $ui = mysql_fetch_row ($e);
	}
?>

</tbody></table>
</td>
</tr>
</tbody></table>
</td></tr></tbody></table>
</td></tr>
</tbody></table>
<br><br><br>
<br><br><br><br><br>
<?php 
//include ("all2.php"); 
?>
</div>