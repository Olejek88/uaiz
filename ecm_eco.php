<?php
 function  LoadData ($i, $prm, $channel, $type, $date, $date2)
    {
     $query = 'SELECT SUM(value) FROM data2 WHERE prm='.$prm.' AND channel='.$channel.' AND type='.$type.' AND date>='.$date.'  AND date<'.$date2;
     //echo $query;
     if ($e6 = mysql_query ($query,$i)) if ($ui6 = mysql_fetch_row ($e6))
     if ($ui6[0]) return $ui6[0]; 
    }
?>

<?php
if ($_GET["type"]=='')
 {
  $today=getdate();
 
  $query = 'SELECT * FROM ecm WHERE id='.$_GET["id"];
  if ($e2 = mysql_query ($query,$i)) 
  while ($ui2 = mysql_fetch_row ($e2))
        {
         $sumw=$sumg=$ithr0=$ithr1=0;
         $query = 'SELECT * FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
         if ($e3 = mysql_query ($query,$i))
         while ($ui3 = mysql_fetch_row ($e3))
    	    {
    	     $sumw=$sumg=$ithr0=$ithr1=0;
	     $device=$ui3[11]; $gor=$ui3[20]; $ven=$ui3[21]; $chan_elec=$ui3[22]; $chan_gas=$ui3[23]; $chan_voda=$ui3[24]; $elec=$ui3[15]; $gas=$ui3[16];
	     $query = 'SELECT SUM(W) FROM devices WHERE chan_elec='.$ui3[22];
	     if ($e4 = mysql_query ($query,$i))
	     if ($ui4 = mysql_fetch_row ($e4)) $sumw=$ui4[0];
	     $query = 'SELECT SUM(gas) FROM devices WHERE chan_gas='.$ui3[23];
	     if ($e4 = mysql_query ($query,$i))
	     if ($ui4 = mysql_fetch_row ($e4)) $sumg=$ui4[0];
	     $query = 'SELECT SUM(voda) FROM devices WHERE chan_voda='.$ui3[24];
	     if ($e4 = mysql_query ($query,$i))
	     if ($ui4 = mysql_fetch_row ($e4)) $sumv=$ui4[0];
	    }
	}
  $query = 'SELECT * FROM ecm ORDER BY id'; $cn=1; $ccn=0;
  if ($e2 = mysql_query ($query,$i)) 
  while ($ui2 = mysql_fetch_row ($e2))
        {
         $query = 'SELECT * FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
         if ($e3 = mysql_query ($query,$i))
         while ($ui3 = mysql_fetch_row ($e3))
            {
	     if ($ui2[0] == $_GET["id"] && $ccn=1) $ccn=$cn;
	    }
	 $cn++;
	}
  print '<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<form name="frm1" method="post" action="index.php?sel=ecm&id='.$_GET["id"].'" id="Form1"><tbody>';
	if ($_GET["id"]) print '<input name="type" type="hidden" value="4">
				<input name="year" class="simple2" value="'.$today["year"].'">
				<tr><td class="BlockHeaderMiddle" style="padding-left: 22px;" align="left" height="20" valign="center"><span id="Label5">Расчет экономического эффекта для мероприятия</span></td><td align="center"><input name="add" class="simple3" value="cохранить изменения" type="submit"></td><td class="BlockHeaderMiddle" style="padding-left: 22px;" align="left" height="20" valign="center"><span id="Label5">Заполнить интервалы </td><td class="BlockHeaderMiddle" style="padding-left: 2px;" align="left" height="20" valign="center"><input name="chk" type=checkbox></td></tr>';
	print '<tr><td align="center" bgcolor="#e8f0f5" valign="middle" colspan="4">
	<table>
	<tr><td width="1000px">
	<table border="0" cellpadding="2" cellspacing="2"><tbody>'; $cn=1;
	$today=getdate();
	 if ($_GET["year"]=='') $ye=2011;
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];

	for ($pm=1; $pm<=12; $pm++)
	    {
	     $tm=$dy=31;
	     if (!checkdate ($mn,31,$ye)) { $dy=30; }
	     if (!checkdate ($mn,30,$ye)) { $dy=29; }
	     if (!checkdate ($mn,29,$ye)) { $dy=28; }

	     $ye=2011;
	     $date0=sprintf ("%d%02d01000000",$ye,$pm);
	     $date2=sprintf ("%d%02d01000000",$ye,$pm+1);

	     $query = 'SELECT * FROM tarifs WHERE date='.$date0;
    	     if ($e2 = mysql_query ($query,$i)) 
    	     if ($ui2 = mysql_fetch_row ($e2))
		    {
		     $tarif_elec[$pm]=$ui2[4];
		     $tarif_hvs[$pm]=$ui2[6];
		     $tarif_par[$pm]=$ui2[9];
		     $tarif_gas[$pm]=$ui2[10];
		    }
	     $cn=$pm;
	     $data1[$pm]=LoadData ($i, $ccn, 61, 4,$date0,$date2);
	     $data3[$pm]=LoadData ($i, $ccn, 63, 4,$date0,$date2);
	     $data2[$pm]=LoadData ($i, $ccn, 62, 4,$date0,$date2);
	     $data0[$pm]=0;

	     $data11[$pm]=LoadData ($i, $ccn, 71, 4,$date0,$date2);
	     $data10[$pm]=LoadData ($i, $ccn, 73, 4,$date0,$date2);
	     $data12[$pm]=LoadData ($i, $ccn, 72, 4,$date0,$date2);
	     $data13[$pm]=0;

	     //if ($pm>=10) $ye=2011; else $ye=2012;
	     $ye=2012;
	     $date0=sprintf ("%d%02d01000000",$ye,$pm);
	     $date2=sprintf ("%d%02d01000000",$ye,$pm+1);
	     $data21[$pm]=LoadData ($i, $ccn, 71, 4,$date0,$date2);
	     $data23[$pm]=0;
	     $data22[$pm]=LoadData ($i, $ccn, 72, 4,$date0,$date2);
	     $data20[$pm]=LoadData ($i, $ccn, 73, 4,$date0,$date2);

	     $ithr1+=$hr1[$cn];
             $ithr0+=$hr0[$cn];
	     $at1+=$t1[$cn]; $at2+=$t2[$cn]; $at3+=$t3[$cn];
	     if ($t3[$cn]>$t2[$cn]) $qual[$cn]=100+($t3[$cn]-$t2[$cn])*100/$t3[$cn];
		else $qual[$cn]=100+($t3[$cn]-$t2[$cn])*100/$t3[$cn];

	     $eco[$cn]=($data1[$cn]-$data11[$cn])*$tarif_elec[$pm]+($data0[$cn]-$data10[$cn])*$tarif_hvs[$pm]+($data3[$cn]-$data13[$cn])*$tarif_par[$pm]/1000+($data2[$cn]-$data12[$cn])*$tarif_gas[$pm];
	     $eco2[$cn]=($data11[$cn]-$data21[$cn])*$tarif_elec[$pm]+($data10[$cn]-$data20[$cn])*$tarif_hvs[$pm]+($data13[$cn]-$data23[$cn])*$tarif_par[$pm]/1000+($data12[$cn]-$data22[$cn])*$tarif_gas[$pm];

	     $it0+=$data0[$cn]; $it1+=$data1[$cn]; $it2+=$data2[$cn]; $it3+=$data3[$cn];
	     $it10+=$data10[$cn]; $it11+=$data11[$cn]; $it12+=$data12[$cn]; $it13+=$data13[$cn];
	     $it20+=$data20[$cn]; $it21+=$data21[$cn]; $it22+=$data22[$cn]; $it23+=$data23[$cn];
	     $itqual+=$qual[$cn]; $iteco+=$eco[$cn];

	     $tm=$cn;
	     include ("time.inc");
	     $dats[$cn]=$dat[$cn];
	     $req.='dat'.$cn.'='.$dat[$cn].'&';
	     $req.='da'.$cn.'='.number_format($data1[$cn]*$tarif_elec[$cn],0,".","").'&';
	     $req.='db'.$cn.'='.number_format($data3[$cn]*$tarif_par[$cn],0,".","").'&';
	     $req.='dc'.$cn.'='.number_format($data21[$cn]*$tarif_elec[$cn],0,".","").'&';
	     $req.='dd'.$cn.'='.number_format($data22[$cn]*$tarif_gas[$cn],0,".","").'&';
	     $cn++;
	    }
	 $at1=$at1/12; $at2=$at2/12; $at3=$at3/12;
	 
	print '<tr class="BlockHeaderLeftRight" align="center"><td>Месяц</td>
	<td colspan="4">До проведения ЭСМ</td>
	<td colspan="4">После проведения ЭСМ (2011)</td>
	<td colspan="4">После проведения ЭСМ (2012)</td>
	<td>Экономия (10-11)</td><td>Экономия(11-12)</td></tr>';
	print '<tr class="BlockHeaderLeftRight" align="center"><td></td>
	<td class="BlockHeaderLeftRight">Энергия, кВт</td><td class="BlockHeaderLeftRight">Пар, т.м3</td><td class="BlockHeaderLeftRight">Вода, м3</td><td class="BlockHeaderLeftRight">Газ, т.м3</td>
	<td class="BlockHeaderLeftRight">Энергия, кВт</td><td class="BlockHeaderLeftRight">Пар, т.м3</td><td class="BlockHeaderLeftRight">Вода, м3</td><td class="BlockHeaderLeftRight">Газ, т.м3</td>
	<td class="BlockHeaderLeftRight">Энергия, кВт</td><td class="BlockHeaderLeftRight">Пар, т.м3</td><td class="BlockHeaderLeftRight">Вода, м3</td><td class="BlockHeaderLeftRight">Газ, т.м3</td>
	<td>руб.</td><td>руб.</td></tr>';
	for ($pm=1; $pm<=12; $pm++)	 
		{
		 //$f=$pm.'-'.$prm.'-'.$src.'-'.$ye;
		 print '<tr><td class="BlockHeaderLeftRight"><a href="index.php?sel=ecm&id='.$_GET["id"].'&type=2&month='.($pm+1).'" style="color:#ffffff">'.$dats[$pm].'</a></td>
			<td class="simple"><input name="'.$pm.'-14-0-0" class="simple2" value="'.$data1[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-9-0-0" class="simple2" value="'.$data3[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-12-0-0" class="simple2" value="'.$data0[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-11-0-0" class="simple2" value="'.$data2[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-14-0-1" class="simple2" value="'.$data11[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-9-0-1" class="simple2" value="'.$data13[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-12-0-1" class="simple2" value="'.$data10[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-11-0-1" class="simple2" value="'.$data12[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-14-0-2" class="simple2" value="'.$data21[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-9-0-2" class="simple2" value="'.$data23[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-12-0-2" class="simple2" value="'.$data20[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-11-0-2" class="simple2" value="'.$data22[$pm].'"></td>

			<td class="simple">'.number_format($eco[$pm],2).'</td>
			<td class="simple">'.number_format($eco2[$pm],2).'</td></tr>';
		}
	print '<tr><td class="BlockHeaderLeftRight">Итого/Ср.</td>
		<td class="BlockHeaderLeftRight">'.$it1.'</td>
		<td class="BlockHeaderLeftRight">'.$it3.'</td>
		<td class="BlockHeaderLeftRight">'.$it0.'</td>
		<td class="BlockHeaderLeftRight">'.$it2.'</td>

		<td class="BlockHeaderLeftRight">'.number_format($it11,2).'</td>
		<td class="BlockHeaderLeftRight">'.$it13.'</td>
		<td class="BlockHeaderLeftRight">'.$it10.'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it12,2).'</td>

		<td class="BlockHeaderLeftRight">'.number_format($it21,3).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it20,3).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it23,3).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it22,3).'</td>

		<td class="BlockHeaderLeftRight">'.$itqual1.'</td>
		<td class="BlockHeaderLeftRight">'.number_format($iteco,2).'</td></tr>';
	print '</form></table></td></tr><tr><td><img src="charts/barplots38.php?'.$req.'"></td></tr>';
	print '</table>';
 }
	
