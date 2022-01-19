<?php

class OLXDokiBridge extends BridgeAbstract
{
    const MAINTAINER = 'RedTyper';
    const NAME = 'OLXDoki';
    const URI = '';
    const DESCRIPTION = 'Powiadomienia o nowych dostawczakach';
    //  const PARAMETERS = array(); // Can be omitted!
    const CACHE_TIMEOUT = 0; // Can be omitted!

    public function collectData()
    {

        $feed_url = 'https://www.olx.pl/motoryzacja/dostawcze-ciezarowe/dostawcze/?search%5Bfilter_enum_mark%5D%5B0%5D=ford&search%5Bfilter_enum_mark%5D%5B1%5D=peugeot&search%5Bfilter_enum_mark%5D%5B2%5D=renault&search%5Bfilter_enum_mark%5D%5B3%5D=iveco';
        $item = getSimpleHTMLDOM($feed_url)
        or returnServerError('Unable to get changelog data from "' . $feed_url . '"!');

            foreach ($item->find('#offers_table .wrap') as $article) {
                $item = array();
                    if ($article->find('.detailsLink strong', 0)->plaintext != '') {
                        $item['title'] = $article->find('.detailsLink strong', 0)->plaintext;
                        $item['image'] = $article->find('.linkWithHash img', 0)->attr['src'];
                    if (strpos($article->find('.detailsLink', 0)->href, 'https://www.otomoto.pl') !== false) {
                        $item['url'] = $article->find('.detailsLink', 0)->href;
                        $item['uid'] = $article->find('.detailsLink', 0)->href;
                    } else {
                        $item['url'] = (strstr($article->find('.detailsLink', 0)->href, '#', true));
                        $item['uid'] = (strstr($article->find('.detailsLink', 0)->href, '#', true));
                    }
                    } else {
                        $item['title'] = $article->find('.detailsLinkPromoted strong', 0)->plaintext;
                        $item['image'] = $article->find('.linkWithHash img', 0)->attr['src'];
                    if (strpos($article->find('.detailsLinkPromoted', 0)->href, 'https://www.otomoto.pl') !== false) {
                        $item['url'] = $article->find('.detailsLinkPromoted', 0)->href;
                        $item['uid'] = $article->find('.detailsLinkPromoted', 0)->href;

                    } else {
                        $item['url'] = (strstr($article->find('.detailsLinkPromoted', 0)->href, '#', true));
                        $item['uid'] = (strstr($article->find('.detailsLinkPromoted', 0)->href, '#', true));
                    }}

                $item['price'] = $article->find('.price', 0)->plaintext;

                $bcell = $article->find('td.bottom-cell')[0];

                $item['location'] = $bcell->find('.breadcrumb', 0)->plaintext;

                $item['date'] = $bcell->find('.breadcrumb', 1)->plaintext;
                    if (strpos($bcell->find('.breadcrumb', 1)->plaintext, 'dzisiaj')) {
                        $item['date'] = strftime('%e %b');
                    } elseif (strpos($bcell->find('.breadcrumb', 1)->plaintext, 'wczoraj')) {
                        $item['date'] = strftime('%e %b', strtotime('-1 days'));
                    }

                $item['description'] = $item['url'] . $item['location'] . $item['date'] . $item['price'];

			    $image = $article->find('.linkWithHash img', 0)->src;

		        $item['content'] .= '<table cellpadding="10">
                                        <tbody>
                                        <tr>
                                            <td width="300" bgcolor="#eeeeee">
                                            <a href="'.$item['url'].'" target="_blank">
                                                <center>
                                                <img src="' . $image . '">
                                                </center>
                                            </a>
                                            </td>
                                            <td>
                                            <p>Miejscowosc: <strong>' . $item['location'] . ',</strong><br> Wystawiono: '.$item['date'].'</p>
                                            <h1>Cena: '.$item['price'].'</h1>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table><hr>';

		        $this->items[] = $item;
		}
    }
}