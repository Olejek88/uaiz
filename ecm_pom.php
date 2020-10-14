<?php
if ($_GET["post"]=='8')
 {
  $today=getdate();
  if ($_GET["month"]=='') $mn=$today["mon"];
  else $mn=$_GET["month"];
  $tm=$dy=31;
  if (!checkdate ($mn,31,$ye)) { $dy=30; }
  if (!checkdate ($mn,30,$ye)) { $dy=29; }
  if (!checkdate ($mn,29,$ye)) { $dy=28; }
  for ($tn=1; $tn<=$dy; $tn++)
  for ($tn=1; $tn<=$dy; $tn++)
	{	
	 $f=$tn.'-1';
	 //if (is_array($_REQUEST)) foreach(array_keys($_REQUEST) as $var_to_kill)
	 if (is_array($_POST))
	 foreach ($_POST as $key => $var)
	        if (isset($_POST[$key]) && $var === $_POST[$key]) 
                       echo 'found '.$key.' = '.$var."\n";
	}
}
?>

<td align="left" valign="top" width="200">
<table border="0" cellpadding="0" cellspacing="0" width="200">
<tbody><tr>
<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="11"><img src="files/icons_featured_co.gif" height="17" hspace="1" vspace="1" width="20"></td>
<td class="BlockHeaderLeftRight" height="20" width="148">&nbsp;<span id="IndicesLbl">Месяц</span></td>
<td class="vdots" width="1"></td></tr>
	<?php
	 $today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
	 for ($pm=1; $pm<=12; $pm++)
	    {	 
	     $date=sprintf ("%d%02d%02d000000",$ye,$pm,1); 
	     $date2=sprintf ("%d%02d%02d000000",2010,$pm,1); 
	     $month=$pm; include ("time.inc");
	     if ($pm==$mn) print '<tr><td align="center" style="font-family: Verdana; font-size: xx-small; color: #006995"><img alt="" src="files/SideArrow.gif" hspace="3"></td><td bgcolor="#dedede">&nbsp;<a class="clickablebluetext" href="index.php?sel=ecm_pom&month='.$pm.'&object='.$_GET["object"].'">'.$month.', '.$ye.'</a></td><td class="vdots"></td></tr>';
	     else print '<tr><td align="center" style="font-family: Verdana; font-size: xx-small; color: #006995"><img alt="" src="files/SideArrow.gif" hspace="3"></td><td>&nbsp;<a class="clickablebluetext" href="index.php?sel=ecm_pom&month='.$pm.'&object='.$_GET["object"].'">'.$month.', '.$ye.'</a></td><td class="vdots"></td></tr>';
	    }	     			
	?>
</table><br>
<table id="Table1" border="0" cellpadding="0" cellspacing="0" width="200">
	<tbody><tr>
	<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="21"><img src="files/icons_featured_co.gif" height="17" hspace="1" vspace="1" width="20"></td>
	<td class="BlockHeaderLeftRight" height="20" width="178">&nbsp;<span id="IndicesLbl">Объекты</span></td>
	<td class="vdots" width="1"></td></tr>
	<?php
	 $query = 'SELECT * FROM objects';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{	 
		 if ($ui[0]==$_GET["object"]) print '<tr style="font-family: Verdana; font-size: xx-small;"><td colspan=3 style="padding-left:5px" bgcolor="#dedede"><a href="index.php?sel=ecm_pom&month='.$_GET["month"].'&object='.$ui[0].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$ui[1].'</a></td></tr>';
		 else print '<tr style="font-family: Verdana; font-size: xx-small;"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=ecm_pom&month='.$_GET["month"].'&object='.$ui[0].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$ui[1].'</a></td></tr>';
		 print '<tr><td colspan="3" style="height:5px"></td></tr>';
	         $ui = mysql_fetch_row ($e);
		}
	?>
</table></td>

<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="left" valign="top" width="100%">
<form name="frm9" method="post" action="index.php?sel=ecm_pom&month='.$_GET["month"].'&object='.$_GET["object"].'">
<input name="post" type="hidden" value="8">

