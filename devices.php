<link rel="stylesheet" type="text/css" href="files/site.css">

<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">

<div id="body-wrapper">
<table cellpadding="0" cellspacing="0">
<tbody><tr><td id="default-panel" align="left" valign="top">

<table style="margin-top: 0pt;" id="MarketDG" class="table-content" cellpadding="0" cellspacing="0">
<tbody><tr style="width: 1051px; background-color: rgb(238, 238, 238);">
<td style="width: 210px;" class="small">Устройство</td>
<td style="width: 20px;" class="small">Стс</td>
<td style="width: 20px;" class="small">Уст</td>
<td style="width: 115px;" class="small">Время</td>
<td style="width: 50px;" class="small">Номер</td>
<td style="width: 50px;" class="small">Адрес</td>
<td style="width: 43px;" class="small">Каналов</td>
<td style="width: 80px;" class="small">Идентификатор | Прошивка</td>
<td style="width: 132px;" class="small">Текущих</td>
<td style="width: 132px;" class="small">Часовых</td>
<td style="width: 132px;" class="small">Дневных</td>
<td style="width: 112px;" class="small">По месяцам</td>
</tr>

<?php        
 $query = 'SELECT * FROM devices WHERE type=11 ORDER BY object,adr';
 if ($e2 = mysql_query ($query,$i))
 while ($ui2 = mysql_fetch_row ($e2))
	{
 	 $device=$ui2[11]; $count0=$count1=$count2=$count4=$count5=0; $date0=$date1=$date2=$date4=$date5=0;
	 if ($cn%2) print '<tr class="alter-row"><td class="left"><a href="index.php?sel=device&id='.$ui2[11].'" title="'.$ui2[11].'">'.$ui2[1].'</a></td>';
         else print '<tr class="row"><td class="left"><a href="index.php?sel=device&id='.$ui2[11].'" title="'.$ui2[11].'">'.$ui2[1].'</a></td>';

	 $query = 'SELECT COUNT(id),MAX(date) FROM data WHERE type=0 AND device='.$device;
	 if ($e4 = mysql_query ($query,$i))
	 if ($uo2 = mysql_fetch_row ($e4)) { $count0=$uo2[0]; $date0=$uo2[1]; }
	 $query = 'SELECT COUNT(id),MAX(date) FROM data WHERE type=1 AND device='.$device;
	 if ($e4 = mysql_query ($query,$i))
	 if ($uo2 = mysql_fetch_row ($e4)) { $count1=$uo2[0]; $date1=substr ($uo2[1],0,16); }
	 $query = 'SELECT COUNT(id),MAX(date) FROM data WHERE type=2 AND device='.$device;
	 if ($e4 = mysql_query ($query,$i))
	 if ($uo2 = mysql_fetch_row ($e4)) { $count2=$uo2[0]; $date2=substr ($uo2[1],0,16); }
	 $query = 'SELECT COUNT(id),MAX(date) FROM data WHERE type=4 AND device='.$device;
	 if ($e4 = mysql_query ($query,$i))
	 if ($uo2 = mysql_fetch_row ($e4)) { $count4=$uo2[0]; $date4=substr($uo2[1],0,10); }
	 $query = 'SELECT COUNT(id) FROM channels WHERE device='.$device;
	 if ($e4 = mysql_query ($query,$i))
	 if ($uo2 = mysql_fetch_row ($e4)) { $count5=$uo2[0]; $date5=$uo2[1]; }

         if ($ui2[12]==0) print '<td align="center"><img src="files/status2.gif"></td>';
         if ($ui2[12]==1) print '<td align="center"><img src="files/status1.gif"></td>';
         if ($ui2[12]==2) print '<td align="center"><img src="files/status3.gif"></td>';
         if ($ui2[12]==3) print '<td align="center"><img src="files/status4.gif"></td>';

         if ($ui2[14]==0) print '<td align="center"><img src="files/status4.gif"></td>';
         if ($ui2[14]==1) print '<td align="center"><img src="files/status1.gif"></td>';

	 if ($count5 && $ui2[14]==1)
	    {
    	     print '<td class="left">'.$ui2[19].'</td>';
	     print '<td class="left">'.$ui2[6].'</td>';
	     print '<td class="left">'; printf("%d [%x]",$ui2[10],$ui2[10]); print '</td>';
	     print '<td class="left">'.$count5.'</td>';
	     print '<td class="left">'.$ui2[11].'[<a href="tsk/'.$ui2[9].'">tsk</a>]</td>';
	     print '<td class="left">'.$count0.' ['.$date0.']</td>';
	     print '<td class="left">'.$count1.' ['.$date1.']</td>';
	     print '<td class="left">'.$count2.' ['.$date2.']</td>';
	     print '<td class="left">'.$count4.' ['.$date4.']</td>';
	    }
	 else
	    {
    	     print '<td class="left"></td>';
	     print '<td class="left">'.$ui2[6].'</td>';
	     print '<td class="left">'; printf("%d [%x]",$ui2[10],$ui2[10]); print '</td>';
	     print '<td class="left">'.$count5.'</td>';
	     print '<td class="left">'.$ui2[11].'</td>';
	     print '<td class="left"></td>';
	     print '<td class="left"></td>';
	     print '<td class="left"></td>';
	     print '<td class="left"></td>';
	    }
         print '</tr>'; $cn++;
	}
?>
</table>
</td></tr>
</table>

</div>
</div>
</div>
