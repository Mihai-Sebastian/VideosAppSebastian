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

## Sprint 3

## Descripció del Sprint

Durant aquest sprint, s'han realitzat diverses tasques clau per millorar la funcionalitat i seguretat de l'aplicació. Aquí es detallen els canvis més importants:

### 1. **Gestió de vídeos**
S'ha implementat la gestió de vídeos en una vista protegida, accessible només per usuaris amb el permís adequat. Això inclou:
- Un controlador `VideosManageController`amb la funció `manage` (per gestionar vídeos).
- Les rutes de gestió de vídeos estan protegides per middleware d'autenticació i control de permisos.
- Les funcions de la vista i la ruta s'han integrat amb permisos usant el package `spatie/laravel-permission`.

### 2. **Creació d'usuaris amb rols i permisos**
S'han afegit rols personalitzats com "superadmin" i "video_manager", amb permisos específics:
- Els superadmins i videos_manager tenen accés complet a la gestió de vídeos.
- Els usuaris regulars no poden gestionar vídeos, i se'ls denega l'accés.
- S'han creat proves per verificar que només els usuaris amb els permisos correctes poden accedir a les funcionalitats de gestió de vídeos.

### 3. **Millores a la seguretat**
S'han millorat les funcionalitats de seguretat per garantir que les rutes protegides siguin accessibles només per usuaris autenticats amb permisos adequats. També s'ha implementat la protecció contra usuaris no autenticats i aquells que no tenen els permisos corresponents.

### 4. **Testos d'unitat i de funcionalitat**
S'han afegit proves automatitzades per verificar el correcte funcionament dels permisos i rols dels usuaris, així com la capacitat de gestionar vídeos segons el rol assignat.

## Sprint 4

### Descripció del Sprint

En aquest sprint, s'han realitzat millores significatives en la interfície d'usuari i en la gestió de vídeos. A continuació, es detallen les principals tasques realitzades:

### 1. **Millores en la interfície d'usuari**
- S'ha redissenyat la pàgina de llistat de vídeos per mostrar els vídeos en una graella de **2 per fila**.
- S'ha afegit un disseny responsiu per assegurar que la pàgina es vegi bé en totes les mides de pantalla.
- S'han afegit miniatures als vídeos, que ocupen tota la card, i el títol del vídeo es mostra sota la card.

### 2. **Paginació de vídeos**
- S'ha implementat la paginació per mostrar 12 vídeos per pàgina (2 per fila × 6 files).
- S'han afegit botons de paginació ("Anterior" i "Següent") per navegar entre les pàgines de vídeos.

### 3. **Proves de la interfície d'usuari**
- S'han afegit proves per verificar que els vídeos es mostren correctament en la graella de 2 per fila.
- S'han afegit proves per verificar que la paginació funciona correctament.

### 4. **Gestió d'usuaris**
- S'ha afegit la possibilitat de crear, editar i eliminar usuaris.
- S'han afegit proves per verificar que la gestió d'usuaris funciona correctament.

# Sprint 5 - Resum de Desenvolupament

## Funcionalitats Implementades
- **Gestió d'Usuaris**
    - Creació del `UsersManageController` per gestionar usuaris amb permisos adequats.
    - Implementació de les funcionalitats `index`, `create`, `store`, `edit`, `update` i `destroy`.
    - Validació de dades per evitar errors en la creació i actualització d'usuaris.
    - Assignació de rols mitjançant `spatie/laravel-permission`.
    - 
## Correcció d'Errors
- **Problema amb rols inexistents en els tests**
    - Afegida la creació de rols abans d'executar les proves amb `createRoles()`.
- **Error de camp obligatori en l'actualització d'usuaris**
    - S'ha corregit l'assignació del rol en `update()` per evitar errors de validació.

# Sprint 6 - Resum de Desenvolupament

### 1. Testos funcionals amb Laravel

S’ha creat el fitxer `SeriesManageControllerTest.php` amb proves completes de permisos d’accés i operacions CRUD:

- **Tests d’autenticació i rols:**
    - `guest_users_cannot_manage_series`
    - `regular_users_cannot_manage_series`
    - `videomanagers_can_manage_series`
    - `superadmins_can_manage_series`

- **Tests de creació:**
    - `user_with_permissions_can_see_add_series`
    - `user_without_series_manage_create_cannot_see_add_series`
    - `user_with_permissions_can_store_series`
    - `user_without_permissions_cannot_store_series`

- **Tests d’edició:**
    - `user_with_permissions_can_see_edit_series`
    - `user_without_permissions_cannot_see_edit_series`
    - `user_with_permissions_can_update_series`
    - `user_without_permissions_cannot_update_series`

- **Tests d’eliminació:**
    - `user_with_permissions_can_destroy_series`
    - `user_without_permissions_cannot_destroy_series`

- **Test global de gestió:**
    - `user_with_permissions_can_manage_series`

### 2. Creació manual d’usuaris i permisos

- No s'han utilitzat `factories`.
- Els usuaris, rols i permisos s’han creat manualment mitjançant els mètodes:
    - `loginAsVideoManager()`
    - `loginAsSuperAdmin()`
    - `loginAsRegularUser()`

### 3. Configuració de permisos amb Spatie

- Utilització del paquet `spatie/laravel-permission`.
- Assignació de permisos directament dins els tests (`manage-series`).

# Sprint 7 - Resum de Desenvolupament

## 🔧 Funcionalitats desenvolupades

- **Event `VideoCreated`**  
  S'ha creat un event `VideoCreated` que s'activa en crear un nou vídeo.

- **Broadcast de l'event via Pusher**  
  S'ha configurat `ShouldBroadcast` i s'ha afegit `broadcastAs()` per enviar notificacions en temps real mitjançant Pusher.

- **Listener `SendVideoCreatedNotification`**  
  El listener envia una notificació a la base de dades a tots els usuaris amb `super_admin = true` quan es crea un vídeo nou.

- **Notificació `VideoCreatedNotification`**  
  La notificació s'ha configurat perquè es guardi a la base de dades (`via(['database'])`). També s'ha afegit estil al correu per enviar una versió HTML més elegant.

- **Vista de notificacions millorada**  
  La vista Blade `notifications/index.blade.php` mostra totes les notificacions en un disseny net i modern.

- **Tests unitaris afegits**
    - `test_video_created_event_is_dispatched`: verifica que es dispara l'event.
    - `test_push_notification_is_sent_when_video_is_created`: comprova que es desa la notificació per als superadmins.

## ⚙️ Configuració del sistema

- **Pusher**: Configurat al `.env` per broadcasting.
- **Mailtrap**: Utilitzat per rebre els correus de notificació en entorns de desenvolupament.
- **Laravel Echo + JavaScript**: Configurat per escoltar events `video.created`.

## 📂 Ubicació del codi clau

- Event: `app/Events/VideoCreated.php`
- Listener: `app/Listeners/SendVideoCreatedNotification.php`
- Notificació: `app/Notifications/VideoCreatedNotification.php`
- Test: `tests/Unit/VideoNotificationsTest.php`
- Vista: `resources/views/notifications/index.blade.php`
- Correu: `resources/views/emails/video_created.blade.php`

## ✅ Estat
Totes les funcionalitats s'han testejat correctament i funcionen com s'espera.
