<?php
class OLXDokiBridge extends BridgeAbstract
{
   const MAINTAINER = 'qwertygc';
    const NAME = 'OLXNow';
    const URI = 'https://www.olx.pl/';
    const CACHE_TIMEOUT = 0;
    const DESCRIPTION = 'Push Notification from new ads on OLX';

    public function collectData(){
        $html = getSimpleHTMLDOM(self::URI . 'motoryzacja/dostawcze-ciezarowe/dostawcze/?search%5Bfilter_enum_mark%5D%5B0%5D=ford&search%5Bfilter_enum_mark%5D%5B1%5D=peugeot&search%5Bfilter_enum_mark%5D%5B2%5D=renault&search%5Bfilter_enum_mark%5D%5B3%5D=iveco&search%5Bfilter_float_price%3Ato%5D=25000&search%5Bfilter_float_year%3Afrom%5D=2007');

        $limit = 0;

        foreach($html->find('table[summary="Ogłoszenie"]') as $element) {
            
                $item = array();
                $item['title'] = $element->find('a[data-cy=listing-ad-title]', 0)->innertext;
                $item['uri'] = $element->find('a[data-cy=listing-ad-title]', 0)->href;
                $item['timestamp'] = time();

                $image = $element->find('a[class*=thumb]', 0)->find('img', 0)->src;
                $item['image'] = $image;

                $price = $element->find('.space.inlblk.rel', 0)->plaintext;
                //$negotiate_price = $element->find('.lheight16', 1)->outertext;

                $location = $element->find('td[class*=bottom-cell]', 0)->find('span', 0)->innertext;  
                $time = $element->find('td[class*=bottom-cell]', 0)->find('span', 1)->innertext;  

               $item['content'] = $content;
              // $content =  str_replace("\r\n","",$description);;
               $content = '<style>table.greyGridTable {
                border: 2px solid #FFFFFF;
                width: 100%;
                text-align: center;
                border-collapse: collapse;
              }
              table.greyGridTable td, table.greyGridTable th {
                border: 1px solid #000000;
                padding: 3px 4px;
              }
              table.greyGridTable tbody td {
                font-size: 13px;
              }
              table.greyGridTable tfoot td {
                font-size: 14px;
              }</style><table class="greyGridTable">
              <tr>
              <th>Cena</th>
              <th colspan="2">Lokalizacja</th>    
            </tr>
            <tr>
              <td>' .  $price .'</td>
              <td>' . $location . '</td>
              <td>'. $time . ' </td>    
            </tr>
            <tr>
            <td><img src="' . $image . '"></td></tr>
             </table>';

                $this->items[] = $item;
                           
        }
    }
 
}

  