<?php         
 print '<table border="0" cellpadding="0" cellspacing="0" style="padding-left:5px" width="800px">
	<tr><td>УТВЕРЖДАЮ</td><td width="100px"></td><td>УТВЕРЖДАЮ</td></tr>
	<tr><td>Директор ООО "ЮАИЗ-ПФИ"</td><td></td><td>Директор ООО ИПК "Технологии энергосбережения"</td></tr>
	<tr><td colspan="3" style="height:20px"></td></tr>
	<tr><td>_______________ П.Ю. Синеок</td><td></td><td>________________ И.И. Курнаков</td></tr>
	<tr><td>"___"________________201___ год</td><td></td><td>"___"________________201___ год</td></tr>
	<tr><td colspan="3"></td></tr>
	</table>
 	<table border="0" cellpadding="0" cellspacing="0" width="800px">
	<tr><td style="height:40px"></td></tr>
	<tr><td align="center"><font class="head4">Данные мониторинга работы систем отопления по помещениям ООО "ЮАИЗ-ПФИ" до момента начала реализации энергосберегающего проекта</td></tr>
	<tr><td style="height:40px"></td></tr>
	</table>

        <table border="0" cellpadding="1" cellspacing="1" style="background-color: #ffffff" align="left" width="800px">
	<tr class="BlockHeaderLeftRight" align="left"><td colspan="8">Наименование помещения: </td></tr>
	<tr class="BlockHeaderLeftRight" align="left"><td colspan="8">Тип установленных отопительных приборов: </td></tr>
	<tr class="BlockHeaderLeftRight" align="center"><td>Дата</td><td colspan="2">Температура</td><td colspan="3">Расход</td><td>Наработка вентилят.</td><td>Кол-во работающих регистров</td></tr>
	<tr align="center"><td class="simple"></td><td class="simple">улица</td><td class="simple">внутри</td><td class="simple">ЭЭ</td><td class="simple">Пар</td><td class="simple">Вода</td><td class="simple"></td><td class="simple"></td></tr>';

	$tm=$dy=31;
	if (!checkdate ($mn,31,$ye)) { $dy=30; }
	if (!checkdate ($mn,30,$ye)) { $dy=29; }
	if (!checkdate ($mn,29,$ye)) { $dy=28; }
	for ($tn=1; $tn<=$dy; $tn++)
	    {		
	     $query = 'SELECT * FROM device WHERE type=11 AND object='.$_GET["object"];
	     $a = mysql_query ($query,$i);
	     if ($a)
	     while ($uy = mysql_fetch_row ($a))
		{
		 $date1=sprintf ("%d%02d01000000",2010,$mn,$tn);
		 $query = 'SELECT * FROM channels WHERE device='.$uy[11];
		 $a2 = mysql_query ($query,$i);
		 if ($a2) $uy2 = mysql_fetch_row ($a2);
	         while ($uy2 = mysql_fetch_row ($a2))
			{
			 $query = 'SELECT * FROM data2 WHERE type=2 AND date='.$date1.' AND channel='.$uy2[0];
			 $a3 = mysql_query ($query,$i);
			 if ($a3)
			 while ($uy3 = mysql_fetch_row ($a3))
				{
				 if ($uy2[9]=='4' && $uy2[10]=='0') { $data2=$uy2[3]; $chan2=$uy2[0]; }
				 if ($uy2[9]=='14' && $uy2[10]=='0') { $data3=$uy2[3]; $chan3=$uy2[0]; } 
				 if ($uy2[9]=='15' && $uy2[10]=='0') { $data4=$uy2[3]; $chan4=$uy2[0]; }
				 if ($uy2[9]=='12' && $uy2[10]=='6') { $data5=$uy2[3]; $chan5=$uy2[0]; } 
				 if ($uy2[9]=='30') { $data6=$uy2[3];  $chan6=$uy2[0]; $chan6=$uy2[0]; }
				 if ($uy2[9]=='31') { $data7=$uy2[3];  $chan7=$uy2[0]; $chan7=$uy2[0]; }
				}			 
			 $query = 'SELECT * FROM data2 WHERE type=2 AND date='.$date1;
			 $a3 = mysql_query ($query,$i);
			 if ($a3)
			 while ($uy3 = mysql_fetch_row ($a3))
				{
				 if ($uy2[9]=='4' && $uy2[10]=='10') $data1=$uy2[3]; 
				}
			}
	      	  }
	     $date2=sprintf ("%02d-%02d-%d",$tn,$mn,$ye);
	     print '<tr><td class="BlockHeaderLeftRight" align="center">'.$date2.'</td>
		<td class="simple"><input name="'.$tn.'-'.$chan1.'" class="simple2" value="'.$data1.'"></td>
		<td class="simple"><input name="'.$tn.'-'.$chan2.'" class="simple2" value="'.$data2.'"></td>
		<td class="simple"><input name="'.$tn.'-'.$chan3.'" class="simple2" value="'.$data3.'"></td>
		<td class="simple"><input name="'.$tn.'-'.$chan4.'" class="simple2" value="'.$data4.'"></td>
		<td class="simple"><input name="'.$tn.'-'.$chan5.'" class="simple2" value="'.$data5.'"></td>
		<td class="simple"><input name="'.$tn.'-'.$chan6.'" class="simple2" value="'.$data6.'"></td>
		<td class="simple"><input name="'.$tn.'-'.$chan7.'" class="simple2" value="'.$data7.'"></td></tr>';
	    }

	print '<table border="0" cellpadding="5" cellspacing="0" width="800px">
	<tr><td style="height:20px"></td></tr>
	<tr><td align="left"><font class="head4">Согласовано:</font></td></tr>
	<tr><td style="height:20px"></td></tr>
	<tr><td align="left"><font class="head4">Представитель Заказчика _____________________ФИО</font></td></tr>
	<tr><td align="left"><font class="head4">Представитель Исполнителя __________________ФИО</font></td></tr>
	<tr><td align="left"><font class="head4">Менеджер проекта __________________________ФИО</font></td></tr>
	<tr><td style="height:20px"></td></tr>
	<tr><td style="height:20px"><input name="add" value="сохранить" type="submit" style="width:111; height:22px;"></td></tr>
	</table>';

?>
</form>
</td></tr></tbody></table></td>