<?php
 $qnt=15;
 if ($_POST["type"]==2 && $_COOKIE['name'])
     {
      //phpinfo();
      $cn=0; $today=getdate();
      $ye=$today["year"];
      $mn=$today["mon"];
      for ($tn=1; $tn<=$qnt; $tn++)
         {
          $year[$tn]=$ye; $mon[$tn]=$mn;
          $dats[$tn]=sprintf ("%d%02d%02d000000",$ye,$mn,1);
	  $mn--; if (!$mn) { $mn=12; $ye--; }
         }

      for ($tn=1; $tn<=$qnt; $tn++)
      for ($q=1; $q<=8; $q++)
	{
	 $f=$tn.'-'.$q;
	 //echo $f.'<br>';
	 if ($_POST[$f] || $_POST[$f]==0)
		{
		 if ($q>0 && $q<7) $query='SELECT * FROM tarifs WHERE date='.$dats[$tn];
    		 if ($q==7) $query = 'SELECT * FROM data WHERE prm=41 AND source=0 AND type=4 AND date=\''.$dats[$tn].'\' AND device=\'\'';
		 if ($q==8) $query = 'SELECT * FROM data WHERE prm=41 AND source=1 AND type=4 AND date=\''.$dats[$tn].'\' AND device=\'\'';
		 $e = mysql_query ($query,$i);
		 //echo $query.'<br>';
		 if ($q>0 || $q<7)
			{
			 if ($e) $ui = mysql_fetch_row ($e);
			 if ($ui) 
				{
				 if ($q==1 && $_POST[$f]!=$ui[10]) { $query='UPDATE tarifs SET date=date,gas='.$_POST[$f].' WHERE date='.$dats[$tn]; $e = mysql_query ($query,$i); }
				 if ($q==2 && $_POST[$f]!=$ui[4]) { $query='UPDATE tarifs SET date=date,elec='.$_POST[$f].' WHERE date='.$dats[$tn]; $e = mysql_query ($query,$i); }
				 if ($q==3 && $_POST[$f]!=$ui[9]) { $query='UPDATE tarifs SET date=date,par='.$_POST[$f].' WHERE date='.$dats[$tn]; $e = mysql_query ($query,$i); }
				 if ($q==4 && $_POST[$f]!=$ui[6]) { $query='UPDATE tarifs SET date=date,hvs='.$_POST[$f].' WHERE date='.$dats[$tn]; $e = mysql_query ($query,$i); }
				 if ($q==5 && $_POST[$f]!=$ui[11]) { $query='UPDATE tarifs SET date=date,vodootv='.$_POST[$f].' WHERE date='.$dats[$tn]; $e = mysql_query ($query,$i); }
				 if ($q==6 && $_POST[$f]!=$ui[12]) { $query='UPDATE tarifs SET date=date,salt='.$_POST[$f].' WHERE date='.$dats[$tn]; $e = mysql_query ($query,$i); }
        			 //echo $query;
        			 
				 if ($q==1 && $_POST[$f]!=$ui[10]) { $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="change parametr [Tarif::Gas] on '.$ui[2].'/'.$ui[1].' from '.$ui[10].' to '.$_POST[$f].'"'; mysql_query ($query,$i); }
				 if ($q==2 && $_POST[$f]!=$ui[4]) { $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="change parametr [Tarif::Energy] on '.$ui[2].'/'.$ui[1].' from '.$ui[4].' to '.$_POST[$f].'"'; mysql_query ($query,$i); }
				 if ($q==3 && $_POST[$f]!=$ui[9]) { $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="change parametr [Tarif::Par] on '.$ui[2].'/'.$ui[1].' from '.$ui[9].' to '.$_POST[$f].'"'; mysql_query ($query,$i); }
				 if ($q==4 && $_POST[$f]!=$ui[6]) { $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="change parametr [Tarif::HVS] on '.$ui[2].'/'.$ui[1].' from '.$ui[6].' to '.$_POST[$f].'"'; mysql_query ($query,$i); }
				 if ($q==5 && $_POST[$f]!=$ui[11]) { $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="change parametr [Tarif::Vodootvedenie] on '.$ui[2].'/'.$ui[1].' from '.$ui[11].' to '.$_POST[$f].'"'; mysql_query ($query,$i); }
    				 if ($q==6 && $_POST[$f]!=$ui[12]) { $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="change parametr [Tarif::Salt] on '.$ui[2].'/'.$ui[1].' from '.$ui[12].' to '.$_POST[$f].'"'; mysql_query ($query,$i); }
        			 //echo $query;
				 mysql_query ($query,$i);
				}
			 else
				{
				 if ($q==1) $query='INSERT INTO tarifs SET gas='.$_POST[$f].',date='.$dats[$tn].',year='.$year[$tn].',month='.$mon[$tn];
				 if ($q==2) $query='INSERT INTO tarifs SET elec='.$_POST[$f].',date='.$dats[$tn].',year='.$year[$tn].',month='.$mon[$tn];
				 if ($q==3) $query='INSERT INTO tarifs SET par='.$_POST[$f].',date='.$dats[$tn].',year='.$year[$tn].',month='.$mon[$tn];
				 if ($q==4) $query='INSERT INTO tarifs SET hvs='.$_POST[$f].',date='.$dats[$tn].',year='.$year[$tn].',month='.$mon[$tn];
				 if ($q==5) $query='INSERT INTO tarifs SET vodoot='.$_POST[$f].',date='.$dats[$tn].',year='.$year[$tn].',month='.$mon[$tn];
				 if ($q==6) $query='INSERT INTO tarifs SET salt='.$_POST[$f].',date='.$dats[$tn].',year='.$year[$tn].',month='.$mon[$tn];
				 $e = mysql_query ($query,$i);
				}
			 //echo $query.'<br>';
			}
		 if ($q==7 || $q==8)
			{				
			 if ($e) $ui = mysql_fetch_row ($e);
			 if ($ui) $query = 'UPDATE data SET date=\''.$dats[$tn].'\', value=\''.$_POST[$f].'\' WHERE prm=41 AND type=4 AND source='.($q-7).' AND device=0 AND date='.$dats[$tn];
			 else  $query = 'INSERT INTO data SET value=\''.$_POST[$f].'\',prm=41,type=4,source='.($q-7).',device=0,date='.$dats[$tn];
			 $e = mysql_query ($query,$i);
			 //echo $query.'<br>';
			 if ($q==7 && $_POST[$f]!=$ui[3]) { $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="change data [Vodootv] on '.$ui[2].' from '.$ui[3].' to '.$_POST[$f].'"'; mysql_query ($query,$i); $query=''; }
			 if ($q==8 && $_POST[$f]!=$ui[3]) { $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="change data [Salt] on '.$ui[2].' from '.$ui[3].' to '.$_POST[$f].'"'; mysql_query ($query,$i); $query=''; }
			 //mysql_query ($query,$i); 
			}
		} 
	}
    }
?>

<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">
<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="top">

<div id="maincontent" >
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody>
<tr>
<td>
<table border="0" cellpadding="0" cellspacing="1" width="980">
<tbody>
<tr class="BlockHeaderLeftRight"><td align="center"><font style="font-color:white"><a href="index.php?sel=eco&id=1&hide=1">hide</a></td><td align="center"><font style="color:white"><a href="index.php?sel=eco&id=1">all</a></td><td align="center" width="80%" style="background-color:white"></td></tr>

<?php
$today=getdate();
if ($_GET["id"]=='1') 
    {
     //print '<img src="files/pict1.jpg">';
     include ("ecm_eco3.php");
    }
if ($_GET["id"]=='8') 
    {
     //print '<img src="files/pict1.jpg">';
     include ("ecm_eco8.php");
    }

if ($_GET["id"]=='2') 
    {
     $cn=0; $today=getdate();
     if ($_GET["year"]=='') $ye=$today["year"];
     else $ye=$_GET["year"];
     if ($_GET["month"]=='') $mn=$today["mon"];
     else $mn=$_GET["month"];
     $startdate=sprintf ("%d0101000000",$ye);
     for ($tn=1; $tn<=$qnt; $tn++)
        {
	 $month=$mn;
	 include ("time.inc");
	 $dat[$tn]=$month.' '.$ye;
	 $dats[$tn]=sprintf ("%d%02d%02d000000",$ye,$mn,1);
	 $date[$tn]=sprintf ("%d-%02d-%02d 00:00:00",$ye,$mn,1);
	 //echo $date[$tn];
	 $mn--; if (!$mn) { $mn=12; $ye--; }
	}
     print '<tr class="BlockHeaderLeftRight" align="center"><td width="250px">Ресурс</td>';
     for ($tn=$qnt; $tn>=1; $tn--)
        {
         print '<td><a href="index.php?sel=ecm2&type=2&month='.$tn.'" style="color:white">'.$dat[$tn].'</a></td>';
        }
     print '</tr>';

     $query = 'SELECT * FROM tarifs';
     if ($e = mysql_query ($query,$i))
     while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
	{
	 $x=$qnt+1;
	 //echo $ui["date"].' '.$date[2].'<br>';
	 for ($tn=1; $tn<=$qnt; $tn++)
	     if ($ui["date"]==$date[$tn]) $x=$tn;
	 // echo $x.'<br>';
	 $gas[$x]=$ui["gas"];
	 $elec[$x]=$ui["elec"];
	 $par[$x]=$ui["par"];
	 $hvs[$x]=$ui["hvs"];
	 $vodootv[$x]=$ui["vodootv"];
	 $salt[$x]=$ui["salt"];
	}

     $query = 'SELECT * FROM data WHERE prm=41 AND type=4';
     //echo $query;
     if ($e = mysql_query ($query,$i))
     while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
	{
	 $x=$qnt+1;
	 for ($tn=1; $tn<=$qnt; $tn++)
	     if ($ui["date"]==$date[$tn]) $x=$tn;
	 //echo $ui["prm"];
	 if ($ui["prm"]==41 && $ui["source"]==0) $val5[$x]=$ui["value"];
	 if ($ui["prm"]==41 && $ui["source"]==1) $val6[$x]=$ui["value"];
	}
     print '<form name="frm2" method="post" action="index.php?sel=eco&id=2" id="frm">';
     print '<input name="type" type="hidden" value="2">';
     print '<tr class="BlockHeaderLeftRight" align="center">';
     print '<td colspan='.($qnt+1).' align="center">Тарифы</td>';
     print '</tr>';
     print '<tr class="BlockHeaderLeftRight" align="center"><td width="250px">Природный газ</td>';
     for ($tn=$qnt; $tn>=1; $tn--) { print '<td><input name="'.$tn.'-1" class="simple2" value="'.$gas[$tn].'"></td>'; $name1.='&mon'.$tn.'='.$dat[$tn].'&dat'.$tn.'='.$gas[$tn];}
     print '</tr>';
     print '<tr class="BlockHeaderLeftRight" align="center"><td>Электроэнергия</td>';
     for ($tn=$qnt; $tn>=1; $tn--) { print '<td><input name="'.$tn.'-2" class="simple2" value="'.$elec[$tn].'"></td>'; $name2.='&mon'.$tn.'='.$dat[$tn].'&dat'.$tn.'='.$elec[$tn]; }
     print '</tr>';
     print '<tr class="BlockHeaderLeftRight" align="center"><td>Водяной пар</td>';
     for ($tn=$qnt; $tn>=1; $tn--) { print '<td><input name="'.$tn.'-3" class="simple2" value="'.$par[$tn].'"></td>'; $name3.='&mon'.$tn.'='.$dat[$tn].'&dat'.$tn.'='.$par[$tn]; }
     print '</tr>';
     print '<tr class="BlockHeaderLeftRight" align="center"><td>Холодноеводоснабжение</td>';
     for ($tn=$qnt; $tn>=1; $tn--) print '<td><input name="'.$tn.'-4" class="simple2" value="'.$hvs[$tn].'"></td>';
     print '</tr>';
     print '<tr class="BlockHeaderLeftRight" align="center"><td>Сточные воды</td>';
     for ($tn=$qnt; $tn>=1; $tn--) print '<td><input name="'.$tn.'-5" class="simple2" value="'.$vodootv[$tn].'"></td>';
     print '</tr>';
     print '<tr class="BlockHeaderLeftRight" align="center"><td>Соль(водоподготовка)</td>';
     for ($tn=$qnt; $tn>=1; $tn--) print '<td><input name="'.$tn.'-6" class="simple2" value="'.$salt[$tn].'"></td>';
     print '</tr>';
     print '<tr class="BlockHeaderLeftRight" align="center">';
     print '<td colspan='.($qnt+1).' align="center">Потребление</td>';
     print '</tr>';

     print '<tr class="BlockHeaderLeftRight" align="center"><td>Сточные воды</td>';
     for ($tn=$qnt; $tn>=1; $tn--) print '<td><input name="'.$tn.'-7" class="simple2" value="'.$val5[$tn].'"></td>';
     print '</tr>';
     print '<tr class="BlockHeaderLeftRight" align="center"><td>Соль(водоподготовка)</td>';
     for ($tn=$qnt; $tn>=1; $tn--) print '<td><input name="'.$tn.'-8" class="simple2" value="'.$val6[$tn].'"></td>';
     print '</tr>';
     print '</table><input type="submit" value="ok"></form></table>';
     print '<table>';
     print '<tr><td><img src="charts/barplots_tarif.php?name=Цена на природный газ'.$name1.'"></td></tr>';
     print '<tr><td><img src="charts/barplots_tarif.php?name=Цена на электроэнергию'.$name2.'"></td></tr>';
     print '<tr><td><img src="charts/barplots_tarif.php?name=Цена на водяной пар'.$name3.'"></td></tr>';
     print '</table>';
  }

if ($_GET["id"]=='3') 
    {
    
     print '<img src="files/pict3.jpg">';
    }
if ($_GET["id"]=='4')
	{
	 print '<table><tr>';
	 $mn=$today["mon"];
	 for ($pm=1; $pm<=12; $pm++)
	    {
	     $req='';
	     $data1[$cn]=$data0[$cn]=0; 
	     //echo $mn;
	     $month=$mn;  include ("time.inc");
	     $dd=$month.'/'.$today["year"];
	     $date1=sprintf ("%d%02d01000000",$today["year"],$mn);
	     $date2=sprintf ("%d%02d01000000",$today["year"],$mn+1);
	     $query = 'SELECT SUM(value) FROM data WHERE type=2 AND prm=14 AND date>='.$date1.' AND date<'.$date2;
	     if ($a = mysql_query ($query,$i))
	     if ($uy = mysql_fetch_row ($a)) $data0[$cn]=$uy[0];
	     $query = 'SELECT SUM(value) FROM data WHERE type=2 AND prm=11 AND date>='.$date1.' AND date<'.$date2;
	     //echo $query;
	     if ($a = mysql_query ($query,$i))
	     if ($uy = mysql_fetch_row ($a)) $data1[$cn]=$uy[0];
	     $query = 'SELECT SUM(value) FROM data WHERE type=2 AND prm=12 AND date>='.$date1.' AND date<'.$date2;
	     if ($a = mysql_query ($query,$i))
	     if ($uy = mysql_fetch_row ($a)) $data3[$cn]=$uy[0];
	     $data2[$cn]=$data4[$cn]=0;

	     $query = 'SELECT * FROM data2 WHERE type=4 AND device=0 AND date='.$date1;
	     if ($a = mysql_query ($query,$i))
	     while ($uy = mysql_fetch_row ($a))
	      	{
	       	 if ($uy[8]==14 && $uy[6]==0) $data0[$cn]+=$uy[3];
	       	 if ($uy[8]==14 && $uy[6]==0) $data0[$cn]+=$uy[3];
	       	 if ($uy[8]==15 && $uy[6]==0) $data2[$cn]+=$uy[3];
	       	 if ($uy[8]==15 && $uy[6]==1) $data2[$cn]+=$uy[3];

	       	 if ($uy[8]==13 && $uy[6]==3) $data4[$cn]=$uy[3];
	       	 if ($uy[8]==11 && $uy[6]==8) $data1[$cn]+=$uy[3];
	       	 if ($uy[8]==11 && $uy[6]==9) $data1[$cn]+=$uy[3];

	       	 if ($uy[8]==12 && $uy[6]==5) $data3[$cn]+=$uy[3];
	      	}

	     $query = 'SELECT * FROM tarifs WHERE date='.$date1;
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

	     $data0[$cn]*=$tarif_elec[$cn]; $data1[$cn]*=$tarif_gas[$cn]; $data2[$cn]*=$tarif_par[$cn]; $data3[$cn]*=$tarif_hvs[$cn]; $data4[$cn]*=$tarif_vodootv[$cn];
    	     $req.='dat1=Газ,'.$dd.'&dat2=Электроэнергия&dat3=Пар&dat4=Вода&dat5=Тепло&';
	     $req.='da1='.$data1[$cn].'&da2='.$data0[$cn].'&da3='.$data2[$cn].'&da4='.$data3[$cn].'&da5='.$data4[$cn];
	     if ($data1[$cn])
	        {
	         print '<td><img src="charts/pieplot22.php?'.$req.'"></td>';
	         $cn++;
	         if ($cn%4==0) print '</tr><tr>';
	        }
	     if ($mn>1) $mn--;
	     else 
	        {
	    	 $today["year"]--;
	    	 $mn=12;
	    	}
	    }
	 print '</td></tr></table>';
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