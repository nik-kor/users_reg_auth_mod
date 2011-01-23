<h1>Login:</h1>
<div style='color: red'>
<?php echo $values['errors'];?>
</div>
<form action='/?action=Login' method='post'>
    <table>
        <tr>
            <td>Email</td>
            <td><input type='text' name='email' value='<?php echo $_POST['email']?>' /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input  type='password' name='password' value='<?php echo $_POST['password']?>' /></td>
        </tr>
        <tr>
            <td colspan=2><input type='submit' name='Submit' value='Submit' /></td>
        </tr>
    </table>
</form>

<a href='/?action=Register'>register</a>
