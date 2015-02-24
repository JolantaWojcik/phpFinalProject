<form action="" method="post">
	<div class="field">
		<label for="username">Login</label>
		<input type="text" name="login" id="login" autocomplete="off">
	</div>
	
	<div class="field">
		<label for="haslo">Haslo</label>
		<input type="password" name="haslo" id="haslo" autocomplete="off">
	</div>
	
	<div class="field">
		<label for="remember">
			<input type="checkbox" name="remember" id="remember"> Remember me
		</label>
	</div>
	
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" value="Log in">
	</form>
	
	
	
	