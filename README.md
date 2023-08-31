<h1>Mini Proyecto de Reserva de Películas en Laravel</h1>
<p>Este proyecto es una aplicación web desarrollada en Laravel 9 que te permite explorar, reservar y administrar películas.</p>

<h2>Características Principales</h2>
<ul>
    <ul>
      <li>Autenticación de administradores para gestionar el CRUD de Películas</li>
      <li>Uso de Soft Deletes para manejar eliminaciones sin pérdida de datos</li>
      <li>Utilización de Mutadores para formatear fechas y precios en formato local</li>
      <li>Implementación de Validaciones tanto en operaciones CRUD como en autenticación de usuarios</li>
      <li>Filtro por título y sistema de paginación en el catálogo de películas</li>
      <li>Integración de la API de Checkout PRO de MercadoPago</li>
      <li>Integración de PHP Mailer para notificaciones por correo</li>
      <li>Utilización de componentes, Repositorios, Interfaces y Middlewares para una estructura modular</li>
    </ul>
</ul>

<h2>Tecnologías</h2>
<ul>
    <ul>
      <li>HTML5/CSS</li>
      <li>Laravel 9</li>
      <li>Bootstrap</li>
    </ul>
</ul>

<h2>Instalación</h2>

<h3>Instalar composer</h3>
<pre>
<code>
    composer i
</code>
</pre>

<h3>Crear la Base de datos</h3>
<pre>
<code>
    CREATE SCHEMA IF NOT EXISTS `imperiale_eric_db`
</code>
</pre>

<h3>Correr las migraciones junto a los seeders</h3>
<pre>
<code>
    php artisan migrate:fresh --seeder
    php artisan db:seed
</code>
</pre>

<h3>Iniciar el servidor</h3>
<pre>
<code>
    php artisan serve
</code>
</pre>
