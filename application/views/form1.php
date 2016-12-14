<div id="second_form">
<form name="form1" method="POST" id="form1" action="">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
<div><input type="text" name="name">Name</div>
<div><input type="password" name="pass">Pass</div>
<div><input type="submit" name="submit" value="submit"id="submit"></div>
</form>
</div>
<!--   Git uses for  -->