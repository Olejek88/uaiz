<div id="maincontent" style="width:100%; left: 0px;">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody>
<?php
 $query = 'SELECT * FROM uzels';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 $query = 'SELECT * FROM channels WHERE prm=14 AND device='.$ui[5];
	 if ($_GET["res"]=='1') $query = 'SELECT * FROM channels WHERE prm=14 AND device='.$ui[5];
	 if ($_GET["res"]=='2') $query = 'SELECT * FROM channels WHERE prm=12 AND device='.$ui[5];
	 if ($_GET["res"]=='3') $query = 'SELECT * FROM channels WHERE prm=11 AND pipe=2 AND device='.$ui[5];
	 if ($_GET["res"]=='4') $query = 'SELECT * FROM channels WHERE prm=4 AND device='.$ui[5];
 	 $device=$ui[5];
	 if ($e2 = mysql_query ($query,$i))
	 while ($uo = mysql_fetch_row ($e2))
		{
		 print '<tr><td><img src="charts/trend2.php?type=1&chan='.$uo[0].'&device='.$device.'&type='.$_GET["type"].'&name='.$uo[1].'"></td></tr>';
		}
	 $ui = mysql_fetch_row ($e);
	}
?>
</tbody></table>
</div>