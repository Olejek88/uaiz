<?php
 $today=getdate();
 if ($_GET["year"]=='') $ye=$today["year"]; else $ye=$_GET["year"];
 if ($_GET["month"]=='') $mn=$today["mon"]; else $mn=$_GET["month"];

 for ($tm=1; $tm<=12; $tm++) $data2[$tm]=$data1[$tm]=$data0[$tm]=0;
 $tm=$today["mon"];
 for ($pm=1; $pm<=12; $pm++)
    {	 
     $tod=31;
     if (!checkdate ($tm,31,$today["year"])) { $tod=30; }
     if (!checkdate ($tm,30,$today["year"])) { $tod=29; }
     if (!checkdate ($tm,29,$today["year"])) { $tod=28; }
     $sts=sprintf("%d%02d01000000",$today["year"],$tm); $fns=sprintf("%d%02d01000000",$today["year"],$tm+1);


         $query = 'SELECT COUNT(id) FROM device WHERE type=5';
	 $a = mysql_query ($query,$i); $uy = mysql_fetch_row ($a); 
	 if ($tm==$today["mon"]) $numm=($today["mday"]-1)*$uy[0]; else $numm=31*$uy[0];
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND flat=0 AND prm=13 AND source=2 AND value>0.1';
	 //echo $query.'<br>';
	 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); $data1[$cn]=$ui[0]; $cntid=$ui[1];
//	 echo $data1[$cn].' '.$cntid.'<br>';
	 if ($cn==0) 
	    {
	     $query = 'SELECT AVG(value) FROM data WHERE date>'.$sts.' AND date<'.$fns.' AND type=2 AND flat=0 AND prm=13 AND source=2';
	     $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); //$data1[$cn]+=$ui[0]*7;
	    }
	    
         if ($_GET["obj"]==1) $query = 'SELECT SUM(value),COUNT(id),AVG(value) FROM prdata WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND (prm=13 OR prm=11) AND value>10';
	 else $query = 'SELECT SUM(value),COUNT(id),AVG(value) FROM prdata WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND value>5';
	 $e = mysql_query ($query,$i);
	 $ui = mysql_fetch_row ($e); 
	 //echo $query.'<br>';	
//	 echo $numm.' '.$ui[0].' '.$ui[1].' '.$ui[2].'<br>';

   	    //if ($tm==$today["mon"] && $tm>5) $ui[0]=$ui[0]+($numm-$ui[1])*$ui[2];
	    //else if ($tm>2 && $tm<5) 
	    $ui[0]=$ui[0]+($numm-$ui[1])*$ui[2];
	    
	    $data2[$cn]=($ui[0]/4184); 
	    $data9[$cn]=$data1[$cn];
	    if ($data1[$cn]-$data2[$cn]>0) $data1[$cn]=$data1[$cn]-$data2[$cn]; 
	    else { $data2[$cn]=$data1[$cn]; $data1[$cn]=0; }

	    if ($cntid>28) $data0[$cn]=0.0322*$sum0;
	    else $data0[$cn]=($cntid/31)*0.0322*$sum0;
	    //if ($data2[$cn]>$data1[$cn]) 

	    if ($data0[$cn]>0) $pr[$cn]=($data0[$cn]-$data9[$cn])*100/$data0[$cn];
	    else $pr[$cn]=100;
	    $rub[$cn]=537*($data0[$cn]-$data9[$cn]);
     include("time.inc");
     if ($tm>1) $tm--;
     else { $tm=12; $today["year"]--; }
     $cn++;
  }
?>