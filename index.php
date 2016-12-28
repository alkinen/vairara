<?php
$name = "Oleg";
$age = 25;
function wellcome_Message($name, $age)
{
    echo "Wellcome to PHP " . $name . "</br>Your age is " . $age;
}

//wellcome_Message($name, $age);
?>


<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta content="origin-when-cross-origin" name="referrer"/>
    <meta name='robots' content='noindex,follow'/>
</head>
<body>
<p><a href="https://www.codecademy.com/courses/web-beginner-en-StaFQ/0/1?curriculum_id=5124ef4c78d510dd89003eb8">Курсы PHP</a></p>
<div class="header"><h1>
        <?php
        $welcome = "Let's get started with PHP!";
        echo $welcome;
        ?>
    </h1></div>
<p><strong>Generate a list:</strong>
    <?php
    for ($number = 1; $number <= 10; $number++) {
        if ($number <= 9) {
            echo $number . ", ";
        } else {
            echo $number . "!";
        }
    }; ?>
</p>
<p><strong>Things you can do:</strong>
    <?php
    $things = array("Talk to databases",
        "Send cookies", "Evaluate form data",
        "Build dynamic webpages");
    foreach ($things as $thing) {
        echo "<li>$thing</li>";
    }

    unset($thing);
    ?>
</p>
<p><strong>This jumbled sentence will change every time you click Submit!<strong></p>
<p>
    <?php
    $words = array("the ", "quick ", "brown ", "fox ",
        "jumped ", "over ", "the ", "lazy ", "dog ");
    shuffle($words);
    foreach ($words as $word) {
        echo $word;
    };

    unset($word);
    ?>
</p>
</body>
</HTML>


