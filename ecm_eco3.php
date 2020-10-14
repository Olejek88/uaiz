<?php
 print '<table><tr><td class="m_separator">'; include("ch_mon2.php"); print '</td></tr></table>';

?>
<style type="text/css">
.BlockHeaderLeftRight { font-size: 9px; }
.simple { font-size: 9px; }
.simple2 { font-size: 9px;  background-color: #efefef; }
</style>
<?php
    function workday_count($start_day_as_timestamp,$total_days)
	    {
    	     $weekday = date('w',$start_day_as_timestamp);
    	     //echo $weekday;
             $days_without_1st_incomplete_week = $total_days - (7-$weekday);
             $workdays_in_1st_incomplete_week = 6 - $weekday;
             $workdays_in_complete_weeks = floor($days_without_1st_incomplete_week / 7) * 5;
             $days_in_last_week = $days_without_1st_incomplete_week % 7;
             $workdays_in_last_week = $days_in_last_week ? $days_in_last_week - 1: 0;
             return $workdays_in_1st_incomplete_week + $workdays_in_complete_weeks + $workdays_in_last_week;
            }
  $qnt=7;
  if ($_POST["qnt"]!='') $_GET["qnt"]=$_POST["qnt"];
  if ($_POST["day"]!='') $_GET["day"]=$_POST["day"];
  if ($_POST["year"]!='') $_GET["year"]=$_POST["year"];

  if ($_GET["qnt"]!='') $qnt=$_GET["qnt"];
  //phpinfo ();
  $today=getdate();
  if ($_GET["year"]=='') $ye=2012;
  else $ye=$_GET["year"];
  if ($_GET["month"]=='') $mn=$today["mon"];
  else $mn=$_GET["month"];

  $cn=$qnt;
  for ($pm=1; $pm<=$qnt; $pm++)
    {	     	
     $date[$cn]=sprintf ("%d-%02d-01 00:00:00",$ye,$mn);   
     $dates[$cn]=sprintf ("%d%02d01000000",$ye,$mn);   
     $dates2[$cn]=sprintf ("%d%02d01000000",$ye,$mn+1);   

     $date1=sprintf ("%d-%02d-01",$ye,$mn);
     $date2=sprintf ("%d-%02d-01",$ye,$mn+1);
     
 
     $query = 'SELECT * FROM tarifs WHERE date='.$dates[$cn];
     if ($e2 = mysql_query ($query,$i)) 
     if ($ui2 = mysql_fetch_row ($e2))
	{
	 $tarif_elec[$cn]=$ui2[4];
	 $tarif_hvs[$cn]=$ui2[6];
	 $tarif_par[$cn]=$ui2[9];
	 $tarif_gas[$cn]=$ui2[10];
	 $tarif_vodootv[$cn]=$ui2[11];
	 $tarif_salt[$cn]=$ui2[12];
	}
     else 
        {
         $query = 'SELECT * FROM tarifs WHERE elec>0 AND par>0 AND gas>0 ORDER BY date DESC';
         if ($e2 = mysql_query ($query,$i)) 
         if ($ui2 = mysql_fetch_row ($e2))
    	    {
	     $tarif_elec[$cn]=$ui2[4];
	     $tarif_hvs[$cn]=$ui2[6];
	     $tarif_par[$cn]=$ui2[9];
	     $tarif_gas[$cn]=$ui2[10];
	     $tarif_vodootv[$cn]=$ui2[11];
	     $tarif_salt[$cn]=$ui2[12];
	    }
        }

     $dy=31;
     if (!checkdate ($mn,31,$ye)) { $dy=30; }
     if (!checkdate ($mn,30,$ye)) { $dy=29; }
     if (!checkdate ($mn,29,$ye)) { $dy=28; }
     //$cnt_hours[$cn]=$dy*24;
     $cnt_days[$cn]=$dy;
     $monn[$cn]=$mn;

//	12.05.2012
//     if ($pm>1) $cnt_days_w[$cn]=workday_count($dates[$cn],$dy);
//     else $cnt_days_w[$cn]=workday_count($dates[$cn],$today["mday"]);
//     if ($pm>1) $cnt_hours[$cn]=$dy*24;
//     else $cnt_hours[$cn]=($today["mday"]-1)*24;
     $cnt_days_w[$cn]=workday_count($dates[$cn],$dy);
     $cnt_hours[$cn]=$dy*24;

     if ($cnt_days_w[$cn]==0) $cnt_days_w[$cn]=0;
     //echo $cnt_days_w[$cn].'<br>';

     $query = 'SELECT * FROM reports WHERE date='.$dates[$cn];
     if ($e2 = mysql_query ($query,$i)) 
     if ($ui2 = mysql_fetch_row ($e2))
	{
	 $visa[$cn]=$ui2[4]*$ui2[2];
	}
     else 
	{
	 $query = 'INSERT INTO reports SET date=\''.$dates[$cn].'\', visa1=0, visa2=0';
    	 $e6 = mysql_query ($query,$i);
	}
     $tm=$mn;
     include ("time.inc");
     $dats[$cn]=$dat[$cn].' '.$ye;
     $mn--; if ($mn==0) { $mn=12; $ye--; $pims=$pm; }
     $cn--;
    }

if ($_POST["type"]=='5')
{
 $cn=1; $qnt3=0;
 $query = 'SELECT * FROM ecm ORDER BY id1';
 if ($e2 = mysql_query ($query,$i)) 
 while ($ui2 = mysql_fetch_row ($e2))
	{
	 $ccn=$cn;
	 $query = 'SELECT * FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
	 if ($e3 = mysql_query ($query,$i))
	 while ($ui3 = mysql_fetch_row ($e3))
		{
		 $gor=$ui3[20]; $ven=$ui3[21]; $elec=$ui3[28]; $gas=$ui3[29]; $voda=$ui3[17]; $par=$ui3[26]; $par2=$ui3[27];
		 for ($tn=1; $tn<$qnt; $tn++) 
			{
		 	 $f=$cn.'-'.$tn.'-2-0'; 
			 $query = 'SELECT * FROM data WHERE prm=2 AND channel='.$gor.' AND type=4 AND date='.$dates[$tn];
			 //echo $query.'<br>';
			 if ($e6 = mysql_query ($query,$i))
			 if ($ui6 = mysql_fetch_row ($e6)) $data_gr=$ui6[3];
			 $query='';
		         if (!$ui6[0])
			    {
			     if ($_POST[$f]>0)
				{ 
			    	 $query = 'INSERT INTO data SET status=1, prm=2, channel='.$gor.', type=4,date='.$dates[$tn].',value='.$_POST[$f]; 
			    	 $e6 = mysql_query ($query,$i);
			    	 //echo $query.'<br>'; 
			    	 $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="insert data [hours of work] on channel '.$gor.' date '.$dates[$tn].' to '.$_POST[$f].'"'; mysql_query ($query,$i);
			    	}
			    }
			  else 
			     if ($_POST[$f]!=$data_gr) 
			        { 
			         $query = 'UPDATE data SET status=1, prm=2, channel='.$gor.', type=4, date='.$dates[$tn].',value='.$_POST[$f].' WHERE prm=2 AND channel='.$gor.' AND type=4 AND date='.$dates[$tn]; 
			         $e6 = mysql_query ($query,$i);
			         //echo $query.'<br>'; 
			         $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="update data [hours of work] on channel '.$gor.' date '.$dates[$tn].' from '.$data_gr.' to '.$_POST[$f].'"'; mysql_query ($query,$i);
			        }
			}
		 $f=$ccn.'-1-0'; if ($elec!=$_POST[$f]) { $query = 'UPDATE devices SET elec='.$_POST[$f].' WHERE id='.$ui3[0]; $e6 = mysql_query ($query,$i); /*echo $query.'<br>';*/ }
		 $f=$ccn.'-1-1'; if ($gas!=$_POST[$f]) { $query = 'UPDATE devices SET gas='.$_POST[$f].' WHERE id='.$ui3[0]; $e6 = mysql_query ($query,$i); /*echo $query.'<br>';*/ }
		 $f=$ccn.'-1-2'; if ($par!=$_POST[$f]) { $query = 'UPDATE devices SET par='.$_POST[$f].' WHERE id='.$ui3[0]; $e6 = mysql_query ($query,$i); /*echo '['.$par.' | '.$_POST[$f].']'.$query.'<br>';*/ }
		 $f=$ccn.'-1-3'; if ($par2!=$_POST[$f]) { $query = 'UPDATE devices SET par2='.$_POST[$f].' WHERE id='.$ui3[0]; $e6 = mysql_query ($query,$i); /*echo $query.'<br>';*/ }
		 $cn++;
		}
	 $qnt3++;
	}
 $qnt3--;
 
 for ($tn=1; $tn<=$qnt; $tn++)
	{
	 $query = 'SELECT * FROM data WHERE prm=11 AND source=10 AND type=4 AND date='.$dates[$tn];
	 //echo $query.'<br>';
	 if ($e6 = mysql_query ($query,$i))
	 if ($ui6 = mysql_fetch_row ($e6)) $data_gr=$ui6[3];
	 $query=''; $f=$tn.'-11-10';
	 if ($_POST[$f]>=0)
	    {
	     if (!$ui6[0]) $query = 'INSERT INTO data SET prm=11, channel=111, source=10, type=4, date='.$dates[$tn].',value='.$_POST[$f];
	     else if ($_POST[$f]!=$data_gr) $query = 'UPDATE data SET prm=11, channel=111, type=4, date='.$dates[$tn].',value='.$_POST[$f].' WHERE prm=11 AND channel=111 AND type=4 AND source=10 AND date='.$dates[$tn];
	     $e6 = mysql_query ($query,$i); echo $query.'<br>';
	    }
	 $query = 'SELECT * FROM data WHERE prm=41 AND source=0 AND type=4 AND date='.$dates[$tn];
	 //echo $query.'<br>';
	 if ($e6 = mysql_query ($query,$i))
	 if ($ui6 = mysql_fetch_row ($e6)) $data_gr=$ui6[3];
	 $query=''; $f=$tn.'-41-0';
	 if ($_POST[$f]>=0 && $_POST[$f]!='')
	    {
	     if (!$ui6[0]) $query = 'INSERT INTO data SET prm=41, channel=112, source=0, type=4, date='.$dates[$tn].',value='.$_POST[$f];
	     else if ($_POST[$f]!=$data_gr) $query = 'UPDATE data SET prm=41, channel=112, type=4, date='.$dates[$tn].',value='.$_POST[$f].' WHERE prm=41 AND channel=112 AND type=4 AND source=0 AND date='.$dates[$tn];
	     $e6 = mysql_query ($query,$i); echo $query.'<br>';
	    }
	} 
}

//-----------------------------------------------------------------------------------------------------------------------------------------
function  StoreData ($i, $prm, $channel, $type, $date, $value)
{
 $query = 'SELECT * FROM data2 WHERE prm='.$prm.' AND channel='.$channel.' AND type='.$type.' AND date='.$date;
 if ($e6 = mysql_query ($query,$i)) $ui6 = mysql_fetch_row ($e6);

 if (!$ui6[0]) $query = 'INSERT INTO data2 SET prm='.$prm.', channel='.$channel.', type='.$type.',date='.$date.',value='.$value;
 else $query = 'UPDATE data2 SET date='.$date.',value='.$value.' WHERE prm='.$prm.' AND channel='.$channel.' AND type='.$type.' AND date='.$date;
 $e6 = mysql_query ($query,$i);  //echo $query.' ['.$i.']<br>';
}
//-----------------------------------------------------------------------------------------------------------------------------------------

if ($_GET["type"]=='')
 {
  $today=getdate();
  //$qnt=2;
 
  print '<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	 <form name="frm1" method="post" action="index.php?sel=ecm_post"><tbody>';
  print '<input name="type" type="hidden" value="4">';

  print '<tr><td align="center" bgcolor="#ffffff" valign="middle" colspan="4">
	 <table><tr><td width="1200px">
		<table border="0" cellpadding="2" cellspacing="2" width="100%"><tbody>';

	  print '<tr class="BlockHeaderLeftRight" align="center"><td rowspan="2" style="width: 150px">Было</td><td rowspan="2">Стало</td>';
	  print '<td rowspan="2">Номер счетчика Э/Э</td>
	  	<td colspan="2">Пиковые нагрузки нового оборудования</td>
		<td colspan="'.$qnt.'">Нормативное время работы в месяц, часы</td>';
	  if ($_GET["hide"]!=1)
	  print '<td colspan="'.$qnt.'">Время работы горелок в месяц, часы</td>
		<td colspan="'.$qnt.'">Время работы вентиляторов в месяц, часы</td>
		<td colspan="'.$qnt.'">Пиковое потребление газа новым оборуд., м3</td>
		<td colspan="'.$qnt.'">Пиковое потребление электричества новым оборуд., м3</td>';

	  print '<td colspan="4">Базисный удельный расход, в час</td>';

	  for ($pm=1; $pm<=$qnt; $pm++)
		print '<td colspan="3">Базисный расход, руб. '.$dats[$pm].'</td>';

	  for ($pm=1; $pm<=$qnt; $pm++)
		{	
	     	 print '<td colspan="4">Новый расход, '.$dats[$pm].'</td>';
	     	 print '<td colspan="2">Экономия в рублях, '.$dats[$pm].'</td>';
		}
	  print  '</tr>';
	  print  '<tr class="BlockHeaderLeftRight" align="center"><td>Газ, м3/ч</td><td>Э/Э, кВт</td>';
	  for ($pm=1; $pm<=$qnt; $pm++) print '<td>'.$dats[$pm].'</td>';
	  if ($_GET["hide"]!=1)
	    {
	     for ($pm=1; $pm<=$qnt; $pm++) print '<td>'.$dats[$pm].'</td>';
	     for ($pm=1; $pm<=$qnt; $pm++) print '<td>'.$dats[$pm].'</td>';
	     for ($pm=1; $pm<=$qnt; $pm++) print '<td>'.$dats[$pm].'</td>';
	     for ($pm=1; $pm<=$qnt; $pm++) print '<td>'.$dats[$pm].'</td>';
	    }
	  print  '<td>Э/Э, кВт</td><td>Газ, м3/ч</td><td>Пар, ГКал/ч</td><td>Пар, т/ч</td>';
	  for ($pm=1; $pm<=$qnt; $pm++)	print  '<td>Э/Э</td><td>Газ</td><td>Пар</td>';
	  for ($pm=1; $pm<=$qnt; $pm++)	print  '<td>Э/Э, кВт.ч</td><td>Газ м3/ч</td><td>ЭЭ, руб.</td><td>Газ, руб.</td><td>ЭЭ</td><td>Пар/Газ</td>';
	  print '</tr>';

	$ccn=1; $qnt3=0;
	$query = 'SELECT * FROM ecm ORDER BY id1';
	if ($e2 = mysql_query ($query,$i)) 
	while ($ui2 = mysql_fetch_row ($e2))
		{
		 $query = 'SELECT * FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
    		 if ($e3 = mysql_query ($query,$i))
		 while ($ui3 = mysql_fetch_row ($e3))
			{
			 if ($ui3[42]==7) for ($pm=1; $pm<=$qnt; $pm++) $work_days[$ccn][$pm]=$ui3[$monn[$pm]+29]*$cnt_days[$pm];
			 if ($ui3[42]==5) for ($pm=1; $pm<=$qnt; $pm++) $work_days[$ccn][$pm]=$ui3[$monn[$pm]+29]*$cnt_days_w[$pm];
			 //for ($pm=1; $pm<=$qnt; $pm++) echo $ui3[1].' '.$work_days[$ccn][$pm].' '.$ui3[$monn[$pm]+29].'<br>';

			 $devid[$ccn]=$ui3[0]; $ecmid[$ccn]=$ui2[0];
			 $devices[$ccn]=$ui3[11]; $elecs[$ccn]=$ui3[15]; $gass[$ccn]=$ui3[16];
			 $gors[$ccn]=$ui3[20]; $vens[$ccn]=$ui3[21];
			 $chan_elecs[$ccn]=$ui3[22]; $chan_gass[$ccn]=$ui3[23];  $chan_voda[$ccn]=$ui3[24];
			 $welecs[$ccn]=$ui3[28]; $gazs[$ccn]=$ui3[29];  $pars[$ccn]=$ui3[26]; $par2s[$ccn]=$ui3[27];
			 $ccn++;
			}
		 $qnt3++;
		}
	$qnt3--;
	$qnt2=$ccn-1;

	$query = 'SELECT * FROM data WHERE type=4';
	if ($e6 = mysql_query ($query,$i))
	while ($ui6 = mysql_fetch_row ($e6))
		{
		 $x=$qnt+1;
		 // dannie po vsem kanalam, kotorie imeut tot je nomer kanala po elec i gas SUM(t*W)
		 for ($tn=1; $tn<$qnt; $tn++) if ($ui6[2]==$date[$tn]) $x=$tn; 
		 for ($tn=1; $tn<=$qnt2; $tn++) if ($ui6[9]==$vens[$tn]) $sum_vens[$tn][$x]=$ui6[3];
		 for ($tn=1; $tn<=$qnt2; $tn++) if ($ui6[9]==$gors[$tn]) $sum_gors[$tn][$x]=$ui6[3];
		 //if ($y<$qnt2) echo $sum_ven[$y][$x].' '.$sum_gor[$y][$x].'<br>';
		}
	//for ($tn=1; $tn<=$qnt2; $tn++) echo $sum_gor[$tn][$qnt-1].'<br>';
	//echo $gors[$tn].' '.$ui6[3].' = '.$sum_gors[$tn][$x].'<br>';
	for ($tn=1; $tn<=$qnt2; $tn++) $sum_ven[$tn][$qnt]=$sum_gor[$tn][$qnt]=0;

        $query = 'SELECT * FROM data WHERE type=2 AND date>='.$dates[$qnt].' AND date<'.$dates2[$qnt].' AND value<25';
	if ($e6 = mysql_query ($query,$i))
	while ($ui6 = mysql_fetch_row ($e6))
		{
		 $x=$qnt;
		 for ($tn=1; $tn<=$qnt2; $tn++) if ($ui6[9]==$vens[$tn]) $sum_vens[$tn][$x]+=$ui6[3];
		 for ($tn=1; $tn<=$qnt2; $tn++) if ($ui6[9]==$gors[$tn]) $sum_gors[$tn][$x]+=$ui6[3];
		 //if ($y<$qnt2) echo $sum_ven[$y][$x].' '.$sum_gor[$y][$x].'<br>';
		}

	for ($x=1; $x<=$qnt; $x++)
	for ($tn=1; $tn<=$qnt2; $tn++)
	    {
	     for ($y=1; $y<=$qnt2; $y++)
	        {
	         if ($chan_elecs[$tn]==$chan_elecs[$y])
	            {
	             if ($sum_vens[$y][$x]>0)
	                $sum_ven[$tn][$x]+=$sum_vens[$y][$x]*$elecs[$y];
	             else $sum_ven[$tn][$x]+=$sum_gors[$y][$x]*$elecs[$y];
	            }
	         if ($chan_gass[$tn]==$chan_gass[$y]) 
	            {
	             //if ($x==$qnt-2) echo '['.$chan_gass[$tn].']['.$tn.'] '.$sum_gors[$y][$x].' '.$gass[$tn].' = '.$sum_gor[$tn][$x].'<br>';
	             $sum_gor[$tn][$x]+=$sum_gors[$y][$x]*$gass[$y];
	            }
	        }
	    }
	 //for ($tn=1; $tn<=$qnt2; $tn++) echo '['.$chan_gass[$tn].'] '.$sum_gors[$tn][4].' '.$gass[$tn].' = '.$sum_gor[$tn][4].'<br>';
	 //for ($pm=1; $pm<=$qnt; $pm++) echo $ui3[1].' '.$work_days[$ccn][$pm].' '.$ui3[$monn[$pm]+29].'<br>';

	 for ($x=1; $x<=$qnt; $x++)
	 for ($tn=1; $tn<=$qnt2; $tn++)
    	 	{ $data_work[$tn][$x]=$work_days[$tn][$x]; $data_work1[$tn][$x]=1; }

	$query = 'SELECT * FROM data WHERE type=4';
	if ($e = mysql_query ($query,$i))
	while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
		{
		 $x=$qnt+1;
		 for ($tn=1; $tn<$qnt; $tn++) if ($ui["date"]==$date[$tn]) $x=$tn;
		 //echo $ui["channel"].' '.$vens[1].' '.$ui["value"].'<br>';
		 for ($tn=1; $tn<=$qnt2; $tn++)
    	 	    if ($ui["channel"]==300 && $ui["source"]==$ecmid[$tn]) { $data_work[$tn][$x]=$ui["value"]; $data_work1[$tn][$x]=$ui["status"]; }
		 for ($tn=1; $tn<=$qnt2; $tn++)
    	 	    if ($ui["channel"]==$vens[$tn]) { $data_ven[$tn][$x]=$ui["value"]; $data_ven1[$tn][$x]=$ui["status"]; }
    		 for ($tn=1; $tn<=$qnt2; $tn++)
		    if ($ui["channel"]==$gors[$tn]) { $data_gor[$tn][$x]=$ui["value"]; $data_gor1[$tn][$x]=$ui["status"]; }
    		 for ($tn=1; $tn<=$qnt2; $tn++)
    		    if ($ui["channel"]==$chan_elecs[$tn]) { $data_elec[$tn][$x]=$ui["value"]; $data_elec1[$tn][$x]=$ui["status"]; }
    		 for ($tn=1; $tn<=$qnt2; $tn++)
		    if ($ui["channel"]==$chan_gass[$tn]) { $data_gas[$tn][$x]=$ui["value"]; $data_gas1[$tn][$x]=$ui["status"]; }
    		 for ($tn=1; $tn<=$qnt2; $tn++)
		    if ($ui["channel"]==$chan_voda[$tn]) { $data_voda[$tn][$x]=$ui["value"]; }
		 //if ($ui["channel"]==561) echo $ui["channel"].' '.$data_ven[$tn][$x].' '.$ui["value"].'<br>';
		}
	//for ($tn=1; $tn<=$qnt; $tn++)	echo $vens[1].' '.$gors[1].' '.$chan_elecs[1].' '.$chan_gass[1].'<br>';
	//for ($tn=1; $tn<=$qnt; $tn++)	echo $data_gor[2][$tn].' '.$data_ven[2][$tn].' '.$data_elec[2][$tn].' '.$data_gas[2][$tn].'<br>';

	$query = 'SELECT * FROM data WHERE type=2 AND date>='.$dates[$qnt].' AND date<'.$dates2[$qnt];
	//echo $query;
	if ($e = mysql_query ($query,$i))
	while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
		{
		 //echo $ui["date"].' '.$date[1].'<br>';
		 $x=$qnt;
		 //for ($tn=1; $tn<=$qnt; $tn++) if ($ui["date"]==$date[$tn]) $x=$tn;
		 for ($tn=1; $tn<=$qnt2; $tn++)
    	 	    if ($ui["channel"]==$vens[$tn] && $ui["value"]<25) $data_ven[$tn][$x]+=$ui["value"];
    		 for ($tn=1; $tn<=$qnt2; $tn++)
    		     if ($ui["channel"]==$gors[$tn] && $ui["value"]<25) $data_gor[$tn][$x]+=$ui["value"];
		 // if ($ui["channel"]==638) echo $gors[$tn].' '.$data_gor[$tn][$x].'<br>';
    		 for ($tn=1; $tn<=$qnt2; $tn++)
    		    if ($ui["channel"]==$chan_elecs[$tn]) $data_elec[$tn][$x]+=$ui["value"];
    		 for ($tn=1; $tn<=$qnt2; $tn++)
		    if ($ui["channel"]==$chan_gass[$tn]) $data_gas[$tn][$x]+=$ui["value"];
    		 for ($tn=1; $tn<=$qnt2; $tn++)
		    if ($ui["channel"]==$chan_voda[$tn]) $data_voda[$tn][$x]+=$ui["value"];
		}

	$ccn=1; $cn=0; $ecm=1;
	$query = 'SELECT * FROM ecm ORDER BY id1';
	if ($e2 = mysql_query ($query,$i)) 
	while ($ui2 = mysql_fetch_row ($e2))
		{
		 $cn=0;
		 $query = 'SELECT COUNT(id) FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
    		 if ($e3 = mysql_query ($query,$i))
		 if ($ui3 = mysql_fetch_row ($e3)) $counts=$ui3[0];
		 //if ($ui2[0]==8) $counts=1;
		 
		 for ($tn=1; $tn<=$qnt; $tn++) $w[$tn]=$g[$tn]=0;
		 for ($tn=1; $tn<=$qnt; $tn++) $base1[$tn]=$base2[$tn]=$base3[$tn]=0;

		 $query = 'SELECT * FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
    		 if ($e3 = mysql_query ($query,$i))
		 while ($ui3 = mysql_fetch_row ($e3))
			{
			 for ($tn=1; $tn<=$qnt; $tn++)
			    {
	        	     $base1[$tn]+=$data_work[$ccn][$tn]*($welecs[$ccn]/$counts)*$tarif_elec[$tn]; // !!!!!!!!!!!!!!!!!!!!!!
		    	     $base2[$tn]+=$data_work[$ccn][$tn]*($gazs[$ccn]/$counts)*$tarif_gas[$tn];
			     if ($ui3[25]!=8888) $base3[$tn]+=$data_work[$ccn][$tn]*($pars[$ccn]/$counts)*$tarif_par[$tn];
			     else $base3[$tn]+=$data_work[$ccn][$tn]*($pars[$ccn]/$counts)*$tarif_par[$tn]/2;  // dush2
			     //if ($ui2[0]==1) echo $ui3[1].' '.$base3[$tn].' '.$data_work[$ccn][$tn].' '.$pars[$ccn].' '.$counts.' '.$tarif_par[$tn].'<br>';

	        	     //$base1[$tn]+=$data_ven[$ccn][$tn]*($welecs[$ccn]/$counts)*$tarif_elec[$tn]; // !!!!!!!!!!!!!!!!!!!!!!
		    	     //$base2[$tn]+=$data_gor[$ccn][$tn]*($gazs[$ccn]/$counts)*$tarif_gas[$tn];
			     //if ($ui3[25]!=8) $base3[$tn]+=$data_gor[$ccn][$tn]*($pars[$ccn]/$counts)*$tarif_par[$tn];
			     //else $base3[$tn]+=$data_gor[$ccn][$tn]*($pars[$ccn]/$counts)*$tarif_par[$tn]/2;  // dush2
			     //echo $ui3[25].' '.$base3[$tn].'<br>';
	        	     //$baz1[$ccn][$tn]=$data_ven[$ccn][$tn]*($welecs[$ccn]/$counts)*$tarif_elec[$tn];
		    	     //$baz2[$ccn][$tn]=$data_gor[$ccn][$tn]*($gazs[$ccn]/$counts)*$tarif_gas[$tn];
			     //$baz3[$ccn][$tn]=$data_gor[$ccn][$tn]*($pars[$ccn]/$counts)*$tarif_par[$tn];
	    		     //echo $baz1[$ccn][$tn].' '.$baz2[$ccn][$tn].' '.$baz3[$ccn][$tn].'<br>'; 

			     //if ($data_ven[$ccn][$tn]==0 && $data_gor[$ccn][$tn]>1) $data_ven[$ccn][$tn]=$data_gor[$ccn][$tn];

	    		     $w[$tn]+=$tarif_elec[$tn]*($elecs[$ccn]*$data_elec[$ccn][$tn]*$data_ven[$ccn][$tn]/$sum_ven[$ccn][$tn]);
	    		     $g[$tn]+=$tarif_gas[$tn]*($gass[$ccn]*$data_gas[$ccn][$tn]*$data_gor[$ccn][$tn]/$sum_gor[$ccn][$tn]);
			     $h[$tn]=0;
			     if ($w[$tn]==0) $w[$tn]+=$tarif_elec[$tn]*$elecs[$ccn]*$data_ven[$ccn][$tn];
			     if ($g[$tn]==0) $g[$tn]+=$tarif_gas[$tn]*$gass[$ccn]*$data_gor[$ccn][$tn];
	    		     //echo $ui3[1].' ['.$w[$tn].'] '.$elec.' 1='.$data_elec[$ccn][$tn].' 2='.$data_ven[$ccn][$tn].' 3='.$sum_ven[$ccn][$tn].'<br>';
			    }
			 $ccn++; $cn++;
			}
		 for ($tn=1; $tn<=$qnt; $tn++)
		    {
    	             $baze1[$ecm][$tn]=$base1[$tn];
		     $baze2[$ecm][$tn]=$base2[$tn];
		     $baze3[$ecm][$tn]=$base3[$tn];

		     $wecm[$ecm][$tn]=$w[$tn]/$tarif_elec[$tn];
		     $gecm[$ecm][$tn]=$g[$tn]/$tarif_gas[$tn];
		     $hecm[$ecm][$tn]=$h[$tn];
		    }
		 for ($yn=$ccn-$cn; $yn<$ccn; $yn++)
		 for ($tn=1; $tn<=$qnt; $tn++)
		    {
    	             $baz1[$yn][$tn]=$base1[$tn];
		     $baz2[$yn][$tn]=$base2[$tn];
		     $baz3[$yn][$tn]=$base3[$tn];

    		     $ek1[$yn][$tn]=$base1[$tn]-$w[$tn];
    		     //echo $yn.'/'.$tn.' '.$ek1[$yn][$tn].' '.$base1[$tn].' '.$w[$tn].'<br>';
		     $ek2[$yn][$tn]=$base2[$tn]+$base3[$tn]-$g[$tn];
		    }
		 $ecm++;
		}

        $ccn=1; $ecm=0;
	$query = 'SELECT * FROM ecm ORDER BY id1';
	if ($e2 = mysql_query ($query,$i)) 
	while ($ui2 = mysql_fetch_row ($e2))
		{
		 $cn=0; $count=1;
		 $query = 'SELECT COUNT(id) FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
		 if ($e3 = mysql_query ($query,$i))
		 if ($ui3 = mysql_fetch_row ($e3)) $count=$ui3[0];

		 $query = 'SELECT * FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
		 if ($e3 = mysql_query ($query,$i))
		 while ($ui3 = mysql_fetch_row ($e3))
			{
    			 //for ($tn=0; $tn<=31; $tn++) $data_ven[$tn]=$data_gor[$tn]=$data_elec[$tn]=$data_gas[$tn]=$sum_ven[$tn]=$sum_gor[$tn]=0;
			 $device=$ui3[11]; $gor=$ui3[20]; $ven=$ui3[21]; $chan_elec=$ui3[22]; $chan_gas=$ui3[23]; $elec=$ui3[15]; $gas=$ui3[16]; $voda=$ui3[17]; $welec=$ui3[28]; $gaz=$ui3[29];  $par=$ui3[26]; $par2=$ui3[27];
		         $sumelec+=$elec;

			 if ($ui2[17]) print '<tr class="BlockHeaderLeftRight" align="center">';
			 else print '<tr class="BlockHeaderLeftRight" align="center" style="background-color: gray">';
			 print '<td style="white-space:nowrap">'.$ui3[13].'</td>';
			 print '<td style="white-space:nowrap">'.$ui3[1].'</td><td class="simple">'.$ui3[25].'</td><td class="simple">'.number_format($gas,2).'</td><td class="simple">'.number_format($elec,2).'</td>';
			 $sum_gas+=$gas; $sum_elec+=$elec;

			 //for ($tn=1; $tn<=$qnt; $tn++)
			 //	if ($data_work1[$ccn][$tn]==0) print '<td class="simple" align="center"><input id="'.$ccn.'-'.$tn.'-2-2" name="'.$ccn.'-'.$tn.'-2-2" class="simple2" value="'.number_format($data_work[$ccn][$tn],3).'" align="center"></td>';
			 //	else if ($data_work1[$ccn][$tn]==1) print '<td class="simple2" align="center"><input id="'.$ccn.'-'.$tn.'-2-2" name="'.$ccn.'-'.$tn.'-2-2" class="simple2" value="'.number_format($data_work[$ccn][$tn],3).'" align="center" style="background:#dedede"></td>';
			 if (!$cn)
			    {
			     for ($tn=1; $tn<=$qnt; $tn++)
    			        print '<td class="simple" rowspan="'.$count.'" align="center"><input id="'.$ui2[0].'-'.$tn.'-2-2" name="'.$ui2[0].'-'.$tn.'-2-2" class="simple2" value="'.number_format($data_work[$ccn][$tn],3).'" align="center"></td>';
			    }

			 if (!$_GET["hide"])
			    {
			     for ($tn=1; $tn<=$qnt; $tn++)
				if ($data_work[$ccn][$tn]>=$data_gor[$ccn][$tn] && $data_work[$ccn][$tn]>=$data_ven[$ccn][$tn]) print '<td class="simple" align="center"><input id="'.$ccn.'-'.$tn.'-2-0" name="'.$ccn.'-'.$tn.'-2-0" class="simple2" value="'.number_format($data_gor[$ccn][$tn],3).'" align="center"></td>';
				else 
				    {
				     print '<td class="simple" align="center"><input style="background-color:pink" id="'.$ccn.'-'.$tn.'-2-0" name="'.$ccn.'-'.$tn.'-2-0" class="simple2" value="'.number_format($data_gor[$ccn][$tn],3).'" align="center" style="background:#dedede"></td>';
				     //echo iconv('Windows-1251', 'UTF-8//IGNORE', $ui3[1]);
				     //$rs=CP1251toUTF8($ui3[1]);
				     if ($data_work[$ccn][$tn]-$data_gor[$ccn][$tn]<-1) $comment[$tn].='Переработка '.$ui3[1].' составила '.(number_format($data_ven[$ccn][$tn]-$data_work[$ccn][$tn],2)).' часов<br>';
				    }
			     for ($tn=1; $tn<=$qnt; $tn++)
				if ($data_work[$ccn][$tn]>=$data_gor[$ccn][$tn] && $data_work[$ccn][$tn]>=$data_ven[$ccn][$tn]) print '<td class="simple" align="center"><input id="'.$ccn.'-'.$tn.'-2-1" name="'.$ccn.'-'.$tn.'-2-1" class="simple2" value="'.number_format($data_ven[$ccn][$tn],3).'" align="center"></td>';
				else 
				    {
				     print '<td class="simple" align="center"><input style="background-color:pink" id="'.$ccn.'-'.$tn.'-2-1" name="'.$ccn.'-'.$tn.'-2-1" class="simple2" value="'.number_format($data_ven[$ccn][$tn],3).'" align="center" style="background:#dedede"></td>';
     				     //$comment[$tn].='РџРµСЂРµСЂР°Р±РѕС‚РєР° РїРѕ СЂР°Р±РѕС‚Рµ  РїРѕ '.$ui[1].' СЃРѕСЃС‚Р°РІР»СЏРµС‚ '.($data_gor[$ccn][$tn]-$data_work[$ccn][$tn]).' С‡Р°СЃРѕРІ<br>';
				    }
			     for ($tn=1; $tn<=$qnt; $tn++)
				 print '<td class="simple" align="center">'.number_format($data_gor[$ccn][$tn]*$gas,2).'</td>';
    			     for ($tn=1; $tn<=$qnt; $tn++)
				 print '<td class="simple" align="center">'.number_format($data_ven[$ccn][$tn]*$elec,2).'</td>';
			    }
		         for ($tn=1; $tn<=$qnt; $tn++)
				 $sum_gasp[$tn]+=$data_gor[$ccn][$tn]*$gas;
			 for ($tn=1; $tn<=$qnt; $tn++)
				 $sum_venp[$tn]+=$data_ven[$ccn][$tn]*$elec;

			 if (!$cn)
				{
				 //if ($ui2[0]==8) $count=1;
				 print '<td class="simple" rowspan="'.$count.'"><input id="'.$ccn.'-1-0" name="'.$ccn.'-1-0" class="simple2" value="'.number_format($welec,4).'" align="center"></td>';
				 print '<td class="simple" rowspan="'.$count.'"><input id="'.$ccn.'-1-1" name="'.$ccn.'-1-1" class="simple2" value="'.number_format($gaz,4).'" align="center"></td>';
				 print '<td class="simple" rowspan="'.$count.'"><input id="'.$ccn.'-1-2" name="'.$ccn.'-1-2" class="simple2" value="'.number_format($par,4).'" align="center"></td>';
				 print '<td class="simple" rowspan="'.$count.'"><input id="'.$ccn.'-1-3" name="'.$ccn.'-1-3" class="simple2" value="'.number_format($par2,4).'" align="center"></td>';
				}
			 else	{
				 print '<input id="'.$ccn.'-1-0" name="'.$ccn.'-1-0" value="'.number_format($welec,4).'" style="visibility:hidden; width:1px; height:1px">';
				 print '<input id="'.$ccn.'-1-1" name="'.$ccn.'-1-1" value="'.number_format($gaz,4).'" style="visibility:hidden; width:1px; height:1px">';
				 print '<input id="'.$ccn.'-1-2" name="'.$ccn.'-1-2" value="'.number_format($par,4).'" style="visibility:hidden; width:1px; height:1px">';
				 print '<input id="'.$ccn.'-1-3" name="'.$ccn.'-1-3" value="'.number_format($par2,4).'" style="visibility:hidden; width:1px; height:1px">';
				}

			 if (!$cn)
			 for ($tn=1; $tn<=$qnt; $tn++)
				{
				 //if ($ui2[0]==8) $count=2;
				 print '<td rowspan="'.$count.'" class="simple">'.number_format($baz1[$ccn][$tn],2).'</td>';
				 print '<td rowspan="'.$count.'" class="simple">'.number_format($baz2[$ccn][$tn],2).'</td>';
				 print '<td rowspan="'.$count.'" class="simple">'.number_format($baz3[$ccn][$tn],2).'</td>';
				 $sum_baz1[$tn]+=$baz1[$ccn][$tn]; //$baze1[$ecm][$tn]=$baz1[$ccn][$tn];
				 $sum_baz2[$tn]+=$baz2[$ccn][$tn]; //$baze2[$ecm][$tn]=$baz2[$ccn][$tn];
				 $sum_baz3[$tn]+=$baz3[$ccn][$tn]; //$baze3[$ecm][$tn]=$baz3[$ccn][$tn];
				}
			 for ($tn=1; $tn<=$qnt; $tn++)
				{
				 //if ($ui2[0]==8) $count=2;
				 //echo $elec.' '.$data_elec[$ccn][$tn].' '.$data_ven[$ccn][$tn].' '.$sum_ven[$ccn][$tn].'<br>';
				 $w=$elec*$data_elec[$ccn][$tn]*$data_ven[$ccn][$tn]/$sum_ven[$ccn][$tn];
				 $g=$gas*$data_gas[$ccn][$tn]*$data_gor[$ccn][$tn]/$sum_gor[$ccn][$tn];

				 //$ggg[$tn]+=$data_gor[$ccn][$tn]*$gas;
				 //if ($tn==4) echo $g.'               '.($gas*$data_gor[$ccn][$tn]/$sum_gor[$ccn][$tn]).' '.$ggg[$tn].' / '.$sum_gor[$ccn][$tn].'<br>';
				 if ($w==0 && $data_ven1[$ccn][$tn]==0) $w=$elec*$data_ven[$ccn][$tn];
				 if ($g==0 && $data_gor1[$ccn][$tn]==0) $g=$gas*$data_gor[$ccn][$tn];
				 //if ($dates[$tn]<'20120301000000') { $w=$elec*$data_ven[$ccn][$tn]; $g=$gas*$data_gor[$ccn][$tn]; }
//if (1)
//				 if ($ui2[17])
				 if ($ui2[18]!=28) 
				 //if (1)
				    {
				     $sum_w[$tn]+=$w; $sum_g[$tn]+=$g;
				     $sum_wt[$tn]+=$w*$tarif_elec[$tn]; $sum_gt[$tn]+=$g*$tarif_gas[$tn];
    				    }
				 else 
				    {
				     $sum_w[$tn]+=$w;
				     $sum_wt[$tn]+=$w*$tarif_elec[$tn];
				    }
				 //if ($tn==4) echo $g.'               '.($gas*$data_gor[$ccn][$tn]/$sum_gor[$ccn][$tn]).' / '.$sum_gor[$ccn][$tn].' '.$sum_g[$tn].'<br>';

				 print '<td class="simple">'.number_format($w,2).'</td>';
				 print '<td class="simple">'.number_format($g,2).'</td>';
				 //print '<td class="simple">'.number_format($data_elec[$ccn][$tn]*$elec*$data_ven[$ccn][$tn]/$sum_ven[$ccn][$tn],2).'</td>';
				 //print '<td class="simple">'.number_format($gas*$data_gor[$ccn][$tn]/$sum_gor[$ccn][$tn],2).'</td>';

				 print '<td class="simple">'.number_format($w*$tarif_elec[$tn],2).'</td>';
				 print '<td class="simple">'.number_format($g*$tarif_gas[$tn],2).'</td>';
				 //print '<td class="simple">'.number_format($cn,2).'</td>';

				 if (!$cn)
				    {
				     print '<td class="simple" rowspan="'.$count.'">'.number_format($ek1[$ccn][$tn],2).'</td>';
				     print '<td class="simple" rowspan="'.$count.'">'.number_format($ek2[$ccn][$tn],2).'</td>';
				     if ($ui2[17]) { $sum_ek1[$tn]+=$ek1[$ccn][$tn]; $sum_ek2[$tn]+=$ek2[$ccn][$tn]; }
				     if ($ui2[18]==28) {  $sum_ek1[$tn]-=$ek1[$ccn][$tn]; $sum_ek2[$tn]-=$ek2[$ccn][$tn]; }
				     //if ($ui2[18]==28) {  echo $sum_ek1[$tn].' '.$sum_ek2[$tn].' '.$ek2[$ccn][$tn].' '.'<br>';$sum_ek1[$tn]-=$ek1[$ccn][$tn]; $sum_ek2[$tn]-=$ek2[$ccn][$tn]; echo $sum_ek1[$tn].' '.$sum_ek2[$tn].' '.$ek2[$ccn][$tn].' '.'<br>';}
				    }
				}
			 $ccn++; $cn++;
			}
		 $ecm++;
		}

  if (!$_GET["hide"]) $qqq=8; else $qqq=4;
  print '<tr class="BlockHeaderLeftRight" align="center"><td rowspan="3">Прочие расходы</td><td rowspan="3"></td>
	 <td class="simple" colspan="'.($qqq*$qnt+7).'" rowspan="3"></td>';

  $query = 'SELECT * FROM data WHERE (prm=41 OR prm=12 OR prm=11) AND type=4';
  if ($e = mysql_query ($query,$i))
  while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
	{
	 // 596+597 - 602
	 $x=$qnt+1;
	 for ($tn=1; $tn<=$qnt; $tn++)
	     if ($ui["date"]==$date[$tn]) $x=$tn;
	 //echo $date[$tn].'<br>';
 	 if ($ui["prm"]==41 && $ui["source"]==2 && $ui["device"]==0) $data1[$x]=$ui["value"];
 	 if ($ui["prm"]==41 && $ui["source"]==0 && $ui["device"]==0) $data2[$x]=$ui["value"];
	 if ($ui["prm"]==12 && $ui["source"]==0 && $ui["device"]>0) $data3[$x]+=$ui["value"];

	 if ($ui["channel"]==596 || $ui["channel"]==597) $data4[$x]+=$ui["value"];
	 if ($ui["channel"]==602) $data5[$x]+=$ui["value"];
	}
  //print '</tr><tr>';
  for ($tn=1; $tn<=$qnt; $tn++)
	{
	 print '<td class="simple">ХВС, м3</td>';
	 print '<td class="simple"><input name="'.$tn.'-11-10" class="simple2" value="'.number_format($data3[$tn],2).'"></td>';
	 print '<td class="simple">ХВС, руб</td>';
	 print '<td class="simple">'.number_format ($data3[$tn]*$tarif_hvs[$tn],2).'</td>';
	 print '<td class="simple"></td>';
	 print '<td class="simple"></td>';
	}
  print '</tr><tr align="center">';
  for ($tn=1; $tn<=$qnt; $tn++)
	{
	 $vodootv[$tn]=$data3[$tn]-$data4[$tn]*(1/80.77);
	 //$vodootv[$tn]=$data4[$tn]*(1/80.77);

	 if ($vodootv[$tn]<0) $vodootv[$tn]=0;

	 print '<td class="simple">Стоки, м3</td>';
	 print '<td class="simple"><input name="'.$tn.'-41-0" class="simple2" value="'.number_format($vodootv[$tn],2).'"></td>';
	 print '<td class="simple">Стоки, руб</td>';
	 print '<td class="simple">'.number_format(($vodootv[$tn]*$tarif_vodootv[$tn]),2).'</td>';
	 print '<td class="simple"></td>';
	 print '<td class="simple"></td>';
	}
  print '</tr><tr align="center">';
  for ($tn=1; $tn<=$qnt; $tn++)
	{
	 print '<td class="simple">Соль,кг</td>';
	 print '<td class="simple"><input name="'.$tn.'-41-2" class="simple2" value="'.number_format($data1[$tn],2).'"></td>';
	 print '<td class="simple">Соль, руб</td>';
	 print '<td class="simple">'.($data1[$tn]*$tarif_salt[$tn]).'</td>';
	 print '<td class="simple"></td>';
	 print '<td class="simple"></td>';
	}
  print '</tr>';

  print '<tr class="BlockHeaderLeftRight" align="center"><td colspan="3"></td>
	 <td>'.$sum_gas.'</td><td>'.$sum_elec.'</td>';
  for ($tn=1; $tn<=$qnt; $tn++)
	 print '<td align="center"></td>';

  if (!$_GET["hide"])
  for ($tn=1; $tn<=$qnt*2; $tn++)
	 print '<td align="center"></td>';
  if (!$_GET["hide"])
  for ($tn=1; $tn<=$qnt; $tn++)
	 print '<td align="center">'.number_format($sum_gasp[$tn],2).'</td>';
  if (!$_GET["hide"])
  for ($tn=1; $tn<=$qnt; $tn++)
	 print '<td align="center">'.number_format($sum_venp[$tn],2).'</td>';

  print '<td align="center" colspan="4"></td>';

  for ($tn=1; $tn<=$qnt; $tn++)
	{
	 print '<td>'.number_format($sum_baz1[$tn],2).'</td>';
	 print '<td>'.number_format($sum_baz2[$tn],2).'</td>';
	 print '<td>'.number_format($sum_baz3[$tn],2).'</td>';
	}
  for ($tn=1; $tn<=$qnt; $tn++)
	{
	 $sum_ek1[$tn]=$sum_baz1[$tn]-$sum_wt[$tn];
	 $sum_ek2[$tn]=$sum_baz2[$tn]+$sum_baz3[$tn]-$sum_gt[$tn];

	 print '<td>'.number_format($sum_w[$tn],2).'</td>';
	 print '<td>'.number_format($sum_g[$tn],2).'</td>';
	 print '<td>'.number_format($sum_wt[$tn],2).'</td>';
	 print '<td>'.number_format($sum_gt[$tn],2).'</td>';
	 print '<td>'.number_format($sum_ek1[$tn],2).'</td>';
	 print '<td>'.number_format($sum_ek2[$tn],2).'</td>';
	 $sum_ek[$tn]=$sum_ek1[$tn]+$sum_ek2[$tn]-($data3[$tn]*$tarif_hvs[$tn])-($vodootv[$tn]*$tarif_vodootv[$tn])-($data1[$tn]*$tarif_salt[$tn]);
	}
  print '</tr>';

  print '<tr class="BlockHeaderLeftRight" align="center">';
  for ($tn=1; $tn<=($qnt*$qqq+9); $tn++) print '<td align="center" class="simple"></td>';
  for ($tn=1; $tn<=$qnt; $tn++)
	 print '<td colspan="4" class="simple"></td><td>Итого:</td><td>'.number_format($sum_ek[$tn],2).'</td>';
  print '</tr>';
  print '<tr class="BlockHeaderLeftRight" align="center">';
  print '<td align="center" class="simple" colspan="'.($qnt*$qqq+9).'"></td>';
  for ($tn=1; $tn<=$qnt; $tn++) print '<td class="simple"></td><td colspan="4">Итого к оплате без НДС (80%):</td><td>'.(number_format($sum_ek[$tn]*0.8,2)).'</td>';
  print '</tr>';
  print '<tr class="BlockHeaderLeftRight" align="center">';
  print '<td align="center" class="simple" colspan="'.($qnt*$qqq+9).'"></td>';
  for ($tn=1; $tn<=$qnt; $tn++) print '<td class="simple"></td><td colspan="4">Итого к оплате с НДС</td><td>'.(number_format(($sum_ek[$tn]*0.8)*1.18,2)).'</td>';
  print '</tr>';


  $query = 'SELECT * FROM reports WHERE date='.$dates[$tn];
  if ($e2 = mysql_query ($query,$i)) 
  if ($ui2 = mysql_fetch_row ($e2))
	{
	 $visa[$cn]=$ui2[2]*$ui2[2];
	}

  if ($_COOKIE["name"] && $_COOKIE["id"]) 
    {
     for ($tn=1; $tn<=$qnt; $tn++)
     if ($tn>=$qnt-1)
	{
	 StoreData ($i, 1, 50, 4, $dates[$tn], $sum_ek[$tn]);
	 StoreData ($i, 1, 51, 4, $dates[$tn], $sum_baz1[$tn]);
	 StoreData ($i, 2, 51, 4, $dates[$tn], $sum_baz2[$tn]);
	 StoreData ($i, 3, 51, 4, $dates[$tn], $sum_baz3[$tn]);

	 StoreData ($i, 1, 52, 4, $dates[$tn], $sum_w[$tn]);
	 StoreData ($i, 2, 52, 4, $dates[$tn], $sum_g[$tn]);
	 StoreData ($i, 3, 52, 4, $dates[$tn], 0);
	 StoreData ($i, 4, 52, 4, $dates[$tn], $data3[$tn]);
	 StoreData ($i, 5, 52, 4, $dates[$tn], $vodootv[$tn]);
	 StoreData ($i, 6, 52, 4, $dates[$tn], $data1[$tn]);

         $query = 'UPDATE reports SET comment2=\''.$comment[$tn].'\' WHERE date='.$dates[$tn];
	 $e8 = mysql_query ($query,$i); 
	 //echo $e8;
	 //echo $query.'<br>';
	}
    for ($tn=1; $tn<=$qnt; $tn++)
    if ($tn>=$qnt-1)
    for ($ccn=1; $ccn<=$qnt3; $ccn++)
	    {
//    	     StoreData ($i, $ccn+1, 61, 4, $dates[$tn], $baz1[$ccn][$tn]/$tarif_elec[$tn]);
//	     StoreData ($i, $ccn+1, 62, 4, $dates[$tn], $baz2[$ccn][$tn]/$tarif_gas[$tn]);
//	     StoreData ($i, $ccn+1, 63, 4, $dates[$tn], $baz3[$ccn][$tn]/$tarif_par[$tn]);
    	     StoreData ($i, $ccn, 61, 4, $dates[$tn], $baze1[$ccn][$tn]/$tarif_elec[$tn]);
	     StoreData ($i, $ccn, 62, 4, $dates[$tn], $baze2[$ccn][$tn]/$tarif_gas[$tn]);
	     StoreData ($i, $ccn, 63, 4, $dates[$tn], $baze3[$ccn][$tn]/$tarif_par[$tn]);

    	     StoreData ($i, $ccn, 71, 4, $dates[$tn], $wecm[$ccn][$tn]);
	     StoreData ($i, $ccn, 72, 4, $dates[$tn], $gecm[$ccn][$tn]);
	     StoreData ($i, $ccn, 73, 4, $dates[$tn], $hecm[$ccn][$tn]);
	    }
    }
  print '<input type="submit" style="visibility: hidden">';
  print '</form>';
  print '</table>';
 }
?>                                                                                                                                                                                                                                                                                     } 