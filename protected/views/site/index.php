<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>

<?php
/*echo CHtml::link("<strong>Accueil</strong>", array('/'));
echo " | ";
echo CHtml::link("Données personnelles", array('users/modif'));*/
foreach($rides as $ride)
{
    $r[$ride->id]=0;
}
echo "<table>";
$i=0;
$date=$datetime = date('Y-m-d 00:00:00', time());
while($i<20 && array_sum($r)<count($rides))
{
    foreach ($rides as $ride) {
        if($ride->startDate<$date && $ride->endDate>=$date && $ride->day==date('N',strtotime($date)) && $r[$ride->id]==0){
            echo "<tr onclick=";
            echo "\"document.location='/covoiturage/covoiturage/rides/".$ride->id."';";
            echo "\">";
            echo "<td>".CHtml::link($ride->driver->cpnvId, array('rides/view', 'id' => $ride->id))."</td>";
            echo "<td>".CHtml::link("0/".$ride->seats, array('rides/view', 'id' => $ride->id))."</td>";

            echo "<td>".CHtml::link($ride->departuretown->name, array('rides/view', 'id' => $ride->id))."</td>";
            echo "<td>".CHtml::link("--->", array('rides/view', 'id' => $ride->id) )."</td>";
            echo "<td>".CHtml::link($ride->arrivaltown->name, array('rides/view', 'id' => $ride->id))."</td>";
            
            echo "<td>".CHtml::link(substr($ride->departure, 11, 5), array('rides/view', 'id' => $ride->id))."</td>";
            echo "<td>".CHtml::link(substr($ride->arrival, 11, 5), array('rides/view', 'id' => $ride->id))."</td>";
            
            switch ($ride->day) {
                    case '1':
                        $day = "Lundi";
                        break;
                    case '2':
                        $day = "Mardi";
                        break;
                    case '3':
                        $day = "Mercredi";
                        break;
                    case '4':
                        $day = "Jeudi";
                        break;
                    case '5':
                        $day = "Vendredi";
                        break;
                    case '6':
                        $day = "Samedi";
                        break;
                    case '7':
                        $day = "Dimanche";
                        break;
                    default:
                        $day = "?";
                        break;
                }

            $nextday = date("d-m-Y",strtotime($date));

            echo "<td>".CHtml::link($day." ".$nextday,array('rides/view', 'id' => $ride->id))."</td>";
            echo "</tr>";
            $i++;
        }
        if($ride->endDate<$date)
        {
            $r[$ride->id]=1;
        }
    }
    $date=date('Y-m-d 00:00:00', strtotime($date.' +1 day'));
}
echo "</table>";

/*
//afficher 20 trajets en comptant les récurrences

i=0 //dès qu'une ligne est affichée, augmente de 1
j=date //commence à aujourd'hui, à chaque while, augmente d'un jour
while i<=20
    pour tout les rides en tant que ride    //on parcours tous les rides transmis par le controlleur
        si ride->startdate<=j && ride.joursemaine=j.joursemaine //afin de n'afficher que les rides voulus
            affiche le ride
        end si
    end pour tout
    i++
    j=j+1 jour
endwhile
*/

?>