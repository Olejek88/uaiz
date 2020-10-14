<?php
 if ($_POST["type"]=='4')
	{
	 for ($pm=0; $pm<=11; $pm++)
	 for ($prm=0; $prm<=20; $prm++)	
	 for ($src=0; $src<=1; $src++)	
	 for ($ye=0; $ye<=2; $ye++)
		{
		 $f=$pm.'-'.$prm.'-'.$src.'-'.$ye;
		 //echo $f.'<br>';
		 if ($_POST[$f] || $_POST[$f]==0)
			{
			 if ($ye==0) $date=sprintf ("%d%02d01000000",2010,$pm+1);
			 if ($ye==1) $date=sprintf ("%d%02d01000000",2011,$pm+1);
 			 if ($ye==2) $date=sprintf ("%d%02d01000000",2012,$pm+1);
 			 if ($prm==11) $_POST[$f]*=1000;
			 $query = 'SELECT * FROM data2 WHERE prm='.$prm.' AND channel=0 AND source='.$src.' AND type=4 AND date=\''.$date.'\' AND device=\''.$_GET["id"].'\'';
			 //echo $query.'<br>';
			 $e = mysql_query ($query,$i);
			 if ($e) $ui = mysql_fetch_row ($e);
			 if ($ui) $query = 'UPDATE data2 SET date=date, value=\''.$_POST[$f].'\' WHERE prm='.$prm.' AND channel=0 AND type=4 AND source='.$src.' AND device='.$_GET["id"].' AND date='.$date;
			 else  $query = 'INSERT INTO data2 SET value=\''.$_POST[$f].'\',prm='.$prm.',channel=0,type=4,source='.$src.',device='.$_GET["id"].',date='.$date;
			 $e = mysql_query ($query,$i);
			 //echo $query.'<br>';
			 if ($_POST["chk"])
				{
				 $dy=31;
				 if (!checkdate ($pm+1,31,$ye)) { $dy=30; }
				 if (!checkdate ($pm+1,30,$ye)) { $dy=29; }
				 if (!checkdate ($pm+1,29,$ye)) { $dy=28; }
				 for ($dm=0; $dm<$dy; $dm++)	 
					{
					 if ($prm!=4) $value=number_format($_POST[$f]/$dy,2);
					 else $value=number_format($_POST[$f],2);
    					 if ($ye==0) $date=sprintf ("%d%02d%02d000000",2010,$pm+1,$dm+1);
					 if ($ye==1) $date=sprintf ("%d%02d%02d000000",2011,$pm+1,$dm+1);
 					 if ($ye==2) $date=sprintf ("%d%02d%02d000000",2012,$pm+1,$dm+1);

					 $query = 'SELECT * FROM data2 WHERE prm='.$prm.' AND channel=0 AND source='.$src.' AND type=2 AND date=\''.$date.'\' AND device=\''.$_GET["id"].'\'';
					 //echo $query.'<br>';
					 $e = mysql_query ($query,$i);
					 if ($e) $ui = mysql_fetch_row ($e);
					 if ($ui) $query = 'UPDATE data2 SET date=date, value=\''.$value.'\' WHERE prm='.$prm.' AND channel=0 AND type=2 AND source='.$src.' AND device='.$_GET["id"].' AND date='.$date;
					 else  $query = 'INSERT INTO data2 SET value=\''.$value.'\',prm='.$prm.',channel=0,type=2,source='.$src.',device='.$_GET["id"].',date='.$date;
					 $e = mysql_query ($query,$i);
					 //echo $query.'<br>';
					}
				}
			}
		} 
	}
 if ($_POST["type"]=='2')
	{
	 $today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];

	 $dy=31;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }

	 for ($pm=0; $pm<$dy; $pm++)	 
	 for ($prm=0; $prm<=20; $prm++)	 
	 for ($src=0; $src<=1; $src++)	 	 
	 for ($ye=0; $ye<=1; $ye++)
		{	
		 $f=$pm.'-'.$prm.'-'.$src.'-'.$ye;
		 echo $f.'<br>';
		 if ($_POST[$f])
			{
			 if ($ye) $date=sprintf ("%d%02d%02d000000",$_POST["year"],$mn,$pm+1);
			 else $date=sprintf ("%d%02d%02d000000",2010,$mn,$pm+1);
			 $query = 'SELECT * FROM data2 WHERE prm='.$prm.' AND channel=0 AND source='.$src.' AND type=2 AND date=\''.$date.'\' AND device=\''.$_GET["id"].'\'';
			 //echo $query.'<br>';
			 $e = mysql_query ($query,$i);
			 if ($e) $ui = mysql_fetch_row ($e);
			 if ($ui) $query = 'UPDATE data2 SET date=date, value=\''.$_POST[$f].'\' WHERE prm='.$prm.' AND channel=0 AND type=2 AND source='.$src.' AND device='.$_GET["id"].' AND date='.$date;
			 else  $query = 'INSERT INTO data2 SET value=\''.$_POST[$f].'\',prm='.$prm.',channel=0,type=2,source='.$src.',device='.$_GET["id"].',date='.$date;
			 $e = mysql_query ($query,$i);
			 //echo $query.'<br>';
			 if ($_POST["chk"])
				{
				 for ($dm=0; $dm<=23; $dm++)	 
					{
					 if ($prm!=4) $value=number_format($_POST[$f]/24,2);
					 else $value=number_format($_POST[$f],2);
			 		 if ($ye) $date=sprintf ("%d%02d%02d%02d0000",$_POST["year"],$mn,$pm+1,$dm);
					 else $date=sprintf ("%d%02d%02d%02d0000",2010,$mn,$pm+1,$dm);
					 $query = 'SELECT * FROM data2 WHERE prm='.$prm.' AND channel=0 AND source='.$src.' AND type=1 AND date=\''.$date.'\' AND device=\''.$_GET["id"].'\'';
					 //echo $query.'<br>';
					 $e = mysql_query ($query,$i);
					 if ($e) $ui = mysql_fetch_row ($e);
					 if ($ui) $query = 'UPDATE data2 SET date=date, value=\''.$value.'\' WHERE prm='.$prm.' AND channel=0 AND type=1 AND source='.$src.' AND device='.$_GET["id"].' AND date='.$date;
					 else  $query = 'INSERT INTO data2 SET value=\''.$value.'\',prm='.$prm.',channel=0,type=1,source='.$src.',device='.$_GET["id"].',date='.$date;
					 $e = mysql_query ($query,$i);
					 //echo $query.'<br>';
					}
				}
			}
		} 
	}
 if ($_POST["type"]=='1')
	{
	 $today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
	 if ($_GET["day"]=='') $dy=$today["days"];
	 else $dy=$_GET["day"];

	 for ($pm=0; $pm<=23; $pm++)	 
	 for ($prm=0; $prm<=20; $prm++)	 
	 for ($src=0; $src<=1; $src++)	 	 
	 for ($ye=0; $ye<=1; $ye++)
		{	
		 $f=$pm.'-'.$prm.'-'.$src.'-'.$ye;
		 //echo $f.'<br>';
		 if ($_POST[$f])
			{
			 if ($ye) $date=sprintf ("%d%02d%02d%02d0000",$_POST["year"],$mn,$dy,$pm);
			 else $date=sprintf ("%d%02d%02d%02d0000",2010,$mn,$dy,$pm);
			 $query = 'SELECT * FROM data2 WHERE prm='.$prm.' AND channel=0 AND source='.$src.' AND type=1 AND date=\''.$date.'\' AND device=\''.$_GET["id"].'\'';
			 //echo $query.'<br>';
			 $e = mysql_query ($query,$i);
			 if ($e) $ui = mysql_fetch_row ($e);
			 if ($ui) $query = 'UPDATE data2 SET date=date, value=\''.$_POST[$f].'\' WHERE prm='.$prm.' AND channel=0 AND type=1 AND source='.$src.' AND device='.$_GET["id"].' AND date='.$date;
			 else  $query = 'INSERT INTO data2 SET value=\''.$_POST[$f].'\',prm='.$prm.',channel=0,type=1,source='.$src.',device='.$_GET["id"].',date='.$date;
			 $e = mysql_query ($query,$i);
			 //echo $query.'<br>';
			}
		} 
	}
