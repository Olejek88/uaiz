<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">
<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr><td class="BlockHeaderMiddle" style="padding-left: 22px;" align="left" height="20" valign="center"><span id="Label5">Распределение общей экономии по месяцам в финансовом эквиваленте</span></td></tr>
<tr><td align="center" bgcolor="#e8f0f5" valign="middle">
	<table>
	<tr><td width="400px">
	<?php
	 $today=getdate();
	 print '<table border="0" cellpadding="2" cellspacing="2"><tbody>'; $cn=0;
         $req='';
	 for ($pm=1; $pm<=12; $pm++)
	    {
	     $data1[$cn]=$data0[$cn]=0; 
	     $month=$mn;  include ("time.inc");
	     $dd=$month.'/'.$today["year"];
	     $date1=sprintf ("%d%02d01000000",$today["year"],$pm);
	     $date2=sprintf ("%d%02d01000000",$today["year"],$pm+1);

	     $query = 'SELECT SUM(value) FROM data2 WHERE type=4 AND channel=52 AND prm=1 AND date>='.$date1.' AND date<'.$date2;
	     if ($a = mysql_query ($query,$i))
	     if ($uy = mysql_fetch_row ($a)) $data10[$cn]=$uy[0];
	     $query = 'SELECT SUM(value) FROM data2 WHERE type=4 AND channel=52 AND prm=2 AND date>='.$date1.' AND date<'.$date2;
	     if ($a = mysql_query ($query,$i))
	     if ($uy = mysql_fetch_row ($a)) $data11[$cn]=$uy[0];
	     $query = 'SELECT SUM(value) FROM data2 WHERE type=4 AND channel=52 AND prm=4 AND date>='.$date1.' AND date<'.$date2;
	     if ($a = mysql_query ($query,$i))
	     if ($uy = mysql_fetch_row ($a)) $data13[$cn]=$uy[0];
	     $query = 'SELECT SUM(value) FROM data2 WHERE type=4 AND channel=52 AND prm=5 AND date>='.$date1.' AND date<'.$date2;
	     if ($a = mysql_query ($query,$i))
	     if ($uy = mysql_fetch_row ($a)) $data14[$cn]=$uy[0];

	     $data12[$cn]=$data14[$cn]=0;

	     $query = 'SELECT SUM(value) FROM data2 WHERE type=4 AND channel=51 AND prm=1 AND date>='.$date1.' AND date<'.$date2;
	     if ($a = mysql_query ($query,$i))
	     if ($uy = mysql_fetch_row ($a)) $data0[$cn]=$uy[0];
	     $query = 'SELECT SUM(value) FROM data2 WHERE type=4 AND channel=51 AND prm=2 AND date>='.$date1.' AND date<'.$date2;
	     if ($a = mysql_query ($query,$i))
	     if ($uy = mysql_fetch_row ($a)) $data1[$cn]=$uy[0];
	     $query = 'SELECT SUM(value) FROM data2 WHERE type=4 AND channel=51 AND prm=3 AND date>='.$date1.' AND date<'.$date2;
	     if ($a = mysql_query ($query,$i))
	     if ($uy = mysql_fetch_row ($a)) $data3[$cn]=$uy[0];
	     $query = 'SELECT SUM(value) FROM data2 WHERE type=4 AND channel=51 AND prm=4 AND date>='.$date1.' AND date<'.$date2;
	     if ($a = mysql_query ($query,$i))
	     if ($uy = mysql_fetch_row ($a)) $data2[$cn]=$uy[0];

	     $query = 'SELECT * FROM tarifs WHERE date='.$date1;
	     if ($e2 = mysql_query ($query,$i)) 
	     if ($ui2 = mysql_fetch_row ($e2))
	        {
	         $tarif_elec=$ui2[4];
	         $tarif_hvs=$ui2[6];
	         $tarif_par=$ui2[9];
	         $tarif_gas=$ui2[10];
	         $tarif_vodootv=$ui2[11];
	         $tarif_sal=$ui2[12];
	        }
	     
	     //echo $data0[$cn];
	     $datad0[$cn]=$data0[$cn]; $datad1[$cn]=$data1[$cn]; $datad2[$cn]=$data2[$cn]; $datad3[$cn]=$data3[$cn]; $datad4[$cn]=$data4[$cn];
	     $datad10[$cn]=$data10[$cn]*$tarif_elec; $datad11[$cn]=$data11[$cn]*$tarif_gas; $datad12[$cn]=$data12[$cn]*$tarif_hvs; $datad13[$cn]=$data13[$cn]*$tarif_hvs; $datad14[$cn]=$data14[$cn]*$tarif_vodootv;

	     //echo $datad10[$cn].' '.$datad11[$cn].' '.$datad12[$cn].' '.$datad13[$cn].' '.$datad14[$cn].'<br>';
	     //echo $datad10[$cn].' '.$datad11[$cn].' '.$datad12[$cn].' '.$datad13[$cn].' '.$datad14[$cn].'<br>';
	     //echo $data0[$cn].' | '.$data1[$cn].' | '.$data2[$cn].' | '.$data3[$cn].'<br>';
	     //echo $datad10[$cn].' | '.$datad11[$cn].' | '.$datad12[$cn].' | '.$datad13[$cn].' | '.$datad14[$cn].'<br>';
	     
	     $datas0[$cn]=$datad10[$cn]+$datad11[$cn]+$datad12[$cn]+$datad13[$cn]+$datad14[$cn];
	     $datas1[$cn]=$datad0[$cn]+$datad1[$cn]+$datad2[$cn]+$datad3[$cn]+$datad4[$cn];

	     $total10+=$data10[$cn]; $total11+=$data11[$cn]; $total12+=$data12[$cn]; $total13+=$data13[$cn]; $total14+=$data14[$cn];
	     $total0+=$data0[$cn]; $total1+=$data1[$cn]; $total2+=$data2[$cn]; $total3+=$data3[$cn]; $total4+=$data4[$cn];

             if ($data10[$cn]) $rz0[$cn]=($data10[$cn]-$data0[$cn])*100/$data10[$cn];
             if ($data11[$cn]) $rz1[$cn]=($data11[$cn]-$data1[$cn])*100/($data11[$cn]);
             if ($data12[$cn]) $rz2[$cn]=($data12[$cn]-$data2[$cn])*100/$data12[$cn];
             $rz3[$cn]=($data13[$cn]-$data3[$cn])*100/$data13[$cn];
	     if ($data14[$cn]) $rz4[$cn]=($data14[$cn]-$data4[$cn])*100/$data14[$cn];
                                 
             if ($data10[$cn]) $rz10[$cn]=($datad10[$cn]-$datad0[$cn]);
    	     if ($data11[$cn]) $rz11[$cn]=($datad11[$cn]-$datad1[$cn]);
             if ($data12[$cn]) $rz12[$cn]=($datad12[$cn]-$datad2[$cn]);
             $rz13[$cn]=($datad13[$cn]-$datad3[$cn]);
             if ($data14[$cn]) $rz14[$cn]=($datad14[$cn]-$datad4[$cn]);
                                                                                 
	     $tm=$pm;
	     include ("time.inc");
	     $dats[$cn]=$dat[$cn];
	     $req.='dat'.$cn.'='.$dat[$cn].'&';
	     $req.='da'.$cn.'='.$datas1[$cn].'&';
	     $req.='db'.$cn.'='.$datas0[$cn].'&';
	     if ($datas1[$cn] && $datas0[$cn]) { $it1+=$datas1[$cn]; $it0+=$datas0[$cn]; }
	     $cn++;
	    }
	 print '<tr><td class="BlockHeaderLeftRight" colspan="5" align="center">Затраты на энергоресурсы (тыс.руб)</td></tr>';
	 print '<tr><td class="BlockHeaderLeftRight">Месяц</td><td class="BlockHeaderLeftRight">До проведения ЭСМ</td><td class="BlockHeaderLeftRight">После проведения ЭСМ</td><td class="BlockHeaderLeftRight">Экономия (р.)</td><td class="BlockHeaderLeftRight">Экономия (%)</td></tr>';
	 for ($pm=0; $pm<=11; $pm++)
		{
		 if ($datas1[$pm] && $datas0[$pm]) print '<tr><td class="BlockHeaderLeftRight">'.$dats[$pm].'</td><td class="simple">'.number_format($datas1[$pm],0).'</td><td class="simple">'.number_format($datas0[$pm],0).'</td><td class="simple">'.number_format($datas1[$pm]-$datas0[$pm],0).'</td><td class="simple_green">'.number_format(($datas1[$pm]-$datas0[$pm])*100/$datas1[$pm],2).'%</td></tr>';
		 else print '<tr><td class="BlockHeaderLeftRight">'.$dats[$pm].'</td><td class="simple">-</td><td class="simple">-</td><td class="simple">-</td><td class="simple_green">-</td></tr>';
		}
	 print '<tr><td class="BlockHeaderLeftRight">Итого</td><td class="BlockHeaderLeftRight">'.number_format($it1,0).'</td><td class="BlockHeaderLeftRight">'.number_format($it0,0).'</td><td class="BlockHeaderLeftRight">'.number_format($it1-$it0,0).'</td><td class="BlockHeaderLeftRight">'.number_format(($it1-$it0)*100/$it1,2).'</td></tr>';
	 print '</table></td><td><img src="charts/barplots28.php?'.$req.'"></td></tr>';
	?>
