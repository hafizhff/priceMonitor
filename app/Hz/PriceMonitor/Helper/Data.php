<?php
/**
 * @author Hafizh FF
 * @copyright Copyright (c) 2020 Magento (https://www.magento.com)
 * @package Hz_PriceMontior
 */
namespace Hz\PriceMonitor\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public static $timeout = 30;
    public static $agent   = 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)';

    /**
     * Crawling Page using Curl
     * 
     * @param  string $url 
     * @return stribg      
     */
    public function httpRequest($url) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,            $url);
      curl_setopt($ch, CURLOPT_USERAGENT,      self::$agent);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::$timeout);
      curl_setopt($ch, CURLOPT_TIMEOUT,        self::$timeout);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      curl_close($ch);
      return $response;
    }

    /**
     * Remove String
     * 
     * @param  string $data 
     * @return string       
     */
    public function stripWhitespace($data) {
      $data = preg_replace('/\s+/', ' ', $data);
      return trim($data);
    }

    /**
     * Extract Base Tag
     * 
     * @param  string $tag  [description]
     * @param  string $data [description]
     * @return string       [description]
     */
    public function extractElementsBySpanClass($tag, $data) {
        $response = array();
        $dom      = new \DOMDocument;
        @$dom->loadHTML($data);

        $xpath = new \DomXPath($dom);
        $nodeList = $xpath->query("//span[@class='".$tag."']");
        $node = $nodeList->item(0);
        return $node->nodeValue;
    }

    /**
     * Extract Base Tag
     * 
     * @param  string $tag  [description]
     * @param  string $data [description]
     * @return string       [description]
     */
    public function extractElementsByDivId($tag, $data) {
        $response = array();
        $dom      = new \DOMDocument;
        @$dom->loadHTML($data);

        $xpath = new \DomXPath($dom);
        $nodeList = $xpath->query("//div[@id='".$tag."']");
        $node = $nodeList->item(0);
        return $node->nodeValue;
    }

    /**
     * Extract Base Tag
     * 
     * @param  string $tag  [description]
     * @param  string $data [description]
     * @return string       [description]
     */
    public function extractElementImageClass($tag, $data)
    {
        $response = array();
        $dom      = new \DOMDocument;
        @$dom->loadHTML($data);

        $xpath = new \DomXPath($dom);
        $nodeList = $xpath->query("//div[@class='".$tag."']");
        // var_dump($nodeList);
        $node = $nodeList->item(0);
        return $node->nodeValue;
    }
}
