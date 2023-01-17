<?php

namespace App\Services;

use DOMDocument;

class UrlService
{
    public function getTitleFromUrl($link)
    {
        $title = 'N/I';
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $link);

            $html = (string)$response->getBody();

            $dom = new DOMDocument();
            @$dom->loadHTML($html);

            $elements = $dom->getElementsByTagName('title');
            if ($elements->length > 0) {
                $title = $elements->item(0)->textContent;
            }
        } catch (\Exception $e) {
            report($e);
        }
        return $title;
    }
}
