<?php
session_start();
if (!isset($_SESSION['nombrepremiers'])) {

    $nombrepremier = [
        'inferieurs' =>[],
        'superieurs' =>[]
    ];
 $_SESSION['nombrepremiers'] = $nombrepremier;   
}


include_once('fonction.php');

    if (isset($_POST['submit'])) {
        $valeur = htmlentities($_POST['valeur']);
        if (!empty($valeur)) {

            if (is_numeric($valeur)) {
                
                if ($valeur ==! 0 && $valeur > 0) 
                {
                   $tabs = NbrsPremiers($valeur);

                    $SommeElementsTableau = array_sum($tabs);
                    $NbrElementsTableau = count($tabs);
                        
                    $MoyenneTableau = floor($SommeElementsTableau / $NbrElementsTableau) ;

                    $Tableau_T = [
                        'inferieur' =>[],
                        'superieur' =>[]
                    ];

                   for ($i=0; $i < $NbrElementsTableau; $i++) { 

                        if ($tabs[$i] < $MoyenneTableau) {
                            
                           $Tableau_T['inferieur'][] = $tabs[$i];
                           $_SESSION['nombrepremiers']['inferieurs'] =  $Tableau_T['inferieur'];
                            
                        }
                        else
                        {
                            array_push($Tableau_T['superieur'],$tabs[$i]);
                            $_SESSION['nombrepremiers']['superieurs'] =  $Tableau_T['superieur'];

                            $valide = "voici le resutat ";
                        }

                    }

                }
                else
                {
                    $erreurs ="le nombre saisi doit être positif!";
                }
            }
            else
            {
                $erreurs ="le nombre saisit doit être un entier!";
            }
            
        }
        else
        {
            $erreurs ="Veuillez remplir un nombre svp!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
        <fieldset>
        <legend>
                une valeur entière supérieure à 10 000
        </legend>
        <form action="" method="post">
            <label for="">Entrer un nombre</label><br>

            <input type="text" name="valeur">
            <input type="submit" name="submit" value="executer">
        </form>
        </fieldset>

        <?php if (isset($erreurs)) {
            echo "<p class='erreurs'>".$erreurs."</p>";
        }
        ?>

        <?php if (isset($valide)) {
            echo "<p class='valide'>".$valide."</p>";
        }
        ?>


    <div class="main">
        <div class="inferieur">
            <h1>
                Tableau Inférieur
            </h1>
            <?php
                if (!empty($_SESSION['nombrepremiers']['inferieurs']))
                {
                    $tab_inferieurs = $_SESSION['nombrepremiers']['inferieurs'];

                    if (isset($_GET['page']) && $_GET['page'] >0)
                    {
                        $page = intval($_GET['page']);                
                    }
                    else
                    { 
                        $page= 1;
                    }
                    
                    echo resultat_par_page($tab_inferieurs,$page);
                }
                
            ?>

        </div>
        <div class="superieur">
            <h1>
                Tableau Superieurs
            </h1>
            <?php
                if (!empty($_SESSION['nombrepremiers']['superieurs']))
                {

                    $tab_superieurs = $_SESSION['nombrepremiers']['superieurs'];
                    if (isset($_GET['page']) && $_GET['page'] >0)
                    {
                        $page = intval($_GET['page']);                
                    }
                    else
                    { 
                        $page= 1;
                    }

                    echo resultat_par_page($tab_superieurs,$page);
                    
                }
            ?>
        </div>
    </div>
</body>
</html>



