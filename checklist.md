# Checklist - Sistema de Gestión de Procedimientos

## Tareas Obligatorias

1. **Configurar la base de datos:**

   - [X]  Configurar la base de datos SQLite en el archivo `.env`.
   - [X]  Configurar las migraciones iniciales para el modelo de procedimientos.
2. **Modelo y Migraciones de "Procedimientos":**

   - [X]  Crear el modelo `Procedure` con estos atributos:
     - Tipo de procedimiento (decidir si es un entero, cadena o relación con otra tabla).
     - Estado del procedimiento (enum: "pending", "in progress", "done").
     - DNI de la persona atendida.
     - Timestamps (`created_at`, `updated_at`).
   - [X]  Crear la migración para la tabla de procedimientos.
3. **Controlador y Rutas:**

   - [X]  Crear un controlador para gestionar los procedimientos.
   - [X]  Definir rutas para crear, actualizar y listar procedimientos.
4. **Vista para Listar Procedimientos:**

   - [X]  Implementar una vista en el Dashboard que muestre la lista de todos los procedimientos.
   - [X]  Asegurar que la vista permita crear nuevos procedimientos.
   - [X]  Agregar funcionalidad para editar el estado del procedimiento.
5. **API de Procedimientos:**

   - [ ]  Crear un endpoint que devuelva todos los registros de procedimientos.

## Extras (Opcional):

1. **Filtros en el Endpoint de la API:**

   - [ ]  Añadir filtros para buscar procedimientos por estado o tipo.
2. **Vista Detallada de Procedimientos:**

   - [ ]  Crear una vista detallada de cada procedimiento con un diseño atractivo.
3. **Modificación de Tipo de Procedimiento y DNI:**

   - [ ]  Implementar la capacidad de modificar el tipo de procedimiento y el DNI en la vista de edición.
4. **Mejoras en el Diseño del Listado:**

   - [ ]  Aplicar un diseño similar al panel de eAgora, según las instrucciones del caso de estudio.
