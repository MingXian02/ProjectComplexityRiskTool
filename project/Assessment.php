<?php
require_once "PDO.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assessment</title>
    <!-- CSS styling -->
    <link rel="stylesheet" href="Assessment.css">
</head>
<body>
    <h1>Assessment</h1>

    <form method="POST">
        <!-- Add a container for the tab navigation -->
        <div class="tab-navigation">
            <ul>
                <?php
                // Retrieve the sections from the database
                $sectionsQuery = $pdo->query("SELECT * FROM sections");
                $sections = $sectionsQuery->fetchAll(PDO::FETCH_ASSOC);

                foreach ($sections as $section) {
                    echo '<li><a href="#section-' . $section['section_id'] . '">' . $section['section_name'] . '</a></li>';
                }
                ?>
            </ul>
        </div>

        <!-- Add a container for the tab content -->
        <div class="tab-content">
            
            <?php
                require "Question.php";
            ?>
        </div>

        <button type="submit">Submit</button>
    </form>

    <?php


    ?>
</body>
</html>
