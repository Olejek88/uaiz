<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">
<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr><td class="BlockHeaderMiddle" style="padding-left: 22px;" align="left" height="20" valign="center"><span id="Label5">Распределение общей экономии по месяцам в финансовом эквиваленте</span></td></tr>
<tr><td align="center" bgcolor="#e8f0f5" valign="middle">
	<table>
	<tr><td width="400px">
	<?php
	 print '<table border="0" cellpadding="2" cellspacing="2"><tbody>'; $cn=0;
	 if ($sim)
	 for ($pm=1; $pm<=12; $pm++)
	    {	 
	     $tm=$pm;
	     $data1[$cn]=rand(60000,65000)/100;
	     $data0[$cn]=rand(30000,35000)/100;
	     include ("time.inc");
	     $dats[$cn]=$dat[$cn];
	     $req.='dat'.$cn.'='.$dat[$cn].'&';
	     $req.='da'.$cn.'='.$data1[$cn].'&';
	     $req.='db'.$cn.'='.$data0[$cn].'&';
	     $it1+=$data1[$cn]; $it0+=$data0[$cn];
	     $cn++;
	    }
	 print '<tr><td class="BlockHeaderLeftRight" colspan="5" align="center">Затраты на энергоресурсы (тыс.руб)</td></tr>';
	 print '<tr><td class="BlockHeaderLeftRight">Месяц</td><td class="BlockHeaderLeftRight">До проведения ЭСМ</td><td class="BlockHeaderLeftRight">После проведения ЭСМ</td><td class="BlockHeaderLeftRight">Экономия (тыс.р.)</td><td class="BlockHeaderLeftRight">Экономия (%)</td></tr>';
	 for ($pm=0; $pm<=11; $pm++)	 
		{
		 print '<tr><td class="BlockHeaderLeftRight">'.$dats[$pm].'</td><td class="simple">'.$data1[$pm].'</td><td class="simple">'.$data0[$pm].'</td><td class="simple">'.number_format($data1[$pm]-$data0[$pm],2).'</td><td class="simple">'.number_format(($data1[$pm]-$data0[$pm])*100/$data1[$pm],2).'</td></tr>';
		}
	 print '<tr><td class="BlockHeaderLeftRight">Итого</td><td class="BlockHeaderLeftRight">'.$it1.'</td><td class="BlockHeaderLeftRight">'.$it0.'</td><td class="BlockHeaderLeftRight">'.number_format($it1-$it0,2).'</td><td class="BlockHeaderLeftRight">'.number_format(($it1-$it0)*100/$it1,2).'</td></tr>';
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
	 if ($sim)
	 for ($pm=1; $pm<=12; $pm++)
	    {	 
	     $tm=$pm;
	     $data3[$cn]=rand(20000,25000)/10;	// par
	     if ($pm<9) $data0[$cn]=rand(3400000,4500000)/10;     // electr
		else $data0[$cn]=rand(5000000,6500000)/10;
	     if ($pm<9) $data1[$cn]=rand(220000,250000)/1000;    // gas
		else $data1[$cn]=rand(400000,470000)/1000;
	     if ($pm<9) $data2[$cn]=rand(240000,350000)/200;	// heat
		else $data2[$cn]=rand(100000,150000)/200;
	     if ($pm<5 && $pm>9) $data2[$cn]=0;

	     $data13[$cn]=rand(20000,25000)/10;
	     $data10[$cn]=rand(3400000,4500000)/10;
	     $data11[$cn]=rand(240000,250000)/1000;
	     $data12[$cn]=rand(240000,350000)/200;
             if ($pm<5 && $pm>9) $data12[$cn]=0;

	     $rz0[$cn]=($data10[$cn]-$data0[$cn])*100/$data10[$cn];
	     $rz1[$cn]=($data11[$cn]-$data1[$cn])*100/$data11[$cn];
	     $rz2[$cn]=($data12[$cn]-$data2[$cn])*100/$data12[$cn];
	     $rz3[$cn]=($data13[$cn]-$data3[$cn])*100/$data13[$cn];

	     $rz10[$cn]=($data10[$cn]-$data0[$cn])*1.7;
	     $rz11[$cn]=($data11[$cn]-$data1[$cn])*2282;
	     $rz12[$cn]=($data12[$cn]-$data2[$cn])*776;
	     $rz13[$cn]=($data13[$cn]-$data3[$cn])*20;
	    
	     $total10+=$data10[$cn]*1.7; $total11+=$data11[$cn]*2282; $total12+=$data12[$cn]*776; $total13+=$data13[$cn]*20;
	     $total0+=$data0[$cn]*1.7; $total1+=$data1[$cn]*2282; $total2+=$data2[$cn]*776; $total3+=$data3[$cn]*20;

	     include ("time.inc");
	     $dats[$cn]=$dat[$cn];
	     $cn++;
	    }
	 $req.='dat1=Газ,2010&dat2=Электроэнергия,2010&dat3=Пар,2010&dat4=Вода,2010&';
	 $req.='da1='.$total10.'&da2='.$total11.'&da3='.$total12.'&da4='.$total13;
	 $req2.='dat1=Газ,2011&dat2=Электроэнергия,2011&dat3=Пар,2011&dat4=Вода,2011&';
	 $req2.='da1='.$total0.'&da2='.$total1.'&da3='.$total2.'&da4='.$total3;

	 print '<tr><td class="BlockHeaderLeftRight" colspan="17" align="center">Потребление энергоресурсов</td></tr>';
	 print '<tr><td class="BlockHeaderLeftRight">Месяц</td><td class="BlockHeaderLeftRight" colspan="4" align="center">Электроэнергия (кВт)</td><td class="BlockHeaderLeftRight" align="center" colspan="4">Газ (тыс.м3)</td><td class="BlockHeaderLeftRight" align="center" colspan="4">Пар (м3)</td><td class="BlockHeaderLeftRight" align="center" colspan="4">Вода (м3)</td></tr>';
	 print '<tr><td class="BlockHeaderLeftRight"></td>
		<td class="BlockHeaderLeftRight">2010</td><td class="BlockHeaderLeftRight">2011</td><td class="BlockHeaderLeftRight">Разн (%)</td><td class="BlockHeaderLeftRight">Разница (руб.)</td>
		<td class="BlockHeaderLeftRight">2010</td><td class="BlockHeaderLeftRight">2011</td><td class="BlockHeaderLeftRight">Разн (%)</td><td class="BlockHeaderLeftRight">Разница (руб.)</td>
		<td class="BlockHeaderLeftRight">2010</td><td class="BlockHeaderLeftRight">2011</td><td class="BlockHeaderLeftRight">Разн (%)</td><td class="BlockHeaderLeftRight">Разница (руб.)</td>
		<td class="BlockHeaderLeftRight">2010</td><td class="BlockHeaderLeftRight">2011</td><td class="BlockHeaderLeftRight">Разн (%)</td><td class="BlockHeaderLeftRight">Разница (руб.)</td></tr>';
	 for ($pm=0; $pm<=11; $pm++)
		{
		 print '<tr><td class="BlockHeaderLeftRight">'.$dats[$pm].'</td>
		<td class="simple">'.$data10[$pm].'</td><td class="simple">'.$data0[$pm].'</td><td class="simple">'.number_format($rz0[$pm],2).'</td><td class="simple">'.number_format($rz10[$pm],0).'</td>
		<td class="simple">'.number_format($data11[$pm],1).'</td><td class="simple">'.number_format($data1[$pm],1).'</td><td class="simple">'.number_format($rz1[$pm],2).'</td><td class="simple">'.number_format($rz11[$pm],0).'</td>
		<td class="simple">'.number_format($data12[$pm],1).'</td><td class="simple">'.number_format($data2[$pm],1).'</td><td class="simple">'.number_format($rz2[$pm],2).'</td><td class="simple">'.number_format($rz12[$pm],0).'</td>
		<td class="simple">'.$data13[$pm].'</td><td class="simple">'.$data3[$pm].'</td><td class="simple">'.number_format($rz3[$pm],2).'</td><td class="simple">'.number_format($rz13[$pm],0).'</td></tr>';
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
