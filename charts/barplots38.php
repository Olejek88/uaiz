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
$cm=1;  $id="dat".$cm;
while ($_GET[$id])
{
// echo $_GET[$id];
 $id="dat".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $dats[$cm-1]=$_GET[$id];
 $id="da".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas1[$cm-1]=$_GET[$id]*1;
 $id="db".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas0[$cm-1]=$_GET[$id]*1;
 $id="dc".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas3[$cm-1]=$_GET[$id]*1;
 $id="dd".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas2[$cm-1]=$_GET[$id]*1;
 $cm++;
 $id="dat".$cm;
}

$graph = new Graph(1040,280,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($datas1);
$lineplot->SetFillColor("#006995");
$lineplot2=new BarPlot($datas0);
$lineplot2->SetFillColor("#0000ff");
$lineplot3=new BarPlot($datas3);
$lineplot3->SetFillColor("#1881B6");
$lineplot4=new BarPlot($datas2);
$lineplot4->SetFillColor("#008888");

$lineplot->SetWidth(0.9);
$lineplot2->SetWidth(0.9);
$lineplot3->SetWidth(0.9);
$lineplot4->SetWidth(0.9);
$lineplot->value->SetFormat('%d');
$lineplot2->value->SetFormat('%d');
$lineplot3->value->SetFormat('%d');
$lineplot4->value->SetFormat('%d');

$graph->xaxis->SetTickLabels($dats);
$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('lavender');

$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
$graph->title->Set("Сравнение потребления за период (руб)");

// Add the plot to the graph
$graph->img->SetMargin(38,8,33,25);
//----------- title --------------------
$lineplot->value->Show();
$lineplot2->value->Show();
$lineplot3->value->Show();
$lineplot4->value->Show();

$name='ЭЭ до ЭСМ         ';
$name2='Пар до ЭСМ       ';
$name3='ЭЭ после ЭСМ      ';
$name4='Газ после ЭСМ     ';
$graph->legend->SetColumns(2);

$graph ->legend->Pos( 0.03,0.01,"right" ,"top");
$lineplot->SetLegend($name);
$lineplot2->SetLegend($name2);
$lineplot3->SetLegend($name3);
$lineplot4->SetLegend($name4);

$gbplot  = new GroupBarPlot (array($lineplot,$lineplot2,$lineplot3,$lineplot4)); 
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