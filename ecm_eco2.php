<?php
if ($_GET["type"]=='' || $_GET["type"]=='4')
 {
  if ($_GET["id"])  $query = 'SELECT * FROM ecm WHERE id='.$_GET["id"];
  else $query = 'SELECT * FROM ecm'; $first=0;
  //echo $query;
  print '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	 <tbody><tr><td align="center" valign="middle"  colspan="3">
	 <table border="0" cellpadding="2" cellspacing="2"><tbody>';

  if ($e2 = mysql_query ($query,$i)) 
  while ($ui2 = mysql_fetch_row ($e2))
	{
	 print '<tr><td colspan="36" class="BlockHeaderMiddle" style="padding-left: 22px;" align="center" height="20" valign="center"><span id="Label5">'.$ui2[1].'</span></td></tr>';
	 $sumw=$sumg=$ithr0=$ithr1=0;
	 $query = 'SELECT * FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
	 //echo $query;
	 if ($e3 = mysql_query ($query,$i))
	 while ($ui3 = mysql_fetch_row ($e3))
		{
    		 $sumw=$sumg=$ithr0=$ithr1=0;
    		 for ($tn=0; $tn<=31; $tn++) $data_ven[$tn]=$data_gor[$tn]=$data_elec[$tn]=$data_gas[$tn]=$sum_ven[$tn]=$sum_gor[$tn]=0;
		 $device=$ui3[11]; $gor=$ui3[20]; $ven=$ui3[21]; $chan_elec=$ui3[22]; $chan_gas=$ui3[23]; $elec=$ui3[15]; $gas=$ui3[16];

		 $query = 'SELECT SUM(W) FROM devices WHERE chan_elec='.$ui3[22];
		 //echo $query.'<br>';
		 if ($e4 = mysql_query ($query,$i))
		 if ($ui4 = mysql_fetch_row ($e4)) $sumw=$ui4[0];
		 $query = 'SELECT SUM(gas) FROM devices WHERE chan_gas='.$ui3[23];
		 if ($e4 = mysql_query ($query,$i))
		 if ($ui4 = mysql_fetch_row ($e4)) $sumg=$ui4[0];

		 $cn=0; $today=getdate(); $dy=31;
		 if ($_GET["year"]=='') $ye=$today["year"];
		 else $ye=$_GET["year"];
		 if ($_GET["month"]=='') $mn=$today["mon"];
		 else $mn=$_GET["month"];
		 $startdate=sprintf ("%d0101000000",$ye);
		 $dy=12;
		 if (!$first)
			{
			 print '<tr class="BlockHeaderLeftRight" align="center"><td>Устройство</td><td>Ресурс</td><td>Норматив</td>';
			 for ($tn=1; $tn<=$dy; $tn++)
				{
				 $month=$tn;
				 include ("time.inc");
			         print '<td><a href="index.php?sel=ecm2&type=2&month='.$tn.'" style="color:white">'.$month.'<br>'.$ye.'</a></td>';
			        }
			 print '<td>Итого</td><td>В рублях</td></tr>';
			}
		 print '<tr class="BlockHeaderLeftRight" align="center"><td rowspan="2">'.$ui3[1].'</td>';
		 for ($tn=1; $tn<=12; $tn++) $date[$tn]=sprintf ("%d-%02d-01 00:00:00",$ye,$tn);

		 $query = 'SELECT * FROM data WHERE (channel='.$gor.' OR channel='.$ven.' OR channel='.$chan_elec.' OR channel='.$chan_gas.') AND type=4 AND date>='.$startdate;
		 //echo $query;
		 if ($e = mysql_query ($query,$i))
		 while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
			{
			 //echo $ui["date"];
			 $x=$dy+1;
			 for ($tn=1; $tn<=$dy; $tn++)
			     if ($ui["date"]==$date[$tn]) $x=$tn;

			 if ($ui["channel"]==$ven) $data_ven[$x]=$ui["value"];
			 if ($ui["channel"]==$gor) $data_gor[$x]=$ui["value"];
			 if ($ui["channel"]==$chan_elec) $data_elec[$x]=$ui["value"];
			 if ($ui["channel"]==$chan_gas) $data_gas[$x]=$ui["value"];
			 //if ($data_ven[$x]) echo $data_ven[$x];
			}		 
		 print '<td>ЭЭ</td><td>'.($elec*24).'кВт</td>';

		 $query = 'SELECT * FROM devices WHERE chan_elec='.$chan_elec;
		 if ($e5 = mysql_query ($query,$i))
		 while ($ui5 = mysql_fetch_row ($e5)) 
			{
			 $query = 'SELECT * FROM data WHERE channel='.$ui5[21].' AND type=4 AND date>='.$startdate;
			 //echo $query;
			 if ($e6 = mysql_query ($query,$i))
			 while ($ui6 = mysql_fetch_row ($e6))
				{
				 $x=$dy+1;
				 for ($tn=1; $tn<=$dy; $tn++)
				     if ($ui6[2]==$date[$tn]) $x=$tn; 
				 $sum_ven[$x]+=$ui6[3]*$ui5[15];  // t * W
				 //echo '['.$x.'] t='.$ui6[3].' W='.$ui5[15].' '.$sum_ven[$x].'<br>';
				}
			}
		 $query = 'SELECT * FROM devices WHERE chan_gas='.$chan_gas;
		 //echo $query;
		 if ($e5 = mysql_query ($query,$i))
		 while ($ui5 = mysql_fetch_row ($e5)) 
			{
			 $query = 'SELECT * FROM data WHERE channel='.$ui5[20].' AND type=4 AND date>='.$startdate;
			 if ($e6 = mysql_query ($query,$i))
			 while ($ui6 = mysql_fetch_row ($e6))
				{
				 $x=$dy+1;
				 for ($tn=1; $tn<=$dy; $tn++)
				     if ($ui6[2]==$date[$tn]) $x=$tn;
				 //echo $ui6[2].' '.$date[$tn].'<br>';
				 $sum_gor[$x]+=$ui6[3]*$ui5[16];  // t * Q
				 //echo '['.$x.'] t='.$ui6[3].' Q='.$ui5[16].' '.$sum_gor[$x].'<br>';
				}
			}
		
	       	 for ($tn=1; $tn<=$dy; $tn++)
		    {
		     $w=$elec*$data_elec[$tn]*$data_ven[$tn]/$sum_ven[$tn];
		     print '<td class="simple">'.number_format($w,3).'</td>';
		     $sum_w[$tn]+=$w;
		     $ithr1+=$w;
		    }
	 	 print '<td class="simple">'.number_format($ithr1,2).'</td>';
	 	 print '<td class="simple">'.number_format($ithr1*$tarif1,2).'</td></tr>';
		 print '<tr align="center" class="BlockHeaderLeftRight"><td>Газ</td><td>'.($gas*24).'м3</td>';
	       	 for ($tn=1; $tn<=$dy; $tn++)
		    {
		     $g=$gas*$data_gas[$tn]*$data_gor[$tn]/$sum_gor[$tn];
		     print '<td class="simple">'.number_format($g,2).'</td>';
		     $sum_g[$tn]+=$g;
	             $ithr0+=$g;
		    }
	 	 print '<td class="simple">'.number_format($ithr0,2).'</td>';
	 	 print '<td class="simple">'.number_format($ithr0/1000*$tarif3,0).'</td></tr>';
    		 //print '<tr><td colspan="29" class="BlockHeaderMiddle" style="padding-left: 22px;" align="center" height="20" valign="center"><span id="Label5">W '.$sumw.' | Q '.$sumg.'</span></td></tr>';
		 $first++;
		}
	}
  print '<tr align="center" class="BlockHeaderLeftRight"><td colspan="3" rowspan="2" valign="center" align="center">Итого</td>';
  $ithr1=$ithr0=0;
  for ($tn=1; $tn<=$dy; $tn++)
    {
     print '<td>'.number_format($sum_w[$tn],3).'</td>';
     $ithr1+=$sum_w[$tn];
    }
  print '<td>'.number_format($ithr1,2).'</td>';
  print '<td>'.number_format($ithr1*$tarif1,1).'</td></tr>';
  print '<tr align="center" class="BlockHeaderLeftRight">';
  for ($tn=1; $tn<=$dy; $tn++)
    {
     print '<td>'.number_format($sum_g[$tn],2).'</td>';
     $ithr0+=$sum_g[$tn];
    }
  print '<td>'.number_format($ithr0,2).'</td>';
  print '<td>'.number_format($ithr0/1000*$tarif3,1).'</td></tr>';
  print '</table></table>';
 }
	
