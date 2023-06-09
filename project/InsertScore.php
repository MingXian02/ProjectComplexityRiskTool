<!DOCTYPE html>
<html>

<head>
    <title>Assessment</title>
</head>

<body>
    <?php
    require "PDO.php";
    if ($sectionScores[0] != null) {
        $stmt = $pdo->prepare("INSERT INTO projectscore VALUES (:name, :username, :total, :s1, :s2, :s3, :s4, :s5, :s6, :s7)");
        $stmt->execute(
            array(
                ":name" => $name,
                ":username" => $username,
                ":total" => $totalScore,
                "s1" => $sectionScores[0],
                "s2" => $sectionScores[1],
                "s3" => $sectionScores[2],
                "s4" => $sectionScores[3],
                "s5" => $sectionScores[4],
                "s6" => $sectionScores[5],
                "s7" => $sectionScores[6],
            )
        );
    }
    ?>
</body>

</html>