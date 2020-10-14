<?php
require_once ("../../jpgraph2/jpgraph.php");
require_once  ("../../jpgraph2/jpgraph_log.php");
require_once  ("../../jpgraph2/jpgraph_line.php");
require_once  ("../../jpgraph2/jpgraph_bar.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
//------------------------------------------------------------------------
$max=15;

$query = 'SELECT * FROM devices WHERE device='.$_GET["id"];
$u = mysql_query ($query,$i);
if ($u) $uo = mysql_fetch_row ($u);
if ($uo) $name='Режим работы '.$_GET["name"].'          ';
$gor=$uo[20]; $ven=$uo[21];

$query = 'SELECT * FROM data WHERE type=2 AND value<24.1 AND channel='.$gor.' ORDER BY date DESC LIMIT '.$max;
//echo $query;
if ($u = mysql_query ($query,$i)) 
while ($uo = mysql_fetch_row ($u))
    {     
     $datas0[$rr]=$uo[2]; $dats0[$rr]=$uo[3];
     $rr++;
     if ($rr>$max) break;
     $uo = mysql_fetch_row ($u);
    }
$query = 'SELECT * FROM data WHERE type=2 AND value<24.1 AND channel='.$ven.' ORDER BY date DESC LIMIT '.$max;
//echo $query; 
$rr=0;
if ($u = mysql_query ($query,$i)) 
while ($uo = mysql_fetch_row ($u))
    {     
     $datas1[$rr]=$uo[2]; $dats1[$rr]=$uo[3];
     $rr++;
     if ($rr>$max) break;
     $uo = mysql_fetch_row ($u);
    }

for ($i=0; $i<$rr; $i++) 
	{ 
	 $dat[$i]=substr ($datas0[$rr-$i-1],0,10);
	 $data0[$i]=$dats0[$rr-$i-1];
	 $data1[$i]=$dats1[$rr-$i-1]; 
	 //echo $dat[$i].' '.$data0[$i].' '.$data1[$i].'<br>';
	}

$graph = new Graph(1000,300,"auto");
//$graph = new Graph(1000,300,0,30);
$graph->SetScale("textlin",0,30);
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($data0);
$lineplot->SetFillColor("red");
$lineplot2=new BarPlot($data1);
$lineplot2->SetFillColor("blue");
$gbplot  = new GroupBarPlot (array($lineplot ,$lineplot2)); 
$graph->Add($gbplot);

$lineplot->SetWidth(0.8);
$lineplot2->SetWidth(0.8);

$graph->xaxis->SetTickLabels($dat);
$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('lavender');

$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
$lineplot2->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
$lineplot->value->SetFormat('%.3f');
$lineplot2->value->SetFormat('%.3f');

// Add the plot to the graph
$graph->img->SetMargin(45,8,33,25);
//----------- title --------------------
$lineplot2->value->Show();
$lineplot->value->Show();

$graph->title->Set($name);

$name='Sostoyanie gorelki  ';
$name2='Sostoyanie ventilyatora  ';

$graph ->legend->Pos( 0.01,0.01,"right" ,"top");
$lineplot->SetLegend($name);
$lineplot2->SetLegend($name2);

$gbplot->SetWidth(0.7);
//----------- legend -------------------
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,9);
$graph->title->SetFont(FF_ARIAL,FS_NORMAL);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8); 
// Display the graph
$graph->Stroke();
?>