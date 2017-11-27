<html>
    <head>
        <title>Reconigtion Voice Application</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/artyom-source/artyom.window.min.js" type="text/javascript"></script>

    </head>
    <body>
        <div>Esto es una prueba</div>
        <input type="button" onclick="stopArtyom()" value="Detener Reconocimiento">
        <a href="javascript:void(0);" role="button" class="btn btn-primary-outline waves-effect">
            Recognized : <span id="artyom-redirect-output"></span>
        </a>
    </body>
    <script>
        const  artyom = new Artyom();
        artyom.initialize({
            lang: "es-ES", // Más lenguajes son soportados, lee la documentación
            continuous: true, // Reconoce 1 solo comando y basta de escuchar
            listen: true, // Iniciar !
            debug: true, // Muestra un informe en la consola
            speed: 1 // Habla normalmente
        }).then(function () {
            console.log("Ready to work !");
        });

        var comandoHola = {
            indexes: ["Hola", "buenos días", "holita"], // Decir alguna de estas palabras activara el comando
            action: function () { // Acción a ejecutar cuando alguna palabra de los indices es reconocida
                artyom.say("Hola! como estás hoy?");
            }
        };

        artyom.addCommands(comandoHola);

// Or add multiple commands at time
        var myGroup = [
            {
                description: "Si mi base de datos contiene alguno del nombre dicho, hacer algo",
                smart: true, // Activar comando como un comando smart para poder usar comodines
                indexes: ["Sabes quién es *", "Sabes *", "Es * una buena persona"],
                // Ejecutar acción
                // i continene el indice que coincide con lo dicho en el array
                action: function (i, wildcard) {
                    var database = ["Carlos", "Bruce", "David", "Joseph", "Kenny"];

                    //Si lo dicho, coincide con la tercera propiedad de los indices
                    //es decir, "Es xxx una buena persona", haga X, de lo contrario Y
                    if (i == 2) {
                        if (database.indexOf(wildcard.trim())) {
                            artyom.say("Soy una máquina, nisiquiera se que es un sentimiento.");
                        } else {
                            artyom.say("No se quien es " + wildcard + " y no se como demonios podría decir si es una buena persona o no.");
                        }
                    } else {
                        if (database.indexOf(wildcard.trim())) {
                            artyom.say("Por supuesto que se quien es " + wildcard + ".  Es alguien sumamente agradable, no hay nadie mejor que el, es el mejor del mundo.");
                        } else {
                            artyom.say("Mi base de datos no es lo suficientemente amplia, no se quien es " + wildcard);
                        }
                    }
                }
            },
            {
                indexes: ["qué hora es", "Es muy tarde"],
                action: function (i) {
                    if (i == 0) {
                        UnaFuncionQueDiceElTiempo(new Date());
                    } else if (i == 1) {
                        artyom.say("Nunca es tarde para hacer algo mi amigo!");
                    }
                }
            },
            {
                indexes: ["noviembre", "estoy cansado", "ahi ta", "github", "un chiste"],
                action: function (i) {

                    if (i == 0) {
                        artyom.say("ya casi navidad");
                    }
                    if (i == 1) {
                        artyom.say("anda a dormir")
                    }
                    if (i == 2) {
                        artyom.say("si, descargalo");
                    }
                    if (i == 3) {
                        artyom.say("yo tambien tengo github");
                    }
                    if (i == 4) {
                        artyom.say("soy una maquina y conquistare el mundo");
                    }
                }
            }
        ];
        artyom.addCommands(myGroup);

        artyom.redirectRecognizedTextOutput(function (recognized, isFinal) {
            if (isFinal) {
                //     $("#artyom-redirect-output").text("");
                console.log("Final recognized text: " + recognized);
            } else {
                console.log(recognized);
                //    $("#artyom-redirect-output").text(recognized);
            }
        });
    </script>
</html>