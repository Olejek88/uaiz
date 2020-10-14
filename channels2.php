<link rel="stylesheet" type="text/css" href="files/site.css">

<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">

<div id="body-wrapper">
<table cellpadding="0" cellspacing="0">
<tbody><tr><td id="default-panel" align="left" valign="top">
<div class="market-watch">
    <div class="lt">
    <label><a href="#" class="hyMarket">Узлы учета газа</a></label>
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
<table class="table-header" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<?php if ($_GET["type"]=='') print '<th class="selected">';  else print '<th class="unselected">'; ?>
<h4><a href="index.php?sel=channels2">Все узлы</a></h4></th>

<?php if ($_GET["type"]=='1') print '<th class="selected">';  else print '<th class="unselected">'; ?>
<h4><a href="index.php?sel=channels2&type=1">Учет электроэнергии</a></h4>
<a href="index.php?sel=channels2&type=1"><?php print number_format($val4,4); ?>
<img src="files/up.gif"><?php print $count4; ?></a></th>

<?php if ($_GET["type"]=='2') print '<th class="selected">';  else print '<th class="unselected">'; ?>
<h4><a href="index.php?sel=channels2&type=2">Учет воды</a></h4>
<a href="index.php?sel=channels2&type=1"><?php print number_format($val1,4); ?>
<img src="files/up.gif"><?php print $count1; ?></a></th>

<?php if ($_GET["type"]=='3') print '<th class="selected">';  else print '<th class="unselected">'; ?>
<h4><a href="index.php?sel=channels2&type=3">Учет газа</a></h4>
<a href="index.php?sel=channels2&type=1"><?php print number_format($val2,4); ?>
<img src="files/up.gif"><?php print $count2; ?></a></th>

<?php if ($_GET["type"]=='4') print '<th class="selected">';  else print '<th class="unselected">'; ?>
<h4><a href="index.php?sel=channels2&type=4">Температуры воздуха</a></h4>
<a href="index.php?sel=channels2&type=1"><?php print number_format($val3,3); ?>
<img src="files/up.gif"><?php print $count3; ?></a></th>

<?php if ($_GET["type"]=='5') print '<th class="selected">';  else print '<th class="unselected">'; ?>
<h4><a href="index.php?sel=channels2&type=5">Учет пара</a></h4>
<a href="index.php?sel=channels2&type=1"><?php print number_format($val5,4); ?>
<img src="files/up.gif"><?php print $count5; ?></a></th>
</tr>
</tbody></table>

