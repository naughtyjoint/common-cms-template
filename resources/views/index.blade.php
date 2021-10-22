<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="title" content="9055蔬果舖|大桃園外送  在家仍享有新鮮蔬菜">
    <meta name="description" content="9055蔬果舖，生鮮蔬果．新鮮直送到家，每日挑選最新鮮蔬菜">
    <meta name="keywords" content="蔬菜、蔬菜箱、防疫蔬菜、防疫蔬菜箱、蔬果、雞蛋、鹹蛋、皮蛋、玉米筍、葉菜、根莖類、瓜類、桃園、桃園外送、防疫外送">
    <title>9055蔬果舖</title>
    <link rel="Shortcut Icon" type="image/x-icon" href="/img/9055.ico">
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    {{-- <?php
        echo "PHP Version: " . phpversion();
    ?> --}}
    <div id="app">
        <home
            :home-info="{{ $options }}"
            :veggie-lists="{{ $veggie_lists }}"
            :discounts="{{ $discounts }}"
            :payments="{{ $payments }}"
        ></home>
    </div>
    <script src="/js/app.js"></script>
</body>

</html>
