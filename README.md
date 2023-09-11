<h1>Mini Proyecto de Reserva de Películas en Laravel 9 y Livewire</h1>
<p>Este proyecto es una aplicación web desarrollada en Laravel 9 que te permite explorar, reservar y administrar películas.</p>

<h2>Propósito</h2> 
<p>En este momento, <b>me encuentro explorando Laravel Livewire</b>. <b>Mi plan es crear un componente que incluya tanto el filtro de búsqueda como la tabla de películas</b>.</p>

<h2>Características Principales</h2>
<ul>
    <ul>
      <li>Autenticación de administradores para gestionar el CRUD de Películas</li>
      <li>Uso de Soft Deletes para manejar eliminaciones sin pérdida de datos</li>
      <li>Utilización de Mutadores para formatear fechas y precios en formato local</li>
      <li>Implementación de Validaciones tanto en operaciones CRUD como en autenticación de usuarios</li>
      <li>Integración de la API de Checkout PRO de MercadoPago</li>
      <li>Integración de PHP Mailer para notificaciones por correo</li>
      <li>Utilización de componentes, Repositorios, Interfaces y Middlewares para una estructura modular</li>
      <li>Filtro por título y sistema de paginación en el catálogo de películas</li>
      <li>Estado de conexión para los componentes</li>
    </ul>
</ul>

<h2>Tecnologías</h2>
<ul>
    <ul>
      <li>HTML5/CSS</li>
      <li>Laravel 9</li>
      <li>Laravel Livewire</li>
      <li>Bootstrap</li>
    </ul>
</ul>

<h2>Filtro para las películas</h2>
<p>El filtro se aplica cuando el usuario deja de tipear, de esta manera evitamos enviar múltiples peticiones al servidor, y además, guardamos el parámetro en la query string.</p>



https://github.com/EricImperiale/laravel-proyecto-1/assets/47151740/c14907f7-9c03-4614-bc61-13c60be4c86e


<h2>Estado de conexión</h2>
![screenshot_proyecto_peliculas_laravel](https://github.com/EricImperiale/laravel-proyecto-1/assets/47151740/54926acc-a2bd-4bb5-9ca5-727aa11f9f6a)


<h2>Instalación</h2>
<h3>Instala Composer</h3>
<pre>
<code>
    composer i
</code>
</pre>

<h3>Crea la Base de Datos</h3>
<pre>
<code>
    CREATE SCHEMA IF NOT EXISTS `imperiale_eric_db`;
</code>
</pre>

<h3>Corre las Migraciones junto a los Seeders</h3>
<pre>
<code>
    php artisan migrate:fresh --seed
    php artisan db:seed
</code>
</pre>

<h3>Inicia el Servidor</h3>
<pre>
<code>
    php artisan serve
</code>
</pre>

