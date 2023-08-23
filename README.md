
# Registro de notas ESP-Inglés por Áreas

### Descripción:

Éste proyecto consiste en desarrollar una aplicación web que pueda ser utilizada para almacenar el registro de notas de los estudiantes a través de los años. Esta información se guarda en una base de datos relacional, segura, y bien estructurada. De manera que se facilite su respaldo y el manejo de datos.

La idea principal es que el sistema no solo funcione para consultar notas a nivel administrativo. Sino que también los profesores puedan alimentar la base de datos con la información de sus cursos, por medio de una interfaz amigable y facil de usar.

### Descripción Técnica

El proyecto consiste en un sistema con 2 tipos de usarios, el usuario con rol de administrador, y el usuario normal (profesor). 

El **administrador** puede modificar todos los aspectos de la base de datos:

- Modificar la lista de profesores y su información
- Modificar la lista de Areas
- Modificar la lista de Niveles
- Modificar la lista de estudiantes y su información
- Modificar el registro de notas

Tambíen tendra un sistema de busqueda especializado que le permita realizar estas modificaciones al registro de notas buscando notas especificas por multiples parámetros.

Por otro lado el **profesor** solamente podrá agregar notas y modificar su información personal. Para otros procesos debe realizar la solicitud a los administradores.

El sistema está montado con la base de datos de manera que los **estudiantes**, **areas**, **niveles** y **profesores**, sean elementos únicos a los cuales se le atribuyen **notas**, es decir, una relación de tipo **One-To-Many**.

#### Tecnologías utilizadas:
- HTML 5
- Bootstrap 5.3.x
- PHP  8.2.4
- MySQL 8.0.34
- JQuery 3.7
- DataTables 1.13.6
- Select2 4.1.0

### Autores:
- Alejandro Duarte Lobo - Gestor de TI de Inglés por Áreas

**Fecha de inicio:** 18 de Agosto del 2023.