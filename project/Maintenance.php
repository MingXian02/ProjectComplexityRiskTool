<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/maintenance.css">
</head>
<body>
<?php
require "PDO.php";
$sectionid = 1;
$questionid = 1;
$sectionsQuery = $pdo->query("SELECT * FROM sections");
$sections = $sectionsQuery->fetchAll(PDO::FETCH_ASSOC);

foreach ($sections as $section) {
    echo '<h2>' . $section['section_name'] . '</h2>';

    // Retrieve the questions for each section
    $questionsQuery = $pdo->prepare("SELECT * FROM questions WHERE section_id = :section_id");
    $questionsQuery->bindValue(':section_id', $sectionid);
    $questionsQuery->execute();

    $questions = $questionsQuery->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<div>";
    echo "<table>";
    foreach ($questions as $question) {

        echo '<tr>';
        echo '<td>' . $question['question_id'] . '. ' . nl2br($question['question_text']) . '</td>';
        echo '<td>';

        // Retrieve the options for each question
        $optionsQuery = $pdo->prepare("SELECT * FROM options WHERE question_id = :question_id");
        $optionsQuery->bindValue(':question_id', $question['question_id']);
        $optionsQuery->execute();
        $options = $optionsQuery->fetchAll(PDO::FETCH_ASSOC);

        foreach ($options as $option) {
            echo '<label><input type="radio" name="' . $option['question_id'] . '"value="' . $option['option_score'] . '">' . $option['option_text'] . '</label><br>';
        }

        echo '</td>';
        echo '<td>';
        echo '<button class="change-button" onclick="location.href=\'Change.php?id=' . $sectionid . '/' . $questionid . '\';">Change</button>';
        echo '</td></tr>';

        

        $questionid++;
    }
    echo '</table>';
    echo '</div>';
    $sectionid++;
}
?>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
