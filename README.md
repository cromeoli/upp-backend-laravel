<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


<div align="center"><img src="https://github.com/cromeoli/upp-backend-laravel/assets/92324278/fa030cf2-b533-41af-8162-063937f98c94"></div>

## Inicio
En este readme estarán las instrucciones para instalar el proyecto en tu máquina, en el proyecto está incluido un archivo insomnia_tests.json que son los exports de insomnia. Igualmente esta es una lista
de todos los endpoints del backend:

## Endpoints

## User

| Endpoint                        | Descripción                                  | Verbo HTTP | Autenticación | CORS |
|---------------------------------|----------------------------------------------|------------|---------------|------|
| /user                           | Obtener información del usuario autenticado  | GET        | Sí            | No   |
| /api/user/login                 | Iniciar sesión del usuario                   | POST       | No            | No   |
| /api/user/register              | Registrar nuevo usuario                      | POST       | No            | No   |
| /api/user/checkNickname/{nickname} | Comprobar disponibilidad de un nickname   | GET        | No            | No   |
| /api/user/checkEmail/{email}    | Comprobar disponibilidad de un email         | GET        | No            | No   |
| /api/user/usersByCircle/{id}    | Obtener usuarios por círculo                 | GET        | No            | No   |
| /api/user/user/{id}             | Obtener información de usuario por ID        | GET        | No            | No   |
| /api/user/logout                | Cerrar sesión del usuario                    | POST       | Sí            | No   |
| /api/user/verify                | Verificar token de usuario                   | POST       | Sí            | No   |
| /api/user/modifyUser            | Modificar información de usuario             | PUT        | Sí            | No   |
| /api/user/getUser               | Obtener información del usuario autenticado  | GET        | Sí            | No   |
| /api/user/users                 | Obtener todos los usuarios                   | GET        | Sí            | No   |
| /api/user/deleteUser            | Eliminar usuario                             | DELETE     | Sí            | No   |

## Circle

| Endpoint                            | Descripción                                  | Verbo HTTP | Autenticación | CORS |
|-------------------------------------|----------------------------------------------|------------|---------------|------|
| /api/circle/circles                 | Obtener todos los círculos                    | GET        | No            | No   |
| /api/circle/circle/{id}             | Obtener información de círculo por ID         | GET        | No            | No   |
| /api/circle/createCircle            | Crear un nuevo círculo                        | POST       | Sí            | No   |
| /api/circle/modifyCircle/{id}       | Modificar información de círculo por ID       | PUT        | Sí            | No   |
| /api/circle/deleteCircle            | Eliminar círculo                              | DELETE     | Sí            | No   |
| /api/circle/myCircles               | Obtener mis círculos                          | GET        | Sí            | No   |
| /api/circle/joinCircle/{id}         | Unirse a un círculo                           | POST       | Sí            | No   |
| /api/circle/leaveCircle/{id}        | Abandonar un círculo                          | DELETE     | Sí            | No   |
| /api/circle/createdCircles          | Obtener círculos creados por el usuario       | GET        | Sí            | No   |

## Post

| Endpoint                          | Descripción                                  | Verbo HTTP | Autenticación | CORS |
|-----------------------------------|----------------------------------------------|------------|---------------|------|
| /api/post/posts                   | Obtener todos los posts                       | GET        | No            | No   |
| /api/post/post/{id}               | Obtener información de post por ID            | GET        | No            | No   |
| /api/post/postsByCircle/{id}       | Obtener posts por círculo                     | GET        | No            | No   |
| /api/post/createPost              | Crear un nuevo post                           | POST       | Sí            | No   |
| /api/post/createImagePost         | Subir imagen de post                          | POST       | Sí            | Sí   |
| /api/post/deletePost/{id}         | Eliminar post                                 | DELETE     | Sí            | No   |


## Instalación

Primero es conveniente levantar el backend para que el frontend pueda recoger los datos necesarios de la UI. Para ello necesitamos tener docker + docker-compose instalado o docker-Desktop. Se han de seguir los siguientes pasos:

1. Clonar mediante git u otro sistema de control de versiones el proyecto desde la siguiente URL: [https://github.com/cromeoli/upp-backend-laravel.git](https://github.com/cromeoli/upp-backend-laravel.git)

2. Una vez hecho esto, deberemos ubicarnos en la carpeta donde hemos clonado el proyecto y entrar la carpeta raíz. En la carpeta raíz encontraremos un archivo llamado `setupScript.sh`. Debemos otorgarle permisos de ejecución con el siguiente comando:
    ```
    chmod +x ./setupScript.sh
    ```

3. Luego deberemos ejecutarlo con el siguiente comando:
    ```
    ./setupScript.sh
    ```

Este script instalará 2 plugins de php que son necesarios como dependencia, hará una copia del archivo `.env` en el directorio del proyecto, realizará las migraciones de las bases de datos, generará una key para para el servidor y levantará los contenedores de `docker-compose` para poder utilizar el backend.

Si en este punto se obtiene algún problema de SQL, es porque no se han introducido unas credenciales válidas para la base de datos en el archivo `.env`.

Es probable que para subir las imágenes al servidor se necesite crear un enlace simbólico, para ello habrá que ejecutar el siguiente comando:
    ```
    ./vendor/bin/sail artisan storage:link
    ```

Habiendo seguido estos pasos, en principio el backend debería estar levantado.

Si ha habido algún error que impidiera la ejecución del script, habrá que ejecutar también las migraciones con los datos de prueba. Para ello ejecutamos:
    ```
    ./vendor/bin/sail artisan migrate --seed
    ```

En caso de que el script no llegase a funcionar nunca, el método alternativo es el siguiente:
1. Asegurarse de tener instalado docker y docker-compose.
2. Crear una copia del archivo `.env.example` llamada `.env` sin cambiar ninguna variable.
3. Puede crearse un alias en el archivo `.bashrc` o `.zshrc` en caso de estar en sistemas UNIX para simplificar los comandos utilizando el siguiente comando:
    ```
    $ alias sail='[-f sail] && sh sail || sh vendor/bin/sail'
    ```
4. Luego siguen los siguientes comandos:
    ```
    sail up -d
    sail artisan key:generate
    sail composer install
    sail artisan migrate --seed
    sail artisan storage:link
    ```

Y ya estaría ejecutándose el proyecto en el puerto `:80`. En el puerto `:8080` podremos ver una instancia de phpMyAdmin por si fuera necesario.

En el proyecto se encuentra un archivo llamado Insomnia_Tests.json que es un export de las peticiones de insomnia. Igualmente, en el readme del proyecto en github podremos encontrar unas tablas con los endpoints.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
