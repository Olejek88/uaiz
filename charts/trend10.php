<?php
include ("../../jpgraph2/jpgraph.php");
include ("../../jpgraph2/jpgraph_log.php");
include ("../../jpgraph2/jpgraph_line.php");
include ("../../jpgraph2/jpgraph_bar.php");
include("../config/local.php");
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);

//phpinfo();
$qnt=90;
$cn=1; $today=getdate(); $dy=31;
if ($_GET["year"]=='') $ye=$today["year"];
else $ye=$_GET["year"];
if ($_GET["month"]=='') $mn=$today["mon"];
else $mn=$_GET["month"];
if ($_GET["mday"]=='') $dy=$today["mday"]-1;
else $dy=$_GET["mday"];

for ($cn=1; $cn<=$qnt; $cn++)
    {
     $dats[$cn-1]=sprintf ("%02d/%02d",$dy,$mn);
     $date[$cn-1]=sprintf ("%d-%02d-%02d 00:00:00",$ye,$mn,$dy);

     $dy--; 
     if ($dy==0) 
        { 
         if ($mn>1) $mn--;
         else { $mn=12; $ye--; }

         $dy=31;
         if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
         if (!checkdate ($mn,29,$ye)) { $dy=28; }
         //echo $dy.'<br>';
        }
     $id="k".$cn;
     if ($_GET[$id] || $_GET[$id]==0) $datas1[$cn-1]=$_GET[$id]*1;
     //echo $id.' '.$datas1[$cn-1].'<br>';
     //$cn++;
    }

 $query = 'SELECT * FROM data WHERE type=2 AND channel=604';
 if ($a = mysql_query ($query,$i))
 while ($uy = mysql_fetch_row ($a))
	{
	 $x=0;	 
	 for ($tn=1; $tn<=$qnt; $tn++)
	     if ($uy[2]==$date[$tn]) $x=$tn;
	 $datas2[$x]=$uy[3];
	 //echo $x.' '.$uy[2].' '.$datas2[$x].'<br>';
        }

$cm=$qnt-1;
for ($rr=0; $rr<$cm; $rr++) 
	{ 
	 $data[$rr]=$datas1[$cm-$rr-1]; 
	 $data2[$rr]=$datas2[$cm-$rr-1];
	 if ($data2[$rr]<-30 || $data2[$rr]>30) $data2[$rr]=$datas2[$cm-$rr];
	 $dat[$rr]=$dats[$cm-$rr-1];
	 //echo $dat[$rr].' '.$data[$rr].' '.$data2[$rr].'<br>';
	}

// Create the graph. These two calls are always required
$graph = new Graph(1250,400,"auto");	
$graph->img->SetMargin(35,25,22,22);
//$graph->SetMargin(30,20,60,20);
$graph->SetMarginColor('white');
$graph->SetScale("linlin");
$graph->SetFrame(false);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->legend->SetFont(FF_ARIAL,FS_BOLD,8);

$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->tabtitle->SetWidth(TABTITLE_WIDTHFIT);
$graph->xgrid->Show();
$graph->xgrid->SetColor('gray@0.5');
$graph->ygrid->SetColor('gray@0.5');

$graph->SetScale("textlin",0,1);
$graph->SetY2Scale("lin",-30,30);

$graph->SetShadow();

$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);

// Create the linear plot
$lineplot=new LinePlot($data);
$lineplot2=new LinePlot($data2);

// Add the plot to the graph
$graph->Add($lineplot);
$graph->AddY2($lineplot2);

$graph->SetMarginColor('white');
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
//----------- legend -------------------
//$graph->xaxis->SetLabelAngle(45);
$lineplot->SetColor("red");
$lineplot->SetWeight(2);
$lineplot2->SetColor("blue");
$lineplot2->SetWeight(2);

//$graph->yaxis->SetWeight(1);
$graph->xaxis->SetTickLabels($dat);
$graph->legend->Pos(0.15,0.02);

$lineplot->SetLegend("Коэффициент использования оборудования                              ");
$lineplot2->SetLegend("Температура наружного воздуха                                      ");

//--------------------------------------
// Display the graph
//$graph->xaxis->HideLabels();
$graph->xaxis->SetTextTickInterval(3,0);
JpGraphError::SetImageFlag(false);

try {
     $graph->Stroke();
    }
catch ( JpGraphException $e ) 
	{ }
//$graph->Stroke();
?>                   