<?php if (!$_GET["print"]) include ("ecm_all_menu.php"); ?>

<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="left" valign="top" width="100%">
<?php
 function  LoadData ($i, $prm, $channel, $type, $date, $date2)
    {
     $query = 'SELECT SUM(value) FROM data2 WHERE prm='.$prm.' AND channel='.$channel.' AND type='.$type.' AND date>='.$date.'  AND date<'.$date2;
     //echo $query;
     if ($e6 = mysql_query ($query,$i)) if ($ui6 = mysql_fetch_row ($e6))
     if ($ui6[0]) return $ui6[0];
    }

 $today=getdate(); $styear=$today["year"]; $enyear=$today["year"];
 if ($_GET["styear"]!='') $styear=$_GET["styear"];
 if ($_GET["enyear"]!='') $enyear=$_GET["enyear"];

 if ($_GET["start"]=='') { if ($today["mon"]>1) $start=$today["mon"]-1; else { $start=12; $styear--; } }
 else $start=$_GET["start"];
 if ($_GET["end"]=='') $end=$today["mon"];
 else $end=$_GET["end"];
 $month=$start; include ("time.inc"); $month_begin=$month;

 if ($end>1) $month=$end-1; else { $month=12; $end=1; $_GET["enyear"]--; }  
// if (1) $month=$end; else { $month=12; $end=13; }  

 $end_day=31;
 if (!checkdate ($month,31,$ye)) { $end_day=30; }
 if (!checkdate ($month,30,$ye)) { $end_day=29; }
