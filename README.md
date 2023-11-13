# TPE-PARTE3: API Información de Artistas

¡Bienvenido a la API de Información de Artistas! Esta API proporciona acceso a datos detallados de artistas almacenados en nuestra base de datos.

**Aviso Especial para Belén:** Hemos incorporado el sistema de confirmación que solicitaste para la eliminación y modificación de artistas utilizando el método cascade.

## Equipo
- **Miembro A:** Gonzalo Giacomino
- **Miembro B:** Matías Gallardo

## Endpoints

### Listado de Artistas
Cada artista se presenta en el siguiente formato:

{
    "id": "2",
    "nombre": "Juan",
    "descripcion": "Holita",
    "edad": "42",
    "nacionalidad": "Puerto Rico",
    "cant_oyentes": "51515151"
}

#### GET:/artistas

Este endpoint lista los artistas por defecto según la cantidad de oyentes, de manera ascendente.

Ordenamiento

    Query Params:
        ?campo=nombre: Filtra a través de campos existentes en la tabla (ejemplo: nombre, edad, nacionalidad).
        ?orden=1 o ?orden=0: Filtra de manera descendente (1) o ascendente (0).

Paginado

    Query Params:
        ?cantElemsPagina: Recibe la cantidad de elementos a mostrar en el listado (valor por defecto: 3).
        ?pagina: Indica la página a recuperar.

EJEMPLO COMPLETO DE LISTADO CON TODOS SUS FILTROS
GET:/api/artistas/?campo=nombre&orden=1&pagina=1&cantElemsPagina=3


#### GET:/artistas/:ID
Este endpoint muestra la información de un artista especificado por su ID.

    GET:/artists/:ID
    Obtiene la información de un artista específico mediante su ID.

#### POST:/artistas
Añade un nuevo artista a la base de datos.

Datos requeridos en el body:
{
    "id": "2",
    "nombre": "Juan",
    "descripcion": "Holita",
    "edad": "42",
    "nacionalidad": "Puerto Rico",
    "cant_oyentes": "51515151"
}


    PUT:/artists/:ID
    Modifica los datos de un artista especificado por su ID. Se requiere confirmación a través del query param ?confirmacion=true. En caso de no proporcionar ciertos datos, como la edad, se mantendrá el valor existente en la base de datos.

Requiere confirmación a través del query param ?confirmacion=true.

Datos requeridos en el body:
{
    "id": "2",
    "nombre": "Juan",
    "descripcion": "Holita",
    "edad": "42",
    "nacionalidad": "Puerto Rico",
    "cant_oyentes": "51515151"
}

En caso de no pasar algún dato (por ejemplo, la edad), se mantendrá el valor existente en la base de datos.

Ejemplo: PUT:/api/artistas/2?confirmacion=true


#### DELETE:/artistas/:ID
Elimina un artista de la base de datos, especificado por su ID.

Requiere confirmación a través del query param ?confirmacion=true.

Ejemplo: DELETE:/api/artistas/2?confirmacion=true
