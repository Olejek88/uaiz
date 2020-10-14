<?php
require_once ("../../jpgraph2/jpgraph.php");
require_once  ("../../jpgraph2/jpgraph_log.php");
require_once  ("../../jpgraph2/jpgraph_bar.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
$query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
$query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
//------------------------------------------------------------------------
$cm=1;  $id="mon".$cm;
while ($_GET[$id])
{
 $id="mon".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $dats[$cm]=$_GET[$id];
 $id="dat".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas1[$cm]=$_GET[$id]*1;
 $cm++;
 $id="mon".$cm;
}

$cm--;
for ($rr=0; $rr<$cm; $rr++) 
	{ 
	 $data[$rr]=$datas1[$cm-$rr]; 
	 $dat[$rr]=$dats[$cm-$rr];
	 //echo $dat[$rr].' '.$data[$rr].' '.$data2[$rr].'<br>';
	}

$graph = new Graph(1100,250,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($data);
$lineplot->SetFillColor("#006995");
$lineplot->SetWidth(0.9);

$graph->xaxis->SetTickLabels($dat);
$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('lavender');
$lineplot->value->SetFormat('%.3f');

$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
$graph->title->Set($_GET["name"]);

// Add the plot to the graph
$graph->img->SetMargin(55,8,33,25);
//----------- title --------------------
$lineplot->value->Show();
$graph->Add($lineplot);
//----------- legend -------------------
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8); 
// Display the graph
$graph->Stroke();
?>