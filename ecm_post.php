<style type="text/css">
.BlockHeaderLeftRight { font-size: 9px; }
.simple { font-size: 9px; }
.simple2 { font-size: 9px;  background-color: #efefef; width:70px}
</style>

<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<form name="frm1" method="post" action="index.php?sel=ecm_post"><tbody>
<input name="type" type="hidden" value="5">

<tr><td align="center" bgcolor="#ffffff" valign="middle" colspan="4">
<table><tr><td width="1200px">
<table border="0" cellpadding="2" cellspacing="2" width="100%"><tbody>

<?php
//-----------------------------------------------------------------------------------------------------------------------------------------
function  StoreDataReg ($i, $prm, $channel, $type, $date, $source, $value1, $value2, $comment, $visa1, $visa2)
{
 $query = 'SELECT * FROM data WHERE prm='.$prm.' AND channel='.$channel.' AND type='.$type.' AND source='.$source.' AND date='.$date;
 //echo $query;
 if ($e6 = mysql_query ($query,$i)) $ui6 = mysql_fetch_row ($e6);
 if (!$ui6[0])
    {
     //echo 'b'.$value1.' '.$ui6[3].'<br>';
     if ($value1>=0)
	{ 
    	 $query = 'INSERT INTO data SET status=1, prm='.$prm.', channel='.$channel.', source='.$source.', type='.$type.', date='.$date.',value='.$value1; 
	 if ($visa1 || $visa2) print '<tr><td class="simple" bgcolor="#f881b6">Not permitted: '.$query.'</td></tr>'; 
	 else 
	    { 
	     print '<tr><td class="simple">'.$query.'</td></tr>'; 
	     $e6 = mysql_query ($query,$i);
    	     $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", channel="'.$channel.'", value1="'.$ui6[3].'", value2="'.$value1.'", comment="'.$value2.'", what="добавлено '.$comment.'"'; 
	     //echo $query;
	     $e6 = mysql_query ($query,$i);
	    }
    	}
    }
  else
    { 
     //echo 'c'.$value1.' '.$ui6[3].'<br>';
     if ($value1!=$ui6[3]) 
        { 
         $query = 'UPDATE data SET status=1, prm='.$prm.', channel='.$channel.', source='.$source.', type='.$type.', date='.$date.',value='.$value1.' WHERE prm='.$prm.' AND source='.$source.' AND channel='.$channel.' AND type='.$type.' AND date='.$date; 
	 if ($visa1 || $visa2) print '<tr><td class="simple" bgcolor="#f881b6">Not permitted: '.$query.'</td></tr>'; 
	 else 
	    { 
	     print '<tr><td class="simple">'.$query.'</td></tr>'; 
	     $e6 = mysql_query ($query,$i);
             $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", channel='.$channel.', value1='.$ui6[3].', value2='.$value1.', comment="'.$value2.'", what="изменено '.$comment.'"'; 
             //echo $query;
	     $e6 = mysql_query ($query,$i);
	    }
        }
     }
}
//-----------------------------------------------------------------------------------------------------------------------------------------
// phpinfo();
  $qnt=6;
  $today=getdate();
  if ($_GET["year"]=='') $ye=2013;
  else $ye=$_GET["year"];
  if ($_GET["month"]=='') { if ($today["mon"]>1) $mn=$today["mon"]-1; else { $ye=2013; $mn=$today["mon"]=12; } }
  else $mn=$_GET["month"];

  $cn=$qnt;
  for ($pm=1; $pm<=$qnt; $pm++)
    {	     	
     $date[$cn]=sprintf ("%d-%02d-01",$ye,$mn);   
     $dates[$cn]=sprintf ("%d%02d01000000",$ye,$mn);   
     $dates2[$cn]=sprintf ("%d%02d01000000",$ye,$mn+1);   

     $query = 'SELECT * FROM reports WHERE date='.$dates[$cn];
     if ($e2 = mysql_query ($query,$i)) 
     if ($ui2 = mysql_fetch_row ($e2))
        {
	 $visa1[$cn]=$ui2[2];
	 $visa2[$cn]=$ui2[4];
	 if ($visa1[$cn]==1) $visa[$cn]='<td class="simple" style="background-color: lightred" align="center">ЕСТЬ</td>';
	 else $visa[$cn]='<td class="simple" style="background-color: green" align="center">НЕТ</td>';
	 if ($visa2[$cn]==1) $visa[$cn].='<td class="simple" style="background-color: lightred" align="center">ЕСТЬ</td>';
	 else $visa[$cn].='<td class="simple" style="background-color: green" align="center">НЕТ</td>';
	}

     $tm=$mn;
     include ("time.inc");
     $dats[$cn]=$dat[$cn].' '.$ye;
     $mn--; if ($mn==0) { $mn=12; $ye--; $pims=$pm; }
     $cn--;
    }
//--------------------------------------------------------------------------------------------------------------------------------------------------
if ($_POST["type"]=='5')
if ($_COOKIE["name"] && $_COOKIE["id"])
{
 $cn=1; $qnt3=0;
 $query = 'SELECT * FROM ecm WHERE id1>0 ORDER BY id1';
 if ($e2 = mysql_query ($query,$i)) 
 while ($ui2 = mysql_fetch_row ($e2))
	{
	 $ccn=$cn;
	 for ($tn=1; $tn<=$qnt; $tn++) 
		{
	 	 $f=$ui2[0].'-'.$tn.'-2-2'; $f2=$ui2[0].'-'.$tn.'-2-26'; $comment=' нормативное количество часов работы за '.$date[$tn];
		 if ($_POST[$f2]) StoreDataReg ($i, 2, 300, 4, $dates[$tn], $ui2[0], $_POST[$f], $_POST[$f2], $comment, $visa1[$tn], $visa2[$tn]);
		}
	 $query = 'SELECT * FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
	 if ($e3 = mysql_query ($query,$i))
	 while ($ui3 = mysql_fetch_row ($e3))
		{
		 $devid=$ui3[0]; $gor=$ui3[20]; $ven=$ui3[21]; $elec=$ui3[28]; $gas=$ui3[29]; $voda=$ui3[17]; $par=$ui3[26]; $par2=$ui3[27];
    		 //echo '['.$cn.'] '.$gor.' '.$ven.'<br>';
		 for ($tn=1; $tn<=$qnt; $tn++) 
			{
		 	 $f=$cn.'-'.$tn.'-2-0'; $f2=$cn.'-'.$tn.'-2-6'; $comment=' количество часов работы горелки за '.$date[$tn];
			 if ($_POST[$f2]) StoreDataReg ($i, 2, $gor, 4, $dates[$tn], 0, $_POST[$f], $_POST[$f2], $comment, $visa1[$tn], $visa2[$tn]);
		 	 $f=$cn.'-'.$tn.'-2-1'; $f2=$cn.'-'.$tn.'-2-16'; $comment=' количество часов работы вентилятора за '.$date[$tn];
			 if ($_POST[$f2]) StoreDataReg ($i, 2, $ven, 4, $dates[$tn], 0, $_POST[$f], $_POST[$f2], $comment, $visa1[$tn], $visa2[$tn]);
			}
		 //$f=$ccn.'-1-0'; if ($elec!=$_POST[$f]) { $query = 'UPDATE devices SET elec='.$_POST[$f].' WHERE id='.$ui3[0]; $e6 = mysql_query ($query,$i); echo $query.'<br>'; }
		 //$f=$ccn.'-1-1'; if ($gas!=$_POST[$f]) { $query = 'UPDATE devices SET gas='.$_POST[$f].' WHERE id='.$ui3[0]; $e6 = mysql_query ($query,$i); echo $query.'<br>'; }
		 //$f=$ccn.'-1-2'; if ($par!=$_POST[$f]) { $query = 'UPDATE devices SET par='.$_POST[$f].' WHERE id='.$ui3[0]; $e6 = mysql_query ($query,$i); echo '['.$par.' | '.$_POST[$f].']'.$query.'<br>'; }
		 //$f=$ccn.'-1-3'; if ($par2!=$_POST[$f]) { $query = 'UPDATE devices SET par2='.$_POST[$f].' WHERE id='.$ui3[0]; $e6 = mysql_query ($query,$i); echo $query.'<br>'; }
		 $cn++;
		}
	 $qnt3++;
	}
 $qnt3--;
 
 for ($tn=1; $tn<=$qnt; $tn++)
	{
 	 $f=$tn.'-11-10'; $f2=$tn.'-11-17'; $comment=' количество потребленной воды за '.$date[$tn];
	 if ($_POST[$f] && $_POST[$f2]) StoreDataReg ($i, 12, 111, 4, $dates[$tn], 0, $_POST[$f], $_POST[$f2], $comment);
 	 $f=$tn.'-41-0'; $f2=$tn.'-41-17'; $comment=' водоотведение за '.$date[$tn];
	 if ($_POST[$f] && $_POST[$f2]) StoreDataReg ($i, 41, 112, 4, $dates[$tn], 0, $_POST[$f], $_POST[$f2], $comment);
 	 $f=$tn.'-41-2'; $f2=$tn.'-41-27'; $comment=' водоотведение за '.$date[$tn];
	 if ($_POST[$f] && $_POST[$f2]) StoreDataReg ($i, 41, 113, 4, $dates[$tn], 2, $_POST[$f], $_POST[$f2], $comment);
	} 
}
//--------------------------------------------------------------------------------------------------------------------------------------------------

if ($_POST["type"]=='4')
{
 print '<tr class="BlockHeaderLeftRight" align="center">
	<td>Visa1</td>
	<td>Visa2</td>
	<td style="width: 100px">Кто</td>
	<td>Дата</td>
	<td>Параметр - канал</td>
	<td>Номер канала</td>
	<td>Значение было</td>
	<td>Значение стало</td>
	<td>Причина изменения</td></tr>';
 $cn=1; $qnt3=0;
 $query = 'SELECT * FROM ecm WHERE id1>0 ORDER BY id1';
 if ($e2 = mysql_query ($query,$i)) 
 while ($ui2 = mysql_fetch_row ($e2))
	{
	 $ccn=$cn;
	 $query = 'SELECT COUNT(id) FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
	 if ($e3 = mysql_query ($query,$i))
	 if ($ui3 = mysql_fetch_row ($e3)) $count=$ui3[0];

	 if ($count)
	 for ($tn=1; $tn<=$qnt; $tn++) 
		{
	 	 $f=$ui2[0].'-'.$tn.'-2-2'; 
		 $query = 'SELECT * FROM data WHERE prm=2 AND channel=300 AND source='.$ui2[0].' AND type=4 AND date='.$dates[$tn];
		 //echo $query.'<br>';
		 if ($e6 = mysql_query ($query,$i)) $ui6 = mysql_fetch_row ($e6);
	         if (!$ui6 || ($ui6 && $_POST[$f]!=number_format($ui6[3],3)))
		    {
		     print '<tr>'.$visa[$tn].'<td class="simple">'.$_COOKIE['name'].'</td><td class="simple">'.$date[$tn].'</td><td class="simple">Время работы нормативное '.$ui2[1].'</td><td class="simple">-</td>
			    <td><input id="'.$ui2[0].'-'.$tn.'-2-25" name="'.$ui2[0].'-'.$tn.'-2-25" class="simple2" value="'.$ui6[3].'" align="center"></td>
			    <td><input id="'.$ui2[0].'-'.$tn.'-2-2" name="'.$ui2[0].'-'.$tn.'-2-2" class="simple2" value="'.$_POST[$f].'" align="center"></td>
			    <td><input id="'.$ui2[0].'-'.$tn.'-2-26" name="'.$ui2[0].'-'.$tn.'-2-26" class="simple2" style="width:250px" align="center"></td></tr>';
		    }
		}
	 $query = 'SELECT * FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
	 if ($e3 = mysql_query ($query,$i))
	 while ($ui3 = mysql_fetch_row ($e3))
		{
		 $devid=$ui3[0]; $gor=$ui3[20]; $ven=$ui3[21]; $elec=$ui3[28]; $gas=$ui3[29]; $voda=$ui3[17]; $par=$ui3[26]; $par2=$ui3[27];
		 //echo '*['.$cn.'] '.$gor.' '.$ven.'<br>';
		 for ($tn=1; $tn<=$qnt; $tn++) 
			{
		 	 $f=$cn.'-'.$tn.'-2-0'; 
			 $query = 'SELECT * FROM data WHERE prm=2 AND channel='.$gor.' AND type=4 AND date='.$dates[$tn];
			 //echo $query.'<br>';
			 if ($e6 = mysql_query ($query,$i)) $ui6 = mysql_fetch_row ($e6);
		         if (!$ui6 || ($ui6 && $_POST[$f]!=number_format($ui6[3],3)))
			    {
			     print '<tr>'.$visa[$tn].'<td class="simple">'.$_COOKIE['name'].'</td><td class="simple">'.$date[$tn].'</td><td class="simple">Время работы горелки '.$ui3[1].'</td><td class="simple">'.$gor.'</td>
				    <td><input id="'.$cn.'-'.$tn.'-2-5" name="'.$cn.'-'.$tn.'-2-5" class="simple2" value="'.$ui6[3].'" align="center"></td>
				    <td><input id="'.$cn.'-'.$tn.'-2-0" name="'.$cn.'-'.$tn.'-2-0" class="simple2" value="'.$_POST[$f].'" align="center"></td>
				    <td><input id="'.$cn.'-'.$tn.'-2-6" name="'.$cn.'-'.$tn.'-2-6" class="simple2" style="width:250px" align="center"></td></tr>';
			    }
			}
		 for ($tn=1; $tn<=$qnt; $tn++) 
			{
		 	 $f=$cn.'-'.$tn.'-2-1'; 
			 $query = 'SELECT * FROM data WHERE prm=2 AND channel='.$ven.' AND type=4 AND date='.$dates[$tn];
			 //echo $query.'<br>';
			 if ($e6 = mysql_query ($query,$i)) $ui6 = mysql_fetch_row ($e6);
		         if (!$ui6 || ($ui6 && $_POST[$f]!=number_format($ui6[3],3)))
			    {
			     print '<tr>'.$visa[$tn].'<td class="simple">'.$_COOKIE['name'].'</td><td class="simple">'.$date[$tn].'</td><td class="simple">Время работы вентилятора '.$ui3[1].'</td><td class="simple">'.$ven.'</td>
				    <td><input id="'.$cn.'-'.$tn.'-2-15" name="'.$cn.'-'.$tn.'-2-15" class="simple2" value="'.$ui6[3].'" align="center"></td>
				    <td><input id="'.$cn.'-'.$tn.'-2-1" name="'.$cn.'-'.$tn.'-2-1" class="simple2" value="'.$_POST[$f].'" align="center"></td>
				    <td><input id="'.$cn.'-'.$tn.'-2-16" name="'.$cn.'-'.$tn.'-2-16" class="simple2" style="width:250px" align="center"></td></tr>';
			    }
			}

		 $f=$ccn.'-1-0'; $tn=1;
		 if ($elec!=$_POST[$f])
		     print '<tr><td class="simple" style="background-color: lightred" align="center">ЕСТЬ</td><td class="simple" style="background-color: lightred" align="center">ЕСТЬ</td><td class="simple">'.$_COOKIE['name'].'</td><td class="simple">'.$date[$tn].'</td><td class="simple">Базисный удельный расход электричества '.$ui3[1].'</td><td class="simple">-</td>
			    <td><input id="'.$cn.'-1-10" name="'.$cn.'-1-10" class="simple2" value="'.$elec.'" align="center"></td>
			    <td><input id="'.$cn.'-1-0" name="'.$cn.'-1-0" class="simple2" value="'.$_POST[$f].'" align="center"></td>
			    <td><input id="'.$cn.'-1-11" name="'.$cn.'-1-11" class="simple2" style="width:250px" align="center"></td></tr>';
		 $f=$ccn.'-1-1'; 
		 if ($gas!=$_POST[$f])
		     print '<tr><td class="simple" style="background-color: lightred" align="center">ЕСТЬ</td><td class="simple" style="background-color: lightred" align="center">ЕСТЬ</td><td class="simple">'.$_COOKIE['name'].'</td><td class="simple">'.$date[$tn].'</td><td class="simple">Базисный удельный расход электричества '.$ui3[1].'</td><td class="simple">-</td>
			    <td><input id="'.$cn.'-1-12" name="'.$cn.'-1-12" class="simple2" value="'.$gas.'" align="center"></td>
			    <td><input id="'.$cn.'-1-1" name="'.$cn.'-1-1" class="simple2" value="'.$_POST[$f].'" align="center"></td>
			    <td><input id="'.$cn.'-1-13" name="'.$cn.'-1-13" class="simple2" style="width:250px" align="center"></td></tr>';
		 $f=$ccn.'-1-2'; 
		 if ($par!=$_POST[$f])
		     print '<tr><td class="simple" style="background-color: lightred" align="center">ЕСТЬ</td><td class="simple" style="background-color: lightred" align="center">ЕСТЬ</td><td class="simple">'.$_COOKIE['name'].'</td><td class="simple">'.$date[$tn].'</td><td class="simple">Базисный удельный расход электричества '.$ui3[1].'</td><td class="simple">-</td>
			    <td><input id="'.$cn.'-1-14" name="'.$cn.'-1-14" class="simple2" value="'.$par.'" align="center"></td>
			    <td><input id="'.$cn.'-1-2" name="'.$cn.'-1-2" class="simple2" value="'.$_POST[$f].'" align="center"></td>
			    <td><input id="'.$cn.'-1-15" name="'.$cn.'-1-15" class="simple2" style="width:250px" align="center"></td></tr>';
		 $f=$ccn.'-1-3'; 
		 if ($par2!=$_POST[$f])
		     print '<tr><td class="simple" style="background-color: lightred" align="center">ЕСТЬ</td><td class="simple" style="background-color: lightred" align="center">ЕСТЬ</td><td class="simple">'.$_COOKIE['name'].'</td><td class="simple">'.$date[$tn].'</td><td class="simple">Базисный удельный расход электричества '.$ui3[1].'</td><td class="simple">-</td>
			    <td><input id="'.$cn.'-1-16" name="'.$cn.'-1-16" class="simple2" value="'.$par2.'" align="center"></td>
			    <td><input id="'.$cn.'-1-3" name="'.$cn.'-1-3" class="simple2" value="'.$_POST[$f].'" align="center"></td>
			    <td><input id="'.$cn.'-1-17" name="'.$cn.'-1-17" class="simple2" style="width:250px" align="center"></td></tr>';
		 $cn++;
		}
	 $qnt3++;
	}
 $qnt3--;
 
 for ($tn=1; $tn<=$qnt; $tn++)
	{
	 $query = 'SELECT SUM(value) FROM data WHERE prm=12 AND source=0 AND type=4 AND date='.$dates[$tn];
	 //echo $query.'<br>';
	 if ($e6 = mysql_query ($query,$i))
	 if ($ui6 = mysql_fetch_row ($e6)) $data_gr=$ui6[3];
	 $query=''; $f=$tn.'-11-10';
	 if ($_POST[$f]>=0)
	    {
	     if (!$ui6[0] || ($ui6[0] && $_POST[$f]!=$data_gr))
		     print '<tr>'.$visa[$tn].'<td class="simple">'.$_COOKIE['name'].'</td><td class="simple">'.$date[$tn].'</td><td class="simple">Потребление воды</td><td class="simple">-</td>
			    <td><input id="'.$tn.'-11-16" name="'.$tn.'-11-16" class="simple2" value="'.$data_gr.'" align="center"></td>
			    <td><input id="'.$tn.'-11-10" name="'.$tn.'-11-10" class="simple2" value="'.$_POST[$f].'" align="center"></td>
			    <td><input id="'.$tn.'-11-17" name="'.$tn.'-11-17" class="simple2" style="width:250px" align="center"></td></tr>';
	    }
	 $query = 'SELECT SUM(value) FROM data WHERE prm=41 AND source=0 AND type=4 AND date='.$dates[$tn];
	 //echo $query.'<br>';
	 if ($e6 = mysql_query ($query,$i))
	 if ($ui6 = mysql_fetch_row ($e6)) $data_gr=$ui6[3];
	 $query=''; $f=$tn.'-41-0';
	 if ($_POST[$f]>=0 && $_POST[$f]!='')
	    {
	     if (!$ui6[0] || ($ui6[0] && $_POST[$f]!=$data_gr))
		     print '<tr>'.$visa[$tn].'<td class="simple">'.$_COOKIE['name'].'</td><td class="simple">'.$date[$tn].'</td><td class="simple">Водоотведение</td><td class="simple">-</td>
			    <td><input id="'.$tn.'-41-16" name="'.$tn.'-41-16" class="simple2" value="'.$data_gr.'" align="center"></td>
			    <td><input id="'.$tn.'-41-0" name="'.$tn.'-41-0" class="simple2" value="'.$_POST[$f].'" align="center"></td>
			    <td><input id="'.$tn.'-41-17" name="'.$tn.'-41-17" class="simple2" style="width:250px" align="center"></td></tr>';
	    }

	 $query = 'SELECT SUM(value) FROM data WHERE prm=41 AND source=2 AND type=4 AND date='.$dates[$tn];
	 //echo $query.'<br>';
	 if ($e6 = mysql_query ($query,$i))
	 if ($ui6 = mysql_fetch_row ($e6)) $data_gr=$ui6[3];
	 $query=''; $f=$tn.'-41-2';
	 if ($_POST[$f]>=0 && $_POST[$f]!='')
	    {
	     if (!$ui6[0] || ($ui6[0] && $_POST[$f]!=$data_gr))
		     print '<tr>'.$visa[$tn].'<td class="simple">'.$_COOKIE['name'].'</td><td class="simple">'.$date[$tn].'</td><td class="simple">Salt</td><td class="simple">-</td>
			    <td><input id="'.$tn.'-41-16" name="'.$tn.'-41-26" class="simple2" value="'.$data_gr.'" align="center"></td>
			    <td><input id="'.$tn.'-41-0" name="'.$tn.'-41-2" class="simple2" value="'.$_POST[$f].'" align="center"></td>
			    <td><input id="'.$tn.'-41-17" name="'.$tn.'-41-27" class="simple2" style="width:250px" align="center"></td></tr>';
	    }

	} 
}

print '<input type="submit" style="visibility: hidden">';
print '</form>';
print '</table>';

?>