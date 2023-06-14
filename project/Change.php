<!DOCTYPE html>
<html>

<head>
    <title>Assessment</title>
</head>

<body>
    <h1>Change</h1>
    <?php
    require "PDO.php";
    $id = explode('/', $_GET['id']);
    $sectionid = $id[0];
    $questionid = $id[1];

    $questionsQuery = $pdo->prepare("SELECT * FROM questions WHERE section_id = :si and question_id = :qi");
    $questionsQuery->execute(
        array(
            ':si' => $sectionid,
            ':qi' => $questionid,
        )
    );

    $questions = $questionsQuery->fetchAll(PDO::FETCH_ASSOC);
    echo "<div>";
    echo "<table>";
    foreach ($questions as $question) {

        echo '<tr>';
        echo '<td>' . $question['question_id'] . '. ' . nl2br($question['question_text']) . '</td>';
        echo '<form method="POST">';
        echo '<td><label>Change question:</label>';
        echo '<input type="text" name="question_' . $question['question_id'] . '">';
        echo '<input type="submit" value="Change Question"></form><br/>';
        echo '<tr>';
        echo '<td>';

        // Retrieve the options for each question
        $optionsQuery = $pdo->prepare("SELECT * FROM options WHERE question_id = :question_id");
        $optionsQuery->bindValue(':question_id', $question['question_id']);
        $optionsQuery->execute();
        $options = $optionsQuery->fetchAll(PDO::FETCH_ASSOC);

        foreach ($options as $option) {
            echo $option['option_text'] . '<br/>';
            echo '<form method="POST">';
            echo '<label>Change option: </label>';
            echo '<input type="text" name="option_' . $option['option_id'] . '">';
            echo '<input type="submit" value="Change Option"></form><br/>';
            if (isset($_POST['option_' . $option['option_id']])) {
                $update = $pdo->prepare("update options set option_text = :option where question_id = :qi and option_id = :oi");
                $update->execute(
                    array(
                        ":option" => $_POST['option_' . $option['option_id']],
                        ":qi" => $questionid,
                        ":oi" => $option['option_id'],
                    )
                );
            }

        }

        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';

    if (isset($_POST['question_' . $questionid])) {
        $update = $pdo->prepare("update questions set question_text = :question where question_id = :qi");
        $update->execute(
            array(
                ":question" => $_POST['question_' . $questionid],
                ":qi" => $questionid,
            )
        );
    }

    ?>
</body>
<a href="Maintenance.php">Back to Maintenance page</a>

</html>