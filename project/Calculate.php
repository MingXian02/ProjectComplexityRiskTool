<?php
require_once "pdo.php";


// Calculate and store the scores
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'question_') === 0) {
                $questionId = substr($key, 9);
                $score = $_POST[$key];

                $stmt = $pdo->prepare("INSERT INTO score (question_id, section_id, score) VALUES (:question_id, :section_id, :score)");
                $stmt->bindValue(':question_id', $questionId);
                $stmt->bindValue(':section_id', $sections[$questionId]['section_id']);
                $stmt->bindValue(':score', $score);
                $stmt->execute();
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Calculate the section scores
$sectionScores = array();
try {
    foreach ($sections as $section) {
        $sectionId = $section['section_id'];
        $stmt = $pdo->prepare("SELECT SUM(score) FROM score WHERE section_id = :section_id");
        $stmt->bindValue(':section_id', $sectionId);
        $stmt->execute();
        $sectionScore = $stmt->fetchColumn();
        $sectionScores[$sectionId] = $sectionScore;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Calculate the overall score
$stmt = $pdo->query("SELECT SUM(score) FROM score");
$totalScore = $stmt->fetchColumn();

// Display the section scores and overall score
echo '<h2>Section Scores</h2>';
foreach ($sections as $section) {
    $sectionId = $section['section_id'];
    echo '<p>' . $section['section_name'] . ' - Score: ' . $sectionScores[$sectionId] . '</p>';
}

echo '<h2>Overall Score</h2>';
echo '<p>Score: ' . $totalScore . '</p>';
?>
