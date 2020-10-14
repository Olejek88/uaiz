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
$cm=0;  $id="dat".$cm;
while ($_GET[$id])
{
 $id="dat".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $dats[$cm]=$_GET[$id];
 $id="da".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas1[$cm]=$_GET[$id]*1;
 $id="db".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas0[$cm]=$_GET[$id]*1;
 $cm++;
 $id="dat".$cm;
}

$graph = new Graph(850,280,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($datas1);
$lineplot->SetFillColor("#006995");
$lineplot2=new BarPlot($datas0);
$lineplot2->SetFillColor("#1881B6");

$lineplot->SetWidth(0.9);
$lineplot2->SetWidth(0.9);

$graph->xaxis->SetTickLabels($dats);
$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('lavender');

$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
if ($_GET["n1"]==2) $graph->title->Set("Потребление электроэнергии (кВт)");
if ($_GET["n1"]==8) $graph->title->Set("Потребление холодной воды (м3)");
if ($_GET["n1"]==6) $graph->title->Set("Потребление горячей воды (м3)");
if ($_GET["n1"]==13) $graph->title->Set("Потребление тепловой энергии (ГКал)");

// Add the plot to the graph
$graph->img->SetMargin(55,8,33,25);
//----------- title --------------------
$lineplot2->value->Show();
$lineplot->value->Show();

$name='Потребление до ЭСМ         ';
$name2='Фактическое потребление         ';

$graph ->legend->Pos( 0.03,0.01,"right" ,"top");
$lineplot->SetLegend($name);
$lineplot2->SetLegend($name2);

$gbplot  = new GroupBarPlot (array($lineplot,$lineplot2)); 
$graph->Add($gbplot);
//$acbplot->value->Show();
//$gbplot->value->Show();
$gbplot->SetWidth(0.9);
//----------- legend -------------------
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,8);
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8); 
// Display the graph
$graph->Stroke();
?>