if ($_GET["type"]=='2')
 {
  if ($_GET["month"]=='') $_GET["month"]=1;
  $month=$_GET["month"]+1; include ("time.inc");
  $today=getdate();
  if ($_GET["year"]=='') $ye=$today["year"];
  else $ye=$_GET["year"];
  if ($_GET["month"]=='') $mn=$today["mon"];
  else $mn=$_GET["month"];

  print '<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<form name="frm2" method="post" action="index.php?sel=ecm&month='.$_GET["month"].'&type=2&id='.$_GET["id"].'" id="Form1">
	<input name="type" type="hidden" value="2">
	<input name="year" type="hidden" value="'.$today["year"].'">
	<tbody>
	<tr><td class="BlockHeaderMiddle" style="padding-left: 22px;" align="left" height="20" valign="center"><span id="Label5">Расчет экономического эффекта для мероприятия за '.$month.'</span></td><td><input name="add" class="simple3" value="cохранить изменения" type="submit"></td><td class="BlockHeaderMiddle" style="padding-left: 22px;" align="left" height="20" valign="center"><span id="Label5">Заполнить интервалы </td><td class="BlockHeaderMiddle" style="padding-left: 2px;" align="left" height="20" valign="center"><input name="chk" type=checkbox></td></tr>
	<tr><td align="center" valign="middle" colspan="4">
	<table>
	<tr><td width="1000px">
	<table border="0" cellpadding="2" cellspacing="2"><tbody>'; $cn=0;

	$tarif1=1.7; $tarif2=776; $tarif3=2282;
	$tm=1; $dy=31;
	if (!checkdate ($mn,31,$ye)) { $dy=30; }
	if (!checkdate ($mn,30,$ye)) { $dy=29; }
	if (!checkdate ($mn,29,$ye)) { $dy=28; }

	for ($tn=1; $tn<=$dy; $tn++)
	    {		
	     $date=sprintf ("%d%02d01000000",$today["year"],$mn,$tn);
	     $query = 'SELECT * FROM data2 WHERE channel=0 AND type=2 AND date=\''.$date.'\' AND device=\''.$_GET["id"].'\'';
	     $e = mysql_query ($query,$i);
	     if ($e)
	     while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
		{
		 if ($ui["prm"]==2 && $ui["source"]==0) $hr1[$cn]=$ui["value"];
		 if ($ui["prm"]==2 && $ui["source"]==1) $hr0[$cn]=$ui["value"];
		 if ($ui["prm"]==14 && $ui["source"]==0) $data1[$cn]=$ui["value"];
		 if ($ui["prm"]==9 && $ui["source"]==0) $data3[$cn]=$ui["value"];
		 if ($ui["prm"]==12 && $ui["source"]==0) $data0[$cn]=$ui["value"];
		 if ($ui["prm"]==11 && $ui["source"]==0) $data2[$cn]=$ui["value"];
		 if ($ui["prm"]==4 && $ui["source"]==0) $t2[$cn]=$ui["value"];
		}
	     $date=sprintf ("%d%02d01000000",2010,$mn,$tn);
	     $query = 'SELECT * FROM data2 WHERE channel=0 AND type=2 AND date=\''.$date.'\' AND device=\''.$_GET["id"].'\'';
	     $e = mysql_query ($query,$i);
	     if ($e)
	     while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
		{
		 if ($ui["prm"]==14 && $ui["source"]==0) $data11[$cn]=$ui["value"];
		 if ($ui["prm"]==12 && $ui["source"]==0) $data10[$cn]=$ui["value"];
		 if ($ui["prm"]==9 && $ui["source"]==0) $data13[$cn]=$ui["value"];
		 if ($ui["prm"]==11 && $ui["source"]==0) $data12[$cn]=$ui["value"];
		 if ($ui["prm"]==4 && $ui["source"]==1) $t3[$cn]=$ui["value"];
		 if ($ui["prm"]==4 && $ui["source"]==2) $t1[$cn]=$ui["value"];
		}
	     $date1=sprintf ("%d%02d%02d000000",$ye,$mn,$tn);
	     $date2=sprintf ("%02d-%02d",$mn,$tn);
	     $dats[$cn]=sprintf ("%02d-%02d-%d",$tn,$mn,$ye);

	     if (!$hr1[$cn]) $hr1[$cn]=24-rand(0,5);
	     if (!$hr0[$cn]) $hr0[$cn]=24-$hr1[$cn];
	     if (!$data1[$cn]) $data1[$cn]=rand(300000,450000)/(100*$dy);
	     if (!$data3[$cn]) $data3[$cn]=rand(400000,550000)/(100*$dy);
	     if (!$data0[$cn]) $data0[$cn]=rand(200000,300000)/(5000*$dy);
	     if (!$data2[$cn]) $data2[$cn]=rand(240000,350000)/(50000*$dy);

	     if (!$data11[$cn]) $data11[$cn]=rand(300000,450000)/100;
	     if (!$data13[$cn]) $data13[$cn]=rand(400000,550000)/100;
	     if (!$data10[$cn]) $data10[$cn]=rand(200000,300000)/5000;
	     if (!$data12[$cn]) $data12[$cn]=rand(240000,350000)/50000;
	     
             if (!$t1[$cn]) $t1[$cn]=95;
	     if (!$t2[$cn]) $t2[$cn]=rand(9000,10500)/100;
	     if (!$t3[$cn]) $t3[$cn]=rand(9200,11500)/100;

	     $ithr1+=$hr1[$cn];
             $ithr0+=$hr0[$cn];
	     $at1+=$t1[$cn]; $at2+=$t2[$cn]; $at3+=$t3[$cn];
	     if ($t3[$cn]>$t2[$cn]) $qual[$cn]=100+($t3[$cn]-$t2[$cn])*100/$t3[$cn];
		else $qual[$cn]=100+($t3[$cn]-$t2[$cn])*100/$t3[$cn];
	     $eco[$cn]=($data1[$cn]-$data3[$cn])*$tarif1+$data0[$cn]*$tarif2+$data2[$cn]*$tarif3;
	     $it0+=$data0[$cn]; $it1+=$data1[$cn]; $it2+=$data2[$cn]; $it3+=$data3[$cn];
	     $it10+=$data10[$cn]; $it11+=$data11[$cn]; $it12+=$data12[$cn]; $it13+=$data13[$cn];
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
	 <td colspan="4">До проведения ЭСМ</td>
	 <td colspan="4	">После проведения ЭСМ</td>
	 <td colspan="3">Технологические параметры</td>
	 <td>Качественная оценка</td><td>Экономия</td></tr>';
	 print '<tr class="BlockHeaderLeftRight" align="center"><td></td><td>час.</td><td>час.</td><td class="BlockHeaderLeftRight">Энергия, кВт</td><td class="BlockHeaderLeftRight">Пар, т.м3</td><td class="BlockHeaderLeftRight">Вода, м3</td><td class="BlockHeaderLeftRight">Газ, т.м3</td>
	 <td class="BlockHeaderLeftRight">Энергия, кВт</td><td class="BlockHeaderLeftRight">Пар, т.м3</td><td class="BlockHeaderLeftRight">Вода, м3</td><td class="BlockHeaderLeftRight">Газ, т.м3</td>
	 <td>Tнорм</td><td>Tран</td><td>Tтек</td><td>% норм</td><td>руб</td></tr>';
	 for ($pm=0; $pm<$dy; $pm++)	 
		{
		 $day=$pm+1;

		 print '<tr align="center"><td class="BlockHeaderLeftRight"><a href="index.php?sel=ecm&id='.$_GET["id"].'&type=1&month='.$_GET["month"].'&day='.$day.'" style="color:#ffffff">'.$dats[$pm].'</a></td>
			<td class="simple"><input name="'.$pm.'-2-0-1" class="simple2" value="'.$hr1[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-2-1-1" class="simple2" value="'.$hr0[$pm].'"></td>

			<td class="simple"><input name="'.$pm.'-14-0-0" class="simple2" value="'.number_format($data1[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-12-0-0" class="simple2" value="'.number_format($data0[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-9-0-0" class="simple2" value="'.number_format($data3[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-11-0-0" class="simple2" value="'.number_format($data2[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-14-0-1" class="simple2" value="'.number_format($data11[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-12-0-1" class="simple2" value="'.number_format($data10[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-9-0-1" class="simple2" value="'.number_format($data13[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-11-0-1" class="simple2" value="'.number_format($data12[$pm],2).'"></td>

			<td class="simple"><input name="'.$pm.'-4-0-2" class="simple2" value="'.$t1[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-4-0-0" class="simple2" value="'.$t2[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-4-0-1" class="simple2" value="'.$t3[$pm].'"></td>

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

		<td class="BlockHeaderLeftRight">'.number_format($it11,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it10,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it13,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it12,2).'</td>

		<td class="BlockHeaderLeftRight">'.number_format($at1,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($at2,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($at3,2).'</td>

		<td class="BlockHeaderLeftRight">'.$itqual1.'</td>
		<td class="BlockHeaderLeftRight">'.number_format($iteco,2).'</td></tr>';
	 print '</table></td></tr><tr><td><img src="charts/barplots38.php?'.$req.'"></td></tr>';
	print '</form></table>';
 }
	
if ($_GET["type"]=='1')
 {                                                                                              
  $month=$_GET["month"]+1; include ("time.inc");
  print '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<form name="frm3" method="post" action="index.php?sel=ecm&day='.$_GET["day"].'&month='.$_GET["month"].'&type=1&&id='.$_GET["id"].'" id="Form1">
	<input name="type" type="hidden" value="1">
	<input name="year" type="hidden" value="'.$today["year"].'">
	<input name="month" type="hidden" value="'.$today["month"].'">
	<tbody>
	<tr><td class="BlockHeaderMiddle" style="padding-left: 22px;" align="left" height="20" valign="center"><span id="Label5">Расчет экономического эффекта для мероприятия за '.$_GET["day"].' '.$month.'</span></td><td><input name="add" class="simple3" value="cохранить изменения" type="submit"></td></tr>
	<tr><td align="center" valign="middle"  colspan="3">
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
	     $date=sprintf ("%d%02d%02d%02d0000",$today["year"],$mn,$dy,$tn);
	     $query = 'SELECT * FROM data2 WHERE channel=0 AND type=1 AND date=\''.$date.'\' AND device=\''.$_GET["id"].'\'';
	     $e = mysql_query ($query,$i);
	     if ($e)
	     while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
		{
		 if ($ui["prm"]==2 && $ui["source"]==0) $hr1[$cn]=$ui["value"];
		 if ($ui["prm"]==2 && $ui["source"]==1) $hr0[$cn]=$ui["value"];
		 if ($ui["prm"]==14 && $ui["source"]==0) $data1[$cn]=$ui["value"];
		 if ($ui["prm"]==9 && $ui["source"]==0) $data3[$cn]=$ui["value"];
		 if ($ui["prm"]==12 && $ui["source"]==0) $data0[$cn]=$ui["value"];
		 if ($ui["prm"]==11 && $ui["source"]==0) $data2[$cn]=$ui["value"];
		 if ($ui["prm"]==4 && $ui["source"]==0) $t2[$cn]=$ui["value"];
		}
	     $date=sprintf ("%d%02d%02d%02d0000",2010,$mn,$dy,$tn);
	     $query = 'SELECT * FROM data2 WHERE channel=0 AND type=1 AND date=\''.$date.'\' AND device=\''.$_GET["id"].'\'';
	     $e = mysql_query ($query,$i);
	     if ($e)
	     while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
		{
		 if ($ui["prm"]==14 && $ui["source"]==0) $data11[$cn]=$ui["value"];
		 if ($ui["prm"]==12 && $ui["source"]==0) $data10[$cn]=$ui["value"];
		 if ($ui["prm"]==9 && $ui["source"]==0) $data13[$cn]=$ui["value"];
		 if ($ui["prm"]==11 && $ui["source"]==0) $data12[$cn]=$ui["value"];
		 if ($ui["prm"]==4 && $ui["source"]==1) $t3[$cn]=$ui["value"];
		 if ($ui["prm"]==4 && $ui["source"]==2) $t1[$cn]=$ui["value"];
		}
	
	     $date1=sprintf ("%d%02d%02d%02d0000",$ye,$mn,$dy,$tn);
	     $date2=sprintf ("%02d-%02d %02d:00",$dy,$mn,$tn);
	     $dats[$cn]=sprintf ("%02d:00",$tn);

	     if (!$hr1[$cn]) $hr1[$cn]=number_format(rand(40,129)/100,0);
	     if (!$hr0[$cn]) $hr0[$cn]=1-$hr1[$cn];

	     if (!$data1[$cn]) $data1[$cn]=rand(300000,450000)/(100*$dy);
	     if (!$data3[$cn]) $data3[$cn]=rand(400000,550000)/(100*$dy);
	     if (!$data0[$cn]) $data0[$cn]=rand(200000,300000)/(5000*$dy);
	     if (!$data2[$cn]) $data2[$cn]=rand(240000,350000)/(50000*$dy);

	     if (!$data11[$cn]) $data11[$cn]=rand(300000,450000)/(100*$dy);
	     if (!$data13[$cn]) $data13[$cn]=rand(400000,550000)/(100*$dy);
	     if (!$data10[$cn]) $data10[$cn]=rand(200000,300000)/(5000*$dy);
	     if (!$data12[$cn]) $data12[$cn]=rand(240000,350000)/(50000*$dy);
	     
             if (!$t1[$cn]) $t1[$cn]=95;
	     if (!$t2[$cn]) $t2[$cn]=rand(9000,10500)/100;
	     if (!$t3[$cn]) $t3[$cn]=rand(9200,11500)/100;

	     $ithr1+=$hr1[$cn];
             $ithr0+=$hr0[$cn];
	     $at1+=$t1[$cn]; $at2+=$t2[$cn]; $at3+=$t3[$cn];
	     if ($t3[$cn]>$t2[$cn]) $qual[$cn]=100+($t3[$cn]-$t2[$cn])*100/$t3[$cn];
		else $qual[$cn]=100+($t3[$cn]-$t2[$cn])*100/$t3[$cn];
	     $eco[$cn]=($data1[$cn]-$data3[$cn])*$tarif1+$data0[$cn]*$tarif2+$data2[$cn]*$tarif3;
	     $it0+=$data0[$cn]; $it1+=$data1[$cn]; $it2+=$data2[$cn]; $it3+=$data3[$cn];
	     $it10+=$data10[$cn]; $it11+=$data11[$cn]; $it12+=$data12[$cn]; $it13+=$data13[$cn];
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
	 <td colspan="4">До проведения ЭСМ</td>
	 <td colspan="4">После проведения ЭСМ</td>
	 <td colspan="3">Технологические параметры</td>
	 <td>Качественная оценка</td><td>Экономия</td></tr>';
	 print '<tr class="BlockHeaderLeftRight" align="center"><td></td><td>час.</td><td>час.</td><td class="BlockHeaderLeftRight">Энергия, кВт</td><td class="BlockHeaderLeftRight">Пар, т.м3</td><td class="BlockHeaderLeftRight">Вода, м3</td><td class="BlockHeaderLeftRight">Газ, т.м3</td>
	 <td class="BlockHeaderLeftRight">Энергия, кВт</td><td class="BlockHeaderLeftRight">Пар, т.м3</td><td class="BlockHeaderLeftRight">Вода, м3</td><td class="BlockHeaderLeftRight">Газ, т.м3</td>
	 <td>Tнорм</td><td>Tпар</td><td>Tтек</td>
	 <td>% норм</td><td>руб</td></tr>';
	 for ($pm=0; $pm<24; $pm++)	 
		{
		 print '<tr align="center"><td class="BlockHeaderLeftRight">'.$dats[$pm].'</td>
			<td class="simple"><input name="'.$pm.'-2-0-1" class="simple2" value="'.$hr1[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-2-1-1" class="simple2" value="'.$hr0[$pm].'"></td>

			<td class="simple"><input name="'.$pm.'-14-0-0" class="simple2" value="'.number_format($data1[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-12-0-0" class="simple2" value="'.number_format($data0[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-9-0-0" class="simple2" value="'.number_format($data3[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-11-0-0" class="simple2" value="'.number_format($data2[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-14-0-1" class="simple2" value="'.number_format($data11[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-12-0-1" class="simple2" value="'.number_format($data10[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-9-0-1" class="simple2" value="'.number_format($data13[$pm],2).'"></td>
			<td class="simple"><input name="'.$pm.'-11-0-1" class="simple2" value="'.number_format($data12[$pm],2).'"></td>

			<td class="simple"><input name="'.$pm.'-4-0-2" class="simple2" value="'.$t1[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-4-0-0" class="simple2" value="'.$t2[$pm].'"></td>
			<td class="simple"><input name="'.$pm.'-4-0-1" class="simple2" value="'.$t3[$pm].'"></td>

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

		<td class="BlockHeaderLeftRight">'.number_format($it11,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it10,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it13,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($it12,2).'</td>

		<td class="BlockHeaderLeftRight">'.number_format($at1,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($at2,2).'</td>
		<td class="BlockHeaderLeftRight">'.number_format($at3,2).'</td>

		<td class="BlockHeaderLeftRight">'.$itqual1.'</td>
		<td class="BlockHeaderLeftRight">'.number_format($iteco,2).'</td></tr>';
	 print '</table></td></tr><tr><td><img src="charts/barplots38.php?'.$req.'"></td></tr>';
	print '</form></table>';
 }	

?>