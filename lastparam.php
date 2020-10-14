<?php
if ($_GET["type"]=='')
 {
  print '<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
	<tr><td align="center" bgcolor="#e8f0f5" valign="middle">
	<table>
	<tr><td>
	<table border="0" cellpadding="2" cellspacing="2"><tbody>'; 
	$cn=0;
	$today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
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
	     $req.='da'.$cn.'='.number_format($data1[$cn]*$tarif1,0).'&';
	     $req.='db'.$cn.'='.number_format($data0[$cn]*$tarif2,0).'&';
	     $req.='dc'.$cn.'='.number_format($data3[$cn]*$tarif1,0).'&';
	     $req.='dd'.$cn.'='.number_format($data2[$cn]*$tarif3,0).'&';
	     $cn++;
	    }
	 $at1=$at1/12; $at2=$at2/12; $at3=$at3/12;

	 print '<tr class="BlockHeaderLeftRight" align="center"><td>Месяц</td><td colspan="2">Час. раб/нраб.</td>
	 <td colspan="1">ЭЭ</td>
	 <td colspan="3">Газ</td>
	 <td colspan="1">Вода</td>
	 <td colspan="1">Вода</td></tr>';
	 print '<tr class="BlockHeaderLeftRight" align="center"><td></td><td>час.</td><td>час.</td><td class="BlockHeaderLeftRight">Электроэнергия, кВт</td><td class="BlockHeaderLeftRight">Пар, т.м3</td>
	 <td class="BlockHeaderLeftRight">Электроэнергия, кВт</td><td class="BlockHeaderLeftRight">Газ, т.м3</td>
	 <td>Tнорм</td><td>Tпар</td><td>Tтек</td>
	 <td>% норм</td><td>руб.</td></tr>';
	 for ($pm=0; $pm<=11; $pm++)	 
		{
		 print '<tr><td class="BlockHeaderLeftRight"><a href="index.php?sel=ecm&id='.$_GET["id"].'&type=2&month='.$pm.'" style="color:#ffffff">'.$dats[$pm].'</a></td>
			<td class="simple">'.$hr1[$pm].'</td>
			<td class="simple">'.$hr0[$pm].'</td>

			<td class="simple">'.$data1[$pm].'</td>
			<td class="simple">'.$data0[$pm].'</td>
			<td class="simple">'.$data3[$pm].'</td>
			<td class="simple">'.$data2[$pm].'</td>

			<td class="simple">'.$t1[$pm].'</td>
			<td class="simple">'.$t2[$pm].'</td>
			<td class="simple">'.$t3[$pm].'</td>

			<td class="simple">'.number_format($qual[$pm],2).'</td>
			<td class="simple">'.number_format($eco[$pm],2).'</td></tr>';
		}
	 print '<tr><td class="BlockHeaderLeftRight">Итого/Ср.</td>
		<td class="BlockHeaderLeftRight">'.$ithr1.'</td>
		<td class="BlockHeaderLeftRight">'.$ithr0.'</td>

		<td class="BlockHeaderLeftRight">'.$it1.'</td>
		<td class="BlockHeaderLeftRight">'.$it0.'</td>
		<td class="BlockHeaderLeftRight">'.$it3.'</td>
		<td class="BlockHeaderLeftRight">'.$it2.'</td>

		<td class="BlockHeaderLeftRight">'.number_format($at1,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($at2,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($at3,2).'</td>

		<td class="BlockHeaderLeftRight">'.$itqual1.'</td>
		<td class="BlockHeaderLeftRight">'.number_format($iteco,2).'</td></tr>';
	 print '</table></td></tr><tr><td><img src="charts/barplots38.php?'.$req.'"></td></tr>';
 }
	
