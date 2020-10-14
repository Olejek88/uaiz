<link rel="stylesheet" type="text/css" href="files/site.css">

<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">

<div id="body-wrapper">
<table cellpadding="0" cellspacing="0">
<tbody><tr><td id="default-panel" align="left" valign="top">
<div class="market-watch">
    <div class="lt">
    <label><a href="#" class="hyMarket">Накопительные итоги всех каналов измерения</a></label>
    <div class="indices">
    &nbsp; <span>Last Update: 18/12/2011 17:27, KSA</span>
    </div>
</div>
<?php
 error_reporting(0);
 $query = 'SELECT AVG(value),COUNT(id) FROM data WHERE type=0 AND prm=4 AND source=0';
 if ($e4 = mysql_query ($query,$i))
 if ($uo2 = mysql_fetch_row ($e4)) { $val4=$uo2[0]; $count4=$uo2[1]; }
 $query = 'SELECT AVG(value),COUNT(id) FROM data WHERE type=0 AND prm=14 AND source=0';
 if ($e4 = mysql_query ($query,$i))
 if ($uo2 = mysql_fetch_row ($e4)) { $val1=$uo2[0]; $count1=$uo2[1]; }
 $query = 'SELECT AVG(value),COUNT(id) FROM data WHERE type=0 AND prm=11 AND source=0';
 if ($e4 = mysql_query ($query,$i))
 if ($uo2 = mysql_fetch_row ($e4)) { $val2=$uo2[0]; $count2=$uo2[1]; }
 $query = 'SELECT AVG(value),COUNT(id) FROM data WHERE type=0 AND prm=12 AND source=0';
 if ($e4 = mysql_query ($query,$i))
 if ($uo2 = mysql_fetch_row ($e4)) { $val3=$uo2[0]; $count3=$uo2[1]; }
 $query = 'SELECT AVG(value),COUNT(id) FROM data WHERE type=0 AND prm=13 AND source=0';
 if ($e4 = mysql_query ($query,$i))
 if ($uo2 = mysql_fetch_row ($e4)) { $val5=$uo2[0]; $count5=$uo2[1]; }
?>	

<table style="margin-top: 0pt;" id="MarketDG" class="table-content" cellpadding="0" cellspacing="0">
<tbody><tr style="width: 1051px; background-color: rgb(238, 238, 238);">
<td style="width: 350px;" class="small">Канал</td>
<td style="width: 150px;" class="small">Последняя метка</td>
<td style="width: 93px;" class="small">Текущее</td>
</tr>

<?php        
 $query = 'SELECT * FROM uzels ORDER BY id';
 if ($e = mysql_query ($query,$i))
 while ($ui = mysql_fetch_row ($e))
	{
	 print '<tr class="gray-back"><td colspan="12" style="padding-left: 2px;">'.$ui[1].'</td></tr>';
	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 if ($e2 = mysql_query ($query,$i))
	 while ($ui2 = mysql_fetch_row ($e2))
		{
	 	 $device=$ui2[11];
		 $query = 'SELECT * FROM channels WHERE opr>0 AND (prm!=4) AND device='.$device;

		 $cn=0;
		 if ($e3 = mysql_query ($query,$i))
		 while ($uo = mysql_fetch_row ($e3))
			{
			 $dis=0; $time=$cvalue=$pvalue1=$pvalue2=$minvalue=$maxvalue=$pvalue3=$ptime3=$ptime2=$pvalue4='';
			 if ($cn%2) print '<tr class="alter-row"><td class="left"><a href="index.php?sel=report" title="'.$uo[1].'">'.$uo[1].' ('.$uo[0].')</a></td>';
		         else print '<tr class="row"><td class="left"><a href="index.php?sel=report" title="'.$uo[1].'">'.$uo[1].' ('.$uo[0].')</a></td>';

		         if ($uo[9]==2)
				{
				 $query = 'SELECT SUM(value),MAX(date) FROM data WHERE type=2 AND device='.$device.' AND channel='.$uo[0];
				 if ($e4 = mysql_query ($query,$i))
				 if ($uo2 = mysql_fetch_row ($e4))
					{
					 $pvalue1=$uo2[0]; $ptime1=$time=$uo2[1];
					} 
				}
			 else
				{
				 $query = 'SELECT * FROM data WHERE type=5 AND device='.$device.' AND channel='.$uo[0].' ORDER BY date DESC LIMIT 2';
				 if ($e4 = mysql_query ($query,$i))
				 if ($uo2 = mysql_fetch_row ($e4))
					{
					 $pvalue1=$uo2[3]; $ptime1=$time=$uo2[2];
					}
				}
			 $query = 'SELECT COUNT(id) FROM hours WHERE type=1 AND device='.$device.' AND channel='.$uo[0];
			 if ($e4 = mysql_query ($query,$i))
			 if ($uo2 = mysql_fetch_row ($e4))
				{
				 $count=$uo2[0];
				}

			 $dis=$pvalue1-$pvalue2;
			 if ($count>2)
			    {
    	                     print '<td class="left">'.$time.'</td>';
	                     print '<td class="right">'.number_format($pvalue1,2).'('.$count.')</td>';
	                    }
			 else
			    {
    	                     print '<td class="left"></td>';
	                     print '<td class="right"></td>';
	                    }
			 print '</tr>'; $cn++;
			}
		}
	}
?>
</table>
</td></tr>
</table>

</div>
</div>
</div>
