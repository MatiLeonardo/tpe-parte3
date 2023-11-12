# TPE Parte 3: API de Información de Artistas

¡Bienvenido a la API de Información de Artistas! Este proyecto ofrece acceso a datos de artistas almacenados en una base de datos.

**Aviso Especial para Belén:** Hemos incorporado el sistema de confirmación que solicitaste para la eliminación y modificación de artistas, tal como discutimos al decidir el uso de cascade.

**Integrantes del Equipo:**
- Gonzalo Giacomino
- Matías Gallardo

## Endpoints

### Listado de Artistas

Cada artista se presenta en el siguiente formato:

```json
{
    "id": "2",
    "nombre": "Juan",
    "descripcion": "Holita",
    "edad": "42",
    "nacionalidad": "Puerto Rico",
    "cant_oyentes": "51515151"
}

    GET:/artistas
    Obtiene un listado de artistas ordenados por la cantidad de oyentes, de forma ascendente por defecto.

Ordenamiento

    Query Params:
        ?campo=nombre: Filtra los artistas por campos existentes en la tabla, por ejemplo: nombre, edad, nacionalidad.
        ?orden=1: Ordena de manera descendente (1) o ascendente (0).

Paginado

    Query Params:
        ?cantElemsPagina: Define la cantidad de elementos a mostrar (por defecto, 3).
        ?pagina: Indica la página que se quiere recuperar.

Detalles de un Artista

    GET:/artistas/:ID
    Obtiene la información de un artista específico mediante su ID.

Agregar un Artista

    POST:/artistas
    Agrega un nuevo artista a la base de datos. Se deben proporcionar los siguientes datos en el body.

Modificar un Artista

    PUT:/artistas/:ID
    Modifica los datos de un artista especificado por su ID. Se requiere confirmación a través del query param ?confirmacion=true. En caso de no proporcionar ciertos datos, como la edad, se mantendrá el valor existente en la base de datos.

Ejemplo de Uso:

http

PUT:/api/artistas/2?confirmacion=true

Eliminar un Artista

    DELETE:/artistas/:ID
    Elimina un artista de la base de datos, indicando su ID. Se requiere confirmación a través del query param ?confirmacion=true.

Ejemplo de Uso:

http

DELETE:/api/artistas/2?confirmacion=true

Este README proporciona detalles sobre los endpoints disponibles y cómo interactuar con la API para listar, agregar, modificar y eliminar información de artistas en la base de datos.