if ($_GET["type"]=='2')
 {
  if ($_GET["id"])  $query = 'SELECT * FROM ecm WHERE id='.$_GET["id"];
  else $query = 'SELECT * FROM ecm'; $first=0;
  //echo $query;
  print '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	 <tbody><tr><td align="center" valign="middle"  colspan="3">
	 <table border="0" cellpadding="2" cellspacing="2"><tbody>';

  if ($e2 = mysql_query ($query,$i)) 
  while ($ui2 = mysql_fetch_row ($e2))
	{
	 print '<tr><td colspan="36" class="BlockHeaderMiddle" style="padding-left: 22px;" align="center" height="20" valign="center"><span id="Label5">'.$ui2[1].'</span></td></tr>';
	 $sumw=$sumg=$ithr0=$ithr1=$itecm0=$itecm1=$itecm2=0; $data_voda=0; $v=0;
	 $query = 'SELECT * FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
	 //echo $query;
	 if ($e3 = mysql_query ($query,$i))
	 while ($ui3 = mysql_fetch_row ($e3))
		{
    		 $sumw=$sumg=$ithr0=$ithr1=0; 
    		 for ($tn=0; $tn<=31; $tn++) $data_ven[$tn]=$data_gor[$tn]=$data_elec[$tn]=$data_gas[$tn]=$datavoda[$tn]=$sum_ven[$tn]=$sum_gor[$tn]=$sum_voda[$tn]=0;
		 $device=$ui3[11]; $gor=$ui3[20]; $ven=$ui3[21]; $chan_elec=$ui3[22]; $chan_gas=$ui3[23]; $chan_voda=$ui3[24]; $elec=$ui3[15]; $gas=$ui3[16]; $voda=$ui3[17];

		 $query = 'SELECT SUM(W) FROM devices WHERE chan_elec='.$ui3[22];
		 //echo $query.'<br>';
		 if ($e4 = mysql_query ($query,$i))
		 if ($ui4 = mysql_fetch_row ($e4)) $sumw=$ui4[0];
		 $query = 'SELECT SUM(gas) FROM devices WHERE chan_gas='.$ui3[23];
		 if ($e4 = mysql_query ($query,$i))
		 if ($ui4 = mysql_fetch_row ($e4)) $sumg=$ui4[0];
		 $query = 'SELECT SUM(V) FROM devices WHERE chan_voda='.$ui3[24];
		 //echo $query;
		 if ($e4 = mysql_query ($query,$i))
		 if ($ui4 = mysql_fetch_row ($e4)) $sumv=$ui4[0];


		 $cn=0; $today=getdate(); $dy=31;
		 if ($_GET["year"]=='') $ye=$today["year"];
		 else $ye=$_GET["year"];
		 if ($_GET["month"]=='') $mn=$today["mon"];
		 else $mn=$_GET["month"];
		 if (!checkdate ($mn,31,$ye)) { $dy=30; }
		 if (!checkdate ($mn,30,$ye)) { $dy=29; }
		 if (!checkdate ($mn,29,$ye)) { $dy=28; }
		 $startdate=sprintf ("%d%02d01000000",$ye,$mn);

		 if (!$first)
			{
			 print '<tr class="BlockHeaderLeftRight" align="center"><td>Устройство</td><td>Ресурс</td><td>Норматив</td>';

			 for ($tn=1; $tn<=$dy; $tn++)
				{
			         $date2=sprintf ("%02d/%02d",$tn,$mn);
			         print '<td><a href="index.php?sel=ecm2&type=1&day='.$tn.'&month='.$mn.'" style="color:white">'.$date2.'</a></td>';
			        }
			 print '<td>Итого</td><td>В рублях</td></tr>';
			}
		 print '<tr class="BlockHeaderLeftRight" align="center"><td rowspan="2">'.$ui3[1].'</td>';

		 for ($tn=1; $tn<=$dy; $tn++) $date[$tn]=sprintf ("%d-%02d-%02d 00:00:00",$today["year"],$mn,$tn);

		 $query = 'SELECT * FROM data WHERE (channel='.$gor.' OR channel='.$chan_voda.' OR channel='.$ven.' OR channel='.$chan_elec.' OR channel='.$chan_gas.') AND type=2 AND date>='.$startdate;
		 //echo $query;
		 if ($e = mysql_query ($query,$i))
		 while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
			{
			 //echo $ui["date"];
			 $x=$dy+1;
			 for ($tn=1; $tn<=$dy; $tn++)
			     if ($ui["date"]==$date[$tn]) $x=$tn;

			 if ($ui["channel"]==$chan_voda) { $datavoda[$x]=$ui["value"];  }
			 if ($ui["channel"]==$ven) $data_ven[$x]=$ui["value"];
			 if ($ui["channel"]==$gor) $data_gor[$x]=$ui["value"];
			 if ($ui["channel"]==$chan_elec) $data_elec[$x]=$ui["value"];
			 if ($ui["channel"]==$chan_gas) $data_gas[$x]=$ui["value"];
			 //if ($data_ven[$x]) echo $data_ven[$x];
			}		 
		 print '<td>ЭЭ</td><td>'.($elec*24).'кВт</td>';

		 $query = 'SELECT * FROM devices WHERE chan_elec='.$chan_elec;
		 if ($e5 = mysql_query ($query,$i))
		 while ($ui5 = mysql_fetch_row ($e5)) 
			{
			 $query = 'SELECT * FROM data WHERE channel='.$ui5[21].' AND type=2 AND date>='.$startdate;
			 //echo $query;
			 if ($e6 = mysql_query ($query,$i))
			 while ($ui6 = mysql_fetch_row ($e6))
				{
				 $x=$dy+1;
				 for ($tn=1; $tn<=$dy; $tn++)
				     if ($ui6[2]==$date[$tn]) $x=$tn; 
				 $sum_ven[$x]+=$ui6[3]*$ui5[15];  // t * W
				 //echo '['.$x.'] t='.$ui6[3].' W='.$ui5[15].' '.$sum_ven[$x].'<br>';
				}
			}
		 $query = 'SELECT * FROM devices WHERE chan_gas='.$chan_gas;
		 if ($e5 = mysql_query ($query,$i))
		 while ($ui5 = mysql_fetch_row ($e5)) 
			{
			 $query = 'SELECT * FROM data WHERE channel='.$ui5[20].' AND type=2 AND date>='.$startdate;
			 if ($e6 = mysql_query ($query,$i))
			 while ($ui6 = mysql_fetch_row ($e6))
				{
				 $x=$dy+1;
				 for ($tn=1; $tn<=$dy; $tn++)
				     if ($ui6[2]==$date[$tn]) $x=$tn;
				 //echo $ui6[2].' '.$date[$tn].'<br>';
				 $sum_gor[$x]+=$ui6[3]*$ui5[16];  // t * Q
				 //echo '['.$x.'] t='.$ui6[3].' Q='.$ui5[16].' '.$sum_gor[$x].'<br>';
				}
			}
		 $query = 'SELECT * FROM devices WHERE chan_voda='.$chan_voda;
		 if ($e5 = mysql_query ($query,$i))
		 while ($ui5 = mysql_fetch_row ($e5)) 
			{
			 $query = 'SELECT * FROM data WHERE channel='.$ui5[20].' AND type=2 AND date>='.$startdate;
			 if ($e6 = mysql_query ($query,$i))
			 while ($ui6 = mysql_fetch_row ($e6))
				{
				 $x=$dy+1;
				 for ($tn=1; $tn<=$dy; $tn++)
				     if ($ui6[2]==$date[$tn]) $x=$tn; 
				 $sum_voda[$x]+=$ui6[3]*$ui5[17];  // t * W
				 //echo '['.$x.'] t='.$ui6[3].' W='.$ui5[15].' '.$sum_ven[$x].'<br>';
				}
			}
		 $query = 'SELECT * FROM devices WHERE chan_gas='.$chan_gas;

		 //$v=$data_voda;
	       	 for ($tn=1; $tn<=$dy; $tn++)
		    {
		     $v=($voda/$sumv)*$datavoda[$tn];
		     //echo $voda.' | '.$sumv.' | '.$datavoda[$tn].' | '.$data_ven[$tn].' | '.$sum_voda[$tn].'<br>';
		     $sum_v[$tn]+=$v;
		     $ithr2+=$v; $itecm2+=$v;
		    }
	       	 for ($tn=1; $tn<=$dy; $tn++)
		    {
		     $w=$elec*$data_elec[$tn]*$data_ven[$tn]/($sum_ven[$tn]);
		     print '<td class="simple">'.number_format($w,3).'</td>';
		     $sum_w[$tn]+=$w;
		     $ithr1+=$w; $itecm1+=$w;
		    }
	 	 print '<td class="simple">'.number_format($ithr1,2).'</td>';
	 	 print '<td class="simple">'.number_format($ithr1*$tarif1,2).'</td></tr>';
		 print '<tr align="center" class="BlockHeaderLeftRight"><td>Газ</td><td>'.($gas*24).'м3</td>';
	       	 for ($tn=1; $tn<=$dy; $tn++)
		    {
		     $g=$gas*$data_gas[$tn]*$data_gor[$tn]/($sum_gor[$tn]);
		     //echo $gas.' | '.$sumg.' | '.$data_gas[$tn].' | '.$data_gor[$tn].' | '.$sum_gor[$tn].'<br>';
		     print '<td class="simple">'.number_format($g,2).'</td>';
		     $sum_g[$tn]+=$g;
	             $ithr0+=$g; $itecm0+=$g;
		    }
	 	 print '<td class="simple">'.number_format($ithr0,2).'</td>';
	 	 print '<td class="simple">'.number_format($ithr0/1000*$tarif3,0).'</td></tr>';
    		 //print '<tr><td colspan="29" class="BlockHeaderMiddle" style="padding-left: 22px;" align="center" height="20" valign="center"><span id="Label5">W '.$sumw.' | Q '.$sumg.'</span></td></tr>';
		 $first++;
		}
         if ($itecm1 || $itecm0)
            {
             $date[$tn]=sprintf ("%d%02d01000000",$today["year"],$mn,$tn);
	     $query = 'SELECT * FROM data2 WHERE device='.$ui2[0].' AND type=4 AND prm=14 AND source=0 AND date='.$date[$tn];
	     //echo $query;
	     if ($e3 = mysql_query ($query,$i))
	     if ($ui3 = mysql_fetch_row ($e3))
	        {
		 $query = 'UPDATE data2 SET date=date, value=\''.$itecm1.'\' WHERE prm=14 AND type=4 AND source=0 AND device='.$ui2[0].' AND date='.$date[$tn];
	        }
	     else  $query = 'INSERT INTO data2 SET value=\''.$itecm1.'\',prm=14,type=4,source=0,device='.$ui2[0].',date='.$date[$tn];
	     //echo $query.'<br>';
	     $e3 = mysql_query ($query,$i);

	     $query = 'SELECT * FROM data2 WHERE device='.$ui2[0].' AND type=4 AND prm=11 AND source=0 AND date='.$date[$tn];
	     //echo $query;
	     if ($e3 = mysql_query ($query,$i))
	     if ($ui3 = mysql_fetch_row ($e3))
	        {
		 $query = 'UPDATE data2 SET date=date, value=\''.$itecm0.'\' WHERE prm=11 AND type=4 AND source=0 AND device='.$ui2[0].' AND date='.$date[$tn];
	        }
	     else  $query = 'INSERT INTO data2 SET value=\''.$itecm0.'\',prm=11,type=4,source=0,device='.$ui2[0].',date='.$date[$tn];
	     // echo $query.'<br>';
	     $e3 = mysql_query ($query,$i);

	     $query = 'SELECT * FROM data2 WHERE device='.$ui2[0].' AND type=4 AND prm=12 AND source=0 AND date='.$date[$tn];
	     //echo $query;
	     if ($e3 = mysql_query ($query,$i))
	     if ($ui3 = mysql_fetch_row ($e3))
	        {
		 $query = 'UPDATE data2 SET date=date, value=\''.$itecm2.'\' WHERE prm=12 AND type=4 AND source=0 AND device='.$ui2[0].' AND date='.$date[$tn];
	        }
	     else  $query = 'INSERT INTO data2 SET value=\''.$itecm2.'\',prm=12,type=4,source=0,device='.$ui2[0].',date='.$date[$tn];
	     //echo $query.'<br>';
	     $e3 = mysql_query ($query,$i);
    	    }
	}
  print '<tr align="center" class="BlockHeaderLeftRight"><td colspan="3" rowspan="2" valign="center" align="center">Итого</td>';
  $ithr1=$ithr0=0;
  for ($tn=1; $tn<=$dy; $tn++)
    {
     print '<td>'.number_format($sum_w[$tn],3).'</td>';
     $ithr1+=$sum_w[$tn];
    }
  print '<td>'.number_format($ithr1,2).'</td>';
  print '<td>'.number_format($ithr1*$tarif1,1).'</td></tr>';
  print '<tr align="center" class="BlockHeaderLeftRight">';
  for ($tn=1; $tn<=$dy; $tn++)
    {
     print '<td>'.number_format($sum_g[$tn],2).'</td>';
     $ithr0+=$sum_g[$tn];
    }
  print '<td>'.number_format($ithr0,2).'</td>';
  print '<td>'.number_format($ithr0/1000*$tarif3,1).'</td></tr>';
  print '</table></table>';
 }
	