// if (!checkdate ($end-1,30,$ye)) { $end_day=29; }
 if (!checkdate ($month,29,$ye)) { $end_day=28; }
 include ("time.inc"); $month_end=$month;

 $cn=1;
 $date0=sprintf ("%d%02d01000000",$styear,$start);
 $date2=sprintf ("%d%02d01000000",$enyear,$end);

 $date1=sprintf ("%d0101000000",$styear);

     $query = 'SELECT * FROM reports WHERE date='.$date0;
     if ($e2 = mysql_query ($query,$i)) 
     if ($ui2 = mysql_fetch_row ($e2))
        {
	 $visa_date1=$ui2[1];
	 $visa1=$ui2[2];
	 $visa_date2=$ui2[3];
	 $visa2=$ui2[4];
	 $reps=$ui2[6];
	}
 if ($_POST["type"]=='1')
	{
	 //echo 'cc='.$_COOKIE["user"].' '.$_POST["visa1"];
	 //$_COOKIE["name"]='FrolovNM' && $_POST["visa1"]
	 if ($_COOKIE["name"]=='KurnakovII' && $_POST["visa2"]) 
		{
		 $query = 'UPDATE reports SET visa2=1,date2=CURRENT_TIMESTAMP WHERE date='.$date0;
		 //echo $query;
		 $e2 = mysql_query ($query,$i);
	    	 $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", channel=0, value1=0, value2=1, comment=\''.$_POST["visa1"].'\', what="поставлена виза за отчет '.$date0.' - '.$date2.' со стороны ООО ТТ"'; 
		 //echo $query.'<br>'; 
		 mysql_query ($query,$i);
		}
	 //if (1)
	 if ($_COOKIE["name"]=='FrolovNM' && $_POST["visa1"])
		{
		 $query = 'UPDATE reports SET visa1=1,date1=CURRENT_TIMESTAMP WHERE date='.$date0;
		 //echo $query;
		 $e2 = mysql_query ($query,$i);
	    	 $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", channel=0, value1=0, value2=1, comment=\''.$_POST["visa1"].'\', what="поставлена виза за отчет '.$date0.' - '.$date2.' со стороны ЮАИЗ"'; 
		 //echo $query.'<br>'; 
		 mysql_query ($query,$i);
		}
	 if ($_COOKIE["name"]=='KurnakovII' && $_POST["visa2"]=='')
		{
		 $query = 'UPDATE reports SET visa2=0,date2=CURRENT_TIMESTAMP WHERE date='.$date0;
		 //echo $query;
		 $e2 = mysql_query ($query,$i);
	    	 $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", channel=0, value1=1, value2=0, comment=\''.$_POST["visa1"].'\', what="отозвана виза за отчет '.$date0.' - '.$date2.' со стороны ООО ТТ"'; 
		 //echo $query.'<br>'; 
		 mysql_query ($query,$i);
		}
	 if ($_COOKIE["name"]=='FrolovNM' && $_POST["visa1"]=='')
		{
		 $query = 'UPDATE reports SET visa1=0,date1=CURRENT_TIMESTAMP WHERE date='.$date0;
		 //echo $query;
		 $e2 = mysql_query ($query,$i);
	    	 $query='INSERT INTO registers SET who="'.$_COOKIE['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", channel=0, value1=1, value2=0, comment=\''.$_POST["visa1"].'\', what="отозвана виза за отчет '.$date0.' - '.$date2.' со стороны ЮАИЗ"'; 
		 //echo $query.'<br>'; 
		 mysql_query ($query,$i);
		}
	}
 $query = 'SELECT SUM(value) FROM data2 WHERE prm=1 AND channel=50 AND type=4 AND date>='.$date1.' AND date<'.$date2;
// echo $query;
 if ($e6 = mysql_query ($query,$i)) if ($ui6 = mysql_fetch_row ($e6))
 if ($ui6[0]) $eksum_nach=$ui6[0];
// $eksum_nach=3141245.89;
// $eksum_nach=4391818.34;
//$eksum_nach-=1145610.84;
//$eksum_nach-=129299.07;
if ($styear==2012) $eksum_nach-=338424.26;
//$eksum_nach-=598061.39;


 $query = 'SELECT SUM(value) FROM data2 WHERE prm=1 AND channel=50 AND type=4 AND date<'.$date2;
 //echo $query;
 if ($e6 = mysql_query ($query,$i)) if ($ui6 = mysql_fetch_row ($e6))
 if ($ui6[0]) $eksum_all=$ui6[0];
// $eksum_all=5704992.62;
// $eksum_all=6955565.07;
//$eksum_all-=1864347.31;
$eksum_all-=1057160.73;


 $query = 'SELECT * FROM tarifs WHERE date='.$date0;
 if ($e2 = mysql_query ($query,$i)) 
 if ($ui2 = mysql_fetch_row ($e2))
    {
     $tarif_elec=$ui2[4];
     $tarif_hvs=$ui2[6];
     $tarif_par=$ui2[9];
     $tarif_gas=$ui2[10];
     $tarif_vodootv=$ui2[11];
     $tarif_sal=$ui2[12];
    }

 $eksum_data=LoadData ($i, 1,50,4,$date0,$date2);

 $data0=LoadData ($i, 1,51,4,$date0,$date2)/$tarif_elec;
 $data1=LoadData ($i, 2,51,4,$date0,$date2)/$tarif_gas;
 $data3=LoadData ($i, 3,51,4,$date0,$date2)/$tarif_par;
 $data2=0;
 $data4=0;
 $data5=0;

 $data10=LoadData ($i, 1,52,4,$date0,$date2);
 $data11=LoadData ($i, 2,52,4,$date0,$date2);
 $data13=LoadData ($i, 3,52,4,$date0,$date2)/1000;
 $data12=LoadData ($i, 4,52,4,$date0,$date2);
 $data14=LoadData ($i, 5,52,4,$date0,$date2);
 $data15=LoadData ($i, 6,52,4,$date0,$date2);

 $ek0=$data0-$data10;
 $ek1=$data1-$data11;
 $ek2=$data2-$data12;
 $ek3=$data3-$data13;
 $ek4=$data4-$data14;
 $ek5=0-$data15;

// echo $data3; 

 $ekpr0=($data0-$data10)*$tarif_elec;
 $ekpr1=($data1-$data11)*$tarif_gas;
 $ekpr2=($data2-$data12)*$tarif_hvs;
 $ekpr3=($data3-$data13)*$tarif_par;
 $ekpr4=($data4-$data14)*$tarif_vodootv;
 $ekpr5=(0-$data15)*$tarif_sal;
 //$eksum_nach=$ekpr0+$ekpr1+$ekpr2+$ekpr3+$ekpr4;
 $eksum1=$eksum_data*0.2;
 $eksum2=$eksum_data*0.8;

 $rent=139358;
 $total_pay=$eksum2-$rent;

 print '<table border="0" cellpadding="0" cellspacing="0" style="padding-left:5px" width="800px">
	<tr><td>УТВЕРЖДАЮ</td><td width="100px"></td><td>УТВЕРЖДАЮ</td></tr>
	<tr><td>Директор ООО "ЮАИЗ-ПФИ"</td><td></td><td>Директор ООО ИПК "Технологии энергосбережения"</td></tr>
	<tr><td colspan="3" style="height:20px"></td></tr>
	<tr><td>_______________ П.Ю. Синеок</td><td></td><td>________________ И.И. Курнаков</td></tr>
	<tr><td>"___"________________201___ год</td><td></td><td>"___"________________201___ год</td></tr>
	<tr><td colspan="3"></td></tr>
	</table>
 	<table border="0" cellpadding="0" cellspacing="0" width="800px">
	<tr><td style="height:60px"></td></tr>
	<tr><td align="center"><font class="head4">Отчет за очередной отчётный период о величине фактической экономии</td></tr>
	<tr><td style="height:60px"></td></tr>
	<tr><td align="left"><font class="head4"> 1. Отчётный период: с "01" '.$month_begin.' '.$_GET["styear"].' года по "'.$end_day.'" '.$month_end.' '.$_GET["enyear"].' года</font></td></tr>
	<tr><td align="left"><font class="head4">&nbsp;</font></td></tr>
	<tr><td align="left"><font class="head4"> 2.	В отчете отражена экономия по следующим мероприятиям: ЭСМ 1-17 приложения 3 к договору № 1-ПК/333/А-10 от 12 октября 2010 г. Время работы большинства оборудования - неполное. Это учтено при расчете экономии.</font></td></tr>
	<tr><td align="left"><font class="head4">&nbsp;</font></td></tr>
	<tr><td align="left"><font class="head4"> 3. Затраты ТЭР за отчетный период по расчету до начала реализации проекта энергосбережения:</font></td></tr>
	<tr><td align="left"><font class="head4">&nbsp;</font></td></tr>
	</table>

        <table border="0" cellpadding="1" cellspacing="1" style="background-color: #ffffff" align="left" width="800px" class="TableBorder">
	<tr><td>
	<table class="GirdStyle" cellspacing="0" cellpadding="3" rules="all" border="1" id="Datagrid2" style="width:100%;border-collapse:collapse;">
	<tr class="gridHeaderStyle" align="center"><td>№</td><td>Вид ТЭР</td><td>Затраты в натуральном выражении</td><td>Затраты в денежном выражении, руб. без НДС.</td><td>Действующая цена (тариф), руб. без НДС</td></tr>
	<tr class="GridItemStyle"><td>1.</td><td >Природный газ</td><td >'.number_format($data1,2).'</td><td >'.(number_format($data1*$tarif_gas,2,'.','')).'</td><td >'.$tarif_gas.' руб. * 1000 м3</td></tr>
	<tr class="GridAlternateItemStyle"><td>2.</td><td>Электроэнергия</td><td >'.number_format($data0,2).'</td><td >'.(number_format($data0*$tarif_elec,2,'.','')).'</td><td >'.$tarif_elec.' руб.кВт*ч</td></tr>
	<tr class="GridItemStyle"><td>3.</td><td >Водяной пар (с учётом невозврата конденсата)</td><td >'.number_format($data3,2).'</td><td >'.(number_format($data3*$tarif_par,2,'.','')).'</td><td >'.$tarif_par.' руб.Гкал</td></tr>
	<tr class="GridAlternateItemStyle"><td>4.</td><td>Холодное водоснабжение</td><td >'.number_format($data2,2).'</td><td >'.(number_format($data2*$tarif_hvs,2,'.','')).'</td><td >'.$tarif_hvs.' м3</td></tr>
	<tr class="GridItemStyle"><td>5.</td><td>Сточные воды</td><td >'.number_format($data4,2).'</td><td >'.(number_format($data4*$tarif_vodootv,2,'.','')).'</td><td >'.$tarif_vodootv.' м3</td></tr>
	<tr class="GridAlternateItemStyle"><td>6.</td><td>Соль (водоподготовка)</td><td >'.number_format($data5,2).'</td><td >'.(number_format($data5*$tarif_salt,2,'.','')).'</td><td >'.$tarif_sal.' руб.кг</td></tr>
	</table></td></tr></table>

	<table border="0" cellpadding="0" cellspacing="0" width="800px">
	<tr><td style="height:20px"></td></tr>
	<tr><td align="left"><font class="head4">4.	Затраты ТЭР за отчетный период фактические после начала реализации проекта энергосбережения:</td></tr>
	<tr><td style="height:20px"></td></tr>
	</table>

        <table border="0" cellpadding="1" cellspacing="1" style="background-color: #ffffff" align="left" width="800px" class="TableBorder">
	<tr><td>
	<table class="GirdStyle" cellspacing="0" cellpadding="3" rules="all" border="1" id="Datagrid2" style="width:100%;border-collapse:collapse;">
	<tr class="gridHeaderStyle" align="center">
	<td>№</td><td>Вид ТЭР</td><td>Затраты в натуральном выражении</td><td>Затраты в денежном выражении, руб. без НДС.</td><td>Действующая цена (тариф), руб. без НДС</td></tr>
	<tr class="GridItemStyle"><td>1.</td><td>Природный газ</td><td>'.number_format($data11,2).'</td><td>'.(number_format($data11*$tarif_gas,2,'.','')).'</td><td>'.$tarif_gas.' руб. * 1000 м3</td></tr>
	<tr class="GridAlternateItemStyle"><td>2.</td><td>Электроэнергия</td><td>'.number_format($data10,2).'</td><td>'.(number_format($data10*$tarif_elec,2,'.','')).'</td><td>'.$tarif_elec.' руб.кВт*ч</td></tr>
	<tr class="GridItemStyle"><td>3.</td><td>Водяной пар (с учётом невозврата конденсата)</td><td>'.number_format($data13,2).'</td><td>'.(number_format($data13*$tarif_par,2,'.','')).'</td><td>'.$tarif_par.' руб.Гкал</td></tr>
	<tr class="GridAlternateItemStyle"><td>4.</td><td>Холодное водоснабжение</td><td>'.number_format($data12,2).'</td><td>'.(number_format($data12*$tarif_hvs,2,'.','')).'</td><td>'.$tarif_hvs.' руб.м3</td></tr>
	<tr class="GridItemStyle"><td>5.</td><td>Сточные воды</td><td >'.number_format($data14,2).'</td><td >'.(number_format($data14*$tarif_vodootv,2,'.','')).'</td><td >'.$tarif_vodootv.' руб.м3</td></tr>
	<tr class="GridAlternateItemStyle"><td>6.</td><td>Соль (водоподготовка)</td><td >'.$data15.'</td><td >'.(number_format($data15*$tarif_sal,2,'.','')).'</td><td >'.$tarif_sal.' руб.кг</td></tr>
	</table></td></tr></table>

	<table border="0" cellpadding="0" cellspacing="0" width="800px">
	<tr><td style="height:20px"></td></tr>
	<tr><td align="left"><font class="head4">5.	Экономия за отчётный период по видам ТЭР:</td></tr>
	<tr><td style="height:20px"></td></tr>
	</table>

        <table border="0" cellpadding="1" cellspacing="1" style="background-color: #ffffff" align="left" width="800px" class="TableBorder">
	<tr><td>
	<table class="GirdStyle" cellspacing="0" cellpadding="3" rules="all" border="1" id="Datagrid2" style="width:100%;border-collapse:collapse;">
	<tr class="gridHeaderStyle" align="center">
	<td>№</td><td>Вид ТЭР</td><td>Затраты в натуральном выражении</td><td>Затраты в денежном выражении, руб. без НДС.</td><td>Действующая цена (тариф), руб. без НДС</td></tr>
	<tr class="GridItemStyle"><td>1.</td><td >Природный газ</td><td >'.(number_format($ek1,2,'.','')).'</td><td >'.(number_format($ekpr1,2,'.','')).'</td><td >'.$tarif_gas.' руб. * 1000 м3</td></tr>
	<tr class="GridAlternateItemStyle"><td>2.</td><td >Электроэнергия</td><td >'.(number_format($ek0,2,'.','')).'</td><td >'.(number_format($ekpr0,2,'.','')).'</td><td >'.$tarif_elec.' руб.кВт*ч</td></tr>
	<tr class="GridItemStyle"><td>3.</td><td >Водяной пар (с учётом невозврата конденсата)</td><td >'.(number_format($ek3,2,'.','')).'</td><td >'.(number_format($ekpr3,2,'.','')).'</td><td >'.$tarif_par.' руб.Гкал</td></tr>
	<tr class="GridAlternateItemStyle"><td>4.</td><td >Холодное водоснабжение</td><td >'.(number_format($ek2,2,'.','')).'</td><td >'.(number_format($ekpr2,2,'.','')).'</td><td >'.$tarif_hvs.' руб.м3</td></tr>
	<tr class="GridItemStyle"><td>5.</td><td>Сточные воды</td><td >'.(number_format($ek4,2,'.','')).'</td><td >'.(number_format($ek4*$tarif_vodootv,2,'.','')).'</td><td >'.$tarif_vodootv.' руб.м3</td></tr>
	<tr class="GridAlternateItemStyle"><td>6.</td><td>Соль (водоподготовка)</td><td >'.$ek5.'</td><td >'.(number_format($ek5*$tarif_sal,2,'.','')).'</td><td >'.$tarif_sal.' руб.кг</td></tr>
	</table></td></tr></table>

	<table border="0" cellpadding="3" cellspacing="0" width="800px">
	<tr><td style="height:40px"></td></tr>
	<tr><td align="left"><font class="head3">6.	Суммарная экономия за отчётный период: '.number_format($eksum_data,2).' рублей;</td></tr>
	<tr><td align="left"><font class="head3">7.	Доля суммарной экономии Заказчика за отчётный период: '.number_format($eksum1,2).' рублей;</td></tr>
	<tr><td align="left"><font class="head3">8.	Доля суммарной экономии Исполнителя за отчётный период: '.number_format($eksum2,2).' рублей;</td></tr>
	<tr><td align="left"><font class="head3">9.	Суммарный экономический эффект с начала календарного года: '.number_format($eksum_nach,2).' рублей;</td></tr>
	<tr><td align="left"><font class="head3">10.	Суммарный экономический эффект с момента начала реализации проекта энергосбережения: '.number_format($eksum_all,2).' рублей;</td></tr>
	<tr><td align="left"><font class="head3">11.	Выплаты Заказчика в пользу Исполнителя, сделанные по Договору аренды № 1-ПК-А1 от 26 сентября 2011 г. за отчётный период: '.number_format($rent,2).' рублей;</td></tr>
	<tr><td align="left"><font class="head3">12.	Сумма, причитающаяся к выплате Исполнителю за отчётный период с учётом выплат Заказчика по Договору аренды № 1-ПК-А1 от 26 сентября 2011 г.: '.number_format($total_pay,2).' рублей;</td></tr>
	<tr><td align="left"><font class="head3">13.	Переработка по агрегатам составила:<br>'.$reps.'</td></tr>

	<tr><td style="height:20px"></td></tr>
	<tr><td align="left"><font class="head3">Составил: Менеджер по мониторингу __________________ ФИО</td></tr>
	<tr><td align="left"><font class="head3">Дата ___________</td></tr>
	</table>';

if (!$_GET["print"]) 
    {
     $tm=$mn;
     include ("time.inc");
     $dats[$cn]=$dat[$cn].' '.$ye;
     $mn--; if ($mn==0) { $mn=12; $ye--; $pims=$pm; }
     $cn--;

     print '<form name="frm1" method="post" action="'.$_SERVER['REQUEST_URI'].'">';
     print '<table border="0" cellpadding="3" cellspacing="0" width="1100px"><br><br><br><br>';
     print '<tr><td><font class="head3">Согласовано со стороны ЮАИЗ-ПФИ</font></td><td><font class="head3">'.$visa_date1.'</font></td><td>';
     if (!$visa1 && !$visa2) print '<input id="visa1" name="visa1" class="simple2" style="width:100" align="center">';
     else if ($visa1) print '<input id="visa1" name="visa1" class="simple2" style="width:100" align="center" value="СОГЛАСОВАНО">';
     print '</td>
	    <td><font class="head3">Согласовано со стороны ООО ИПК "Технологии энергосбережения"</font></td><td><font class="head3">'.$visa_date2.'</font></td><td>';
     if (!$visa1 && !$visa2) print '<input id="visa2" name="visa2" class="simple2" style="width:100" align="center" disabled>';
     else if ($visa1 && !$visa2) print '<input id="visa2" name="visa2" class="simple2" style="width:100" align="center">';
     else if ($visa1 && $visa2) print '<input id="visa2" name="visa2" class="simple2" style="width:100" align="center" value="СОГЛАСОВАНО">';
     print '</td></tr>';
     print '</table>';
     print '<input name="type" type="hidden" value="1">';
     print '<input type="submit" style="visibility: hidden">';
     print '</form>';
    }
?>
</td></tr></tbody></table></td>
