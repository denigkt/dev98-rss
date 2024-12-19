<?php
/**
 * RSS Feed Fetcher
 * Updated to PHP's latest standards
 * @Deni
 */

// Aktiviert die interne Fehlerbehandlung für XML
libxml_use_internal_errors(true);

try {
    // Überprüfen, ob die $loadrss-Variable definiert ist
    if (empty($loadrss) || !filter_var($loadrss, FILTER_VALIDATE_URL)) {
        throw new Exception("Ungültige oder fehlende RSS-Feed-URL.");
    }

    // RSS-Feed laden
    $xml = simplexml_load_file($loadrss, "SimpleXMLElement", LIBXML_NOCDATA);

    if ($xml === false) {
        throw new Exception("Fehler beim Laden des RSS-Feeds.");
    }

    // Inhalt aus dem Namespace "dc:creator" extrahieren
    $dcNamespace = $xml->channel->item->children("http://purl.org/dc/elements/1.1/");
    $creator = $dcNamespace->creator ?? "Unbekannt";

    // Veröffentlichungsdatum (pubDate) abrufen und formatieren
    $pubDate = $xml->channel->item->pubDate ?? null;
    if ($pubDate) {
        $dateTime = new DateTime($pubDate);
        $formattedDate = $dateTime->format("Y-m-d H:i:s");
    } else {
        $formattedDate = "Kein Veröffentlichungsdatum verfügbar.";
    }

    // Ausgabe (nur für Testzwecke)
    echo "Autor: " . htmlspecialchars($creator, ENT_QUOTES, 'UTF-8') . PHP_EOL;
    echo "Veröffentlichungsdatum: " . htmlspecialchars($formattedDate, ENT_QUOTES, 'UTF-8') . PHP_EOL;

} catch (Exception $e) {
    // Fehler ausgeben
    echo "Ein Fehler ist aufgetreten: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . PHP_EOL;

    // XML-Fehler detailliert ausgeben
    foreach (libxml_get_errors() as $error) {
        echo "XML-Fehler: " . htmlspecialchars($error->message, ENT_QUOTES, 'UTF-8') . PHP_EOL;
    }
} finally {
    // Fehlerliste zurücksetzen
    libxml_clear_errors();
}
?>