if ($_GET["type"]=='1')
 {         
 if ($_GET["id"])  $query = 'SELECT * FROM ecm WHERE id='.$_GET["id"];
 else $query = 'SELECT * FROM ecm'; $first=0;
 //echo $query;
 print '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody><tr><td align="center" valign="middle"  colspan="3">
	<table border="0" cellpadding="2" cellspacing="2"><tbody>';

 if ($e2 = mysql_query ($query,$i)) 
 while ($ui2 = mysql_fetch_row ($e2))
	{
	 print '<tr><td colspan="29" class="BlockHeaderMiddle" style="padding-left: 22px;" align="center" height="20" valign="center"><span id="Label5">'.$ui2[1].'</span></td></tr>';
	 $sumw=$sumg=$ithr0=$ithr1=0;
	 //
	 $query = 'SELECT * FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
	 //echo $query;
	 if ($e3 = mysql_query ($query,$i))
	 while ($ui3 = mysql_fetch_row ($e3))
		{
    		 $sumw=$sumg=$ithr0=$ithr1=0;
    		 for ($tn=0; $tn<=23; $tn++) $data_ven[$tn]=$data_gor[$tn]=$data_elec[$tn]=$data_gas[$tn]=$data_voda[$tn]=$sum_ven[$tn]=$sum_gor[$tn]=0;
		 $device=$ui3[11]; $gor=$ui3[20]; $ven=$ui3[21]; $chan_elec=$ui3[22]; $chan_gas=$ui3[23]; $chan_voda=$ui3[24]; $elec=$ui3[15]; $gas=$ui3[16];

		 $query = 'SELECT SUM(W) FROM devices WHERE chan_elec='.$ui3[22];
		 //echo $query.'<br>';
		 if ($e4 = mysql_query ($query,$i))
		 if ($ui4 = mysql_fetch_row ($e4)) $sumw=$ui4[0];
		 $query = 'SELECT SUM(gas) FROM devices WHERE chan_gas='.$ui3[23];
		 if ($e4 = mysql_query ($query,$i))
		 if ($ui4 = mysql_fetch_row ($e4)) $sumg=$ui4[0];

		 $cn=0; $today=getdate();
		 if ($_GET["year"]=='') $ye=$today["year"];
		 else $ye=$_GET["year"];
		 if ($_GET["month"]=='') $mn=$today["mon"];
		 else $mn=$_GET["month"];
		 if ($_GET["day"]=='') if ($today["mday"]>1) $dy=$today["mday"]-1; else $dy=$today["mday"];
		 else $dy=$_GET["day"];
		 $startdate=sprintf ("%d%02d%02d000000",$today["year"],$mn,$dy);

		 if (!$first)
			{
			 print '<tr class="BlockHeaderLeftRight" align="center"><td>Устройство</td><td>Ресурс</td><td>Норматив</td>';
			 for ($tn=0; $tn<=23; $tn++)
			    {	
			     $date2=sprintf ("%02d-%02d<br>%02d:00",$dy,$mn,$tn);
			     print '<td>'.$date2.'</td>';
			     }
			 print '<td>Итого</td><td>В рублях</td></tr>';
			}
		 print '<tr class="BlockHeaderLeftRight" align="center"><td rowspan="2">'.$ui3[1].'</td>';

		 for ($tn=0; $tn<=23; $tn++) $date[$tn]=sprintf ("%d-%02d-%02d %02d:00:00",$today["year"],$mn,$dy,$tn);

		 $query = 'SELECT * FROM data WHERE (channel='.$gor.' OR channel='.$chan_voda.' OR channel='.$ven.' OR channel='.$chan_elec.' OR channel='.$chan_gas.') AND type=1 AND date>='.$startdate;
		 //echo $query;
		 if ($e = mysql_query ($query,$i))
		 while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
			{
			 //echo $ui["date"];
			 $x=24;
			 for ($tn=0; $tn<=23; $tn++)
			     if ($ui["date"]==$date[$tn]) $x=$tn;

			 if ($ui["channel"]==$ven) $data_ven[$x]=$ui["value"];
			 if ($ui["channel"]==$gor) $data_gor[$x]=$ui["value"];
			 if ($ui["channel"]==$chan_elec) $data_elec[$x]=$ui["value"];
			 if ($ui["channel"]==$chan_gas) $data_gas[$x]=$ui["value"];
			 if ($ui["channel"]==$chan_voda) $data_voda[$x]=$ui["value"];
			 //if ($data_ven[$x]) echo $data_ven[$x];
			}		 
		 print '<td>ЭЭ</td><td>'.$elec.'кВт</td>';

		 $query = 'SELECT * FROM devices WHERE chan_elec='.$chan_elec;
		 if ($e5 = mysql_query ($query,$i))
		 while ($ui5 = mysql_fetch_row ($e5)) 
			{
			 $query = 'SELECT * FROM hours WHERE channel='.$ui5[21].' AND type=1 AND date>='.$startdate;
			 //echo $query;
			 if ($e6 = mysql_query ($query,$i))
			 while ($ui6 = mysql_fetch_row ($e6))
				{
				 $x=24;
				 for ($tn=0; $tn<=23; $tn++)
				     if ($ui6[2]==$date[$tn]) $x=$tn; 
				 $sum_ven[$x]+=$ui6[3]*$ui5[15];  // t * W
				 //echo '['.$x.'] t='.$ui6[3].' W='.$ui5[15].' '.$sum_ven[$x].'<br>';
				}
			}
		 $query = 'SELECT * FROM devices WHERE chan_gas='.$chan_gas;
		 //echo $query;
		 if ($e5 = mysql_query ($query,$i))
		 while ($ui5 = mysql_fetch_row ($e5)) 
			{
			 $query = 'SELECT * FROM hours WHERE channel='.$ui5[20].' AND type=1 AND date>='.$startdate;
			 if ($e6 = mysql_query ($query,$i))
			 while ($ui6 = mysql_fetch_row ($e6))
				{
				 $x=24;
				 for ($tn=0; $tn<=23; $tn++)
				     if ($ui6[2]==$date[$tn]) $x=$tn;
				 //echo $ui6[2].' '.$date[$tn].'<br>';
				 $sum_gor[$x]+=$ui6[3]*$ui5[16];  // t * Q
				 //echo '['.$x.'] t='.$ui6[3].' Q='.$ui5[16].' '.$sum_gor[$x].'<br>';
				}
			}
		
	       	 for ($tn=0; $tn<=23; $tn++)
		    {
		     $w=$elec*$data_elec[$tn]*$data_ven[$tn]/$sum_ven[$tn];
		     print '<td class="simple">'.number_format($w,3).'</td>';
		     $sum_w[$tn]+=$w;
		     $ithr1+=$w;
		    }
	 	 print '<td class="simple">'.number_format($ithr1,2).'</td>';
	 	 print '<td class="simple">'.number_format($ithr1*$tarif1,2).'</td></tr>';
		 print '<tr align="center" class="BlockHeaderLeftRight"><td>Газ</td><td>'.$gas.'м3</td>';
	       	 for ($tn=0; $tn<=23; $tn++)
		    {
		     $g=$gas*$data_gas[$tn]*$data_gor[$tn]/$sum_gor[$tn];
		     print '<td class="simple">'.number_format($g,2).'</td>';
		     $sum_g[$tn]+=$g;
	             $ithr0+=$g; 
		    }
	 	 print '<td class="simple">'.number_format($ithr0,2).'</td>';
	 	 print '<td class="simple">'.number_format($ithr0/1000*$tarif3,0).'</td></tr>';
    		 //print '<tr><td colspan="29" class="BlockHeaderMiddle" style="padding-left: 22px;" align="center" height="20" valign="center"><span id="Label5">W '.$sumw.' | Q '.$sumg.'</span></td></tr>';
		 $first++;
		}
	}
 print '<tr align="center" class="BlockHeaderLeftRight"><td colspan="3" rowspan="2" valign="center" align="center">Итого</td>';
 $ithr1=$ithr0=0;
 for ($tn=0; $tn<=23; $tn++)
    {
     print '<td>'.number_format($sum_w[$tn],3).'</td>';
     $ithr1+=$sum_w[$tn];
    }
 print '<td>'.number_format($ithr1,2).'</td>';
 print '<td>'.number_format($ithr1*$tarif1,1).'</td></tr>';
 print '<tr align="center" class="BlockHeaderLeftRight">';
 for ($tn=0; $tn<=23; $tn++)
    {
     print '<td>'.number_format($sum_g[$tn],2).'</td>';
     $ithr0+=$sum_g[$tn];
    }
 print '<td>'.number_format($ithr0,2).'</td>';
 print '<td>'.number_format($ithr0/1000*$tarif3,1).'</td></tr>';
 print '</table></table>';
}

