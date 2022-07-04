# DOCUMENTACION APIRESTFULL 100% PHP

<h2>Configurar base de datos</h2>

<p> En la ruta models/connection.php se encuentra el metodo infoDatabase();
donde se puede configurar la base de datos , añadiendo el nombre m el usuario y la contraseña.</p>


<h2>Configurar la apiKey</h2>

<p>En la ruta models/connection.php , se encuentra el metodo apiKey, donde se puede agregar una llave maestra para el administrador;</p>



<h2>Configurar base de datos</h2>

<p>En la ruta models/connection.php , se encuentra el metodo publicAccess, donde se pueden agregar las tablas que no necesiten acceso mediante una apiKey;</p>


<h2>Configurar las tablas</h2>

<p>La tablas deben estar escritas en plural , y el nombre de las columnas en singular</p>
EJEMPLO:

Table:users;
Columnas : id_user;name_user;...etc

Las relaciones tienes que seguir este patron (nombre de la columna de la tabla segundaria)_(nombre de la tabla principal en singular)
EJEMPLO : Tabla USERS Y Tabla Experiences
Relacion : en la tabla users , habria un campo id_experience_user
             


