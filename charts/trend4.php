<?php
include ("../../jpgraph2/jpgraph.php");
include ("../../jpgraph2/jpgraph_log.php");
include ("../../jpgraph2/jpgraph_line.php");
include ("../../jpgraph2/jpgraph_bar.php");
include("../config/local.php");
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$max=100;
if ($_GET["maxt"]!='') $max=$_GET["maxt"];
if ($_GET["name"]!='') $name=$_GET["name"];
$vkl=$_GET["vkl"];

$query = 'SELECT * FROM data WHERE channel='.$_GET["chan"].' ORDER BY date DESC LIMIT 700';
//echo $query;
$u = mysql_query ($query,$i); $rr=0;
if ($u) $uo = mysql_fetch_row ($u);
while ($uo)
	{
	 $datas0[$rr]=$uo[3]; $dats[$rr]=$uo[2]; 
	 //echo $datas0[$rr];
 	 $rr++;
	 if ($rr>$max) break;
	 $uo = mysql_fetch_row ($u);
	}

for ($i=0; $i<$rr; $i++) 
	{ 
	 $dat[$i]=$dats[$rr-$i-1];
	 $data0[$i]=$datas0[$rr-$i-1];
	}

//for ($i=0; $i<31; $i++) print $dat[$i].' '.$data0[$i];
// Create the graph. These two calls are always required
$graph = new Graph($_GET["width"],$_GET["height"],"auto");	
$graph->img->SetMargin(35,10,20,5);
//$graph->SetMargin(30,20,60,20);
$graph->SetMarginColor('white');
$graph->SetScale("linlin");
$graph->SetFrame(false);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->tabtitle->Set($name);
$graph->tabtitle->SetWidth(TABTITLE_WIDTHFIT);
$graph->xgrid->Show();
$graph->xgrid->SetColor('gray@0.5');
$graph->ygrid->SetColor('gray@0.5');
$graph->SetShadow();

$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);

// Create the linear plot
$lineplot=new LinePlot($data0);

// Add the plot to the graph
$graph->Add($lineplot);
$title=$_GET["name"].'                   ';
$graph->tabtitle->Set($title);
$graph->SetMarginColor('white');
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
//----------- legend -------------------
//$graph->xaxis->SetLabelAngle(45);
//$graph->xaxis->SetTickLabels($dat);

$lineplot->SetColor("red");
$lineplot->SetWeight(1);
$lineplot->SetStepStyle();
//--------------------------------------
// Display the graph
$graph->xaxis->HideLabels();
$graph->Stroke();
?>                   