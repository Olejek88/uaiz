<?php
include ("../../jpgraph2/jpgraph.php");
include ("../../jpgraph2/jpgraph_log.php");
include ("../../jpgraph2/jpgraph_line.php");
//include ("../../jpgraph2/jpgraph_bar.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$max=150;

$query = 'SELECT * FROM devices WHERE device='.$_GET["id"];
$u = mysql_query ($query,$i);
if ($u) $uo = mysql_fetch_row ($u);
if ($uo) $name='Режим работы '.$_GET["name"].'          ';
$gor=$uo[20]; $ven=$uo[21];

$query = 'SELECT * FROM hours WHERE type=1 AND value<1.1 AND channel='.$gor.' ORDER BY date DESC LIMIT '.$max;
//echo $query;
if ($u = mysql_query ($query,$i)) 
while ($uo = mysql_fetch_row ($u))
    {     
     $datas0[$rr]=$uo[2]; $dats0[$rr]=$uo[3];
     $rr++;
     if ($rr>$max) break;
     $uo = mysql_fetch_row ($u);
    }
$query = 'SELECT * FROM hours WHERE type=1 AND value<1.1 AND channel='.$ven.' ORDER BY date DESC LIMIT '.$max;
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
//$rr--;
for ($i=0; $i<$rr-1; $i++) 
	{ 
	 $dat[$i]=substr ($datas0[$rr-$i-1],0,10);
	 $data0[$i]=$dats0[$rr-$i-1];
	 $data1[$i]=$dats1[$rr-$i-1];
	 //echo $i.' '.$dat[$i].' '.$data0[$i].' '.$data1[$i].'<br>';
	}

//for ($i=0; $i<31; $i++) print $dat[$i].' '.$data0[$i];
// Create the graph. These two calls are always required
$graph = new Graph(1100,150,"auto");
$graph->img->SetMargin(35,15,22,25);
//$graph->SetMargin(30,20,60,20);
$graph->SetMarginColor('white');

//$graph->SetFrame(false);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,9);
$graph->tabtitle->Set($name);
$graph->tabtitle->SetWidth(TABTITLE_WIDTHFIT);
//$graph->xgrid->Show();
//$graph->xgrid->SetColor('gray@0.5');
//$graph->ygrid->SetColor('gray@0.5');

$graph->SetScale("textlin",0,1);

$graph->SetShadow();

$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);

// Create the linear plot
$lineplot=new LinePlot($data0);
$lineplot2=new LinePlot($data1);

// Add the plot to the graph
$graph->Add($lineplot);
$graph->Add($lineplot2);

$graph->SetMarginColor('white');
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
//----------- legend -------------------
//$graph->xaxis->SetLabelAngle(45);
$graph->xaxis->SetTickLabels($dat);
$graph->xaxis->SetTextTickInterval(10,0);

$lineplot->SetColor("red");
$lineplot->SetWeight(2);
$lineplot->SetStepStyle();
$lineplot2->SetStepStyle();
$lineplot2->SetColor("blue");
$lineplot2->SetWeight(2);
//--------------------------------------
// Display the graph
//$graph->xaxis->HideLabels();*/
$graph->Stroke();
?>