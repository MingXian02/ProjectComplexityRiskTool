<?php
$sectionid = 1;
$questionid = 1;
$sectionsQuery = $pdo->query("SELECT * FROM sections");
$sections = $sectionsQuery->fetchAll(PDO::FETCH_ASSOC);

foreach ($sections as $section) {

    // Retrieve the questions for each section
    $questionsQuery = $pdo->prepare("SELECT * FROM questions WHERE section_id = :section_id");
    $questionsQuery->bindValue(':section_id', $sectionid);
    $questionsQuery->execute();
    $questions = $questionsQuery->fetchAll(PDO::FETCH_ASSOC);

    foreach ($questions as $question) {


        // Retrieve the options for each question
        $optionsQuery = $pdo->prepare("SELECT * FROM options WHERE question_id = :question_id");
        $optionsQuery->bindValue(':question_id', $question['question_id']);
        $optionsQuery->execute();
        $options = $optionsQuery->fetchAll(PDO::FETCH_ASSOC);
        foreach ($options as $option) {
        }
        if (isset($_POST[$option['question_id']])) {
            array_push($_SESSION['option'], $_POST[$option['question_id']]);
            $stmt = $pdo->prepare("INSERT INTO score (score, questionid, sectionid) VALUES (:score, :questionid, :sectionid)");
            $stmt->execute(
                array(
                    ":score" => $_POST[$option['question_id']],
                    ":questionid" => $questionid,
                    ":sectionid" => $sectionid,
                )
            );
        } 
        $questionid++;
    }

    $sectionid++;
}
?>