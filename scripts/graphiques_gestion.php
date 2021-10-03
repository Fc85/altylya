<script>
function toggle_graphs() {

new Chart(document.getElementById("journee"), {
    type: 'line',
    data: {
        labels: [   
        <?php
                date_default_timezone_set('Europe/Paris');
                $boucle2 = 0;
                for($boucle=0; $boucle<24; $boucle++){
                $heure = date('H');
                $heure = $heure - $boucle;
                if($heure<0){
                    $heure=23 - $boucle2;
                    $boucle2 = $boucle2 + 1;
                }
                echo'"';
                echo $heure."h";
                echo'",';
                }
        ?>],
        datasets: [{ 
            data: [<?php

                $id_bat = $_GET['id'];
                $moyenne = 0;
                $capteur = $bdd->query('SELECT temp FROM capteur WHERE id_bat='.$id_bat.' ORDER BY date_ DESC LIMIT 144');

                for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                    $moyenne = $moyenne + $data_capt['temp'];
                    if ($boucle % 6 == 0) {
                        $moyenne = $moyenne / 6;
                        echo round($moyenne, 1, PHP_ROUND_HALF_UP);
                        echo ",";
                        $moyenne = 0;
                    }
                }
            ?>],
            label: "Température (°C)",
            backgroundColor: "#ff0000",
            borderColor: "#ff0000",
            fill: false
        }, { 
            data: [<?php
                $capteur = $bdd->query('SELECT poussiere FROM capteur WHERE id_bat='.$id_bat.' ORDER BY date_ DESC LIMIT 144');
                for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                    $moyenne = $moyenne + $data_capt['poussiere'];
                    if ($boucle % 6 == 0) {
                        $moyenne = $moyenne / 6;
                        echo round($moyenne, 1, PHP_ROUND_HALF_UP);
                        echo ",";
                        $moyenne = 0;
                    }
                }
            ?>],
            label: "Poussière (µg/m3)",
            backgroundColor: "#00ff00",
            borderColor: "#00ff00",
            fill: false
        }, { 
            data: [<?php
                $capteur = $bdd->query('SELECT ammoniac FROM capteur WHERE id_bat='.$id_bat.' ORDER BY date_ DESC LIMIT 144');
                for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                    $moyenne = $moyenne + $data_capt['ammoniac'];
                    if ($boucle % 6 == 0) {
                        $moyenne = $moyenne / 6;
                        echo round($moyenne, 3, PHP_ROUND_HALF_UP);
                        echo ",";
                        $moyenne = 0;
                    }
                }
            ?>],
            label: "Ammoniaque (ppm)",
            backgroundColor: "#0000ff",
            borderColor: "#0000ff",
            fill: false
        }, { 
            data: [<?php
                $capteur = $bdd->query('SELECT humi FROM capteur WHERE id_bat='.$id_bat.' ORDER BY date_ DESC LIMIT 144');
                for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                    $moyenne = $moyenne + $data_capt['humi'];
                    if ($boucle % 6 == 0) {
                        $moyenne = $moyenne / 6;
                        echo round($moyenne, 1, PHP_ROUND_HALF_UP);
                        echo ",";
                        $moyenne = 0;
                    }
                }
            ?>],
            label: "Humidité (%)",
            backgroundColor: "#ff00b9",
            borderColor: "#ff00b9",
            fill: false
        }
    ]},
    options: {
        title: {
        display: true,
        text: 'Evolution sur la journee'
        }
    }
});

