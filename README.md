En principio con solo hacer la migracion de BD y ejecutar los seeders deberia funcionar. 

He intentado  montar la autencacion para API pero me devolvia Personal Authentication Token y no sabia como devolver el token. Despues tambien intente hacerlo con JWT y pasarle el token con Bearer y nada no me salio. 

He dejado los dos puntos de entrada para devolver los dominios, en uno aplico la logica con SQL y desde la consulta ya devuelvo lo que necesito (/api/domains/sql) y otra que a partir de la collection montar la array(/api/domains/php). 

A parte he subido la coleccion de POSTMAN por si necesitais hacer alguna prueba.
