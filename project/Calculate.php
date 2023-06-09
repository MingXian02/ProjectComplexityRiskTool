<?php
require_once "pdo.php";

// Calculate the section scores
$sectionScores = array();
try {
    for ($section = 1; $section <= 7; $section++) {
        $stmt = $pdo->prepare("SELECT SUM(score) FROM score WHERE sectionid = :section_id");
        $stmt->bindValue(':section_id', $section);
        $stmt->execute();
        $sectionScore = $stmt->fetchColumn();
        array_push($sectionScores, $sectionScore);
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Calculate the overall score
$stmt = $pdo->query("SELECT SUM(score) FROM score");
$totalScore = $stmt->fetchColumn();

// Display the section scores and overall score
echo '<h2>Section Scores</h2>';
for ($section = 0; $section < 7; $section++) {
    
    echo '<p>Score: ' . $sectionScores[$section] . '</p>';
}

echo '<h2>Overall Score</h2>';
echo '<p>Score: ' . $totalScore . '</p>';

require "InsertScore.php";
?>