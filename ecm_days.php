<td align="left" valign="top" width="200">
<table border="0" cellpadding="0" cellspacing="0" width="200">
	<tbody><tr>
	<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="21"><img src="files/icons_featured_co.gif" height="17" hspace="1" vspace="1" width="20"></td>
	<td class="BlockHeaderLeftRight" height="20" width="178">&nbsp;<span id="IndicesLbl">Дата отчета</span></td>
	<td class="vdots" width="1"></td></tr>
	<?php
	 $today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
	 if ($_GET["day"]=='') $day=$today["mday"];
	 else $day=$_GET["day"];
	 for ($pm=1; $pm<=12; $pm++)
	    {	 
	     $tm=$dy=31;
	     if (!checkdate ($mn,31,$ye)) { $dy=30; }
	     if (!checkdate ($mn,30,$ye)) { $dy=29; }
	     if (!checkdate ($mn,29,$ye)) { $dy=28; }
	     $month=$pm; include ("time.inc");
	     $date=sprintf ("%d%02d%02d000000",$ye,$pm,1); 
	     $date2=sprintf ("%d%02d%02d000000",2010,$pm,1); 

	     print '<tr><td align="center" style="font-family: Verdana; font-size: xx-small; color: #006995"><img alt="" src="files/SideArrow.gif" hspace="3"></td><td>&nbsp;<a class="clickablebluetext" href="index.php?sel=ecm_days&month='.$pm.'&date='.$date.'">'.$month.', '.$ye.'</a></td><td class="vdots"></td></tr>';
	     if ($pm==$mn)
	     for ($tn=1; $tn<=$dy; $tn++)
		    {		
		     $date=sprintf ("%d%02d01000000",$today["year"],$pm,$tn);
		     $date2=sprintf ("%d%02d%02d000000",2010,$pm,$tn); 
		     if ($tn==$day) print '<tr><td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img alt="" src="files/SideArrow.gif" hspace="3"></td><td bgcolor="#dedede">&nbsp;<a class="clickablebluetext" href="index.php?sel=ecm_days&month='.$pm.'&day='.$tn.'&date='.$date.'&date2='.$date2.'">'.$tn.', '.$month.'</a></td><td class="vdots"></td></tr>';
		     else print '<tr><td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img alt="" src="files/SideArrow.gif" hspace="3"></td><td>&nbsp;<a class="clickablebluetext" href="index.php?sel=ecm_days&month='.$pm.'&day='.$tn.'&date='.$date.'&date2='.$date2.'">'.$tn.', '.$month.'</a></td><td class="vdots"></td></tr>';		
		    }
	    }	     			
	?>
</table></td>
<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">