?>

<td align="left" valign="top" width="200">
<table id="Table1" border="0" cellpadding="0" cellspacing="0" width="200">
	<tbody><tr>
	<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="21"><img src="files/icons_featured_co.gif" height="17" hspace="1" vspace="1" width="20"></td>
	<td class="BlockHeaderLeftRight" height="20" width="178">&nbsp;<span id="IndicesLbl">ЭСМ</span></td>
	<td class="vdots" width="1"></td></tr>
	<?php
	 print '<tr style="font-family: Verdana; font-size: xx-small;"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=ecm" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">Все мероприятия</a></td></tr>
		<tr><td colspan="3" style="height:5px"></td></tr>';
	 print '<tr style="font-family: Verdana; font-size: xx-small;"><td colspan=3 style="padding-left:5px"></td></tr><tr><td colspan="3" style="height:5px"></td></tr>';
	 $query = 'SELECT * FROM ecm';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{
		 print '<tr style="font-family: Verdana; font-size: xx-small;"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=ecm&eco=1&id='.$ui[0].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$ui[1].'</a></td></tr>
			<tr><td colspan="3" style="height:5px"></td></tr>';
	         $ui = mysql_fetch_row ($e);
		}
	?>
</table></td>
<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">
<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="top">

<div id="maincontent" >
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody><tr>
<td>
<table border="0" cellpadding="0" cellspacing="0" width="780">
<tbody>
<?php
 if ($_GET["id"]) 
	{
	 $query = 'SELECT * FROM ecm WHERE id='.$_GET["id"];
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 if ($ui)
		{
		 $query = 'SELECT * FROM uzels WHERE esm='.$_GET["id"];
    		 $e2 = mysql_query ($query,$i);
		 if ($e2) $ui2 = mysql_fetch_row ($e2);

		 print '<tr><td class="BlockHeaderMiddle" style="padding-left: 22px;" align="center" height="20" valign="center"><span id="Label5">'.$ui[1].'</span></td></tr>
			<tr><td>
			<table border="0" cellpadding="0" cellspacing="5" width="100%">
			<tbody>
			<tr><td><a href="index.php?sel=uzels_mnem&id='.$ui2[0].'"><img border="0" src="map/mnem'.($ui[0]%3+1).'_resize.jpg"></a></td><td style="font-family: Verdana; font-size: 11px;">'.$ui[2].'</a></td></tr> 
			<tr><td colspan="2">';
		  include ("ecm_eco.php");
		  print '</td></tr>';
		}
	}
 else 
	{
	 print '<div class="feature"><table border="0" cellpadding="0" cellspacing="1" width="100%" style="font-family: Verdana; font-size: xx-small;">';
	 print '<form name="frm4" method="post" action="index.php?sel=ecm&id='.$_GET["id"].'" id="Form1">';
	 print '<tr bgcolor="#1881b6"><td align="center" class="BlockHeaderLeftRight" >N</td><td align="center" class="BlockHeaderLeftRight" >Энергосберегающее мероприятие</td><td align="center" class="BlockHeaderLeftRight" >Цель</td>
		<td align="center" class="BlockHeaderLeftRight">Затраты</td>
		<td align="center" class="BlockHeaderLeftRight">Срок</td>
		<td align="center" class="BlockHeaderLeftRight">Эффект</td>
		<td align="center" class="BlockHeaderLeftRight">Доход</td>
		<td align="center" class="BlockHeaderLeftRight">Режим работы, ч</td>
		<td align="center" class="BlockHeaderLeftRight">Пар до модер</td>
		<td align="center" class="BlockHeaderLeftRight">ЭЭ до модер</td>
		<td align="center" class="BlockHeaderLeftRight">Газ до модер</td>
		<td align="center" class="BlockHeaderLeftRight">Вода до модер</td>
		</tr>';
	 $query = 'SELECT * FROM ecm';
	 $e = mysql_query ($query,$i); $cm=1;
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{	 
		 print '<tr><td bgcolor="#1881b6" align="center" class="BlockHeaderLeftRight" >'.$cm.'</td>
			<td><a href="index.php?sel=ecm&id='.$ui[0].'">'.$ui[1].'</td>
			<td><input class="simple2" name="'.$ui[0].'-name" style="width:250px" value="'.$ui[3].'"></td>
			<td><input class="simple2" name="'.$ui[0].'-z1" value="'.$ui[4].'"></td>
			<td><input class="simple2" name="'.$ui[0].'-z2" value="'.$ui[5].'"></td>
			<td><input class="simple2" name="'.$ui[0].'-z3" value="'.$ui[6].'"></td>
			<td><input class="simple2" name="'.$ui[0].'-z4" value="'.$ui[7].'"></td>
			<td><input class="simple2" name="'.$ui[0].'-z5" value="'.$ui[8].'"></td>
			<td><input class="simple2" name="'.$ui[0].'-z6" value="'.$ui[9].'"></td>
			<td><input class="simple2" name="'.$ui[0].'-z7" value="'.$ui[10].'"></td>
			<td><input class="simple2" name="'.$ui[0].'-z8" value="'.$ui[11].'"></td>
			<td><input class="simple2" name="'.$ui[0].'-z9" value="'.$ui[13].'"></td></tr>';
		 $cm++;			
	         $ui = mysql_fetch_row ($e);
		}
	 print '</table><input name="type" type="hidden" value="11"><input name="add" class="simple3" value="cохранить изменения" type="submit" style="width:1; height:1;  visibility:hidden"></form></div>';	 
	 print '<table border="0" cellpadding="0" cellspacing="5" width="100%"><tbody><tr><td colspan="2">';
	 include ("ecm_eco.php");
	 print '</td></tr></table>';
	}
?>

</tbody></table>
</td>
</tr>
</tbody></table>
</td></tr></tbody></table>
<br><br><br>
<br><br><br><br><br>
<?php 
//include ("all2.php"); 
?>
</div>