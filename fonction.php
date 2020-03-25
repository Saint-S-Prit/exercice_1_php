<?php

function NbrsPremiers($valeur)
{
    
    $tabs =[];
                    
    for ($i=1; $i < $valeur; $i++)
    {          

        $reste = 1;
        $diviseur = 2; 

        while ($reste !== 0 && $diviseur <= sqrt($i)) 
        {
            $reste = $i % $diviseur;
            $diviseur = $diviseur + 1; 
        }
        if ($reste !== 0 && $i !== 1) 
        {
            $tabs[] = $i;
        }
    }

    return $tabs;
    
}










function resultat_par_page($tab_inferieurs,$page)
{
    $NbrParPage=100;
    $nbrElements = count($tab_inferieurs);
    $nombreDePages=ceil($nbrElements/$NbrParPage);

    

    $indiceDebut = ($page-1) * $NbrParPage;
    $indiceFin = $indiceDebut + $NbrParPage -1;

    echo "<table>";
    for ($i=$indiceDebut; $i <= $indiceFin ; $i+=10)
        { 
            echo "<tr>";
            for ($j=$i; $j < $i+10 ; $j++) { 
                echo "<td>";
                    echo $tab_inferieurs[$j]." ";
                echo "</td>";
            }
            echo "</tr>";
        }
    echo "</table>";
        echo "<br><br>";
        for ($i=1; $i <$nombreDePages ; $i++) 
        { 
            echo '<a href="index.php?page='.$i.'">'.$i." ".'</a>';
        }
   
}

?>





