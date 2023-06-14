<?php require_once 'PDO.php'; ?>

<html>

<head>
    <title>Complexity Risk Level</title>
</head>

<body>
    <?php
    $score = 81;

    $levelQuery = $pdo->query("SELECT * FROM complexity_risk_levels");
    $levels = $levelQuery->fetchAll(PDO::FETCH_ASSOC);

    if ($score < 45) {
        $level = $levels[0];
    } elseif ($score >= 45 && $score <= 63) {
        $level = $levels[1];
    } elseif ($score >= 64 && $score <= 82) {
        $level = $levels[2];
    } else {
        $level = $levels[3];
    }

    echo $level['complexity'] . '<br>';
    echo $level['definition'] . '<br>';
    ?>

</body>

</html>
