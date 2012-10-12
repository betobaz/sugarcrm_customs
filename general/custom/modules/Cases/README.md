# Logic Hook para Casos

Se realiza la programación de un logic hook para el envio de correos a los contactos relacionados de este.

## Clase AbproCase

La clase AbproCase se encarga de el procesamiento del logic hook. Se debe de configurar la plantilla de correo asignando el id en la variable "id_template".

##Plantilla de Email

Tanto en el titulo de la plantilla como el contenido de la plantilla se puede utilizar la siguiente sintaxis para introducir datos del objecto Case a estos.

{::[future|past]::[module_dir]::[name_field]::}

Donde:
* future | past. Indica si se va a tomar el valor previamente o posteriormente a la actualización
* module_dir. Indica el nombre del modulo a que pertenece la entidad, para este proposito es Cases
* name_field. Indica el nombre del campo del cual será tomado el valor

Para obtener información de las relaciones se puede ocupar la siguiente sintaxix

{::[future|past]::[module_dir]::[module_dir_relationship]::[name_field]::}

Donde:
* module_dir_relationship. Indica la relación de la que obtendra el objeto del cual sera tomado el valor

