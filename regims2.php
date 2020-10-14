<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">
<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="top">

<div id="maincontent" >
<table border="0" cellpadding="0" cellspacing="1" width="99%">
<tbody>
<tr><td>
<?php
 $sumw=$sumg=$ithr0=$ithr1=$itecm0=$itecm1=$itecm2=0; $data_voda=0; $v=0;

 $query = 'SELECT * FROM devices WHERE type>=21 AND type<28 ORDER BY ecm';
 //echo $query;
 if ($e3 = mysql_query ($query,$i))
 while ($ui3 = mysql_fetch_row ($e3))
	{
	 $sumw=$sumg=$ithr0=$ithr1=0; 
	 for ($tn=0; $tn<=31; $tn++) $data_ven[$tn]=$data_gor[$tn]=$data_elec[$tn]=$data_gas[$tn]=$datavoda[$tn]=$sum_ven[$tn]=$sum_gor[$tn]=$sum_voda[$tn]=0;
	 $device=$ui3[11]; $gor=$ui3[20]; $ven=$ui3[21]; $chan_elec=$ui3[22]; $chan_gas=$ui3[23]; $chan_voda=$ui3[24]; $elec=$ui3[15]; $gas=$ui3[16]; $voda=$ui3[17];

	 $cn=0; $today=getdate(); $qnt=31;
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];	 
	 else $mn=$_GET["month"];
	 $tm=$today["mday"]-1;
	 $startdate=sprintf ("%d%02d01000000",$ye,$mn-1);
	 for ($tn=0; $tn<=$qnt; $tn++)
		{
		 $dat[$tn]=sprintf ("%02d/%02d",$tm,$mn);
    		 $date[$tn]=sprintf ("%d-%02d-%02d 00:00:00",$ye,$mn,$tm);
    		 //echo $date[$tn];
		 $tm--;
	         if ($tm==0)
		    {
		     $mn--;
		     if ($mn==0) { $mn=12; $ye--; }
		     $dy=31;
		     if (!checkdate ($mn,31,$ye)) { $dy=30; }
		     if (!checkdate ($mn,30,$ye)) { $dy=29; }
		     if (!checkdate ($mn,29,$ye)) { $dy=28; }
	    	     $tm=$dy;
	    	    }
	    	}

	 if (!$first)
		{
		 print '<tr class="BlockHeaderLeftRight" align="center"><td>Устройство</td>';
		 for ($tn=$qnt; $tn>=0; $tn--)
			{
		         print '<td><a href="index.php?sel=regims&day='.$tn.'&month='.$mn.'" style="color:white">'.$dat[$tn].'</a></td>';
		        }
		 print '</tr>';
		}
	 print '<tr class="BlockHeaderLeftRight" align="center"><td>'.$ui3[1].'</td>';

	 $query = 'SELECT * FROM data WHERE (channel='.$gor.' OR channel='.$ven.') AND type=2 AND date>='.$startdate;
	 //echo $query;
	 if ($e = mysql_query ($query,$i))
	 while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
		{
		 //echo $ui["date"];
		 $x=$qnt+1;
		 for ($tn=0; $tn<=$qnt; $tn++)
		     if ($ui["date"]==$date[$tn]) $x=$tn;
		 if ($ui["channel"]==$ven) $data_ven[$x]=$ui["value"];
		 if ($ui["channel"]==$gor) $data_gor[$x]=$ui["value"];
		}
	 for ($tn=$qnt; $tn>=0; $tn--)
	    {
	     if ($data_gor[$tn]>24) $data_gor[$tn]=24;
	     if ($data_gor[$tn]<0) $data_gor[$tn]=0;
	     print '<td class="simple">'.number_format($data_gor[$tn],1).'ч</td>';
	    }
	 print '</tr>'; $first++;
	}
  print '</table>';
?>

<tr>
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
		 print '<tr><td><img src="charts/barplots9.php?id='.$uo[11].'&name='.$uo[1].'"></td></tr>';
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