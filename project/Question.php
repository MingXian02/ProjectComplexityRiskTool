<?php
$sectionid = 1;
$sectionsQuery = $pdo->query("SELECT * FROM sections");
$sections = $sectionsQuery->fetchAll(PDO::FETCH_ASSOC);

foreach ($sections as $section) {
    echo '<h2>' . $section['section_name'] . '</h2>';

    // Retrieve the questions for each section
    $questionsQuery = $pdo->prepare("SELECT * FROM questions WHERE section_id = :section_id");
    $questionsQuery->bindValue(':section_id', $sectionid);
    $questionsQuery->execute();
    $questions = $questionsQuery->fetchAll(PDO::FETCH_ASSOC);
    $questionid = 1;
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

        $questionname = "question" . $questionid;

        foreach ($options as $option) {
            echo '<label><input type="radio" name="' . $questionname . '"value="' . $option['option_score'] . '">' . $option['option_text'] . '</label><br>';
        }

        echo '</td>';
        echo '</tr>';

        if (isset($_POST[$questionname])) {
            $stmt = $pdo->prepare("INSERT INTO score (score, questionid, sectionid) VALUES (:score, :questionid, :sectionid)");
            $stmt->execute(
                array(
                    ":score" => $_POST[$questionname],
                    ":questionid" => $questionid,
                    ":sectionid" => $sectionid,
                )
            );
        }
        $questionid++;

    }

    echo '</table>';
    echo '</div>';
    $sectionid++;
}
?>