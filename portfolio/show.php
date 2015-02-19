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
            $baseUrl = 'http://www.jessicalopez.me';
            $url = urlencode($baseUrl . '/portfolio/show.php?project=' . $projectName);
            $imgUrl = generateFilePath($folderName, $i);
            while (file_exists($imgUrl)) {
                $mediaUrl = urlencode($baseUrl . '/portfolio/' . $imgUrl);
                echo <<<HTML
<div class="show-item-wrapper">
    <div class="show-item">
        <img src="$imgUrl" class="sample">
        <div class="show-item-link">
            <a href="//es.pinterest.com/pin/create/button/?url=$url&media=$mediaUrl&description=www.jessicalopez.me"
                data-pin-do="buttonPin" data-pin-height="28">
            <img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_28.png" /></a>
        </div>
    </div>
</div>
HTML;
                $i++;
                $imgUrl = generateFilePath($folderName, $i);
            }
         ?>
            <p class="back-link">
                <a href="./">Go back to the portfolio</a>
            </p>
        </section>

        <? include "../common/footer.phtml" ?>
    </div>

    <script type="text/javascript" async defer src="//assets.pinterest.com/js/pinit.js"></script>
    <script type="text/javascript">
        var linkNode, items = document.getElementsByClassName('show-item');

        for (var i = 0; i < items.length; i++) {
            linkNode = items[i].getElementsByClassName('show-item-link')[0]

            items[i].onmouseover = function (linkNode) {
                return function (e) {
                    linkNode.style.visibility = 'visible';
                }
            }(linkNode);


            items[i].onmouseout = function (linkNode) {
                return function (e) {
                    linkNode.style.visibility = 'hidden';
                }
            }(linkNode);
        }
    </script>
</body>
</html>
