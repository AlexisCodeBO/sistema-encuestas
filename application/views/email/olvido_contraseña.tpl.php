<html>
<body>
	<h1>Reiniciar contrase�a para <?php echo $identity;?></h1>
	<p>Por favor haga click en este link para <?php echo anchor('auth/reset_password/'. $forgotten_password_code, 'Resetear su Contrase�a');?>.</p>
</body>
</html>