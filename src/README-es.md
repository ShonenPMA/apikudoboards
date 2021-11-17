# API Kudoboards

## Resumen

  * [Instalación](#instalación)
  * [Documentación de la API](#documentación-de-la-api)
  * [Optimizando el proyecto en producción](#optimizando-el-proyecto-en-producción)

### Instalación

1. Clonar el repositorio en una carpeta(api-kudoboards):

> git clone https://github.com/ShonenPMA/apikudoboards.git  api-kudoboards

2. Ir a la carpeta y ejecutar el comando:

 - 2.1 Para produccion
    > composer install --optimize-autoloader --no-dev
 - 2.2 Para desarrollo
    > composer install

3. Copiar el .env.example para generar tus variables de entorno:

> cp .env.example .env

4. Editar tu archivo .env:

> nano .env

5. Generar la llave de la aplicación:

> php artisan key:generate

6. Ejecutar migraciones

 - 6.1 Solo tablas 
    > php artisan migrate
 - 6.2 Con data de prueba
    > php artisan migrate --seed

7. Asignar permisos a las carpetas bootstrap/cache y storage

> chmod -R 775 boostrap/cache
>
> chmod -R 775 storage

8. Configurar en public_html el acceso a tu app (Opcional según donde se haga el despliegue)

    8.1. Si se usara el proyecto como principal
    > ln -s /home/user/api-kudoboards/public public_html 

    8.2 Si se usara el proyecto como secundario

    > ln -s /home/user/api-kudoboards/public api-kudoboards 

9. Una vez creado nuestro hipervinculo en el paso 8 crearemos el hipervinculo para la carpeta storage (Opcional para archivos)

>php artisan storage:link (en el path de tu aplicacion)

### Documentación de la API

Para obtener la documentación de los endpoints en general, se debe ejecutar el siguiente comando:
> php artisan scribe:generate

Una vez ejecutado el comando, se deberá acceder a el por medio de la ruta : `/docs`

### Optimizando el proyecto en producción

Cada vez que se actualice el repositorio y para obtener un mejor rendimiento del aplicativo se deberán ejecutar los siguientes comandos:

> php artisan config:cache
>
> php artisan route:cache
>
> php artisan view:cache


Comandos opcionales y se deberan ejecutar cuando:
1. Si se han añadido nuevos paquetes o modificado el archivo composer.sjon

> composer install --optimize-autoloader --no-dev

2. Se crearon nuevas migraciones

> php artisan migrate