	<tr>
	<td class="BlueText" style="padding-bottom: 15px;" colspan="2" align="left" height="100%">
	<table id="ProfileSummeryUC1_ResearchReportDL" style="width: 100%; border-collapse: collapse;" border="0" cellspacing="0">
	<?
	$cn=0;
	$today=getdate();
	$tarif1=0.9; $tarif2=776; $tarif3=3002;
	for ($pm=1; $pm<=12; $pm++)
	    {	 
	     $tm=$dy=31;
	     if (!checkdate ($mn,31,$ye)) { $dy=30; }
	     if (!checkdate ($mn,30,$ye)) { $dy=29; }
	     if (!checkdate ($mn,29,$ye)) { $dy=28; }

	     $hr1[$cn]=$dy*24-rand(0,250);
	     $hr0[$cn]=$dy*24-$hr1[$cn];
	     $data1[$cn]=rand(300000,450000)/100;
	     $data3[$cn]=rand(400000,550000)/100;
	     $data0[$cn]=rand(200000,300000)/5000;
	     $data2[$cn]=rand(240000,350000)/50000;
             $t1[$cn]=95;
	     $t2[$cn]=rand(9000,10500)/100;
	     $t3[$cn]=rand(9200,11500)/100;

	     $ithr1+=$hr1[$cn];
             $ithr0+=$hr0[$cn];
	     $at1+=$t1[$cn]; $at2+=$t2[$cn]; $at3+=$t3[$cn];
	     if ($t3[$cn]>$t2[$cn]) $qual[$cn]=100+($t3[$cn]-$t2[$cn])*100/$t3[$cn];
		else $qual[$cn]=100+($t3[$cn]-$t2[$cn])*100/$t3[$cn];
	     $eco[$cn]=($data1[$cn]-$data3[$cn])*$tarif1+$data0[$cn]*$tarif2+$data2[$cn]*$tarif3;
	     $it0+=$data0[$cn]; $it1+=$data1[$cn]; $it2+=$data2[$cn]; $it3+=$data3[$cn];
	     $itqual+=$qual[$cn]; $iteco+=$eco[$cn];
	     $tm=$pm;
	     include ("time.inc");
	     $dats[$cn]=$dat[$cn];
	     $req.='dat'.$cn.'='.$dat[$cn].'&';
	     $req.='da'.$cn.'='.number_format($data1[$cn]*$tarif1+$data0[$cn]*$tarif2,0).'&';
	     $req.='db'.$cn.'='.number_format($data3[$cn]*$tarif1+$data2[$cn]*$tarif3,0).'&';
	     $cn++;
	    }
	 $at1=$at1/12; $at2=$at2/12; $at3=$at3/12;
	 print '<tr><td><img src="charts/barplots38a.php?'.$req.'"></td></tr>';
	 ?>
	</tbody></table></td>
	</tr>