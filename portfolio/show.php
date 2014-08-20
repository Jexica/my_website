<?
    $baseDir = '../';

    $projectName = strip_tags($_GET['project']);
    $projectName = urlencode($projectName);

    if (!isset($projectName)) {
        die('No project specified');
    }

    // Each project is in a separate folder named after it
    $folderName = 'projects/' . $projectName;

    if (!file_exists($folderName)) {
        die('Could not open the specified project');
    }

    // Helper function to keep the path generation in one place
    function generateFilePath($folderName, $index) {
        return $folderName . "/" . $index . ".jpg";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Jessica López</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <? include "../common/favicon.phtml" ?>
    <link rel="stylesheet" type="text/css" href="../static/css/base.css">
    <link rel="stylesheet" type="text/css" href="../static/css/portfolio.css">
</head>
<body>
    <div id="page-wrapper">
        <? include "../common/header.phtml" ?>

        <section id="main-content">
        <?
            $i = 1;
            while (file_exists(generateFilePath($folderName, $i))) {
                echo '<img src="' . generateFilePath($folderName, $i) . '" class="sample">';
                $i++;
            }
         ?>
            <p class="back-link">
                <a href="./">Go back to the portfolio</a>
            </p>
        </section>

        <? include "../common/footer.phtml" ?>
    </div>
</body>
</html>
