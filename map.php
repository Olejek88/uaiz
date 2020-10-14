<div id="main" style="width:99%">
<img usemap="#menu" border=0 src="map/map1250.jpg">
<map name="menu">
 <?php
 $query = 'SELECT * FROM uzels';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 //$query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 //$u = mysql_query ($query,$i);
	 //if ($u) $uo = mysql_fetch_row ($u);
	 $x=$ui[6]; $y=$ui[7];
	 //echo $x.','.$y.'<br>';
	 print '<area shape="rect" coords="'.$x.','.$y.','.number_format($x+100,0).','.number_format($y+50,0).'" href="index.php?sel=uzels&id='.$ui[0].'" target="_top" alt="'.$ui[1].'" onFocus="this.blur()" Onmouseover="document.all[\'inf'.$ui[0].'\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf'.$ui[0].'\'].style.visibility=\'hidden\'" alt="'.$ui[1].'">';
	 $ui = mysql_fetch_row ($e);
	}
?>
</map>
</div>
<?php
 $query = 'SELECT * FROM uzels';
 if ($e = mysql_query ($query,$i))
 while ($ui = mysql_fetch_row ($e))
	{
	 print '<div id=inf'.$ui[0].' style="position:absolute;top:80;left:900;width:340;height:500;margin-left:10;padding-left:10;visibility:hidden;background-color: #E8F0F5;">';
	 print '<table id="Table9" border="0" cellpadding="3" cellspacing="1" width="100%">';
	 print '<tr><td colspan="2" style="font-family:verdana; font-weight:bold; font-size:12px">'.$ui[1].'</td></tr>';
	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 if ($e2 = mysql_query ($query,$i))
	 while ($ui2 = mysql_fetch_row ($e2))
		{
	 	 $device=$ui2[11];
 
		 $query = 'SELECT * FROM channels WHERE device='.$device;
		 $cn=0;
		 if ($e3 = mysql_query ($query,$i))
		 while ($uo = mysql_fetch_row ($e3))
			{
			 if ($uo[8]!=2) print '<tr><td><img src="charts/trend8.php?device='.$device.'&chan='.$uo[0].'&name='.$uo[1].'"></td></tr>';
			 $query = 'SELECT * FROM data WHERE type=0 AND device='.$device.' AND channel='.$uo[0];

			 if ($e4 = mysql_query ($query,$i))
			 if ($uo2 = mysql_fetch_row ($e4))
				{
				 if ($cn%2==1) print '<tr class="alternatecell"><td width="75%" class="bluetext">';
				 else  print '<tr><td width="75%">';
				 print '<a href="#"><span id="ProfileSummeryUC1_PriceLabel">'.$uo[1].'</span></a></td><td align="right"><span id="ProfileSummeryUC1_lblPrice" class="BlackText">'.$uo2[3].'</span></td></tr>';	 
				}
			}
		}
	 print '</table></div>';
	}
?>