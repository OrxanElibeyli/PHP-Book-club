
<?php

function test()
{
    echo '"error"';
}

?>

<html>
    <head>
        <title>weerg</title>
        <style>
            .error
            {
                background-color: red;
            }
        </style>

    </head>
    <body>
                <div class=<?php test(); ?>>
                    <label for="test" >test<label>
                    <input type="text" name="firstName"/>
                    <br>
                </div>
                <label for="test2">lastName</label>
                <input type="text" name="lastName"/>
                <br>
                <label>lastName</label>
                <input type="text" name="lastName"/>
                <br>
                <label>lastName</label>
                <input type="text" name="lastName"/>
                <br>
                <label>lastName</label>
                <input type="text" name="lastName"/>
                <br>
    </body>
</html>