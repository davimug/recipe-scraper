<?php

namespace RecipeScraper\Scrapers;

use Symfony\Component\DomCrawler\Crawler;
use RecipeScraper\ExtractsDataFromCrawler;

class Tasty extends SchemaOrgJsonLd
{
    use ExtractsDataFromCrawler;

    /**
     * @param  Crawler $crawler
     * @return boolean
     */
    public function supports(Crawler $crawler) : bool
    {
        return parent::supports($crawler)
            && 'tasty.co' === parse_url($crawler->getUri(), PHP_URL_HOST);
    }

    protected function extractRatingValue(Crawler $crawler, array $json)
    {
        if (is_numeric($count = Arr::get($json, 'aggregateRating.ratingValue'))) {
            return $count / 20;
        }


        return null;
    }
}
