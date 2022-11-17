Autor: Nelson Blanco Charro
Fecha: 17/11/2022
Asignatura: Desarrollo Web en Entorno Servidor
Titulo: Trabajo Final Bloque I

DESCRIPCION DE LAS PAGINAS
He elegido tener separadas las paginas web entre usuarios logueados y no logueados porque creo que es mejor tenerlos controlados por separados por temas de permisos, seguridad de la base de datos y porque tienen distinto acceso a las distintas opciones de la aplicacion.

INDEX.PHP
Es la pagina de inicio de la pagina web. Desde aqui se puede acceder como invitado o loguearse.

COMPROBARLOGIN.PHP
Es un fichero sin HTML que permite la redireccion del usuario a la pagina indicada dependiendo de si esta
logueado o no.
Desde este fichero tambien se controla el deslogueo.

INVENTARIOINVITADO.PHP
Pagina web para usuarios no logueados, muestra una tabla y un formulario para ordenar y filtrar los resultados.
Para filtrar se debe seleccionar el orden, el campo por el que se quiere filtrar y el valor para filtrar.
No tiene que ser el valor exacto, simplemente que lo contenga.
Si el valor se deja en blanco, ordenara todos los campos por el filtro seleccionado.

INVENTARIOLOGIN.PHP
Funciona igual que inventariologin.php pero como el usuario esta logueado, en la barra de navegacion,
aparecen mas paginas web a las que puede acceder el usuario.

AGREGAR.PHP
Es un formulario para poder agregar un nuevo articulo. Solo se requiere obligatoriamente el nombre.
Cuando se pulsa el boton "Agregar" se insertan los datos en la base de datos.

ELIMINAR.PHP
Aparece una tabla con una serie de "checkbox" para que el usuario pueda marcarlos.
Cuando se pulsa el boton "Eliminar" se borraran todos los articulos que se hayan marcado con el "checkbox".

MODIFICAR.PHP
Nos muestra una tabla con un input "radio" al final de cada articulo. Solo se permite seleccionar uno de ellos a la vez.
Cuando pulsemos el boton "Modificar" nos llevara al fichero "cambiarDatos.php"

CAMBIARDATOS.PHP
Nos muestra una tabla con el articulo elegido en el fichero "modificar.php" y en la siguiente fila de la tabla una serie de inputs para poder modificar el articulo.
Cuando el usuario pulsa el boton "Modificar" se insertan las modificaciones en la base de datos de los datos que se han cambiado.

ERRORLOG.PHP
Cuando el usuario intenta loguearse y no existen las credenciales en la base de datos, se redirige aqui para indicar que no existe el usuario o la contraseña.

FOOTER.HTML
Elemento HTML footer, como es el mismo en todas las paginas e independienteme de si el usuario esta logueado o no, he preferido crear un fichero html e incluirlo mediante PHP en todas las paginas.

