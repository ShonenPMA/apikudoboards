# DOCKER LARAVEL PHPMYADMIN MYSQL NGINX

Usa WordPress en tu servidor local con Docker usando [Docker compose](https://docs.docker.com/compose/)

## Instrucciones

<details>
 <summary>Requisitos</summary>

+ [Docker](https://www.docker.com/get-started)

</details>

<details>
 <summary>Configuración</summary>

 ### Configurando las variables de entorno

#### 1. Para Docker y Wordress (Paso requerido)

Copiar `.env.example` en la raíz del proyecto como `.env` y editar con tus preferencias.

Ejemplo:

```dotenv
MYSQL_ROOT_PASSWORD=root
MYSQL_DATABASE=homestead
MYSQL_USER=homestead
MYSQL_PASSWORD=secret

PHPMYADMIN_PORT=8090
NGINX_PORT= 8092

OS_USER=ubuntuUser # para obtener tu usuario actual, ejecuta el comando: whoami
OS_UID=1000 # para obtener tu uid, ejecuta el comando:  id $(whoami)
```

### 2. Para evitar problemas de permisos

Deberías crear un archivo vacío en el folder src debido a que si el folder se mantiene vacío antes de ejecutar el docker, los permisos que se otorgarán y el usuario serán de root por defecto.
</details>

<details>
<summary>Ejecutar</summary>

# Ejecutando docker-compose

```shell
docker-compose up -d
```
## Laravel

🚀 Abrir [http://localhost:8092](http://localhost:8092) en tu navegador

## PhpMyAdmin

PhpMyAdmin

🚀 Abrir [http://localhost:8090/](http://localhost:8090/) en tu navegador

</details>
<details>
<summary>Uso del folder bin</summary>

# Copia los archivos

1. Copiar los archivos ubicados en ./config/bin en la carpeta /usr/local/bin
2. (En VScode) Dirigete a las opciones de tu espacio de trabajo y en modo json agrega lo siguiente:

```json
    "php.validate.executablePath" :  "/usr/local/bin/phplaravel"
```

3. Situate en la raiz del proyecto y ejecuta los siguientes comandos para verificar que lo hayas hecho correctamente.

```shell
phplaravel --version
```
Ejemplo de salida:

```shell
Running php on docker test_php_1
PHP 7.4.23 (cli) (built: Sep  3 2021 17:58:14) ( NTS )
Copyright (c) The PHP Group
Zend Engine v3.4.0, Copyright (c) Zend Technologies
```

```shell
composerlaravel --version
```
Ejemplo de salida:

```shell
Running composer on docker test_php_1
Composer version 2.1.5 2021-07-23 10:35:47
```

4. Problemas

Si no puedes copiar los bins o no puedes ejecutarlos

 - Si no puedes copiar :
    - Con la terminal situate en /usr/local/bin y para cada bin vas a repetir el siguiente proceso
    - Ejecutar el comando: `sudo nano phplaravel`
    - Pegas o escribes el codigo:
        ```shell
        path=$(printf '%s\n' "${PWD##*/}")
        command="docker exec ${path}_php_1 php "$@""
        echo "Running php on docker ${path}_php_1"
        $command
        ```
    - Guardas el archivo
 - Si no puedes ejecutar:
    - Asignas permisos ejecutando el comando: `sudo chmod 755 phplaravel`
    - Listo!
</details>
<details>
<summary>Creando un nuevo proyecto laravel</summary>

# Usando los archivos de la carpeta bin

## Ejecuta el comando
```shell
composerlaravel create-project laravel/laravel .
```
## Configura el archivo .env para conectarte a la base de datos usando el nombre del contenedor mysql, por ejemplo
```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

</details>
<details>
<summary>Nodejs u npm</summary>

# Descargando nodejs y npm

Solo descomenta la linea en config/php/Dockerfile

Despues copia los bins nodelaravel and npmlaravel en /usr/local/bin
Y eso sería todo, puedes usarlos ejecutando los comandos en la raíz del proyecto
</details>