new Chart(document.getElementById("semaine"), {
    type: 'line',
    data: {
        labels: [
            <?php
                
                $datetime = new DateTime();
                echo'"';
                echo $datetime->format('D');
                echo'",';
                for($boucle=0; $boucle<6; $boucle++){
                    $datetime->modify('+1 day');
                    echo'"';
                    echo $datetime->format('D');
                    echo'",';
                }
            ?>
        ],
        datasets: [{ 
            data: [ <?php
                        $capteur = $bdd->query('SELECT temp FROM capteur WHERE id_bat=1 ORDER BY date_ DESC LIMIT 1008');   

                        for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                            $moyenne = $moyenne + $data_capt['temp'];
                            if ($boucle % 144 == 0) {
                                $moyenne = $moyenne / 144;
                                echo round($moyenne, 1, PHP_ROUND_HALF_UP);
                                echo ",";
                                $moyenne = 0;
                            }
                        }
                    ?>
    ],
            label: "Température (°C)",
            backgroundColor: "#ff0000",
            borderColor: "#ff0000",
            fill: false
        }, { 
            data: [ <?php
                        $capteur = $bdd->query('SELECT poussiere FROM capteur WHERE id_bat=1 ORDER BY date_ DESC LIMIT 1008');   

                        for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                            $moyenne = $moyenne + $data_capt['poussiere'];
                            if ($boucle % 144 == 0) {
                                $moyenne = $moyenne / 144;
                                echo round($moyenne, 1, PHP_ROUND_HALF_UP);
                                echo ",";
                                $moyenne = 0;
                            }
                        }
                    ?>
    ],
            label: "Poussière (µg/m3)",
            backgroundColor: "#00ff00",
            borderColor: "#00ff00",
            fill: false
        }, { 
            data: [ <?php
                        $capteur = $bdd->query('SELECT ammoniac FROM capteur WHERE id_bat=1 ORDER BY date_ DESC LIMIT 1008');   

                        for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                            $moyenne = $moyenne + $data_capt['ammoniac'];
                            if ($boucle % 144 == 0) {
                                $moyenne = $moyenne / 144;
                                echo round($moyenne, 3, PHP_ROUND_HALF_UP);
                                echo ",";
                                $moyenne = 0;
                            }
                        }
                    ?>
    ],
            label: "Ammoniaque (ppm)",
            backgroundColor: "#0000ff",
            borderColor: "#0000ff",
            fill: false
        }, { 
            data: [ <?php
                        $capteur = $bdd->query('SELECT humi FROM capteur WHERE id_bat=1 ORDER BY date_ DESC LIMIT 1008');   

                        for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                            $moyenne = $moyenne + $data_capt['humi'];
                            if ($boucle % 144 == 0) {
                                $moyenne = $moyenne / 144;
                                echo round($moyenne, 1, PHP_ROUND_HALF_UP);
                                echo ",";
                                $moyenne = 0;
                            }
                        }
                    ?>
    ],
            label: "Humidité (%)",
            backgroundColor: "#ff00b9",
            borderColor: "#ff00b9",
            fill: false
        }
    ]},
    options: {
        title: {
        display: true,
        text: 'Evolution sur la semaine'
        }
    }
});

new Chart(document.getElementById("mois"), {
    type: 'line',
    data: {
    labels: [
            <?php
                date_default_timezone_set('Europe/Paris');
                $datetime = new DateTime();
                for($boucle=0; $boucle<30; $boucle++){
                    echo'"';
                    echo $datetime->format('d');
                    echo'",';
                    $datetime->modify('+1 day');
                }
            ?>
    ],
    datasets: [{
        data: [
                <?php
                    $moyenne = 0;
                    $capteur = $bdd->query('SELECT temp FROM capteur WHERE id_bat=1 ORDER BY date_ DESC LIMIT 4320');   

                    for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                        $moyenne = $moyenne + $data_capt['temp'];
                        if ($boucle % 144 == 0) {
                            $moyenne = $moyenne / 144;
                            echo round($moyenne, 1, PHP_ROUND_HALF_UP);
                            echo ",";
                            $moyenne = 0;
                        }
                    }
                ?>
        ],
        label: "Température (°C)",
        backgroundColor: "#ff0000",
        borderColor: "#ff0000",
        fill: false
        }, { 
            data: [
                <?php
                    $moyenne = 0;
                    $capteur = $bdd->query('SELECT poussiere FROM capteur WHERE id_bat=1 ORDER BY date_ DESC LIMIT 4320');   

                    for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                        $moyenne = $moyenne + $data_capt['poussiere'];
                        if ($boucle % 144 == 0) {
                            $moyenne = $moyenne / 144;
                            echo round($moyenne, 1, PHP_ROUND_HALF_UP);
                            echo ",";
                            $moyenne = 0;
                        }
                    }
                ?>
        ],
        label: "Poussière (µg/m3)",
        backgroundColor: "#00ff00",
        borderColor: "#00ff00",
        fill: false
        }, { 
            data: [
                <?php
                    $moyenne = 0;
                    $capteur = $bdd->query('SELECT ammoniac FROM capteur WHERE id_bat=1 ORDER BY date_ DESC LIMIT 4320');   

                    for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                        $moyenne = $moyenne + $data_capt['ammoniac'];
                        if ($boucle % 144 == 0) {
                            $moyenne = $moyenne / 144;
                            echo round($moyenne, 3, PHP_ROUND_HALF_UP);
                            echo ",";
                            $moyenne = 0;
                        }
                    }
                ?>
        ],
        label: "Ammoniaque (ppm)",
        backgroundColor: "#0000ff",
        borderColor: "#0000ff",
        fill: false
        }, { 
            data: [
                <?php
                    $moyenne = 0;
                    $capteur = $bdd->query('SELECT humi FROM capteur WHERE id_bat=1 ORDER BY date_ DESC LIMIT 4320');   

                    for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                        $moyenne = $moyenne + $data_capt['humi'];
                        if ($boucle % 144 == 0) {
                            $moyenne = $moyenne / 144;
                            echo round($moyenne, 1, PHP_ROUND_HALF_UP);
                            echo ",";
                            $moyenne = 0;
                        }
                    }
                ?>
        ],
        label: "Humidité (%)",
        backgroundColor: "#ff00b9",
        borderColor: "#ff00b9",
        fill: false
        }
    ]},
    options: {
        title: {
        display: true,
        text: 'Evolution sur le mois'
        }
    }
});

