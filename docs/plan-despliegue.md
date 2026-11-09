# Plan de despliegue del incremento

**Informática III · Grupo 1301 · Ciclo 2027-1**
**Tema:** 3.5 Fase de Despliegue
**Entrega:** domingo 8 de noviembre de 2026, 22:00, con el enlace al commit en Classroom

| Dato | Respuesta |
|---|---|
| Equipo (número) | 3 |
| Modelo asignado | V |
| Integrantes | Diego Torres Prado, Natalia Cortez Ramirez y Gabriela Millan Salazar |
| Contexto de negocio de nuestro sistema | Restaurante |



---

## 1. Alcance del incremento



| Requisito | ¿Entra en este despliegue? (Sí / Parcial / No) | Qué incluye exactamente o por qué queda fuera |
|---|---|---|
| RF1 |Parcial |Se implementó la validación de clientes, pero no hemos comprobado el CRUD completo de clientes, empleados y productos. |
| RF2 |Parcial |La funcion existe, pero no está completa, faltan detalles por terminar sin mencionar que es mi repositorio personal por lo que haría falta mover esas funciones |
| RF3 |Parcial |Se implementó el cálculo del total de pedidos, pero falta comprobar el proceso completo de creación y entrega. |
| RF4 |Parcial |Se implementó la lógica para validar las transiciones entre estados, pero falta comprobar su integración completa |
| RF5 |Parcial |Se implementaron búsquedas y resúmenes por estado, pero falta comprobar historial, tickets y filtros por fechas. |
| Cambio de requisito (5 oct) |No |Necesitamos dar por terminadas funciones y requisitos anteriores para dar con finalizado este requisito |

---

## 2. Destino y configuración

| Elemento | Respuesta |
|---|---|
| Destino | Vercel |
| Proyecto o URL en Vercel |Pendiente de crear y vincular con el repositorio oficial del equipo. |
| Repositorio desde el que se despliega |https://github.com/info3-fesc-2027-1/Equipo3-Rocker-Burguer |
| Rama que se publica en producción |main (por confirmar al configurar Vercel) |
| Comando de build (si aplica) |  |

### Variables de entorno necesarias



| Nombre de la variable | Para qué sirve |
|---|---|
| Pendiente de verificar | [ ] |
| Pendiente de verificar | [ ] |

### Servicios externos de los que depende el sistema



- [ ]

---

## 3. Checklist pre-despliegue



| # | Verificación | ¿Cumple? (Sí / No) | Responsable |
|---|---|---|---|
| 1 | El código del incremento está guardado y subido al repositorio oficial. | No | El equipo|
| 2 | El proyecto está integrado en la rama correspondiente. |No |El equipo |
| 3 |  Las dependencias del proyecto se instalan correctamente. | No |El equipo |
| 4 | Las pruebas automatizadas se ejecutan sin errores. | No |El equipo |
| 5 | El proyecto de Vercel está vinculado al repositorio oficial  |No |El equipo |

---

## 4. Smoke test (verificación posdespliegue)



| # | Acción | Resultado esperado | Resultado obtenido (se llena el lunes) |
|---|---|---|---|
| 1 |Abrir la página principal del sistema. | La aplicación carga correctamente y no muestra errores |Pendiente de ejecución. |
| 2 | Registrar o crear un pedido. | El pedido se registra correctamente con los datos proporcionados. |Pendiente de ejecución. |
| 3 | Consultar los pedidos registrados.  | Se muestra la información de los pedidos disponibles. |Pendiente de ejecución. |
| 4 | Cambiar el estado de un pedido. |El sistema permite actualizar el estado conforme al flujo establecido. | Pendiente de ejecución.|
| 5 | |  | |

// EN EL REPO DEL EQUIPO TODAVIA NO ESTAN FUNCIONES INICIADAS, PERO EN UNO PERSONAL HAY FUNCIONES DE LAS PRACTTICAS QUE UTILIZAREMOS EN ESTE REPO

---

## 5. Plan de reversión



**Responsable de la reversión:** Equipo 3, con autorización del responsable del despliegue.

**Señal para revertir:**  La aplicación presenta errores críticos, no carga correctamente o las funciones principales dejan de operar después del despliegue.

**Pasos:**

  1. Identificar el despliegue que presenta errores.
  2. Acceder al panel del proyecto en Vercel.
  3. Localizar el último despliegue estable.
  4. Reactivar el despliegue anterior mediante las opciones de Vercel.
  5. Comprobar que la aplicación vuelva a funcionar correctamente.
  6. Registrar el problema para corregirlo antes de realizar un nuevo despliegue.

---

## 6. Despliegue según nuestro modelo

El equipo trabajará con el modelo V, por lo que el despliegue se realizará después de completar las etapas de desarrollo y verificación.
Primero se identificarán los requisitos que forman parte del incremento.
Posteriormente, se revisará que la implementación corresponda con lo solicitado.
Se realizarán pruebas unitarias para comprobar el funcionamiento de las funciones individuales.
Después se ejecutarán pruebas de integración cuando los módulos estén disponibles.
Antes del despliegue se comprobará que la construcción del proyecto finalice correctamente.
El incremento se publicará en Vercel cuando las verificaciones necesarias hayan sido satisfactorias.
Después de publicar, se realizarán pruebas manuales para comprobar que la aplicación funcione.
Si se detectan errores críticos, se aplicará el plan de reversión.
El equipo buscará realizar despliegues por incrementos validados, evitando publicar cambios que todavía no hayan sido probados.


---

## Bloqueos para el lunes


- Integrar el código de los integrantes en el repositorio oficial del Equipo 3.
- Verificar que las funciones correspondientes a los requisitos estén implementadas.
- Comprobar que las pruebas automatizadas se ejecuten correctamente.
- Crear y vincular el proyecto oficial con Vercel.
- Verificar la configuración de construcción y la URL de producción.
- Confirmar que el incremento esté listo para desplegarse.


---

## Declaración de uso de IA


| Herramienta | Para qué la usamos | Qué verificamos nosotros |
|---|---|---|
| Chat GPT | Apoyo para interpretar las instrucciones de la actividad, organizar el plan de despliegue y redactar propuestas para sus diferentes secciones. | Revisamos que la información corresponda con el código implementado, los requisitos del proyecto, las pruebas realizadas y la configuración real de Vercel. |