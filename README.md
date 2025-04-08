<p align="center">
  <img src="assets/logoSAPD.png" alt="Logo SAPD" width="200"/>
</p>

# Generador de Ascensos, Descensos y Expulsiones

Este proyecto en PHP permite generar automáticamente un informe clasificado de **ascensos**, **descensos** y **expulsiones** dentro de una fuerza policial de un servidor de rol.

Ideal para facilitar el trabajo de supervisores, tenientes, comandantes o encargados de personal en el servidor.

## 📁 ¿Qué hace este generador?

- Lee un archivo CSV con información de personal y rangos.
- Compara el **rango anterior** con el **nuevo rango**.
- Clasifica automáticamente a cada miembro en:
  - 🟩 Ascensos
  - 🟥 Descensos
  - ❌ Expulsiones
- Genera una carpeta con la fecha actual y tres subcarpetas (`Ascensos`, `Descensos`, `Expulsiones`).
- Dentro de cada subcarpeta, crea un archivo `.txt` con el listado correspondiente.

## 📄 Formato esperado del archivo CSV

Nombre del archivo: `Revision/controlSAPD.csv`

Columnas obligatorias:

- `Nombre`
- `Institución`
- `Rangos` (rango anterior)
- `Nuevos Rangos` (rango nuevo)

## 🧠 Jerarquía de rangos usada (de mayor a menor)

1. Comandante  
2. Capitán  
3. Comisario  
4. Teniente  
5. Sargento II  
6. Sargento I  
7. Inspector  
8. Oficial III  
9. Oficial II  
10. Oficial I  
11. Suboficial  
12. Cadete  
13. Estudiante  

*(Puedes modificar el orden dentro del script si tu estructura es distinta.)*

## ✅ Requisitos

- PHP 7.4 o superior
- Archivo `controlSAPD.csv` colocado en la carpeta `Revision/`

## ⚙️ Uso

1. Asegúrate de tener el archivo `controlSAPD.csv` en la carpeta `Revision/`.
2. Ejecuta el script desde la terminal o navegador:

```bash
php ejecutar.php
```

3. Se generará una carpeta con nombre:  
   `Reunión Ascensos - YYYY-MM-DD`  
   Dentro habrá subcarpetas con archivos `.txt`:

```
Reunión Ascensos - 2025-04-07/
├── Ascensos/
│   └── ascensos.txt
├── Descensos/
│   └── descensos.txt
└── Expulsiones/
    └── expulsiones.txt
```

## 📌 Nota sobre expulsiones

Por el momento, el archivo `expulsiones.txt` solo contiene un mensaje informativo. La lógica para detectar expulsiones aún no ha sido implementada.

## 🤝 Contribuciones

¡Ideas y mejoras son bienvenidas! Puedes enviar una sugerencia para agregar funciones como:

- Lógica de expulsión automática
- Generación de archivos PDF
- Filtros por institución o fecha

---

📂 Proyecto pensado para mejorar la organización interna del **SAPD - San Andreas Police Department** en servidores de rol.

<p align="center">
  <img src="assets/bannerSAPD.png" alt="Banner SAPD" style="width: 100%; height: auto;" />
</p>