</table>
</td></tr>
<tr><td class="BlockHeaderMiddle" style="padding-left: 22px;" align="left" height="20" valign="center"><span id="Label5">Распределение экономии по типу ресурсов</span></td></tr>
<tr><td align="center" bgcolor="#e8f0f5" valign="middle">
	<table>
	<tr><td width="800px">
	<?php
	 print '<table border="0" cellpadding="2" cellspacing="2"><tbody>'; $cn=0; $req=''; $req2='';

	 $req2.='dat1=Газ,2011&dat2=Электроэнергия,2011&dat3=Пар,2011&dat4=Вода,2011&dat5=Тепло,2011&';
	 $req2.='da1='.$total11.'&da2='.$total10.'&da3='.$total13.'&da4='.$total12.'&da5='.$total14;
	 $req.='dat1=Газ,2012&dat2=Электроэнергия,2012&dat3=Пар,2012&dat4=Вода,2012&dat5=Тепло,2012&';
	 $req.='da1='.$total1.'&da2='.$total0.'&da3='.$total3.'&da4='.$total2.'&da5='.$total4;

	 print '<tr><td class="BlockHeaderLeftRight" colspan="21" align="center">Потребление энергоресурсов</td></tr>';
	 print '<tr><td class="BlockHeaderLeftRight">Месяц</td><td class="BlockHeaderLeftRight" colspan="4" align="center">Электроэнергия (кВт)</td><td class="BlockHeaderLeftRight" align="center" colspan="4">Газ (тыс.м3)</td><td class="BlockHeaderLeftRight" align="center" colspan="4">Пар (ГКал)</td><td class="BlockHeaderLeftRight" align="center" colspan="4">Вода (м3)</td><td class="BlockHeaderLeftRight" align="center" colspan="4">Горячая вода и отопление (ГКал)</td></tr>';
	 print '<tr><td class="BlockHeaderLeftRight"></td>
		<td class="BlockHeaderLeftRight">2011</td><td class="BlockHeaderLeftRight">2012</td><td class="BlockHeaderLeftRight">Разн (%)</td><td class="BlockHeaderLeftRight">Разница (руб.)</td>
		<td class="BlockHeaderLeftRight">2011</td><td class="BlockHeaderLeftRight">2012</td><td class="BlockHeaderLeftRight">Разн (%)</td><td class="BlockHeaderLeftRight">Разница (руб.)</td>
		<td class="BlockHeaderLeftRight">2011</td><td class="BlockHeaderLeftRight">2012</td><td class="BlockHeaderLeftRight">Разн (%)</td><td class="BlockHeaderLeftRight">Разница (руб.)</td>
		<td class="BlockHeaderLeftRight">2011</td><td class="BlockHeaderLeftRight">2012</td><td class="BlockHeaderLeftRight">Разн (%)</td><td class="BlockHeaderLeftRight">Разница (руб.)</td>
		<td class="BlockHeaderLeftRight">2011</td><td class="BlockHeaderLeftRight">2012</td><td class="BlockHeaderLeftRight">Разн (%)</td><td class="BlockHeaderLeftRight">Разница (руб.)</td></tr>';
	 for ($pm=0; $pm<=11; $pm++)
		{
		 print '<tr><td class="BlockHeaderLeftRight">'.$dats[$pm].'</td>
			<td class="simple">'.number_format($data1[$pm],1).'</td><td class="simple">'.number_format($data11[$pm],1).'</td><td class="simple">'.number_format($rz1[$pm],2).'</td><td class="simple">'.number_format($rz11[$pm],0).'</td>
    			<td class="simple">'.number_format($data0[$pm],0).'</td><td class="simple">'.number_format($data10[$pm],0).'</td><td class="simple">'.number_format($rz0[$pm],2).'</td><td class="simple">'.number_format($rz10[$pm],0).'</td>
			<td class="simple">'.number_format($data3[$pm],1).'</td><td class="simple">'.number_format($data13[$pm],1).'</td><td class="simple">'.number_format($rz3[$pm],2).'</td><td class="simple">'.number_format($rz13[$pm],0).'</td>
			<td class="simple">'.number_format($data2[$pm],1).'</td><td class="simple">'.number_format($data12[$pm],1).'</td><td class="simple">'.number_format($rz2[$pm],2).'</td><td class="simple">'.number_format($rz12[$pm],0).'</td>
			<td class="simple">'.$data4[$pm].'</td><td class="simple">'.$data14[$pm].'</td><td class="simple">'.number_format($rz4[$pm],2).'</td><td class="simple">'.number_format($rz14[$pm],0).'</td></tr>';
		}
	 print '</table></td><td><img src="charts/pieplot2.php?'.$req.'"></td><td><img src="charts/pieplot2.php?'.$req2.'"></td></tr>';
	?>
</table>
</td></tr>

<tr><td class="BlockHeaderMiddle" style="padding-left: 22px;" align="left" height="20" valign="center"><span id="Label5">Распределение общей экономии по годам</span></td></tr>
<tr><td align="center" bgcolor="#e8f0f5" valign="middle"></td></tr>
</tbody></table>
</td></tr>
</tbody></table>
</td>
