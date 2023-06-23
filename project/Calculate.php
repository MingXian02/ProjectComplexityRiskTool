<?php
require_once "pdo.php";

// Calculate the section scores

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

require "InsertScore.php";
?>