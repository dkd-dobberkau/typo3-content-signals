# Content Signals – TYPO3 Extension

Rendert `<meta name="content-signal">` Tags im HTML `<head>` gemäß der [contentsignals.org](https://contentsignals.org/) Spezifikation.

Damit sind AI-Nutzungsrechte direkt im HTML sichtbar – für Crawler, AI-Agents und den [Markdown for Agents](https://blog.cloudflare.com/markdown-for-agents/) Sidecar.

## Output

```html
<meta name="content-signal" content="ai-train=yes, search=yes, ai-input=yes">
```

## Signale

| Signal | Bedeutung |
|--------|-----------|
| `ai-train` | Darf der Inhalt zum Training von AI-Modellen verwendet werden? |
| `search` | Darf der Inhalt in Suchmaschinen indexiert werden? |
| `ai-input` | Darf der Inhalt als Input für AI-Agents verwendet werden? |

## Installation

```bash
composer require dkd/content-signals
```

Danach:

```bash
vendor/bin/typo3 extension:setup dkd_content_signals
vendor/bin/typo3 database:updateschema
vendor/bin/typo3 cache:flush
```

## Konfiguration

### 1. Statisches TypoScript einbinden

Im TYPO3 Backend unter **Template > Info/Modify > Includes** das statische Template **"Content Signals"** hinzufügen.

### 2. Globale Defaults (TypoScript Constants)

```typoscript
plugin.tx_dkdcontentsignals.settings.aiTrain = yes
plugin.tx_dkdcontentsignals.settings.search = yes
plugin.tx_dkdcontentsignals.settings.aiInput = yes
```

Diese Werte gelten für alle Seiten, sofern nicht pro Seite überschrieben.

### 3. Pro-Seite überschreiben

Im Seiteneigenschaften-Dialog erscheint die Palette **"Content Signals (contentsignals.org)"** mit drei Dropdowns:

| Feld | Optionen | Beschreibung |
|------|----------|-------------|
| **AI Training** | Default / Yes / No | Erlaubt AI-Training mit dem Seiteninhalt |
| **Search Indexing** | Default / Yes / No | Erlaubt Suchmaschinen-Indexierung |
| **AI Input** | Default / Yes / No | Erlaubt AI-Agents den Inhalt als Input zu nutzen |

"Default" übernimmt den Wert aus den TypoScript Constants.

### Beispiel: Seite vom AI-Training ausschließen

Globale Defaults bleiben auf `yes`, aber auf einer bestimmten Seite wird AI-Training deaktiviert:

1. Seiteneigenschaften der Seite öffnen
2. **AI Training** auf **No** setzen
3. Speichern

Ergebnis auf dieser Seite:

```html
<meta name="content-signal" content="ai-train=no, search=yes, ai-input=yes">
```

## Projektstruktur

```
dkd_content_signals/
├── Configuration/
│   ├── TCA/Overrides/
│   │   ├── pages.php              ← TCA-Felder auf pages (3 Dropdowns)
│   │   └── sys_template.php       ← Statisches TypoScript registrieren
│   ├── TypoScript/
│   │   ├── constants.typoscript   ← Globale Defaults (yes/yes/yes)
│   │   └── setup.typoscript       ← Meta-Tag Rendering via page.headerData
│   └── Services.yaml
├── Resources/
│   ├── Private/Language/
│   │   └── locallang.xlf          ← Labels für Backend-Felder
│   └── Public/Icons/
│       └── Extension.svg
├── composer.json
├── ext_emconf.php
├── ext_tables.sql                 ← 3 Felder auf pages-Tabelle
├── LICENSE
└── README.md
```

## Funktionsweise

Die Extension nutzt reines TypoScript (`page.headerData`) um den Meta-Tag zu rendern:

1. Pro Signal wird das zugehörige Seiten-Feld (`tx_dkdcontentsignals_*`) gelesen
2. Ist das Feld leer ("Default"), wird der Wert aus den TypoScript Constants verwendet
3. Alle drei Signale werden zu einem `<meta>` Tag zusammengebaut

Es wird kein PHP-Code zur Laufzeit benötigt.

## Zusammenspiel mit Markdown for Agents

Diese Extension und der [Markdown for Agents Sidecar](https://github.com/dkd-dobberkau/md-for-varnish) ergänzen sich:

| Kanal | Mechanismus | Zielgruppe |
|-------|------------|-----------|
| **HTML** | `<meta name="content-signal">` Tag (diese Extension) | Crawler, Bots, die HTML lesen |
| **Markdown** | `Content-Signal` HTTP-Header (Sidecar) | AI-Agents mit `Accept: text/markdown` |

Beide verwenden das gleiche Signal-Format von [contentsignals.org](https://contentsignals.org/).

## Anforderungen

- TYPO3 12.4+ oder 13.x
- PHP 8.1+

## Lizenz

[MIT](LICENSE)
