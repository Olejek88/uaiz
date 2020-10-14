<?php
require_once ("../../jpgraph2/jpgraph.php");
require_once  ("../../jpgraph2/jpgraph_log.php");
require_once  ("../../jpgraph2/jpgraph_line.php");
require_once  ("../../jpgraph2/jpgraph_bar.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
$query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
$query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
//------------------------------------------------------------------------
$max=30;
$type=2;
if ($_GET["type"]) $type=$_GET["type"];
if ($type!=1) $table='data'; else $table='hours';
     if ($_GET["prm"]=='1')
	{
	  $query = 'SELECT * FROM '.$table.' WHERE type='.$type.' AND prm=4 AND value<110 AND source=0 AND device='.$_GET["device"].' ORDER BY date DESC';
	  $a = mysql_query ($query,$i);
	  if ($a) $uy = mysql_fetch_row ($a);
	  while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}
     if ($_GET["prm"]=='2')
	{
	  $query = 'SELECT * FROM '.$table.' WHERE type='.$type.' AND prm=4 AND value<110 AND source=1 AND device='.$_GET["device"].' ORDER BY date DESC';
	  //echo $query;
	  $a = mysql_query ($query,$i); $rr=0;
	  if ($a) $uy = mysql_fetch_row ($a);
	  while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}

     if ($_GET["prm"]=='3')
	{
	  $query = 'SELECT * FROM '.$table.' WHERE type='.$type.' AND prm=12 AND value<80 AND source=6 AND device='.$_GET["device"].' ORDER BY date DESC';
	  $a = mysql_query ($query,$i);
	  if ($a) $uy = mysql_fetch_row ($a);
	  while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}
     if ($_GET["prm"]=='4')
	{
	  $query = 'SELECT * FROM '.$table.' WHERE type='.$type.' AND prm=12 AND value<80 AND source=5 AND device='.$_GET["device"].' ORDER BY date DESC';
	  $a = mysql_query ($query,$i); $rr=0;
	  if ($a) $uy = mysql_fetch_row ($a);
	  while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}
     if ($_GET["prm"]=='5')
	{
	  $query = 'SELECT * FROM '.$table.' WHERE type='.$type.' AND prm=11 AND source=0 AND device='.$_GET["device"].' ORDER BY date DESC';
	  $a = mysql_query ($query,$i);
	  if ($a) $uy = mysql_fetch_row ($a);
	  while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}
     if ($_GET["prm"]=='6')
	{
	  $query = 'SELECT * FROM '.$table.' WHERE type='.$type.' AND prm=11 AND source=1 AND device='.$_GET["device"].' ORDER BY date DESC';
	  $a = mysql_query ($query,$i); $rr=0;
	  if ($a) $uy = mysql_fetch_row ($a);
	  while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}
     if ($_GET["prm"]=='7')
	{
	  $query = 'SELECT * FROM '.$table.' WHERE type='.$type.' AND prm=13 AND source=10 AND device='.$_GET["device"].' ORDER BY date DESC';
	  $a = mysql_query ($query,$i);
	  if ($a) $uy = mysql_fetch_row ($a);
	  while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}
     if ($_GET["prm"]=='8')
	{
	  $query = 'SELECT * FROM '.$table.' WHERE type='.$type.' AND prm=13 AND source=11 AND device='.$_GET["device"].' ORDER BY date DESC';
	  $a = mysql_query ($query,$i);
	  if ($a) $uy = mysql_fetch_row ($a);
	  while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}
     if ($_GET["prm"]=='9')
	{
	  $query = 'SELECT * FROM '.$table.' WHERE type='.$type.' AND prm=13 AND source=2 AND device='.$_GET["device"].' ORDER BY date DESC';
	  $a = mysql_query ($query,$i); $rr=0;
	  if ($a) $uy = mysql_fetch_row ($a);
	  while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2];  $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}
     if ($_GET["prm"]=='10')
	{
	  $query = 'SELECT * FROM '.$table.' WHERE type='.$type.' AND prm=12 AND source=6 AND device='.$_GET["device"].' ORDER BY date DESC';
	  $a = mysql_query ($query,$i);
	  if ($a) $uy = mysql_fetch_row ($a);
	  while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}
     if ($_GET["prm"]=='11')
	{
	  $query = 'SELECT * FROM '.$table.' WHERE type='.$type.' AND prm=12 AND source=5 AND device='.$_GET["device"].' ORDER BY date DESC';
	  $a = mysql_query ($query,$i); $rr=0;
	  if ($a) $uy = mysql_fetch_row ($a);
	  while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2];  $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}