new Chart(document.getElementById("annee"), {
    type: 'line',
    data: {
    labels: [
            <?php
                date_default_timezone_set('Europe/Paris');
                $datetime = new DateTime();
                for($boucle=0; $boucle<12; $boucle++){
                    echo'"';
                    echo $datetime->format('M');
                    echo'",';
                    $datetime->modify('+1 month');
                }
            ?>
    ],
    datasets: [{
        data: [
                <?php
                    $moyenne = 0;
                    $capteur = $bdd->query('SELECT temp FROM capteur WHERE id_bat=1 ORDER BY date_ DESC LIMIT 52560');   

                    for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                        $moyenne = $moyenne + $data_capt['temp'];
                        if ($boucle % 4380 == 0) {
                            $moyenne = $moyenne / 4380;
                            echo round($moyenne, 1, PHP_ROUND_HALF_UP);
                            echo ",";
                            $moyenne = 0;
                        }
                    }
                ?>
        ],
        label: "Température (°C)",
        backgroundColor: "#ff0000",
        borderColor: "#ff0000",
        fill: false
        }, { 
            data: [
                <?php
                    $moyenne = 0;
                    $capteur = $bdd->query('SELECT poussiere FROM capteur WHERE id_bat=1 ORDER BY date_ DESC LIMIT 52560');   

                    for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                        $moyenne = $moyenne + $data_capt['poussiere'];
                        if ($boucle % 4380 == 0) {
                            $moyenne = $moyenne / 4380;
                            echo round($moyenne, 1, PHP_ROUND_HALF_UP);
                            echo ",";
                            $moyenne = 0;
                        }
                    }
                ?>
        ],
        label: "Poussière (µg/m3)",
        backgroundColor: "#00ff00",
        borderColor: "#00ff00",
        fill: false
        }, { 
            data: [
                <?php
                    $moyenne = 0;
                    $capteur = $bdd->query('SELECT ammoniac FROM capteur WHERE id_bat=1 ORDER BY date_ DESC LIMIT 52560');   

                    for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                        $moyenne = $moyenne + $data_capt['ammoniac'];
                        if ($boucle % 4380 == 0) {
                            $moyenne = $moyenne / 4380;
                            echo round($moyenne, 3, PHP_ROUND_HALF_UP);
                            echo ",";
                            $moyenne = 0;
                        }
                    }
                ?>
        ],
        label: "Ammoniaque (ppm)",
        backgroundColor: "#0000ff",
        borderColor: "#0000ff",
        fill: false
        }, { 
            data: [
                <?php
                    $moyenne = 0;
                    $capteur = $bdd->query('SELECT humi FROM capteur WHERE id_bat=1 ORDER BY date_ DESC LIMIT 52560');   

                    for($boucle=1; $data_capt = $capteur->fetch(); $boucle++){
                        $moyenne = $moyenne + $data_capt['humi'];
                        if ($boucle % 4380 == 0) {
                            $moyenne = $moyenne / 4380;
                            echo round($moyenne, 1, PHP_ROUND_HALF_UP);
                            echo ",";
                            $moyenne = 0;
                        }
                    }
                ?>
        ],
        label: "Humidité (%)",
        backgroundColor: "#ff00b9",
        borderColor: "#ff00b9",
        fill: false
        }
    ]},
    options: {
        title: {
        display: true,
        text: "Evolution sur l'année"
        }
    }
});
}
</script>