//--------------------------------------------------------------------------------------------------------------------------------------------	
if ($_GET["type"]=='3')
 {
  $cn=1; $today=getdate(); $dy=31;
  if ($_GET["year"]=='') $ye=$today["year"];
  else $ye=$_GET["year"];
  if ($_GET["month"]=='') $mn=$today["mon"];
  else $mn=$_GET["month"];
  if ($_GET["mday"]=='') $dy=$today["mday"]-1;
  else $dy=$_GET["mday"];

  $qnt=90;
  for ($pm=1; $pm<=$qnt; $pm++)
    {
     $date[$cn]=sprintf ("%d-%02d-%02d 00:00:00",$ye,$mn,$dy);
     $dates[$cn]=sprintf ("%d%02d%02d000000",$ye,$mn,$dy);
     $dat[$cn]=sprintf ("%02d/%02d",$dy,$mn);

     $dy--; 
     if ($dy==0) 
        { 
         if ($mn>1) $mn--;
         else { $mn=12; $ye--; }

         $dy=31;
         if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
         if (!checkdate ($mn,29,$ye)) { $dy=28; }
         //echo $dy.'<br>';
        }
     $cn++;
    }

  if ($_GET["id"])  $query = 'SELECT * FROM ecm WHERE id='.$_GET["id"];
  else $query = 'SELECT * FROM ecm'; $first=0;
  //echo $query;
  print '<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	 <tbody><tr><td align="center" valign="middle"  colspan="3">
	 <table border="0" cellpadding="2" cellspacing="2"><tbody>';

  if ($e2 = mysql_query ($query,$i)) 
  while ($ui2 = mysql_fetch_row ($e2))
	{
	 $sumw=$sumg=$ithr0=$ithr1=$itecm0=$itecm1=$itecm2=0; $data_voda=0; $v=0;
	 $query = 'SELECT * FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
	 //echo $query;
	 if ($e3 = mysql_query ($query,$i))
	 while ($ui3 = mysql_fetch_row ($e3))
		{
    		 $sumw=$sumg=$ithr0=$ithr1=0; 
    		 for ($tn=1; $tn<=$qnt; $tn++) $data_ven[$tn]=$data_gor[$tn]=$data_elec[$tn]=$data_gas[$tn]=$datavoda[$tn]=$sum_ven[$tn]=$sum_gor[$tn]=$sum_voda[$tn]=0;
		 $device=$ui3[11]; $gor=$ui3[20]; $ven=$ui3[21]; $chan_elec=$ui3[22]; $chan_gas=$ui3[23]; $chan_voda=$ui3[24]; $elec=$ui3[15]; $gas=$ui3[16]; $voda=$ui3[17];

		 /*$query = 'SELECT SUM(W) FROM devices WHERE chan_elec='.$ui3[22];
		 if ($e4 = mysql_query ($query,$i))
		 if ($ui4 = mysql_fetch_row ($e4)) $sumw=$ui4[0];*/
		 $query = 'SELECT SUM(gas) FROM devices WHERE chan_gas='.$ui3[23];
		 if ($e4 = mysql_query ($query,$i))
		 if ($ui4 = mysql_fetch_row ($e4)) $sumg=$ui4[0];
		 /*$query = 'SELECT SUM(V) FROM devices WHERE chan_voda='.$ui3[24];
		 if ($e4 = mysql_query ($query,$i))
		 if ($ui4 = mysql_fetch_row ($e4)) $sumv=$ui4[0];*/

		 if (!$first)
			{
			 print '<tr class="BlockHeaderLeftRight" align="center"><td>Устройство</td><td>Ресурс</td><td>Норматив</td>';
			 for ($tn=1; $tn<=$qnt; $tn++)
			         print '<td>'.$dat[$tn].'</td>';
			 print '<td>Итого</td><td>В рублях</td></tr>';
			}
		 print '<tr class="BlockHeaderLeftRight" align="center"><td style="white-space:nowrap">'.$ui3[1].'</td>';

		 //$query = 'SELECT * FROM data WHERE (channel='.$gor.' OR channel='.$chan_voda.' OR channel='.$ven.' OR channel='.$chan_elec.' OR channel='.$chan_gas.') AND type=2 AND date>='.$startdate;
		 //$query = 'SELECT AVG(value) FROM data WHERE channel='.$gor.' AND type=2 AND value>0';
		 //if ($e = mysql_query ($query,$i))
		 //if ($ui = mysql_fetch_row ($e)) $avg_gor=$ui[0];

		 $query = 'SELECT * FROM data WHERE (channel='.$gor.' OR channel='.$chan_gas.') AND type=2';

		 //echo $query;
		 if ($e = mysql_query ($query,$i))
		 while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
			{
			 //echo $ui["date"];
			 $x=$qnt+1;
			 for ($tn=1; $tn<=$qnt; $tn++)
			     if ($ui["date"]==$date[$tn]) $x=$tn;

			 //if ($ui["channel"]==$chan_voda) { $datavoda[$x]=$ui["value"];  }
			 //if ($ui["channel"]==$ven) $data_ven[$x]=$ui["value"];
			 if ($ui["channel"]==$gor) $data_gor[$x]=$ui["value"];
			 //if ($ui["channel"]==$chan_elec) $data_elec[$x]=$ui["value"];
			 if ($ui["channel"]==$chan_gas) $data_gas[$x]=$ui["value"];
			 //if ($data_ven[$x]) echo $data_ven[$x];
			}		 
		 //print '<td>ЭЭ</td><td>'.($elec*24).'кВт</td>';
		 //for ($tn=1; $tn<=$qnt; $tn++) if ($data_gor[$tn]==0) $data_gor[$tn]=$avg_gor;

		 /*$query = 'SELECT * FROM devices WHERE chan_elec='.$chan_elec;
		 if ($e5 = mysql_query ($query,$i))
		 while ($ui5 = mysql_fetch_row ($e5)) 
			{
			 $query = 'SELECT * FROM data WHERE channel='.$ui5[21].' AND type=2 AND date>='.$startdate;
			 //echo $query;
			 if ($e6 = mysql_query ($query,$i))
			 while ($ui6 = mysql_fetch_row ($e6))
				{
				 $x=$qnt+1;
				 for ($tn=1
				 ; $tn<=$qnt; $tn++)
				     if ($ui6[2]==$date[$tn]) $x=$tn; 
				 $sum_ven[$x]+=$ui6[3]*$ui5[15];  // t * W
				 //echo '['.$x.'] t='.$ui6[3].' W='.$ui5[15].' '.$sum_ven[$x].'<br>';
				}
			}*/
		 $query = 'SELECT * FROM devices WHERE chan_gas='.$chan_gas;
		 if ($e5 = mysql_query ($query,$i))
		 while ($ui5 = mysql_fetch_row ($e5)) 
			{
			 $query = 'SELECT AVG(value) FROM data WHERE channel='.$ui5[20].' AND type=2 AND value>0';
    			 if ($e = mysql_query ($query,$i))
			 if ($ui = mysql_fetch_row ($e)) $avg_gor=$ui[0];
			 $query = 'SELECT * FROM data WHERE channel='.$ui5[20].' AND type=2';
			 if ($e6 = mysql_query ($query,$i))
			 while ($ui6 = mysql_fetch_row ($e6))
				{
				 $x=$qnt+1;
				 for ($tn=1; $tn<=$qnt; $tn++)
				     if ($ui6[2]==$date[$tn]) $x=$tn;
				 //echo $ui6[2].' '.$date[$tn].'<br>';
				 $sum_gor[$x]+=$ui6[3]*$ui5[16];  // t * Q
				 //if ($ui6[3]==0) { $sum_gor[$x]+=$avg_gor*$ui5[16]; /*echo  '='.number_format($avg_gor*$ui5[16],2).'<br>';*/ }
				 //echo '['.$x.'] t='.$ui6[3].' Q='.$ui5[16].' '.$sum_gor[$x].'<br>';
				}
			}
		 /*$query = 'SELECT * FROM devices WHERE chan_voda='.$chan_voda;
		 if ($e5 = mysql_query ($query,$i))
		 while ($ui5 = mysql_fetch_row ($e5)) 
			{
			 $query = 'SELECT * FROM data WHERE channel='.$ui5[20].' AND type=2 AND date>='.$startdate;
			 if ($e6 = mysql_query ($query,$i))
			 while ($ui6 = mysql_fetch_row ($e6))
				{
				 $x=$qnt+1;
				 for ($tn=1; $tn<=$qnt; $tn++)
				     if ($ui6[2]==$date[$tn]) $x=$tn; 
				 $sum_voda[$x]+=$ui6[3]*$ui5[17];  // t * W
				 //echo '['.$x.'] t='.$ui6[3].' W='.$ui5[15].' '.$sum_ven[$x].'<br>';
				}
			}*/
		 //$query = 'SELECT * FROM devices WHERE chan_gas='.$chan_gas;
		 //$v=$data_voda;
	       	 /*for ($tn=1; $tn<=$qnt; $tn++)
		    {
		     $v=($voda/$sumv)*$datavoda[$tn];
		     //echo $voda.' | '.$sumv.' | '.$datavoda[$tn].' | '.$data_ven[$tn].' | '.$sum_voda[$tn].'<br>';
		     $sum_v[$tn]+=$v;
		     $ithr2+=$v; $itecm2+=$v;
		    }*/
	       	 /*for ($tn=1; $tn<=$qnt; $tn++)
		    {
		     $w=$elec*$data_elec[$tn]*$data_ven[$tn]/($sum_ven[$tn]);
		     print '<td class="simple">'.number_format($w,3).'</td>';
		     $sum_w[$tn]+=$w;
		     $ithr1+=$w; $itecm1+=$w;
		    }*/
//	 	 print '<td class="simple">'.number_format($ithr1,2).'</td>';
//	 	 print '<td class="simple">'.number_format($ithr1*$tarif1,2).'</td></tr>';
//		 print '<tr align="center" class="BlockHeaderLeftRight"><td>Газ</td><td>'.($gas*24).'м3</td>';
		 print '<td>Газ</td><td>'.($gas*24).'м3</td>';
	       	 for ($tn=1; $tn<=$qnt; $tn++)
		    {
		     $g=$gas*$data_gas[$tn]*$data_gor[$tn]/($sum_gor[$tn]);
		     $k=$g/($gas*24);
		     //echo $gas.' | '.$sumg.' | '.$data_gas[$tn].' | '.$data_gor[$tn].' | '.$sum_gor[$tn].'<br>';
		     print '<td class="simple">'.number_format($k,3).'</td>';
		     $sum_g[$tn]+=$g;
		     $sum_g2[$tn]+=$gas*24;
		     $sum_g22+=$gas*24;
	             $ithr0+=$g; $ithr1+=$gas*24;
		    }
	 	 print '<td class="simple">'.number_format($ithr0,2).'</td>';
	 	 print '<td class="simple">'.number_format($ithr0/1000*$tarif3,0).'</td></tr>';
    		 //print '<tr><td colspan="29" class="BlockHeaderMiddle" style="padding-left: 22px;" align="center" height="20" valign="center"><span id="Label5">W '.$sumw.' | Q '.$sumg.'</span></td></tr>';
		 $first++;
		}
	}
/*  print '<tr align="center" class="BlockHeaderLeftRight"><td colspan="3" rowspan="2" valign="center" align="center">Итого</td>';
  $ithr1=$ithr0=0;
  for ($tn=1; $tn<=$dy; $tn++)
    {
     print '<td>'.number_format($sum_w[$tn],3).'</td>';
     $ithr1+=$sum_w[$tn];
    }
  print '<td>'.number_format($ithr1,2).'</td>';
  print '<td>'.number_format($ithr1*$tarif1,1).'</td></tr>';*/
  print '<tr align="center" class="BlockHeaderLeftRight"><td></td><td></td><td>'.number_format($sum_g22,2).'</td>';
  for ($tn=1; $tn<=$qnt; $tn++)
    {
     print '<td>'.number_format($sum_g[$tn],2).'</td>';
     //if ($tn%10) $reqq.='k'.$tn.'='.number_format($sum_g[$tn]/$sum_g2[$tn],2).'&';
     $reqq.='k'.$tn.'='.number_format($sum_g[$tn]/$sum_g2[$tn],2).'&';
     $ithr0+=$sum_g[$tn];
    }
  print '<td>'.number_format($ithr0,2).'</td>';
  print '<td>'.number_format($ithr1,2).'</td></tr>';
  print '</table></table>';
  print '<table><tr><td>';
  print '<img src="charts/trend10.php?'.$reqq.'">';
  print '</td></tr></table>';
 }

?>