if ($_GET["type"]=='2')
 {
  if ($_GET["month"]=='') $_GET["month"]=1;
  $month=$_GET["month"]+1; include ("time.inc");
  print '<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
	<tr><td class="BlockHeaderMiddle" style="padding-left: 22px;" align="left" height="20" valign="center"><span id="Label5">Расчет экономического эффекта для мероприятия за '.$month.'</span></td></tr>
	<tr><td align="center" valign="middle">
	<table>
	<tr><td width="1000px">
	<table border="0" cellpadding="2" cellspacing="2"><tbody>'; $cn=0;
	$today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];

	$tarif1=1.7; $tarif2=776; $tarif3=2282;
	$tm=1; $dy=31;
	if (!checkdate ($mn,31,$ye)) { $dy=30; }
	if (!checkdate ($mn,30,$ye)) { $dy=29; }
	if (!checkdate ($mn,29,$ye)) { $dy=28; }

	for ($tn=1; $tn<=$dy; $tn++)
	    {		
	     $date1=sprintf ("%d%02d%02d000000",$ye,$mn,$tn);
	     $date2=sprintf ("%02d-%02d",$mn,$tn);
	     $dats[$cn]=sprintf ("%02d-%02d-%d",$tn,$mn,$ye);

	     $hr1[$cn]=24-rand(0,5);
	     $hr0[$cn]=24-$hr1[$cn];
	     $data1[$cn]=rand(300000,450000)/(100*$dy);
	     $data3[$cn]=rand(400000,550000)/(100*$dy);
	     $data0[$cn]=rand(200000,300000)/(5000*$dy);
	     $data2[$cn]=rand(240000,350000)/(50000*$dy);
	     
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
	     $req.='dat'.$cn.'='.$date2.'&';
	     $req.='da'.$cn.'='.number_format($data1[$cn]*$tarif1,0).'&';
	     $req.='db'.$cn.'='.($data0[$cn]*$tarif2).'&';
	     $req.='dc'.$cn.'='.number_format($data3[$cn]*$tarif1,0).'&';
	     $req.='dd'.$cn.'='.number_format($data2[$cn]*$tarif3,0).'&';
	     $cn++;
	    }
	 $at1=$at1/$dy; $at2=$at2/$dy; $at3=$at3/$dy;

	 print '<tr class="BlockHeaderLeftRight" align="center"><td>День</td><td colspan="2">Часов работы / нераб.</td>
	 <td colspan="2">До проведения ЭСМ</td>
	 <td colspan="2">После проведения ЭСМ</td>
	 <td colspan="3">Технологические параметры</td>
	 <td>Качественная оценка</td><td>Экономия</td></tr>';
	 print '<tr class="BlockHeaderLeftRight" align="center"><td></td><td>час.</td><td>час.</td><td class="BlockHeaderLeftRight">Электроэнергия, кВт</td><td class="BlockHeaderLeftRight">Пар, т.м3</td>
	 <td class="BlockHeaderLeftRight">Электроэнергия, кВт</td><td class="BlockHeaderLeftRight">Газ, т.м3</td>
	 <td>Tнорм</td><td>Tпар</td><td>Tтек</td>
	 <td>% норм</td><td>руб</td></tr>';
	 for ($pm=0; $pm<$dy; $pm++)	 
		{
		 $day=$pm+1;
		 print '<tr align="center"><td class="BlockHeaderLeftRight"><a href="index.php?sel=ecm&id='.$_GET["id"].'&type=1&month='.$_GET["month"].'&day='.$day.'" style="color:#ffffff">'.$dats[$pm].'</a></td>
			<td class="simple">'.$hr1[$pm].'</td>
			<td class="simple">'.$hr0[$pm].'</td>

			<td class="simple">'.number_format($data1[$pm],2).'</td>
			<td class="simple">'.number_format($data0[$pm],2).'</td>
			<td class="simple">'.number_format($data3[$pm],2).'</td>
			<td class="simple">'.number_format($data2[$pm],2).'</td>

			<td class="simple">'.$t1[$pm].'</td>
			<td class="simple">'.$t2[$pm].'</td>
			<td class="simple">'.$t3[$pm].'</td>

			<td class="simple">'.number_format($qual[$pm],2).'</td>
			<td class="simple">'.number_format($eco[$pm],2).'</td></tr>';
		}
	 print '<tr><td class="BlockHeaderLeftRight">Итого/Ср.</td>
		<td class="BlockHeaderLeftRight">'.$ithr1.'</td>
		<td class="BlockHeaderLeftRight">'.$ithr0.'</td>

		<td class="BlockHeaderLeftRight">'.number_format($it1,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it0,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it3,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it2,2).'</td>

		<td class="BlockHeaderLeftRight">'.number_format($at1,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($at2,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($at3,2).'</td>

		<td class="BlockHeaderLeftRight">'.$itqual1.'</td>
		<td class="BlockHeaderLeftRight">'.number_format($iteco,2).'</td></tr>';
	 print '</table></td></tr><tr><td><img src="charts/barplots38.php?'.$req.'"></td></tr>';
 }
	
