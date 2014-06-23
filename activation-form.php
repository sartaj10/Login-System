<!DOCTYPE html>
<html>
  <head>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="signin/signin.css" rel="stylesheet">
   </head>

  <body>

<form name="form1" method="POST" action="check-activation-script.php">
  <div align="center">
    <table width="35%" border="0">
      <tr>
        <td>Name</td>
        <td>:</td>
        <td><label>
          <input name="name" type="text" id="name">
        </label></td>
      </tr>
      <tr>
        <td>Activation Code </td>
        <td><label>:</label></td>
        <td><input name="activation_code" type="text" id="activation_code"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><label>
          <input type="submit" name="Submit" value="Submit">
          <input type="reset" name="Submit2" value="Cancel">
        </label></td>
      </tr>
    </table>
</form>	
</body>
</html>