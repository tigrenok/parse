<h1>ДОБРО ПОЖАЛОВАТЬ В <?php echo Yii::app()->name ?>!</h1>
<p>Мы внесли в базу данных вашу учетную запись.</p>
<p>Ваш логин: <?php echo $login;?></p>
<p>Ваш пароль: <?php echo $pass;?></p>
<p>Пожалуйста, убедитесь в том, что вы храните персональные данные в безопасном месте. Чтобы подтвердить ваш адрес электронной почты, пожалуйста, перейдите по ссылке:</p>
<p><a href="<?php echo $activate_url; ?>">Закончите свою регистрацию...</a></p>
<p>Если ссылка не работает - скопируйте предложенную ниже ссылку в адресную строку вашего браузера:</p>
<p><?php echo $activate_url; ?></p>
<p>&nbsp;</p>
