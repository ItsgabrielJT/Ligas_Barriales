<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Integrantes del grupo 🪬
- Joel Tates
- Salomé Quispe
- Andy Loor

## Funcionalidades del proyecto 🧩👥

Para empezar el sistema resulve la problematica de enlistar y registrar los partidos y equipos disputados en las ligas barriales.
- Roles del sistema: directivo, representante, jugador
- CRUD: Torneos, equipos, plantillas, resultados
- Login: Active directory, Directory Native

> La expicacion esta dentro de cada archivo de codigo ⚠️

## Instalar el proyecto de forma local ⚠️⚠️⚠️⚠️

Al clonar el repositorio remoto e instalrlo de forma local debemos de seguir una serie de pasos 
para tener el proyecto funcionando en nuestro computador. Ejecuta los sigueintes comandos en la terminal despues de haber clonado el proyecto, hazlo en la carpeta del proyecto:

- composer install
- php artisan migrate
- php artisan key:generate

> Te recomiendo hacer una copia del archivo .env.example
```
cp .env.example .env
```

> El ultimo comando nos instala lo que nesecitamos para la funcionalidad del login con spotify. 


## Despliegue el raliway 🚀🧩

Recuerda que en railway podemos desplegar nuestra bses de datos MySQL a la vez que nuestro proyecto de laravel.

- Siempre antes que nada tenemos que eliminar nuestro archivo **composer.lock**
- Depues tenemos que copiar las variables del .env y pegarlas en el despliegue
- POr ultimo cambiamos las varibles de la conexion a bases de datos que nos provio Railway al principio del proyecto de MySQL
- [Link del despliqegue](https://ligasbarriales-production.up.railway.app/)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