for ($i=0; $i<$max; $i++) 
	{ 
	 if ($_GET["type"]==1) $dat[$i]=$dats[$max-$i][8].$dats[$max-$i][9].'/'.$dats[$max-$i][5].$dats[$max-$i][6].' '.$dats[$max-$i][11].$dats[$max-$i][12].'-'.$dats[$max-$i][14].$dats[$max-$i][15]; 
	 if ($_GET["type"]==2) $dat[$i]=$dats[$max-$i][5].$dats[$max-$i][6].'-'.$dats[$max-$i][8].$dats[$max-$i][9]; 
	 if ($datas0[$max-$i]>0) $data0[$i]=$datas0[$max-$i]; else $data0[$i]=$datas0[$max-$i-1];
	 //echo $data0[$i].' '.$data1[$i].'<br>';
	}

if ($_GET["x"]!='') $graph = new Graph($_GET["x"],$_GET["y"],"auto");
else $graph = new Graph(1870,200,"auto");	
$graph->img->SetMargin(35,15,22,22);

$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($data0);
if ($_GET["prm"]==1) $lineplot->SetFillColor('#EB7E08');
if ($_GET["prm"]==2) $lineplot->SetFillColor('#5D6D2F');
if ($_GET["prm"]==3) $lineplot->SetFillColor('#EB7E08');
if ($_GET["prm"]==4) $lineplot->SetFillColor('#5D6D2F');
if ($_GET["prm"]==5) $lineplot->SetFillColor('#EB7E08');
if ($_GET["prm"]==6) $lineplot->SetFillColor('#5D6D2F');
if ($_GET["prm"]==7) $lineplot->SetFillColor('#EB7E08');
if ($_GET["prm"]==8) $lineplot->SetFillColor('#5D6D2F');
if ($_GET["prm"]==9) $lineplot->SetFillColor('#5D6D2F');

$graph->yaxis->HideZeroLabel();
//$graph->xaxis->HideLabels();
$graph->xaxis->SetTickLabels($dat);

$graph->SetMarginColor('#D0EEC2');
//$lineplot->SetShadow();
$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
$lineplot->SetWidth(0.8); 
$lineplot->value->Show();
$lineplot->SetValuePos('center');

if ($_GET["prm"]==1) $name='Температура подающей (С) / '.$_GET["name"].'                          ';
if ($_GET["prm"]==2) $name='Температура обратной (С) / '.$_GET["name"].'                          ';
if ($_GET["prm"]==3) $name='Потребление холодной воды (м3) / '.$_GET["name"].'                     ';
if ($_GET["prm"]==4) $name='Потребление горячей воды (м3) / '.$_GET["name"].'                     ';
if ($_GET["prm"]==5) $name='Расход подающей (м3) / '.$_GET["name"].'                               ';
if ($_GET["prm"]==6) $name='Расход обратки (м3) / '.$_GET["name"].'                               ';
if ($_GET["prm"]==7) $name='Тепловая энергия подающей (ГКал) / '.$_GET["name"].'              ';
if ($_GET["prm"]==8) $name='Тепловая энергия обратной (ГКал) / '.$_GET["name"].'              ';
if ($_GET["prm"]==9) $name='Тепловая энергия потребленная (ГКал) / '.$_GET["name"].'              ';
$graph->tabtitle->Set($name);

$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->tabtitle->SetWidth(TABTITLE_WIDTHFIT);

// Add the plot to the graph
//----------- title --------------------
$graph->Add($lineplot);

//----------- legend -------------------
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,8);
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8); 
// Display the graph
$graph->Stroke();
?>