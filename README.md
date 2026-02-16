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

- **AI Training** – Default / Yes / No
- **Search Indexing** – Default / Yes / No
- **AI Input** – Default / Yes / No

"Default" übernimmt den Wert aus den TypoScript Constants.

## Zusammenspiel mit Markdown for Agents

Diese Extension und der Markdown-Sidecar ergänzen sich:

- **Extension** → `<meta>` Tag im HTML für direkte Crawler
- **Sidecar** → `Content-Signal` HTTP-Header in Markdown-Responses

Beide verwenden das gleiche Signal-Format von contentsignals.org.

## Anforderungen

- TYPO3 12.4+ oder 13.x
- PHP 8.1+

## Lizenz

MIT
