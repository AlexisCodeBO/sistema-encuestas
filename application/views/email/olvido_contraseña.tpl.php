<html>
<body>
	<h1>Reiniciar contraseņa para <?php echo $identity;?></h1>
	<p>Por favor haga click en este link para <?php echo anchor('auth/reset_password/'. $forgotten_password_code, 'Resetear su Contraseņa');?>.</p>
</body>
</html>