<h1>ModifyRegister - TODO - :</h1>
<div style='color: red'>
<?php echo $values['errors'];?>
</div>
<form action='/?action=ModifyRegister' method='post'>
    <table>
        <tr>
            <td>Email</td>
            <td><?php echo $values['user']['email']?></td>    
        </tr>
        <tr>
            <td>question</td>
            <td><?php echo $values['user']['email']?></td>    
        </tr>
        <tr>
            <td colspan=2><input type='submit' name='Submit' value='Submit' /></td>
        </tr>
    </table>
</form>

<a href='?action=Logout'>Logout</a>
