<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ScrappingController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // get comming soon movies on IMDB
        $response = Cache::remember('response', 60*24, function () {
            return $this->getPageContent("http://www.imdb.com/movies-coming-soon/");
        });
        
        
        $parsedResponse = $this->parseHtml($response);
        file_put_contents($path = app_path().'/Services/imdb-comming-soon-movies.text', '');
        foreach($parsedResponse->find("table h4 a[href^=/title/]") as $link) {
            $link = $link->plaintext;
            echo $link . "<br>";
            file_put_contents($path, $link . PHP_EOL, FILE_APPEND);
        }
    }

    protected function getPageContent(string $url): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_POST, true);
        // $postFields = [] // array of fields to be send in post request
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
        // curl_setopt($ch, CURLOPT_COOKIEJAR, 'cooki.txt'); // for login
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    protected function parseHtml($html)
    {
        include(app_path().'/Services/simple_html_dom.php');
        return (new \simple_html_dom())->load($html);
    }
}
