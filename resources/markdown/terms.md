# Guia del Projecte VideosApp

## Descripció del Projecte

VideosApp és una aplicació desenvolupada amb Laravel que permet la gestió i visualització de vídeos. L'objectiu del projecte és proporcionar una plataforma on els usuaris puguin accedir a una col·lecció de vídeos estructurats en sèries, amb dates de publicació i diferents formats de visualització. A més, s'han implementat proves unitàries i funcionals per garantir el correcte funcionament del sistema.

---

## Sprint 1

### Creació del Projecte

Per iniciar el projecte, es va crear un nou projecte Laravel amb el nom `VideosAppSebastian`, utilitzant les següents opcions de Jetstream:

- **Livewire** per a la interfície d'usuari.
- **PHPUnit** per a les proves.
- **Teams** per a la gestió d'equips.
- **SQLite** com a base de dades.

### Desenvolupaments Realitzats

1. **Test de Helpers:**
    - S'ha creat una prova per verificar la creació d'usuaris per defecte (usuari estàndard i professor).
    - Es comprova que els camps `name`, `email` i `password` estiguin correctament establerts.
    - La contrasenya s'encripta correctament.
    - Els usuaris es vinculen a un equip per defecte.

2. **Creació de Helpers:**
    - S'ha afegit una carpeta `app/Helpers` per gestionar funcions auxiliars.

3. **Configuració de credencials:**
    - Les credencials per defecte es defineixen a `config` i es llegeixen des del fitxer `.env`.

---

## Sprint 2

### Correccions i Millores

1. **Correcció d'errors del Sprint 1.**
2. **Configuració de PHPUnit:**
    - S'han descomentat les línies `DB_CONNECTION` i `DB_DATABASE` per utilitzar una base de dades temporal en proves.

### Desenvolupaments Realitzats

1. **Migració de Vídeos:**
    - Creació de la taula `videos` amb els camps:
        - `id`, `title`, `description`, `url`, `published_at`, `previous`, `next`, `series_id`.
    - Inserció de vídeos amb URLs de YouTube.

2. **Controlador de Vídeos (`VideosController`)**
    - Implementació de les funcions `testedBy` i `show`.

3. **Model de Vídeos:**
    - El camp `published_at` s'emmagatzema com a data.
    - Funcions per formatar la data:
        - `getFormattedPublishedAtAttribute()`: Retorna la data en format "13 de gener de 2025".
        - `getFormattedForHumansPublishedAtAttribute()`: Retorna "fa 2 hores".
        - `getPublishedAtTimestampAttribute()`: Retorna el timestamp Unix.
    - S'utilitza la llibreria **Carbon** per manipular dates i hores.

4. **Helper de Vídeos per Defecte.**

5. **Seeder de Dades:**
    - Inserció d'usuaris i vídeos per defecte al `DatabaseSeeder`.

6. **Layout del Projecte:**
    - Creació del `VideosAppLayout` a `app/View/Components` i `resources/views/layouts`.

7. **Ruta i Vista del Show de Vídeos.**

### Proves Implementades

1. **HelpersTest (`tests/Unit/HelpersTest.php`)**
    - S'ha afegit una prova per verificar la creació de vídeos per defecte.

2. **VideosTest (`tests/Unit/VideosTest.php`)**
    - `can_get_formatted_published_at_date()`
    - `can_get_formatted_published_at_date_when_not_published()`

3. **VideosTest (`tests/Feature/Videos/VideosTest.php`)**
    - `users_can_view_videos()`
    - `users_cannot_view_not_existing_videos()`

### Millores de Qualitat del Codi

- **Instal·lació i Configuració de Larastan:**
    - S'ha afegit Larastan per a l'anàlisi estàtica del codi.
    - S'han corregit els errors detectats per aquesta eina.

