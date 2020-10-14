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
$rr=0;
 $query = 'SELECT * FROM data WHERE type=2 AND channel='.$_GET["chan"].' ORDER BY date DESC';
//echo $query;
 $a = mysql_query ($query,$i);
 if ($a) $uy = mysql_fetch_row ($a);
 while ($uy)
	{
	 $datas0[$rr]=$uy[3];
	 $dats[$rr]=$uy[2]; $rr++;
	 if ($rr>$max) break;
	 $uy = mysql_fetch_row ($a);
	}

for ($ii=0; $ii<$max; $ii++) 
	{
	 $dat[$ii]=$dats[$max-$ii][5].$dats[$max-$ii][6].'-'.$dats[$max-$ii][8].$dats[$max-$ii][9];
	 if ($datas0[$max-$ii]>0) $data0[$ii]=$datas0[$max-$ii]; else $data0[$ii]=$datas0[$max-$ii-1];
	 //echo $data0[$i].' '.$data1[$i].'<br>';
	}

$graph = new Graph(800,250,"auto");
$graph->img->SetMargin(35,15,22,22);

$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($data0);
$lineplot->SetFillColor('#EB7E08');
$graph->yaxis->HideZeroLabel();
//$graph->xaxis->HideLabels();
$graph->xaxis->SetTickLabels($dat);

//$graph->SetMarginColor('#D0EEC2');
//$lineplot->SetShadow();
$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
$lineplot->SetWidth(0.8); 
$lineplot->value->Show();
$lineplot->SetValuePos('center');

$name=$_GET["name"].'                          ';
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