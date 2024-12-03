# Lach Norris

Eine Laravel Sail Anwendung, die zufällige Chuck Norris Witze anzeigt. Im Frontend wird Vue.js mit TypeScript verwendet. Für die Suche in den gespeicherten Witzen nutzt die Anwendung Laravel Scout mit Meilisearch als Suchprovider.

## Inhaltsverzeichnis

- [Voraussetzungen](#voraussetzungen)
- [Installation](#installation)
- [Umgebung konfigurieren](#umgebung-konfigurieren)
- [Datenbank & Meilisearch einrichten](#datenbank--meilisearch-einrichten)
- [Anwendung starten](#anwendung-starten)

## Voraussetzungen

Stelle sicher, dass folgende Software auf deinem System installiert ist:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Composer](https://getcomposer.org/)
- [Yarn](https://yarnpkg.com/getting-started/install)

## Installation

1. **Repository klonen:**

2. **Abhängigkeiten installieren:**

   ```bash
   composer install
   yarn install
   ```

## Umgebung konfigurieren

1. **Umgebungsdatei erstellen:**

   Kopiere die `.env.example` zu `.env`:

   ```bash
   cp .env.example .env
   ```

2. **Umgebungsvariablen anpassen:**

   Öffne die `.env` Datei und stelle sicher, dass die folgenden Einstellungen korrekt sind:

   ```env
   APP_NAME="Lach Norris"
   APP_ENV=local
   APP_KEY=base64:GENERIERTER_KEY
   APP_DEBUG=true
   APP_URL=http://localhost

   LOG_CHANNEL=stack

   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=sail
   DB_PASSWORD=password

   SCOUT_DRIVER=meilisearch
   MEILISEARCH_HOST=http://meilisearch:7700
   SCOUT_QUEUE=true
   ```

   **Hinweis:** Der `APP_KEY` kann mit dem folgenden Befehl generiert werden:

   ```bash
   php artisan key:generate
   ```

## Datenbank & Meilisearch einrichten

1. **Docker-Container starten:**

   Laravel Sail verwendet Docker. Starte die Container mit:

   ```bash
   ./vendor/bin/sail up -d
   ```

2. **Datenbank migrieren:**

   Führe die Migrationen aus, um die notwendigen Tabellen zu erstellen:

   ```bash
   ./vendor/bin/sail artisan migrate
   ```

3. **Meilisearch konfigurieren:**

   Laravel Scout verwendet Meilisearch als Suchprovider. Stelle sicher, dass Meilisearch läuft. Die Docker-Container sollten Meilisearch bereits bereitstellen.

## Anwendung starten

1. **Queue Worker starten:**

   Da `scout_queue` auf `true` gesetzt ist, müssen die Queue Worker laufen, um die Indizierung der Suchdaten zu verarbeiten:

   ```bash
   ./vendor/bin/sail artisan queue:work
   ```

   **Alternativ:** Du kannst Supervisor konfigurieren, um die Queue Worker automatisch zu verwalten.

2. **Entwicklungsserver starten:**

   Starte den Entwicklungsserver mit Laravel Sail:

   ```bash
   ./vendor/bin/sail up
   ```

   Die Anwendung ist nun unter [http://localhost](http://localhost) erreichbar.


## Lizenz

Dieses Projekt ist lizenziert unter der [MIT Lizenz](LICENSE).

---

Viel Spaß mit deiner Chuck Norris Witze App! Wenn du Fragen oder Probleme hast, zögere nicht, ein Issue im Repository zu erstellen.
