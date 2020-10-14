<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">
<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="top">
<div id="maincontent" >
<table border="0" cellpadding="0" cellspacing="1" width="99%">
<tbody><tr style="font-family: Verdana; font-size: 12px; background-color: #006995; color:#ffffff; font-weight:bold"><td align="center">Журнал системы</td></tr>
<tr><td>
<table border="0" cellpadding="1" cellspacing="1" width="1250" bgcolor="#006995">
<tbody><tr>
<td>
<?php
 $query = 'SELECT * FROM registers ORDER BY date DESC';
 $e = mysql_query ($query,$i);
 print '<tr>';
 print '<td class="BlockHeaderLeftRight" align="center">Пользователь</td>';
 print '<td class="BlockHeaderLeftRight" align="center">ip-адрес</td>';
 print '<td class="BlockHeaderLeftRight" align="center">дата/время</td>';
 print '<td class="BlockHeaderLeftRight" align="center">действие</td>';
 print '<td class="BlockHeaderLeftRight" align="center">Channel</td>';
 print '<td class="BlockHeaderLeftRight" align="center">Value 1</td>';
 print '<td class="BlockHeaderLeftRight" align="center">Value 2</td>';
 print '<td class="BlockHeaderLeftRight" align="center">Comment</td>';
 print '</tr>'; 
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 print '<tr style="font-family: Verdana; font-size: 11px; background-color:#ffffff">';
	 print '<td class="BlockHeaderLeftRight" align="center">'.$ui[1].'</td>';
      	 print '<td style="padding-left:2px; padding-right:2px">['.$ui[2].']</td>';
      	 print '<td style="padding-left:2px; padding-right:2px">'.$ui[3].'</td>';
      	 print '<td style="padding-left:2px; padding-right:2px">'.$ui[4].'</td>';
      	 print '<td style="padding-left:2px; padding-right:2px">'.$ui[5].'</td>';
      	 print '<td style="padding-left:2px; padding-right:2px">'.$ui[6].'</td>';
      	 print '<td style="padding-left:2px; padding-right:2px">'.$ui[7].'</td>';
      	 print '<td style="padding-left:2px; padding-right:2px">'.$ui[8].'</td>';
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