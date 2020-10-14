<?php
 if ($_GET["type"]!=3)
    {
     print '<td align="left" valign="top" width="200">
	<table id="Table1" border="0" cellpadding="0" cellspacing="0" width="200">
	<tbody><tr>
	<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="21"><img src="files/icons_featured_co.gif" height="17" hspace="1" vspace="1" width="20"></td>
	<td class="BlockHeaderLeftRight" height="20" width="178">&nbsp;<span id="IndicesLbl">ÝÑÌ</span></td>
	<td class="vdots" width="1"></td></tr>';

     $query = 'SELECT * FROM ecm';
     $e = mysql_query ($query,$i);
     if ($e) $ui = mysql_fetch_row ($e);
     while ($ui)
	{	 
	 print '<tr style="font-family: Verdana; font-size: xx-small;"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=ecm2&type=1&id='.$ui[0].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$ui[1].'</a></td></tr>
		<tr><td colspan="3" style="height:5px"></td></tr>';
         $ui = mysql_fetch_row ($e);
	}
     print '</table></td>';
    }
?>

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
 include ("ecm_eco2.php");
?>
</tbody></table>
</td>
</tr>
</tbody></table>
</td></tr></tbody></table>
<br><br><br>
</div>