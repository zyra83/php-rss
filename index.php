<?php

$expires = $date = date_format(date_create(NULL, timezone_open('GMT')), DATE_RFC1036);
header("Content-type:application/xml; charset=UTF-8");
header("Date: $expires");
header("Cache-control: max-age=0");
header("Expires: $expires");

include 'database.php';
$statement = 'SELECT * FROM rss_channel WHERE name = "pouic"';
$s = $db->query($statement);
$o = $s->fetch();

$channelName = $o->name;
$channelLink = $o->link;
$channelDescription = $o->description;
$channelLanguage = $o->language;

$statement = 'SELECT ri.*
FROM rss_channel  = rc
	LEFT JOIN rss_item ri
		ON rc.id = ri.channel_id
WHERE rc.name = "pouic"
ORDER BY ri.pubDAte DESC;';
$s = $db->query($statement);
$r = $s->fetchAll();
/**
 * Génère un fichier XML contenant un Flux RSS 2.0 encodé en UTF-8.
 * @author : Mickael BENOIT
 */
$xml = new DOMDocument('1.0', 'UTF-8');
$rss = $xml->createElement("rss");
$rss->setAttribute('version', '2.0');
$channel = $xml->createElement("channel");

$name = $xml->createElement("name");
$name->appendChild($xml->createTextNode($channelName));
$channel->appendChild($name);

$link = $xml->createElement("link");
$link->appendChild($xml->createTextNode($channelLink));
$channel->appendChild($link);

$description = $xml->createElement("description");
$description->appendChild($xml->createTextNode($channelDescription));
$channel->appendChild($description);

$langage = $xml->createElement("langage");
$langage->appendChild($xml->createTextNode($channelLanguage));
$channel->appendChild($langage);

foreach ($r as $item) {

    $itemTitleTxt = $item->title;
    $itemLinkTxt = $item->link;
    $itemDescriptionTxt = $item->description;
    $itemPubDateTxt = date_format(date_create($item->pubDate, timezone_open('GMT')), DATE_RSS);

    $item = $xml->createElement("item");

    $itemTitle = $xml->createElement("title");
    $itemTitle->appendChild($xml->createTextNode($itemTitleTxt));
    $item->appendChild($itemTitle);

    $itemLink = $xml->createElement("link");
    $itemLink->appendChild($xml->createTextNode($itemLinkTxt));
    $item->appendChild($itemLink);

    $itemDescription = $xml->createElement("description");
    $itemDescription->appendChild($xml->createTextNode($itemDescriptionTxt));
    $item->appendChild($itemDescription);

    $itemPubDate = $xml->createElement("pubDate");
    $itemPubDate->appendChild($xml->createTextNode($itemPubDateTxt));
    $item->appendChild($itemPubDate);

    $channel->appendChild($item);
}

$rss->appendChild($channel);
$xml->appendChild($rss);

$xml->formatOutput = true;
echo $xml->saveXML();
