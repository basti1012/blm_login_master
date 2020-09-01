<form method="POST" action="check.php">
<img src="captcha.php?RELOAD=" alt="Captcha" title="Klicken, um das Captcha neu zu laden" onclick="this.src+=1;document.getElementById('captcha_code').value='';" width=140 height=40 />
<input type="text" name="captcha_code" id="captcha_code" size=10 />
<input type="submit">
</form>