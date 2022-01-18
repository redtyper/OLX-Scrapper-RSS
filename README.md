## OLX-Scrapper-RSS

 W gruncie rzeczy chodzi nam o dodanie elementu podrzędnego image majacego wewnątrz title oraz url.
 Z resztą sobie poradzę
 
 Dodałem obiekt image zawierający title oraz url (plik channel.php), nie wiem jak dodać go do pliku get.php gdyż jest on obiekieltem?.
	
## Struktura

```<channel>
<item>
 <image>
  <title></title>
  <url></url>
 </image>
</item>
</channel>
```

## Podsumowując

Plik get.php generuje kanał RSS który jest dostępny pod adresem 
```
https://itdexter.pl/olx-rss/src/get.php?url=https%3A%2F%2Fwww.olx.pl%2Fmotoryzacja%2Fdostawcze-ciezarowe%2Fdostawcze%2F%3Fsearch%255Bfilter_enum_mark%255D%255B0%255D%3Dford%26search%255Bfilter_enum_mark%255D%255B1%255D%3Dpeugeot%26search%255Bfilter_enum_mark%255D%255B2%255D%3Drenault%26search%255Bfilter_enum_mark%255D%255B3%255D%3Diveco%26search%255Bfilter_float_price%253Ato%255D%3D25000%26search%255Bfilter_float_year%253Afrom%255D%3D2007
```

## Dane do FTP :
```
Host : itdexter.pl port: 21
Username : itdevweb.pl
Pass : Honda4ever#
Path: /public_html/itdexter.pl/olx-rss/
```

## Uzyto

HTML/CSS/PHP<br />
Bhaktaraz RSSGenerator (https://github.com/bhaktaraz/php-rss-generator)<br />
PHP Simple HTML DOM Parser (http://simplehtmldom.sourceforge.net)<br />
