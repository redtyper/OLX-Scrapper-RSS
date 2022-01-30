<?php



class OLXKoparkoBridge extends BridgeAbstract
{
   const MAINTAINER = 'RedTyper';
    const NAME = 'OLXNow - Damaged Excavator';
    const URI = 'https://www.olx.pl/';
    const CACHE_TIMEOUT = 0;
    const DESCRIPTION = 'Push Notification from new ads on OLX';

    public function collectData(){
        $html = getSimpleHTMLDOM(self::URI . 'motoryzacja/przyczepy-pojazdy-uzytkowe/pozostale/q-koparko/?search[filter_float_price%3Ato]=35000&search[filter_enum_condition][0]=damaged');

        $limit = 0;

        
          foreach($html->find('table#offers_table > tbody > tr > td > div > table') as $element) {
  
                $title = $element->find('tbody > tr', 0)->find('td', 1)->find('strong', 0)->plaintext;
                $uri = $element->find('tbody > tr', 0)->find('td', 1)->find('a[href]', 0)->href;
                $price = $element->find('tbody > tr', 0)->find('td', 2)->plaintext;
                $images = $element->find('tbody > tr', 0)->find('td', 0)->find('img', 0)->src;
                $location = $element->find('tbody > tr', 1)->find('td', 0)->find('p > small', 0)->plaintext;
                $time = $element->find('tbody > tr', 1)->find('td', 0)->find('p > small', 1)->plaintext;
                $content = 'Cena:' . $price . '<br />Lokalizacja:' . $location . '<br />Dodano:' . $time . '<br /><img src="' . $images .'">';
                
                $item = array();

                $item['title'] = $title;                            
                $item['uri'] = $uri;
                $item['price'] = $price;
                $item['image'] = $images;
                $item['location'] = $location;
                $item['content'] = $content;


                $this->items[] = $item;
                           
        }
    }

    
  }



  
