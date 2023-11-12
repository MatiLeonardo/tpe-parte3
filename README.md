# tpe-parte3

API Información de artistas
Esta api tiene como fin el acceso a datos de artistas incorporados en una base de datos

ENDPOINTS

Artistas

Listado
CASCADE
Cada artista se listará de la siguiente forma: 
 {
        "id": "2",
        "nombre": "Juan",
        "descripcion": "Holita",
        "edad": "42",
        "nacionalidad": "Puerto rico",
        "cant_oyentes": "51515151"
 }

 GET:/albums
Este endpoint tiene como fin listar los artistas por defecto basado en la cantidad de oyentes de manera ascendente.
Se puede filtrar a través de los siguientes query params:

?campo=nombre \ Tiene como objetivo filtrar a través de campos existentes en la tabla. Ejemplo nombre, edad, nacionalidad.
?orden=1 \ Tiene como objetivo filtrar de manera descendente (1) o ascendente (0)


