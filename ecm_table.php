<?php
 if ($_POST["post"])
	{
	 for ($pm=10; $pm<=66; $pm++)	 
		{	
		 $f='c'.$pm;
		 //echo $f.'<br>';
		 if ($_POST[$f])
			{
			 $query = 'SELECT * FROM ecm_regims WHERE id='.$_GET["id"];
			 //echo $query.'<br>';
			 $e = mysql_query ($query,$i);
			 if ($e) $ui = mysql_fetch_row ($e);
			 if ($ui) $query = 'UPDATE ecm_regims SET '.$f.'=\''.$_POST[$f].'\' WHERE id='.$_GET["id"];
			 else  $query = 'INSERT INTO ecm_regims SET id=\''.$_GET["id"].'\','.$f.'=\''.$_POST[$f].'\'';
			 $e = mysql_query ($query,$i);
			 //echo $query.'<br>';
			}
		 $f='t'.$pm;
		 //echo $f.'<br>';
		 if ($_POST[$f])
			{
			 $query = 'SELECT * FROM ecm_regims WHERE id='.$_GET["id"];
			 $e = mysql_query ($query,$i);
			 if ($e) $ui = mysql_fetch_row ($e);
			 if ($ui) $query = 'UPDATE ecm_regims SET '.$f.'=\''.$_POST[$f].'\' WHERE id='.$_GET["id"];
			 else  $query = 'INSERT INTO ecm_regims SET id=\''.$_GET["id"].'\','.$f.'=\''.$_POST[$f].'\'';
			 $e = mysql_query ($query,$i);
			}
		}
	}
 $query = 'SELECT * FROM ecm WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e)
 while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
	{	 	 
	 $name=$ui["name"]; 
	}

 $query = 'SELECT * FROM ecm_regims WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e)
 while ($ui = mysql_fetch_array ($e, MYSQL_ASSOC))
	{	 	 
	 $t11=$ui["t11"]; $t21=$ui["t21"]; $t31=$ui["t31"]; $t41=$ui["t41"];
	 $t12=$ui["t12"]; $t22=$ui["t22"]; $t32=$ui["t32"]; $t42=$ui["t42"];
	 $t13=$ui["t13"]; $t23=$ui["t23"]; $t33=$ui["t33"]; $t43=$ui["t43"];

	 $c10=$ui["c10"]; $c20=$ui["c20"]; $c30=$ui["c30"]; $c40=$ui["c40"];
	 $c11=$ui["c11"]; $c21=$ui["c21"]; $c31=$ui["c31"]; $c41=$ui["c41"];
	 $c12=$ui["c12"]; $c22=$ui["c22"]; $c32=$ui["c32"]; $c42=$ui["c42"];
	 $c13=$ui["c13"]; $c23=$ui["c23"]; $c33=$ui["c33"]; $c43=$ui["c43"];
	 $c14=$ui["c14"]; $c24=$ui["c24"]; $c34=$ui["c34"]; $c44=$ui["c44"];
	 $c15=$ui["c15"]; $c25=$ui["c25"]; $c35=$ui["c35"]; $c45=$ui["c45"];
	 $c16=$ui["c16"]; $c26=$ui["c26"]; $c36=$ui["c36"]; $c46=$ui["c46"];
	}

 print '<form name="frm9" method="post" action="index.php?sel=ecm_table&id='.$_GET["id"].'">
	<input name="post" type="hidden" value="1">
	<input name="add" value="сохранить" type="submit" style="width:111; height:22px;">';
 print '<table border="0" cellpadding="0" cellspacing="0" style="padding-left:5px" width="1024px">
	<tr><td>УТВЕРЖДАЮ</td><td width="100px"></td><td>УТВЕРЖДАЮ</td></tr>
	<tr><td>Директор ООО "ЮАИЗ-ПФИ"</td><td></td><td>Директор ООО ИПК "Технологии энергосбережения"</td></tr>
	<tr><td colspan="3" style="height:20px"></td></tr>
	<tr><td>_______________ П.Ю. Синеок</td><td></td><td>________________ И.И. Курнаков</td></tr>
	<tr><td>"___"________________201___ год</td><td></td><td>"___"________________201___ год</td></tr>
	<tr><td colspan="3"></td></tr>
	</table>
 	<table border="0" cellpadding="0" cellspacing="0" width="1024px">
	<tr><td style="height:120px"></td></tr>
	<tr><td align="center"><font class="head4">Таблица фактических параметров по объекту до начала<br> реализации проекта энергосбережения</td></tr>
	<tr><td style="height:10px"></td></tr>
	</table>
 	<table align="left" border="1" style="border-style:outset; padding-left:5px" cellpadding="3" cellspacing="0" width="1024px">
	<tr><td colspan="2"><font class="head4">Наименование объекта:</font></td><td colspan="3"><font class="head4">'.$name.'</font></td></tr>
	<tr><td colspan="2"><font class="head4">Ответственное лицо за объект:</font></td><td colspan="3"><font class="head4"></font></td></tr>
	<tr><td colspan="2"><font class="head4">№ технологического регламента:</font></td><td colspan="3"><font class="head4"></font></td></tr>
	<tr><td align="center"><font class="head4">Наименование параметра</font></td><td colspan="2" align="center"><font class="head4">До начала реализации проекта</font></td><td colspan="2" align="center"><font class="head4">После начала реализации проекта</font></td></tr>
	<tr><td align="center" colspan="5"><font class="head4">Режим работы</font></td></tr>
	<tr><td>Режим работы</td><td><textarea name="c10" class="simple8">'.$c10.'</textarea></td><td><textarea name="c20" class="simple8">'.$c20.'</textarea></td><td><textarea name="c30" class="simple8">'.$c30.'</textarea></td><td><textarea name="c40" class="simple8">'.$c40.'</textarea></td></tr>
	<tr><td>Режим (график) работы энергетического оборудования (калориферы, вентиляторы и т.п.)</td><td><textarea name="c11" class="simple8">'.$c11.'</textarea></td><td><textarea name="c21" class="simple8">'.$c21.'</textarea></td><td><textarea name="c31" class="simple8">'.$c31.'</textarea></td><td><textarea name="c41" class="simple8">'.$c41.'</textarea></td></tr>
	<tr><td>Режим (график) работы технологического оборудования</td><td><textarea name="c12" class="simple8">'.$c12.'</textarea></td><td><textarea name="c22" class="simple8">'.$c22.'</textarea></td><td><textarea name="c32" class="simple8">'.$c32.'</textarea></td><td><textarea name="c42" class="simple8">'.$c42.'</textarea></td></tr>
	<tr><td align="center" colspan="5"><font class="head4">Расход ТЭР</font></td></tr>
	<tr><td>Расход пара</td><td><textarea name="c13" class="simple8">'.$c13.'</textarea></td><td><textarea name="c23" class="simple8">'.$c23.'</textarea></td><td><textarea name="c33" class="simple8">'.$c33.'</textarea></td><td><textarea name="c43" class="simple8">'.$c43.'</textarea></td></tr>
	<tr><td>Расход электрической энергии</td><td><textarea name="c14" class="simple8">'.$c14.'</textarea></td><td><textarea name="c24" class="simple8">'.$c24.'</textarea></td><td><textarea name="c34" class="simple8">'.$c34.'</textarea></td><td><textarea name="c44" class="simple8">'.$c44.'</textarea></td></tr>
	<tr><td>Расход природного газа</td><td><textarea name="c15" class="simple8">'.$c15.'</textarea></td><td><textarea name="c25" class="simple8">'.$c25.'</textarea></td><td><textarea name="c35" class="simple8">'.$c35.'</textarea></td><td><textarea name="c45" class="simple8">'.$c45.'</textarea></td></tr>
	<tr><td>Расход воды</td><td><textarea name="c16" class="simple8">'.$c16.'</textarea></td><td><textarea name="c26" class="simple8">'.$c26.'</textarea></td><td><textarea name="c36" class="simple8">'.$c36.'</textarea></td><td><textarea name="c46" class="simple8">'.$c46.'</textarea></td></tr>
	<tr><td align="center" colspan="5"><font class="head4">Технологические параметры</font></td></tr>
	<tr><td>Производительность технологической линии</td><td colspan="2"><textarea name="t11" class="simple9">'.$t11.'</textarea></td><td colspan="2"><textarea name="t21" class="simple9">'.$t21.'</textarea></td></tr>
	<tr><td>Контролируемые технологические параметры (температура, давление, влажность и т.п.)</td><td colspan="2"><textarea name="t12" class="simple9">'.$t12.'</textarea></td><td colspan="2"><textarea name="t22" class="simple9">'.$t22.'</textarea></td></tr>
	<tr><td>Удельные затраты ТЭР</td><td colspan="2"><textarea name="t13" class="simple9">'.$t13.'</textarea></td><td colspan="2"><textarea name="t23" class="simple9">'.$t23.'</textarea></td></tr>
	</table>

 	<table align="center" border="0" cellpadding="10" cellspacing="0" width="100%">
	<tr><td style="height:50px"></td></tr>
	<tr><td><font class="head4">Согласовано:</font></td></tr>
	<tr><td style="height:20px"></td></tr>
	<tr><td><font class="head4">Представитель Заказчика _____________________ФИО</font></td></tr>
	<tr><td><font class="head4">Представитель Исполнителя __________________ФИО</font></td></tr>
	<tr><td><font class="head4">Менеджер проекта __________________________ФИО</font></td></tr>
	</table></form>';
?>