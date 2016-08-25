<?php
    include_once 'pogoNameGenerator.php';
    $pogoName = new pogoNameGenerator();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PogoNameGenerator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <nav class="navbar navbar-inverse marg-bot">
        <div class="container">
            <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2">&#9776;</button>
            <a class="hidden-sm-up menu" href="/">PogoNameGenerator</a>
            <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
                <a class="navbar-brand hidden-xs-down" href="/"><b>PogoNameGenerator</b></a>
                <ul class="nav navbar-nav">
                    <!--<li class="nav-item"><a href="/test/test">Home</a></li>-->
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <p>Generate Pokémon Go nicknames to use for botting!</p>
        <form method="post">
            <div class="form-group">
                <textarea class="form-control" id="textarea-name" name="name" style="height: 350px;">
                <?php
                    foreach($pogoName->names as $item)
                    {
                        echo $item."\n";
                    }
                ?>
                </textarea>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" id="randomnick" name="randomnick" value="yes"> Generate random nicknames?
                </label>
            </div>
            <div id="form-randomnick" class="form-group" style="display: none;">
                <label for="exampleInputPassword1">How many nicknames?</label>
                <input type="number" class="form-control" name="quantity-nick" min="1" value="10">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="randomcheck" name="randomcheck" value="yes"> Generate random string behind nicknames?
                </label>
            </div>
            <div id="form-randomcheck" class="form-group" style="display: none;">
                <label for="exampleInputPassword1">What lenght should the random string be?</label>
                <input type="number" class="form-control" name="quantity-string" min="1" max="10" value="3">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="passcheck" name="passcheck" value="yes"> Should we add a password behind the username?
                </label>
            </div>
            <div id="form-passcheck" class="form-group" style="display: none;">
                <label for="exampleInputPassword1">Password?</label>
                <input type="text" class="form-control" name="password">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="comma" value="yes"> Add a comma to the end of every line?
                </label>
            </div>
            <button type="submit" id="btn-submit" name="submit" class="btn btn-info">Generate!</button>
            <button type="submit" onclick="saveTextAsFile()" id="btn-save" class="btn btn-info">Save!</button>
        </form>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>





