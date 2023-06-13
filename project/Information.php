<!DOCTYPE html>
<html>

<head>
    <title>Information Page</title>
    <!-- CSS styling -->
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h1>Information Page</h1>
    <p>The Project Complexity and Risk Assessment Tool (PCRA) is intended to support the Treasury Board Policy on the Management of Projects and the Standard for Project Complexity and Risk.</p>


    <?php require_once "PDO.php"; ?>

    <h2>Description of the sections</h2>
    <?php $sectionQuery = $pdo->prepare('SELECT * FROM sections');
    $sectionQuery->execute();
    $section = $sectionQuery->fetchAll(PDO::FETCH_ASSOC); ?>
    <table>
        <tr>
            <th>Section</th>
            <th>Description</th>
        </tr>
        <?php foreach ($section as $section) : ?>
            <tr>
                <td><?php echo $section['section_name'] . "(" . $section['number_of_question'] . " Questions) "; ?></td>
                <td><?php echo $section['description'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>


    <?php $sectionQuery = $pdo->prepare('SELECT * FROM sections');
    $sectionQuery->execute();
    $section = $sectionQuery->fetchAll(PDO::FETCH_ASSOC); ?>
    <h2>Value of the sections</h2>
    <table>
        <tr>
            <th>Section</th>
            <th>Number of Questions</th>
            <th>Maximum Score</th>
        </tr>
        <?php foreach ($section as $section) : ?>
            <tr>
                <td><?php echo $section['section_name'] ?></td>
                <td><?php echo $section['number_of_question'] ?></td>
                <td><?php echo $section['maximum_score'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Complexity and Risk Level Defined</h2>
    <table>
        <tr>
            <th>Level_id</th>
            <th>Complexity</th>
            <th>Defintion</th>
            <th>Score_range</th>
        </tr>
        <?php $complexityQuery = $pdo->prepare("SELECT * FROM complexity_risk_levels");
        $complexityQuery->execute();
        $result = $complexityQuery->fetchAll(PDO::FETCH_ASSOC); ?>
        <?php foreach ($result as $result) : ?>
            <tr>
                <td><?php echo $result['level_id']; ?></td>
                <td><?php echo $result['complexity']; ?></td>
                <td><?php echo $result['definition']; ?></td>
                <td><?php echo $result['score_range']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Calculation Method</h2>
    <p>The PCRA contains 64 questions. The questions are all given an equal percentage in the overall score. This tool is accompanied by the PCRA User Guide and an Excel spreadsheet that will tabulate the final score and rating automatically.

        There are a few rules for completing the PCRA:

        Every question must be answered. 
        <li>If you are sure a question does not apply to your project, answer with the lowest score ("1") for that question;</li>
        <li>If the answer to a question is unknown, answer with the highest score ("5") for that question; </li>
        <li>If you answer "1" to Question 2 in the "Project characteristics" section (3.1), questions in the "Procurement risks" section (3.3) should be answered with a "1" only.</li>

        </p>

    <h2>Project Complexity and Risk Assessment</h2>
    <?php
    $sectionsQuery = $pdo->query("SELECT * FROM sections");
    $sections = $sectionsQuery->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php foreach ($sections as $section) : ?>
        <?php
        $knowledgeareaQuery = $pdo->query("SELECT KA_text FROM knowledgearea JOIN sections ON knowledgearea.section_id = sections.section_id WHERE sections.section_id = " . $section['section_id']);
        $KA = $knowledgeareaQuery->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <h3><?php echo $section['section_name']; ?></h3>
        <table>
            <tr>
                <th>Knowledge Area</th>
                <th>Question</th>
                <th>Clarification</th>
                <th>Rating</th>
            </tr>
            <?php foreach ($KA as $row) : ?>
                <?php
                $questionsQuery = $pdo->query("SELECT questions.question_id, questions.question_text FROM questions JOIN knowledgearea ON questions.KA = knowledgearea.KA WHERE knowledgearea.KA_text = '" . $row['KA_text'] . "'");
                $questions = $questionsQuery->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php foreach ($questions as $index => $question) : ?>
                    <tr>
                        <?php if ($index === 0) : ?>
                            <td rowspan="<?php echo count($questions); ?>"><?php echo $row['KA_text']; ?></td>
                        <?php endif; ?>
                        <td><?php echo $question['question_text']; ?></td>
                        <?php
                        $clarificationsQuery = $pdo->query("SELECT clarification_text FROM clarifications WHERE question_id = " . $question['question_id']);
                        $clarifications = $clarificationsQuery->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <td>
                            <?php foreach ($clarifications as $clarification) : ?>
                                <li><?php echo $clarification['clarification_text']; ?><br></li>
                            <?php endforeach; ?>
                        </td>
                        <?php
                        $optionsQuery = $pdo->query("SELECT option_value, option_text FROM options WHERE question_id = " . $question['question_id']);
                        $options = $optionsQuery->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <td>
                            <?php foreach ($options as $option) : ?>
                                <?php echo $option['option_value'] . "=" . $option['option_text']; ?><br>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </table>
    <?php endforeach; ?>


</body>



</html>