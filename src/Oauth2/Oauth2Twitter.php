<?php

namespace Procorbin\BirdElephant\Oauth2;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use RandomLib\Factory as RandomLibFactory;
use UnexpectedValueException;

class Oauth2Twitter extends AbstractProvider {

    use BearerAuthorizationTrait;

    protected $pkceVerifier;

    /**
     * @param string $param
     * @return string
     */
    private function base64UrlEncode(string $param): string {
        return rtrim(strtr(base64_encode($param), '+/', '-_'), '=');
    }

    /**
     * @param array $options
     * @return array
     */
    protected function getAuthorizationParameters(array $options): array {
        if (!isset($options['code_challenge'])) {
            $options['code_challenge'] = $this->generatePkceChallenge();
            $options['code_challenge_method'] = 'S256';
        }

        return parent::getAuthorizationParameters($options);
    }

    /**
     * @param array $params
     * @return RequestInterface
     */
    protected function getAccessTokenRequest(array $params): RequestInterface {
        $request = parent::getAccessTokenRequest($params);

        $token_string = base64_encode($this->clientId . ':' . $this->clientSecret);

        return $request->withHeader('Authorization', "Basic $token_string");
    }

    /**
     * @param AccessToken $token
     * @return array|mixed|string
     * @throws IdentityProviderException
     */
    protected function fetchResourceOwnerDetails(AccessToken $token) {
        $url = $this->getResourceOwnerDetailsUrl($token) . '?' . http_build_query(['user.fields' => 'id,name,profile_image_url,username']);

        $request = $this->getAuthenticatedRequest(self::METHOD_GET, $url, $token);

        $response = $this->getParsedResponse($request);

        if (false === is_array($response)) {
            throw new UnexpectedValueException(
                'Invalid response received from Authorization Server. Expected JSON.'
            );
        }

        return $response;
    }

    /**
     * @return string[]
     */
    protected function getDefaultScopes(): array {
        return [
            'tweet.read',
            'users.read',
            'offline.access',
        ];
    }

    /**
     * @return string
     */
    protected function getScopeSeparator(): string {
        return ' ';
    }

    /**
     * @param ResponseInterface $response
     * @param $data
     * @return void
     * @throws IdentityProviderException
     */
    protected function checkResponse(ResponseInterface $response, $data) {
        if ($response->getStatusCode() == 200) {
            return;
        }

        $error = $data['error_description'] ?? '';
        $code = $data['code'] ?? $response->getStatusCode();

        throw new IdentityProviderException($error, $code, $data);
    }

    /**
     * @param array $response
     * @param AccessToken $token
     * @return TwitterResourceOwner
     */
    protected function createResourceOwner(array $response, AccessToken $token): TwitterResourceOwner {
        return new TwitterResourceOwner($response);
    }

    /**
     * Get the unhashed PKCE Verifier string for the request.
     *
     * @return string
     */
    public function getPkceVerifier(): string {
        if (!isset($this->pkceVerifier)) {
            $this->pkceVerifier = $this->generatePkceVerifier();
        }

        return $this->pkceVerifier;
    }

    /**
     * @return string
     */
    public function getBaseAuthorizationUrl(): string {
        return 'https://twitter.com/i/oauth2/authorize';
    }

    /**
     * @param array $params
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params): string {
        return 'https://api.twitter.com/2/oauth2/token';
    }

    /**
     * @param AccessToken $token
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token): string {
        return 'https://api.twitter.com/2/users/me';
    }

    /**
     * Create a PKCE verifier string.
     *
     * @link https://www.oauth.com/oauth2-servers/pkce/authorization-request/
     *
     * @return string
     */
    public function generatePkceVerifier(): string {
        $generator = (new RandomLibFactory())->getMediumStrengthGenerator();

        return $generator->generateString(
            $generator->generateInt(43, 128), // Length between 43-128 characters
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-._~'
        );
    }

    /**
     * Get the hashed and encoded PKCE challenge string for the request.
     *
     * @param string|null $passed_verifier Verifier string to use. Defaults to $this->getPkceVerifier().
     * @return string
     */
    public function generatePkceChallenge(string $passed_verifier = null): string {
        $verifier = $passed_verifier ?? $this->getPkceVerifier();

        return $this->base64Urlencode(hash('SHA256', $verifier, true));
    }
}
