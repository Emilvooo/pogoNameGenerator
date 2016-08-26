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
    <link rel="stylesheet" href="css/styles.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3><a href="/">pogoNameGenerator</a></h3>
                <p class="lead">Bulk generate Pokémon Go nicknames to use for botting!</p>
                <form method="post">
                    <div class="form-group">
                        <textarea class="form-control" id="textarea-name" name="name" style="height: 350px;">
                            <?php
                            foreach($pogoName->names as $name)
                            {
                                echo $name."\n";
                            }
                            ?>
                        </textarea>
                    </div>
                    <button type="button" id="btn-copy" class="btn btn-default btn-sm" data-clipboard-action="copy" data-clipboard-target="#textarea-name">
                        Copy to clipboard!
                    </button>
                    <button type="button" onclick="saveTextAsFile()" id="btn-save" class="btn btn-default btn-sm pull-xs-right">
                        Save as .txt!
                    </button>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="randomnick" name="randomnick" value="yes"> Generate random nicknames?
                        </label>
                    </div>
                    <div id="form-randomnick" class="form-group" style="display: none;">
                        <label for="exampleInputPassword1">How many nicknames?</label>
                        <input type="number" class="form-control" name="quantity-nick" min="1" value="10" required>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="randomcheck" name="randomcheck" value="yes"> Generate random string behind nicknames?
                        </label>
                    </div>
                    <div id="form-randomcheck" class="form-group" style="display: none;">
                        <label for="exampleInputPassword1">What lenght should the random string be?</label>
                        <input type="number" class="form-control" name="quantity-string" min="1" max="10" value="3" required>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="passcheck" name="passcheck" value="yes"> Should we add a password behind the username?
                        </label>
                    </div>
                    <div id="form-passcheck" class="form-group" style="display: none;">
                        <label for="exampleInputPassword1">Password?</label>
                        <input type="text" id="input-pass" class="form-control" name="password">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="comma" value="yes"> Add a comma to the end of every line?
                        </label>
                    </div>
                    <button type="submit" id="btn-submit" name="submit" class="btn btn-primary">
                        Generate nicknames!
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/main.min.js"></script>
</body>
</html>