<table style="margin-top: 0pt;" id="MarketDG" class="table-content" cellpadding="0" cellspacing="0">
<tbody><tr style="width: 1051px; background-color: rgb(238, 238, 238);">
<td style="width: 350px;" class="small">Канал</td>
<td style="width: 150px;" class="small">Последняя метка</td>
<td style="width: 93px;" class="small">Текущее</td>
<td style="width: 96px;" class="small">Прошлый час</td>
<td style="width: 96px;" class="small">Интервал назад</td>
<td style="width: 102px;" class="small">Изменение</td>
<td style="width: 98px;" class="small">Мин.-Макс.</td>
<td style="width: 97px;" class="small">Последний день</td>
<td style="width: 97px;" class="small">Последний день</td>
<td style="width: 97px;" class="small">Метка последний день</td>
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
		 if ($_GET["type"]=='') $query = 'SELECT * FROM channels WHERE opr>0 AND device='.$device;
		 if ($_GET["type"]=='1')  $query = 'SELECT * FROM channels WHERE prm=14 AND device='.$device;
		 if ($_GET["type"]=='2')  $query = 'SELECT * FROM channels WHERE prm=12 AND device='.$device;
		 if ($_GET["type"]=='3')  $query = 'SELECT * FROM channels WHERE prm=11 AND device='.$device;
		 if ($_GET["type"]=='4')  $query = 'SELECT * FROM channels WHERE prm=4 AND pipe=0 AND device='.$device;
		 if ($_GET["type"]=='5') $query = 'SELECT * FROM channels WHERE prm=13 AND pipe=0 AND device='.$device;

		 $cn=0;
		 if ($e3 = mysql_query ($query,$i))
		 while ($uo = mysql_fetch_row ($e3))
			{
			 $dis=0; $time=$cvalue=$pvalue1=$pvalue2=$minvalue=$maxvalue=$pvalue3=$ptime3=$ptime2=$pvalue4='';
			 if ($cn%2) print '<tr class="alter-row"><td class="left"><a href="index.php?sel=channel&id='.$uo[0].'" title="'.$uo[1].'">'.$uo[1].' ('.$uo[0].')</a></td>';
		         else print '<tr class="row"><td class="left"><a href="index.php?sel=channel&id='.$uo[0].'" title="'.$uo[1].'">'.$uo[1].' ('.$uo[0].')</a></td>';

			 $query = 'SELECT * FROM data WHERE type=0 AND device='.$device.' AND channel='.$uo[0];
			 if ($e4 = mysql_query ($query,$i))
			 if ($uo2 = mysql_fetch_row ($e4))
				{
				 $cvalue=$uo2[3]; $time=$uo2[2];
				}
			 $query = 'SELECT * FROM hours WHERE type=1 AND device='.$device.' AND channel='.$uo[0].' ORDER BY date DESC LIMIT 2';
			 if ($e4 = mysql_query ($query,$i))
			 if ($uo2 = mysql_fetch_row ($e4))
				{
				 $pvalue1=$uo2[3]; $ptime1=$uo2[2];
				 if ($uo2 = mysql_fetch_row ($e4))
					 { $pvalue2=$uo2[3]; $ptime2=substr($uo2[2],0,16); }
				}
			 $query = 'SELECT * FROM data WHERE type=2 AND device='.$device.' AND channel='.$uo[0].' ORDER BY date DESC LIMIT 2';
			 if ($e4 = mysql_query ($query,$i))
			 if ($uo2 = mysql_fetch_row ($e4))
				{
				 $pvalue3=$uo2[3]; $ptime3=substr($uo2[2],0,10);
				 $uo2 = mysql_fetch_row ($e4);
				 $pvalue4=$uo2[3]; $ptime4=$uo2[2];
				}
			 $query = 'SELECT MAX(value),MIN(value),COUNT(id) FROM hours WHERE type=1 AND device='.$device.' AND channel='.$uo[0];
			 if ($e4 = mysql_query ($query,$i))
			 if ($uo2 = mysql_fetch_row ($e4))
				{
				 $maxvalue=number_format($uo2[0],4); $minvalue=number_format($uo2[1],4); $count=$uo2[2];
				}
			 $dis=$pvalue1-$pvalue2;
			 if ($count>2)
			    {
    	                     print '<td class="left">'.$time.'</td>';
	                     print '<td class="right">'.number_format($cvalue,4).'('.$count.')</td>';
	                     print '<td class="right">'.$pvalue1.' ['.$ptime2.']</td>';
	                     print '<td class="right">'.$pvalue2.'</td>';
			     if ($dis>0) print '<td class="green">'.number_format($dis,4).'</td>';
			     else if ($dis<0) print '<td class="red">'.number_format($dis,4).'</td>';
			     else print '<td class="right">'.number_format($dis,4).'</td>';
	                     print '<td class="right">'.number_format($minvalue,3).'-'.number_format($maxvalue,3).'</td>';
	                     print '<td class="right">'.$pvalue3.'</td>';
	                     print '<td class="right">'.$pvalue4.'</td>';
	                     print '<td class="right">'.$ptime3.'</td>';
	                    }
			 else
			    {
    	                     print '<td class="left"></td>';
	                     print '<td class="right"></td>';
	                     print '<td class="right"></td>';
			     print '<td class="right"></td>';
	                     print '<td class="right"></td>';
	                     print '<td class="right"></td>';
	                     print '<td class="right"></td>';
	                     print '<td class="right"></td>';
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
