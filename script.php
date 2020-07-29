<!DOCTYPE html>
<html>
    <head>
        <title>Лабораторная работа №1 //Неграш Андрей</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<link rel="stylesheet" type="text/css" href="style2.css">
    </head>
    <body>
        <?php
        $start = microtime(true);
        date_default_timezone_set('Europe/Moscow');
        $now= date("d.m.y H:i"); 
        $coordX=$_POST['coordX'];
        $coordYSee=$_POST['coordY'];
        $paramR=$_POST['paramR'];
        
        $coordNY=explode(",",$coordYSee);
        $coordY=$coordNY[0].".".$coordNY[1];
        $halfR=$paramR/2;
        $chetvert=0;
        if($coordX>0 && $coordY>0) $chetvert=2;
        if($coordX<0 && $coordY>0) $chetvert=1;
        if($coordX>0 && $coordY<0) $chetvert=3;
        if($coordX<0 && $coordY<0) $chetvert=4;
        if ($chetvert==1){
           $message= "Точка не входит в область";
        }
        
        if ($chetvert==2){
            $yfunk=-$coordX+$halfR;
            if($yfunk>=$coordY){
                $message= "Точка входит в область";
            }else{
                $message= "Точка не входит в область";
            }
        }
        
        if ($chetvert==3){
            if($coordY<=$halfR && $coordX<=$paramR){
                $message= "Точка входит в область";
            }else{
                $message= "Точка не входит в область";
            }
        }
        
        if ($chetvert==4){
            $distance=$coordX*$coordX+$coordY*$coordY;
            $distance=sqrt($distance);
            if ($distance>$halfR){
                $message= "Точка не входит в область";
            }else{
                $message= "Точка входит в область";
            }
        }
        if ($chetvert==0){
            if($coordX==0){
                if($coordY<=$halfR && $coordY>=-$halfR) {
                    $message="Точка входит в область";
                }else{
                    $message="Точка не входит в область";
                }
            }else{
                if($coordX<=$paramR && $coordX>=-$halfR) {
                    $message="Точка входит в область";
                }else{
                    $message="Точка не входит в область";
                }
            }
        }
        $finish = microtime(true);
        $timeWork=$finish-$start;
        $timeWork=round($timeWork,7);
        $ses=$_SESSION['counter'];
        $ses++;
        $_SESSION['str_'.$ses]="    <tr>
        <td> $now</td>
        <td> $timeWork с</td>
        <td>$coordX </td>
        <td> $coordYSee </td>
        <td> $paramR </td>
        <td> $message </td>
    </tr>";
        
?>
<h3><center><?php echo $message; ?></center></h3>
<br>
<center>
<table>
    <tr>
        <td>Дата и время запроса</td>
        <td>Время выполнения</td>
        <td>Координата X</td>
        <td>Координата Y</td>
        <td>Параметр R</td>
        <td>Результат</td>
    </tr>
    <?php 
    for($m=1;$m<=$ses;$m++){
        echo $_SESSION['str_'.$m];
    }
    ?>
    
</table>
</center>
    </body>
</html>