<?php                   
 print '<table border="0" cellpadding="0" cellspacing="5" style="padding-left:5px" width="1024px" class="GirdStyle">
	<tr><td><font class="head5">Отчетный период _____________ (месяц, год)</font></td></tr>
	<tr><td><font class="head5">Номер отчета ________</font></td></tr>
	<tr><td style="height:50px"></td></tr>
	<tr><td align="center"><font class="head4">Отчет о суточном потреблении ТЭР и величине экономии</font></td></tr>
	<tr><td style="height:30px"></td></tr>
	</table>

        <table cellpadding="1" cellspacing="1" width="1024px" align="center" class="TableBorder"><tr><td>	
        <table cellpadding="1" cellspacing="1" align="center" class="GirdStyle">
	<tr class="gridHeaderStyle"><td align="center" rowspan=2><font class="head4">Наименование мероприятия</td><td colspan="5" align="center"><font class="head4">Контролируемыe параметры</font></td><td colspan="2" align="center"><font class="head4">Расход ТЭР</font></td><td colspan="2" align="center"><font class="head4">Экономия</font></td></tr>
	<tr class="gridHeaderStyle"><td align="center">название</td><td align="center">норма</td><td align="center">факт</td><td align="center">отклонение</td><td align="center">допустимое отклонение</td><td align="center">до</td><td align="center">после</td><td align="center">кг.у.т</td><td align="center">руб.</td></tr>';

	$tarif1=1.7; $tarif2=776; $tarif3=23; $tarif4=2282;
	$query = 'SELECT * FROM ecm WHERE dohod>0';
	$e = mysql_query ($query,$i);
	if ($e)
	while ($ui = mysql_fetch_row ($e))
		{
		 $do=$posle=$ek=$ekpr='-';
		 $query = 'SELECT * FROM data2 WHERE channel=0 AND type=2 AND date=\''.$_GET["date"].'\' AND device=\''.$ui[0].'\'';
		 //echo $query.'<br>'; 
		 $e2 = mysql_query ($query,$i);
		 if ($e2)
	     	 while ($uo = mysql_fetch_array ($e2, MYSQL_ASSOC))
			{
			 if ($uo["prm"]==2 && $uo["source"]==0) $hr1[$cn]=$uo["value"];
			 if ($uo["prm"]==2 && $uo["source"]==1) $hr0[$cn]=$uo["value"];
			 if ($uo["prm"]==14 && $uo["source"]==0) $data1[$cn]=$uo["value"];
			 if ($uo["prm"]==9 && $uo["source"]==0) $data3[$cn]=$uo["value"];
			 if ($uo["prm"]==12 && $uo["source"]==0) $data0[$cn]=$uo["value"];
			 if ($uo["prm"]==11 && $uo["source"]==0) $data2[$cn]=$uo["value"];
			 if ($uo["prm"]==4 && $uo["source"]==0) $t2[$cn]=$uo["value"];
			}
		 $query = 'SELECT * FROM data2 WHERE channel=0 AND type=2 AND date=\''.$_GET["date2"].'\' AND device=\''.$ui[0].'\'';
		 //echo $query.'<br>';
		 $e2 = mysql_query ($query,$i);
		 if ($e2)
	     	 while ($uo = mysql_fetch_array ($e2, MYSQL_ASSOC))
			{
			 if ($uo["prm"]==14 && $uo["source"]==0) $data11[$cn]=$uo["value"];
			 if ($uo["prm"]==12 && $uo["source"]==0) $data10[$cn]=$uo["value"];
			 if ($uo["prm"]==9 && $uo["source"]==0) $data13[$cn]=$uo["value"];
			 if ($uo["prm"]==11 && $uo["source"]==0) $data12[$cn]=$uo["value"];
			 if ($uo["prm"]==4 && $uo["source"]==1) $t3[$cn]=$uo["value"];
			 if ($uo["prm"]==4 && $uo["source"]==2) $t1[$cn]=$uo["value"];
			}
		 $do=$data11[$cn]+$data10[$cn]+$data13[$cn]+$data12[$cn];
		 $posle=$data1[$cn]+$data0[$cn]+$data3[$cn]+$data2[$cn];
		 $ek=$posle-$do;
		 $ekpr=($data1[$cn]-$data11[$cn])*$tarif1+($data0[$cn]-$data10[$cn])*$tarif2+($data3[$cn]-$data13[$cn])*$tarif3+($data2[$cn]-$data2[$cn])*$tarif4;
		 $s_do+=$do; $s_posle+=$posle;
		 $s_ek+=$ek; $s_ekpr+=$ekpr;

		 $query = 'SELECT * FROM devices WHERE ecm=\''.$ui[0].'\'';
		 //echo $query.'<br>'; 
		 $e3 = mysql_query ($query,$i);
		 $cnt=1;
		 if ($e3)
	     	 while ($uo3 = mysql_fetch_array ($e3, MYSQL_ASSOC))
			{
			 $query = 'SELECT * FROM channels WHERE prm=4 AND device=\''.$uo3["device"].'\'';
			 //echo $query.'<br>';
			 $e2 = mysql_query ($query,$i);
			 if ($e2)
		     	 while ($uo2 = mysql_fetch_array ($e2, MYSQL_ASSOC))
				{
		 		 $query = 'SELECT * FROM data2 WHERE channel=0 AND type=2 AND date=\''.$_GET["date"].'\' AND device=\''.$uo2["device"].'\'';
				 //echo $query.'<br>';
		 		 $eo = mysql_query ($query,$i);
		 		 if ($eo)
	     	 		 while ($uo = mysql_fetch_array ($eo, MYSQL_ASSOC))
				 	{
					 $t[$cnt]=$uo["value"];
					}
				 $tname[$cnt]=$uo2["shortname"];
				 $tnorm[$cnt]=$uo2["addr3"];
				 $cnt++; 
				}
			}
		 //echo $cnt;
		 print '<tr class="GridItemStyle"><td rowspan='.($cnt-1).'><font class="head4">'.$ui[1].'</font></td>';
		 print '<td>'.$tname[1].'</td><td>'.$tnorm[1].'</td><td>'.$t[1].'</td><td>'.($t[1]-$tnorm[1]).'</td><td>'.(number_format($t[1]/10,2)).'</td>';

		 print '<td align="center" rowspan="'.($cnt-1).'">'.$do.'</td><td align="center" rowspan="'.($cnt-1).'">'.$posle.'</td>
			<td align="center" rowspan="'.($cnt-1).'"><font class="head4">'.$ek.'</font></td><td align="center" rowspan="'.($cnt-1).'"><font class="head4">'.$ekpr.'</font></td></tr>';
		 for ($cn=2;$cn<$cnt;$cn++)
			{
			 if ($cn%2) print '<tr class="GridItemStyle"><td>'.$tname[$cn].'</td><td>'.$tnorm[$cn].'</td><td>'.$t[$cn].'</td><td>'.($t[$cn]-$tnorm[$cn]).'</td><td>'.(number_format($t[$cn]/10,2)).'</td></tr>';
			 else print '<tr class="GridAlternateItemStyle"><td>'.$tname[$cn].'</td><td>'.$tnorm[$cn].'</td><td>'.$t[$cn].'</td><td>'.($t[$cn]-$tnorm[$cn]).'</td><td>'.(number_format($t[$cn]/10,2)).'</td></tr>';
			}

		 $cn++;
		}
 print '<tr><td colspan="7"><font class="head4">Экономия по всем мероприятиям в сумме</font></td><td><font class="head4">'.$s_ek.'</font></td><td><font class="head4">'.$s_ekpr.'</font></td></tr>
	<tr><td colspan="7"><font class="head4">Накопленная величина экономия с начала месяца</font></td><td><font class="head4"></font></td><td><font class="head4"></font></td></tr>
	<tr><td colspan="7"><font class="head4">Накопленная величина экономия с начала года</font></td><td><font class="head4"></font></td><td><font class="head4"></font></td></tr>
	</table></td></tr></table>
	          
 	<table align="center" border="0" cellpadding="10" cellspacing="0" width="100%">
	<tr><td style="height:50px"></td></tr>
	<tr><td><font class="head4">Составил менеджер проекта ___________________ФИО</font></td></tr>
	<tr><td><font class="head4">Дата ________</font></td></tr>
	</table>';
?>
</td></tr></tbody></table></td>