if ($_GET["type"]=='1')
 {
  $month=$_GET["month"]+1; include ("time.inc");
  print '<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
	<tr><td class="BlockHeaderMiddle" style="padding-left: 22px;" align="left" height="20" valign="center"><span id="Label5">Расчет экономического эффекта для мероприятия за '.$_GET["day"].' '.$month.'</span></td></tr>
	<tr><td align="center" valign="middle">
	<table>
	<tr><td width="1000px">
	<table border="0" cellpadding="2" cellspacing="2"><tbody>'; $cn=0;
	$today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
	 if ($_GET["day"]=='') $dy=$today["days"];
	 else $dy=$_GET["day"];

	$tarif1=1.7; $tarif2=776; $tarif3=2282;
	for ($tn=0; $tn<=23; $tn++)
	    {		
	     $date1=sprintf ("%d%02d%02d%02d0000",$ye,$mn,$dy,$tn);
	     $date2=sprintf ("%02d-%02d %02d:00",$dy,$mn,$tn);
	     $dats[$cn]=sprintf ("%02d:00",$tn);

	     $hr1[$cn]=number_format(rand(40,129)/100,0);
	     $hr0[$cn]=1-$hr1[$cn];
	     $data1[$cn]=rand(300000,450000)/(100*$dy*24);
	     $data3[$cn]=rand(400000,550000)/(100*$dy*24);
	     $data0[$cn]=rand(200000,300000)/(5000*$dy*24);
	     $data2[$cn]=rand(240000,350000)/(50000*$dy*24);
	     
             $t1[$cn]=95;
	     $t2[$cn]=rand(10000,10500)/100;
	     $t3[$cn]=rand(10200,11500)/100;

	     $ithr1+=$hr1[$cn];
             $ithr0+=$hr0[$cn];
	     $at1+=$t1[$cn]; $at2+=$t2[$cn]; $at3+=$t3[$cn];
	     if ($t3[$cn]>$t2[$cn]) $qual[$cn]=100+($t3[$cn]-$t2[$cn])*100/$t3[$cn];
		else $qual[$cn]=100+($t3[$cn]-$t2[$cn])*100/$t3[$cn];
	     $eco[$cn]=($data1[$cn]-$data3[$cn])*$tarif1+$data0[$cn]*$tarif2+$data2[$cn]*$tarif3;
	     $it0+=$data0[$cn]; $it1+=$data1[$cn]; $it2+=$data2[$cn]; $it3+=$data3[$cn];
	     $itqual+=$qual[$cn]; $iteco+=$eco[$cn];
	     $req.='dat'.$cn.'='.$dats[$cn].'&';
	     $req.='da'.$cn.'='.number_format($data1[$cn]*$tarif1,0).'&';
	     $req.='db'.$cn.'='.($data0[$cn]*$tarif2).'&';
	     $req.='dc'.$cn.'='.number_format($data3[$cn]*$tarif1,0).'&';
	     $req.='dd'.$cn.'='.number_format($data2[$cn]*$tarif3,0).'&';
	     $cn++;
	    }
	 $at1=$at1/24; $at2=$at2/24; $at3=$at3/24;

	 print '<tr class="BlockHeaderLeftRight" align="center"><td>Час</td><td colspan="2">Часов работы / нераб.</td>
	 <td colspan="2">До проведения ЭСМ</td>
	 <td colspan="2">После проведения ЭСМ</td>
	 <td colspan="3">Технологические параметры</td>
	 <td>Качественная оценка</td><td>Экономия</td></tr>';
	 print '<tr class="BlockHeaderLeftRight" align="center"><td></tdДень><td>час.</td><td>час.</td><td class="BlockHeaderLeftRight">Электроэнергия, кВт</td><td class="BlockHeaderLeftRight">Пар, т.м3</td>
	 <td class="BlockHeaderLeftRight">Электроэнергия, кВт</td><td class="BlockHeaderLeftRight">Газ, т.м3</td>
	 <td>Tнорм</td><td>Tпар</td><td>Tтек</td>
	 <td>% норм</td><td>руб</td></tr>';
	 for ($pm=0; $pm<24; $pm++)	 
		{
		 print '<tr align="center"><td class="BlockHeaderLeftRight"><a href="index.php?sel=ecm&id='.$_GET["id"].'&type=1" style="color:#ffffff">'.$dats[$pm].'</a></td>
			<td class="simple">'.$hr1[$pm].'</td>
			<td class="simple">'.$hr0[$pm].'</td>

			<td class="simple">'.number_format($data1[$pm],2).'</td>
			<td class="simple">'.number_format($data0[$pm],2).'</td>
			<td class="simple">'.number_format($data3[$pm],2).'</td>
			<td class="simple">'.number_format($data2[$pm],2).'</td>

			<td class="simple">'.$t1[$pm].'</td>
			<td class="simple">'.$t2[$pm].'</td>
			<td class="simple">'.$t3[$pm].'</td>

			<td class="simple">'.number_format($qual[$pm],2).'</td>
			<td class="simple">'.number_format($eco[$pm],2).'</td></tr>';
		}
	 print '<tr align="center"><td class="BlockHeaderLeftRight">Итого/Ср.</td>
		<td class="BlockHeaderLeftRight">'.$ithr1.'</td>
		<td class="BlockHeaderLeftRight">'.$ithr0.'</td>

		<td class="BlockHeaderLeftRight">'.number_format($it1,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it0,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it3,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it2,2).'</td>

		<td class="BlockHeaderLeftRight">'.number_format($at1,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($at2,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($at3,2).'</td>

		<td class="BlockHeaderLeftRight">'.$itqual1.'</td>
		<td class="BlockHeaderLeftRight">'.number_format($iteco,2).'</td></tr>';
	 print '</table></td></tr><tr><td><img src="charts/barplots38.php?'.$req.'"></td></tr>';
 }	

?>