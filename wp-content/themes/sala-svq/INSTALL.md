# Instalar y validar Sala SVQ en WordPress real

## ⚠️ Requisito obligatorio: ACF PRO (no la versión gratuita)

Este theme usa tres funcionalidades que **solo existen en ACF PRO**:

| Funcionalidad | Dónde se usa | Sin ACF PRO |
| --- | --- | --- |
| Campo `flexible_content` | `page_builder` — el constructor de páginas | No se registra el campo. No hay forma de editar secciones desde el admin. |
| `acf_add_options_page()` | Ajustes → Sala SVQ (logo, colores, redes, contacto) | La página de ajustes no aparece en el menú. |
| Campo `gallery` | Galería del evento, layout "Galería" | El campo no se registra. |

**Instala ACF PRO antes de nada.** Con ACF gratuito (o sin ACF), el theme no falla ni da error fatal — cae automáticamente al contenido DEMO (ver más abajo) — pero nada es editable desde wp-admin. Si al activar el theme ves un aviso rojo o amarillo en el admin ("Sala SVQ: ..."), significa que falta ACF PRO o que solo tienes la versión gratuita.

## 1. Instalación

1. Descarga WordPress (última versión) y despliega el sitio (local o staging).
2. Copia la carpeta `wp-content/themes/sala-svq` de este repo a `wp-content/themes/` de tu instalación.
3. Instala y activa **Advanced Custom Fields PRO**.
4. Activa el theme **Sala SVQ** en Apariencia → Temas.
5. Confirma que NO aparece ningún aviso de "falta ACF PRO" en el admin. Si aparece, revisa el punto 3.

## 2. Checklist de validación

Marca cada punto según lo compruebes. El objetivo de esta fase es demostrar que todo el flujo de contenido funciona desde wp-admin sin tocar código.

- [ ] **Activación del theme** sin errores fatales ni avisos de ACF PRO.
- [ ] **CPT Eventos** visible en el menú lateral del admin, con icono de tickets.
- [ ] **Taxonomía "Categoría de evento"** visible al editar un evento, con 6 términos por defecto (Música, Humor, Escena, Sesiones, Impro, Otros) y su color de acento editable (Apariencia de la categoría → Color de acento).
- [ ] **Campos ACF del evento**: al crear/editar un evento aparecen Subtítulo, Fecha, Hora, Apertura de puertas, Precio, Estado, Enlace de entradas, Artista (nombre/descripción/imagen), Galería.
- [ ] **Crear una página nueva**, añadir el campo "Secciones de la página" (`page_builder`) y comprobar que aparecen los 8 bloques: Hero, Próximos eventos, La Sala, Categorías, CTA, Galería, Marquee, Contacto.
- [ ] **Añadir, eliminar y reordenar bloques** en esa página (arrastrar para reordenar, papelera para eliminar) y guardar.
- [ ] **Configurar esa página como portada**: Ajustes → Lecturas → "Una página estática" → elegirla como página de inicio. La Home debe reflejar exactamente el orden de bloques que configuraste.
- [ ] **Crear 6-9 eventos** con categorías, fechas, precios y estados distintos (ver contenido demo sugerido más abajo).
- [ ] Esos eventos **aparecen automáticamente** en la sección "Próximos eventos" de la Home y en la Agenda (`/agenda/`), sin tocar código.
- [ ] **Filtro por categoría** en Agenda y en la sección de eventos de la Home funciona (JS del lado del cliente, sin recargar página).
- [ ] **Single Evento**: abrir un evento desde la Agenda muestra su detalle completo (fecha, hora, precio, artista, galería si tiene, eventos relacionados).
- [ ] **Eventos relacionados** en el Single muestran otros eventos reales (no demo) una vez hay contenido.
- [ ] **Ajustes globales** (Ajustes → Sala SVQ): logo, colores (con las 2 variantes tonales), redes sociales, dirección y enlace de entradas se reflejan en el Header, Footer y CTA sin tocar plantillas.

## 3. Contenido demo sugerido para la validación

Para poder juzgar el diseño con contenido real, crea (todo ficticio, marcado como DEMO):

| Título | Categoría | Fecha | Precio | Estado |
| --- | --- | --- | --- | --- |
| Los Estanques | Música | +15 días | 16 € | Entradas disponibles |
| Galder Varas | Humor | +20 días | 18 € | Últimas entradas |
| Ruido Local | Música | +25 días | 10 € | Entradas disponibles |
| Impro Sevilla | Impro | +30 días | 12 € | Entradas disponibles |
| Club SVQ | Sesiones | +35 días | 10 € | Agotado |
| La Tangente | Escena | +40 días | 14 € | Próximamente |

(El fallback demo de `inc/helpers.php` ya usa estos mismos nombres — son los que verás en Home/Agenda mientras no haya eventos reales creados, y sirven de plantilla para los que crees a mano.)

## 4. Si algo no aparece

- **La página de ajustes "Sala SVQ" no aparece** → falta ACF PRO (ver arriba).
- **El campo "Secciones de la página" no aparece al editar una página** → mismo motivo: el campo es `flexible_content`, exclusivo de ACF PRO.
- **Los eventos no aparecen en Home/Agenda** → revisa que el evento esté "Publicado" (no borrador) y que la fecha (`fecha_evento`) esté rellena — es el criterio de ordenación.
- **La Home sigue mostrando contenido demo aunque hay eventos reales** → comprueba en Ajustes → Lecturas que la página de inicio sea la página con `page_builder` configurado, no la página de posts por defecto.
