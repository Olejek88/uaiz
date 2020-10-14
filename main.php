<link rel="stylesheet" type="text/css" href="files/AeroWindow-min.css">
<link rel="stylesheet" type="text/css" href="files/english.css">
<link rel="stylesheet" type="text/css" href="files/site.css">

<script type="text/javascript">
function Scratch(ts,ns)
	{
	 var d=document;
	 <?php
	 $query = 'SELECT * FROM uzels WHERE descr!="" ORDER BY id';
	 if ($e = mysql_query ($query,$i))
	 while ($ui = mysql_fetch_row ($e))
		{
		 print 'd.getElementById(\'active-'.$ui[0].'\').setAttribute(\'style\',\'display:none\');'; print "";
		 print 'd.getElementById(\'tab-'.$ui[0].'\').setAttribute(\'class\',\'inactive-summery\');'; print "";
		}
	 ?>

	 d.getElementById(ns).setAttribute('style','display:block');
	 d.getElementById(ts).setAttribute('class','inactive-summery active-summery'); 
	}
</script>

<td align="left" valign="top" width="250">
<table id="Table1" border="0" cellpadding="0" cellspacing="0" width="250">
	<tbody><tr>
	<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="21"><img src="files/icons_login.gif" height="17" hspace="1" vspace="1" width="20"></td>
	<td class="BlockHeaderLeftRight" height="20" width="228">&nbsp;<span id="IndicesLbl">Накопительные итоги</span></td>
	<td class="vdots" width="1"></td></tr>
	<tr><td colspan="2" align="left" valign="top"><iframe id="indicesIF" tabindex="0" marginwidth="0" src="current.php" scrolling="no" frameborder="0" height="100" width="250"></iframe></td><td class="vdots"></td></tr>
	<tr><td class="HDots"><img src="files/spacer_002.gif" height="3" width="3"></td><td class="HDots"></td><td class="vdots"></td></tr>
	<tr>
	<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="21"><img src="files/icons_login.gif" height="17" hspace="1" vspace="1" width="20"></td>
	<td class="BlockHeaderLeftRight" height="20" width="228">&nbsp;<span id="IndicesLbl">Нарастающие за месяц</span></td>
	<td class="vdots" width="1"></td></tr>
	<tr><td colspan="2" align="left" valign="top"><iframe id="indicesIF" tabindex="0" marginwidth="0" src="current2.php" scrolling="no" frameborder="0" height="100" width="250"></iframe></td><td class="vdots"></td></tr>
	<tr><td><img src="files/spacer_002.gif" height="3" width="3"></td><td></td><td class="vdots"></td></tr>
	<tr><td class="HDots"></td><td class="HDots"></td><td class="vdots"></td></tr>

	<tr>
	<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="21"><img src="files/icons_login.gif" height="17" hspace="1" vspace="1" width="20"></td>
	<td class="BlockHeaderLeftRight" height="20" width="228">&nbsp;<span id="IndicesLbl">Вход в систему</span></td>
	<td class="vdots" width="1"></td></tr>
	<form name="Form1" method="post" action="index.php" id="Form1">
	<tr><td colspan="2" align="left" valign="top">
	<table id="Market1" style="border: 1px solid White; background-color: rgb(250, 252, 251); font-family: Rod; width: 100%; border-collapse: collapse;" align="Center" border="0" cellpadding="4" cellspacing="0">
	<?php
	if ($_COOKIE["name"] && $_COOKIE["id"])
	        {
	         print '<tr style="color: Black; background-color: White; font-family: Verdana; font-size: xx-small;">
	    		<td colspan="5">Вы зарегистрированы в системе</td></tr>';
	        }
	else
	        {
	         print '<tr style="color: Black; background-color: White; font-family: Verdana; font-size: xx-small;">
			<td>Логин</td><td align="center"><input type="text" name="name" style="width:50px; height:18px; font-size:10px"></td>';
	         print '<td>Пароль</td><td align="center"><input type="text" name="pass" style="width:50px; height:18px; font-size:10px"></td>
			<td align="center" colspan="4"><input type="submit" value="войти" style="font-family: arial;  font-size:10px"></td>
			</tr>';
		}
	?>
	</table>
	</td></tr>
	<tr><td><img src="files/spacer_002.gif" height="3" width="3"></td><td></td><td class="vdots"></td></tr>
	</form>
	<tr><td class="HDots"></td><td class="HDots"></td><td class="vdots"></td></tr>

	<tr>
	<td bgcolor="#1881b6" height="20" valign="middle"><img src="files/most_viewed_com.gif" hspace="2" width="20"></td>
	<td class="BlockHeaderLeftRight">&nbsp;Узлы учета</td>
	<td class="vdots"></td>
	</tr>
	<tr>
	<td colspan="2"><table id="GulfBaseLeftBar1_ActiveProfilesGrid" style="border: 1px dotted White; background-color: White; font-family: Verdana; font-size: xx-small; width: 100%; border-collapse: collapse;" border="0" cellpadding="2" cellspacing="0">
	<tbody><tr class="GridHeaderStyle" style="border-style: none; background-color: rgb(229, 238, 244);">
	<td>Точка учета</td><td align="center">A</td><td align="center">U</td><td align="center">S</td></tr>
	<?php
	 $query = 'SELECT * FROM devices WHERE type=11 ORDER BY object,adr';
	 if ($e2 = mysql_query ($query,$i))
	 while ($ui2 = mysql_fetch_row ($e2))
		{
		 print '<tr>';
	         print '<td class="left">'.substr ($ui2[1],0,12).'</td>';
	         print '<td class="left">'; printf("&nbsp;[%d] [%x]",$ui2[10],$ui2[10]); print '</td>';
	         if ($ui2[14]==0) print '<td align="center"><img src="files/status4.gif"></td>';
                 if ($ui2[14]==1) print '<td align="center"><img src="files/status1.gif"></td>';
                 
	         if ($ui2[12]==0) print '<td align="center"><img src="files/status2.gif"></td>';
    		 if ($ui2[12]==1) print '<td align="center"><img src="files/status1.gif"></td>';
	         if ($ui2[12]==2) print '<td align="center"><img src="files/status3.gif"></td>';
	         if ($ui2[12]==3) print '<td align="center"><img src="files/status4.gif"></td>';
	         print '</tr>';
	        }
	 // print '<tr style="color: Black; background-color: White; font-size: xx-small;"><td><a style="font-weight: normal;" href="index.php?sel" title="'.$uo[1].'">'.$uo[1].'</a></td><td align="right">'.$uo[7].'</td></tr>';
	?>
	</tbody></table></td>
	<td class="vdots"></td>
	</tr>
	<tr><td class="HDots" colspan="2"></td><td class="vdots"></td></tr>
	</tbody></table>
	</td>

	<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">
	
	<div class="investment-tool">
        <div class="left-panel">
        <h5>Накопительные значения</h5>
            
        <table style="width: 100%;" align="right" cellpadding="0" cellspacing="0">
        <tbody><tr>
        <th class="Market-Sectors"><span>Канал</span></th>
        <th class="index"><span>Значение</span></th>
        <th class="index"><span>Всего</span></th>
        <th class="index"><span>(%)</span></th>
        <th class="index"><span>В рублях</span></th>
        <th class="index"><span>За месяц</span></th></tr>   

	<?php             
	 $today=getdate();
	 $startdate=sprintf ("%d%02d01000000",$today["year"],$today["mon"]-1);
	 $enddate=sprintf ("%d%02d01000000",$today["year"],$today["mon"]);

	 $tarif1=1.7; $tarif2=0.776; $tarif3=23; $tarif4=2282;
	 $query = 'SELECT * FROM channels WHERE opr>0 AND (prm!=4 AND prm!=2 AND prm!=16)';
	 if ($e3 = mysql_query ($query,$i))
	 while ($uo = mysql_fetch_row ($e3))
		{
		 $dis=0; $time=$cvalue=$pvalue1=$pvalue=$svalue=$ptime3=$rval1=$rval2='';
		 print '<tr><td class="sector-content"><a href="index.php?sel=channel&id='.$uo[0].'">'.$uo[1].'('.$uo[0].')</a></td>';

		 $query = 'SELECT * FROM data WHERE type=5 AND channel='.$uo[0].' ORDER BY date DESC';
		 if ($e4 = mysql_query ($query,$i))
		 if ($uo2 = mysql_fetch_row ($e4))
			 $pvalue=$uo2[3];

		 $query = 'SELECT SUM(value) FROM data WHERE type=2 AND channel='.$uo[0].' AND date>='.$startdate.' AND date<'.$enddate;
		 if ($e4 = mysql_query ($query,$i))
		 if ($uo2 = mysql_fetch_row ($e4))
			 $pvalue1=$uo2[0]; 

		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=5 AND prm='.$uo[9];
		 if ($e4 = mysql_query ($query,$i))
		 if ($uo2 = mysql_fetch_row ($e4))
			 { $svalue=$uo2[0]; $count=$uo2[1]; }
	
		 //if ($uo[9]==11) { $rval1=$pvalue*$tarif2; $rval2=$pvalue1*$tarif2; }
    		 //if ($uo[9]==12) { $rval1=$pvalue*$tarif3; $rval2=$pvalue1*$tarif3; }
		 //if ($uo[9]==14) { $rval1=$pvalue*$tarif1; $rval2=$pvalue1*$tarif1; }
		 if ($uo[9]==11) { $rval1=$pvalue; $rval2=$pvalue1; }
		 if ($uo[9]==12) { $rval1=$pvalue; $rval2=$pvalue1; }
		 if ($uo[9]==14) { $rval1=$pvalue; $rval2=$pvalue1; }

		 if ($svalue) $pr=$pvalue*100/$svalue; else $pr=0;

                 print '<td class="right">'.$pvalue.'</td>';
                 print '<td class="right">'.number_format($svalue,3).'('.$count.')</td>';
                 print '<td class="right">'.number_format($pr,4).'%</td>';
                 print '<td class="right">'.number_format($rval1,2).'</td>';
                 print '<td class="right">'.number_format($rval2,2).'</td>';
		 print '</tr>'; $cn++;
		}
	?>	
                
        </tbody></table>
        <div class="stock-summery">
        <h5>Текущие значения по всем каналам измерения</h5>
        <ul>
	<?
	 $query = 'SELECT * FROM uzels WHERE descr!="" ORDER BY id';
	 if ($e = mysql_query ($query,$i))
	 while ($ui = mysql_fetch_row ($e))
		{
		 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
		 if ($e2 = mysql_query ($query,$i)) 
		 if ($ui2 = mysql_fetch_row ($e2))
			{
		         if ($ui2[12]==1) $class='class="active"';
		         //if ($ui2[12]==2) $class='class="gainers"';
		         if ($ui2[12]==0) $class='class="decliners"';

		         if ($ui[0]==7) print '<li class="inactive-summery active-summery" id="tab-'.$ui[0].'" onclick="Scratch(\'tab-'.$ui[0].'\',\'active-'.$ui[0].'\')"><a href="#" '.$class.'></a><label>'.$ui[2].'</label></li>';
		         else print '<li class="inactive-summery" id="tab-'.$ui[0].'" onclick="Scratch(\'tab-'.$ui[0].'\',\'active-'.$ui[0].'\')"><a href="#" '.$class.'></a><label>'.$ui[2].'</label></li>';
			}
		}
	?>			 
        </ul>
	<?
	 $query = 'SELECT * FROM uzels WHERE descr!="" ORDER BY id';
	 if ($e = mysql_query ($query,$i))
	 while ($ui = mysql_fetch_row ($e))
		{
		 $cn=0;
		 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
		 if ($e2 = mysql_query ($query,$i)) 
		 while ($ui2 = mysql_fetch_row ($e2))
			{
			 if (!$cn)
			    {
    			     if ($ui[0]==7) $style='display: block;'; else $style='display: none;';
			     if ($ui2[12]==1) print '<div class="stock-summery-active" class="gainers" id="active-'.$ui[0].'" style="'.$style.'">';
			     else print '<div class="stock-summery-active" class="decliners" id="active-'.$ui[0].'" style="'.$style.'">';
			     print '<div class="stock-summery-margin">
				    <table cellpadding="0" cellspacing="0">
	                    	    <tbody><tr>
        	                    <th style="width:29%"><b>Канал</b></th>
    		                    <th><b>Последнее</b></th>
	    	            	    <th><b>Текущее</b></th>
	                    	    <th style="width:9%"><b>Накопительное</b></th>
	                    	    <th style="width:9%"><b>Часовое</b></th>
	                    	    <th style="width:9%"><b>Изменение</b></th>
    		            	    </tr>';
    		             } $cn++;
			 $query = 'SELECT * FROM channels WHERE prm!=2 AND opr>0 AND device='.$ui2[11];
			 if ($e3 = mysql_query ($query,$i))
			 while ($uo = mysql_fetch_row ($e3))
				{
				 $dis=0; $count=$time=$cvalue=$pvalue1=$pvalue=$svalue=$ptime3=$rval1=$rval2=$pvalue3=$pvalue4='';

				 $query = 'SELECT * FROM data WHERE type=0 AND channel='.$uo[0].' ORDER BY date DESC';
				 if ($e4 = mysql_query ($query,$i))
				 if ($uo2 = mysql_fetch_row ($e4))
					 { $value=$uo2[3]; $time=$uo2[2]; }

				 $query = 'SELECT * FROM data WHERE type=5 AND channel='.$uo[0].' ORDER BY date DESC';
				 if ($e4 = mysql_query ($query,$i))
				 if ($uo2 = mysql_fetch_row ($e4))
					 $pvalue=$uo2[3];

				 if ($pvalue==0 && $uo[9]!='4')
				    {
    				     $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=2 AND channel='.$uo[0];
				     if ($e4 = mysql_query ($query,$i))
				     if ($uo2 = mysql_fetch_row ($e4))
					 { $pvalue=$uo2[0]; $count='['.$uo2[1].']'; }
				    }
				 if ($uo[9]=='4') $pvalue='-';

				 $query = 'SELECT SUM(value) FROM data WHERE type=5 AND prm='.$uo[9];
				 if ($e4 = mysql_query ($query,$i))
				 if ($uo2 = mysql_fetch_row ($e4))
					 $svalue=$uo2[0];

				 $query = 'SELECT * FROM hours WHERE type=1 AND channel='.$uo[0].' ORDER BY date DESC LIMIT 2';
				 if ($e4 = mysql_query ($query,$i))
				 if ($uo2 = mysql_fetch_row ($e4))
					 { $pvalue3=$uo2[3]; $time=$uo2[2]; 
					   $uo2 = mysql_fetch_row ($e4);
    					   $pvalue4=$uo2[3];
					 }
				 $dis=$pvalue3-$pvalue4;
                                                                                                    
				 print '<tr><td class="company-link"><a href="index.php?sel=channel&id='.$uo[0].'">'.$uo[1].'</a></td>
	                                <td>'.$time.'</td>
	                                <td>'.$value.'</td>
	                                <td>'.$pvalue.' '.$count.'</td>
    	                                <td>'.$pvalue3.'</td>';
	                         if ($dis>0) print '<td class="no-right-border positive">'.number_format($dis,3).'</td>';
	                         if ($dis<0.001 && $dis>-0.001) print '<td class="no-right-border nochange">'.number_format($dis,3).'</td>';
                                 if ($dis<0) print '<td class="no-right-border negative">'.number_format($dis,3).'</td>';
	                         print	'</tr>';
				}                            
			}
                 print '</tbody></table></div></div>';
		}
            ?>         
            </div>
	</td>
	</tr>
	<tr>
	<td class="Vdots" style="border-top: 1px solid rgb(130, 158, 197); border-bottom: 1px solid rgb(130, 158, 197);" align="center" bgcolor="#e8f0f5"></td>
	<td style="border-top: 1px solid rgb(130, 158, 197); border-bottom: 1px solid rgb(130, 158, 197);" colspan="2" align="center" bgcolor="#e8f0f5"></td>
	</tr>
	<tr><td class="vdots" colspan="3"></td>
	</tr>
</tbody></table>
</td>
