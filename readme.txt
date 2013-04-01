Sistema Encuestas
=================

Sistema para la toma de encuestas an�nimas a alumnos para conocer su percepci�n sobre la gesti�n acad�mica. Proyecto final de la carrera Ingenier�a en Computaci�n de la Facultad de Ciencias Exactas y Tecnolog�a - U.N.T.

Version: 1.0

�ltima revisi�n: 2013-03-31

Autores: L�a Rold�n, Adrian Jimenez

Requisitos del Servidor
-----------------------

* Servidor Apache versi�n 2.2 o superior
* PHP versi�n 5.2 o superior, con las siguientes extensiones instaladas:

        OpenSSL
        MySQL
        MySQLi
        PDO para MySQL
        XML
        GD2

* MySQL versi�n 5.0 o superior.

Instalaci�n
-----------

Para instalar la base de datos:

1. Ejecutar el comando para crear la base de datos en MySQL:

        -- Nota: Sustituir 'sistema_encuestas' por el nombre de la base de datos.
        CREATE SCHEMA `sistema_encuestas` DEFAULT CHARACTER SET utf8;
        USE `sistema_encuestas`;

2. A continuaci�n ejecutar el script para crear las tablas, relaciones e indices. Dicho script se encuentra en:

        /encuestas/db/sistema_encuestas.sql

3. Luego se deben cargar los Stored Procedures o Routines. Para ello se debe ejecutar el siguiente script:

        /encuestas/db/stored procedures.sql

4. Por �ltimo, en forma opcional se pueden cargar datos iniciales, incluyendo un formulario de encuestas y algunas carreras y materias. El script es:

        /encuestas/db/datos iniciales.sql

Configuraci�n
-------------

### Cuenta de correo electr�nico:

* El archivo de configuraci�n se encuentra en application/config/email.php
* Por ejemplo, si se usa el protocolo smtp (GMAIL), la configuraci�n es como la siguiente:

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'encuestas.facet@gmail.com';
        $config['smtp_pass'] = 'PASS';
        $config['smtp_timeout'] = '7';
    
### Base de datos:

* El archivo de configuraci�n se encuentra en application/config/database.php
* Esta es una configuraci�n de ejemplo:

        $db['default']['hostname'] = 'localhost';
        $db['default']['username'] = 'root';
        $db['default']['password'] = '123456';
        $db['default']['database'] = 'sistema_encuestas';

* Nota: para que el sistema funcione correctamente, la base de datos debe estar configurada con charset: utf8, insensible a may�sculas (utf8_general_ci)

### Cuentas de usuario:

* Se pueden cambiar algunos par�metros de cuentas de usuario, por ejemplo longitud de contrase�a, tiempo de expiraci�n de codigos de activaci�n, etc.
* El archivo de configuraci�n se encuentra en application/config/ion_auth.php
* Los par�metros que se pueden cambiar son:

        // Site Title, example.com
        $config['site_title'] = "Sistema Encuestas";
        
        // Admin Email, admin@example.com
        $config['admin_email'] = "encuestas.facet@gmail.com";
        
        // Minimum Required Length of Password
        $config['min_password_length'] = 6;
        
        // Maximum Allowed Length of Password
        $config['max_password_length'] = 20;
        
        // Email Activation for registration
        $config['email_activation'] = FALSE;
        
        // Manual Activation for registration
        $config['manual_activation'] = FALSE;
        
        // Allow users to be remembered and enable auto-login
        $config['remember_users'] = TRUE;
        
        // How long to remember the user (seconds). Set to zero for no expiration
        $config['user_expire'] = 86500;
        
        // Extend the users cookies everytime they auto-login
        $config['user_extend_on_login'] = FALSE;
        
        // Track the number of failed login attempts for each user or ip
        $config['track_login_attempts'] = FALSE;
        
        // The maximum number of failed login attempts
        $config['maximum_login_attempts'] = 3;
        
        // The number of seconds to lockout an account due to exceeded attempts
        $config['lockout_time'] = 600;
        
        // The number of seconds after which a forgot password request will expire. If set to 0, forgot password requests will not expire
        $config['forgot_password_expiration'] = 0;

### Otras configuraciones:

* El resto de las configuraciones se encuentran en el archivo application/config/app.php

        //nombre de la facultad
        define('NOMBRE_FACULTAD', 'Facultad de Ciencias Exactas y Tecnolog�a');
        
        //nombre de la universidad
        define('NOMBRE_UNIVERSIDAD', 'Universidad Nacional de Tucum�n');
        
        //cantidad de items (filas) se mostraran por pagina en un listado (tabla)
        define('PER_PAGE', 10);
        
        //nombre de un periodo en que se divide el a�o lectivo (trimestre, cuatrimestre, semestre, etc)
        define('PERIODO', 'Cuatrimestre');
        
        //nombre del sistema encuestas. Este se usa para generar los HTML
        define('NOMBRE_SISTEMA', 'Sistema Encuestas');
        
        //indica si cualquier persona (usuario del sistema o no) puede ver los informes a nivel facultad
        $config['publicarInformes'] = FALSE;
        
        //indica si cualquier persona (usuario del sistema o no) puede ver los hist�ricos a nivel facultad
        $config['publicarHistoricos'] = FALSE;
        
        //tiempo de expiraci�n de la imagen captcha
        $config['captchaExpiration'] = 7200;
        
        //fuente utilizada para generar las imagenes captcha
        $config['captchaFont'] = 'fonts/comic.ttf';

Compatibilidad con Navegadores
------------------------------
* Internet Explorer 7+
* Mozilla Firefox 4+
* Opera 11
* �ltimas versiones de Google Chrome
* �ltimas versiones de Safari