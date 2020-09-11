<!DOCTYPE html>
<html>
  <head>
    <title>login</title>
    <link rel="stylesheet" href="CSS/style.css">
  </head>

  <body>

    <?php

    $cls="";

    if(isset($_POST['submitButton']))
    {
      check();
    }
    else
    {
      showForm("true");
    }

    function check()
    {
      $missingFields=array();
      $requiredFields=array("firstName","lastName","password","password2");

      foreach ($requiredFields as $requiredField)
      {
        if(!$_POST[$requiredField])
        {
          $missingFields[]=$requiredField;
        }
      }

      showForm($missingFields);


    }



    ?>


        <?php
        function showForm($missingFields)
        {
          ?>

          <div class="split right">
            <form class="form" action="draft.php" method="post">
              <table class="table">
                <tr class="tableRows">
                  <td class="tableDatas <?php if(in_array("firstName",$missingFields)) echo 'error';  ?>" ><label for="firstName">First name</label></td>
                  <td class="tableDatas"><input type="text" name="firstName" value="<?php echo $_POST["firstName"] ?>"/></td>
                </tr>

                <tr class="tableRows">
                  <td class="tableDatas <?php if(in_array("lastName",$missingFields)) echo 'error'  ?>"><label for="lastName">Last name</label></td>
                  <td class="tableDatas"><input type="text" name="lastName" value="<?php echo $_POST["lastName"] ?>"/></td>
                </tr>

                <tr class="tableRows">
                  <td class="tableDatas <?php if(in_array("password",$missingFields)) echo 'error'  ?>"><label for="password">password</label></td>
                  <td class="tableDatas"><input type="password" name="password" /></td>
                </tr>

                <tr class="tableRows">
                  <td class="tableDatas <?php if(in_array("password2",$missingFields)) echo 'error'  ?>">password</label></td>
                  <td class="tableDatas"><input type="password" name="password2"/ ></td>
                </tr>
              </table>

              <input class="buttons" type="submit" name="submitButton" value="Submit" >
              <input class="buttons" type="reset" name="resetButton" value="Reset">

            </form>

          </div>

      <?php
    } ?>

    <div class="split left">
      <h1>this is test</h1>
    </div>


  </body>
</html>