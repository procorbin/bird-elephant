<?php
namespace Procorbin\Tests;

use Procorbin\BirdElephant\BirdElephant;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Exception\GuzzleException;
use function PHPUnit\Framework\assertObjectHasAttribute;


class BaseTest extends TestCase {

    /**
     * @return array
     */
    protected function setUpCredentials(): array {
        return [
            'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
            'consumer_key' => $_ENV['TWITTER_API_KEY'],
            'consumer_secret' => $_ENV['TWITTER_SECRET'],
            'token_identifier' => $_ENV['TWITTER_ACCESS_TOKEN'],
            'token_secret' => $_ENV['TWITTER_ACCESS_TOKEN_SECRET'],
        ];
    }

    /**
     * @return void
     */
    public function testCreate() {
        $app = new BirdElephant($this->setUpCredentials());
        self::assertInstanceOf(BirdElephant::class, $app);
    }

}
