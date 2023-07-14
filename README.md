# SWAPI Demo

**Installation:**

Download the project from github either by normal download or by git clone.

Once in the project, to generate the vendor folder use the following command:

```
composer install
```

Rename the .env.example file to just .env and edit the MySQL server configuration values

Now generate the key with the following command:

```
php artisan key:generate
```

To create the tables in the database use the following command:

```
php artisan migrate 
```
To execute server : 

```
php -S localhost:3000 -t public
```

**API documentation**

```
Method : GET

http://localhost:3000/api/importarDatos

Import the spaceships and vehicles from the SWAPI api to insert the records into the database

Returns in JSON format the status of the response that will be 1 or 0
```

```
Method : GET

http://localhost:3000/api/cargarNaves

Returns in json format all the spaceships found in the database
```

```
Method : GET

http://localhost:3000/api/cargarVehiculos

Returns in json format all the vehicles found in the database
```

```
Method : POST

http://localhost:3000/api/setearCantidadNave

Parameters :

id : ID of the spaceship
nueva_cantidad : It is the new amount that the spaceship will have

Returns the status in JSON format
```

```
Method : POST

http://localhost:3000/api/aumentarCantidadNave

A number is added to the current amount of the vehicle

Parameters :

id : ID of the spaceship

Returns the status in JSON format
```

```
Method : POST

http://localhost:3000/api/disminuirCantidadNave

A number is subtracted from the current amount of the vehicle

Parameters :

id : ID of the spaceship

Returns the status in JSON format
```

```
Method : POST

http://localhost:3000/api/setearCantidadVehiculo

Parameters :

id : ID of the vehicle
nueva_cantidad : It is the new amount that the vehicle will have

Returns the status in JSON format
```

```
Method : POST

http://localhost:3000/api/aumentarCantidadVehiculo

A number is added to the current amount of the vehicle

Parameters :

id : ID of the vehicle

Returns the status in JSON format
```

```
Method : POST

http://localhost:300/api/disminuirCantidadVehiculo

A number is subtracted from the current amount of the vehicle

Parameters :

id : ID of the vehicle

Returns the status in JSON format
```
