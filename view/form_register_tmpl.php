<form action="<?php echo HREF('user', 'register2'); ?>" method="POST">
    
    <fieldset >
    <legend>Register</legend>
    <table>
    <tr>
    	<td><label for='email' >Email Address*:</label></td>
    	<td><input type='text' name='email' id='email' maxlength="50" /></td>
    </tr>
    <tr>
        <td><label for='password' >Password*:</label></td>
        <td><input type='password' name='password' id='password' maxlength="50" /></td>
    </tr>
    <tr>
        <td><label for='password' >Confirm Password*:</label></td>
        <td><input type='password' name='confirmpassword' id='confirmpassword' maxlength="50" /></td>
    </tr>
    <tr>
    <td><label for='firstname' >First Name*: </label></td>
    <td><input type='text' name='firstname' id='firstname' maxlength="50" /></td>
    </tr>
    <tr>
    <td><label for='lastname' >Last Name*: </label></td>
    <td><input type='text' name='lastname' id='lastname' maxlength="50" /></td>
    </tr>       
    <tr>
    <td><label for='phone' >Phone*:</label></td>
   <td> <input type='tel' name='phone' id='phone' maxlength="50" /></td>
    </tr>
    <tr>
    <td><label for='address' >Address*:</label></td>
    <td> <input type='text' name='address' id='address' maxlength="50" /></td>
    </tr>
    <tr><td><label for='gender' >Gender*:</label></td>
    <td>
        <select name="gender" id="gender">
            <option value="0">Nam</option>
            <option value="1">Nu</option>
        </select>
    </td>
    </tr>
   
    <td></td>
    <td><input type='submit' name='Submit' value='Submit' /></td>
    </table>
 
</fieldset>
</form>