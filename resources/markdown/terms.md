# Guia del Projecte VideosApp

## 📌 Sobre el projecte
VideosApp és una aplicació desenvolupada en Laravel que permet gestionar i visualitzar vídeos. Els usuaris poden veure els vídeos disponibles, consultar-ne la informació i navegar per les sèries de vídeos relacionades.

## 🚀 Sprint 1: Configuració i Desenvolupament Inicial
Durant el primer sprint es van establir les bases del projecte:
- **Configuració de Laravel** i inicialització del repositori.
- **Creació de models i migracions** per `videos` i `series`.
- **Definició de relacions** entre `Video` i `Series` a Eloquent.
- **Implementació de VideoHelper** per generar vídeos per defecte.
- **Primeres proves unitàries** (`HelpersTest`) per verificar la creació dels vídeos.

## 🎯 Sprint 2: Funcionalitats i Testeig
En el segon sprint ens vam centrar en millorar la funcionalitat i assegurar la qualitat del codi:
- **Creació de rutes i controladors**, incloent `videos.show`.
- **Implementació del layout `VideosAppLayout`** per unificar el disseny.
- **Mostra de la informació dels vídeos**, incloent dates formatades en català.
- **Desenvolupament de tests d’integració** (`VideosTest`), provant la visualització i restriccions d’accés a vídeos inexistents.

Aquest document es mantindrà actualitzat amb futurs canvis i millores! 🚀
