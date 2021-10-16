<h2>Регистрация пользователя</h2>
<form action="signup" method="post">
	<label for="name">
		Name
		<input type="text" name="name" id="name" placeholder="enter name" required maxlength="10" />
	</label>
	<label for="pass">
		Pass
		<input type="text" name="pass" id="pass" placeholder="enter pass" />
	</label>
	<label for="email">
		e-Mail
		<input type="text" name="email" id="email" placeholder="enter email" />
	</label>
	<label>
		<input type="submit" value="Signup" />
	</label>
</form>
<p><a href="login">Войти</a></p>