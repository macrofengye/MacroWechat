<?php
namespace MComponent\WX\SWA\Socialite\Providers;

use MComponent\WX\SWA\Socialite\AccessTokenInterface;
use MComponent\WX\SWA\Socialite\ProviderInterface;
use MComponent\WX\SWA\Socialite\User;

/**
 * Class WeiboProvider.
 *
 * @link http://open.weibo.com/wiki/%E6%8E%88%E6%9D%83%E6%9C%BA%E5%88%B6%E8%AF%B4%E6%98%8E [OAuth 2.0 授权机制说明]
 */
class WeiboProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * The base url of Weibo API.
     *
     * @var string
     */
    protected $baseUrl = 'https://api.weibo.com';

    /**
     * The API version for the request.
     *
     * @var string
     */
    protected $version = '2';

    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = ['email'];

    /**
     * The uid of user authorized.
     *
     * @var int
     */
    protected $uid;

    /**
     * Get the authentication URL for the provider.
     *
     * @param string $state
     *
     * @return string
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase($this->baseUrl . '/oauth2/authorize', $state);
    }

    /**
     * Get the token URL for the provider.
     *
     * @return string
     */
    protected function getTokenUrl()
    {
        return $this->baseUrl . '/' . $this->version . '/oauth2/access_token';
    }

    /**
     * Get the Post fields for the token request.
     *
     * @param string $code
     *
     * @return array
     */
    protected function getTokenFields($code)
    {
        return parent::getTokenFields($code) + ['grant_type' => 'authorization_code'];
    }

    /**
     * Get the raw user for the given access token.
     *
     * @param \MComponent\WX\SWA\Socialite\AccessTokenInterface $token
     *
     * @return array
     */
    protected function getUserByToken(AccessTokenInterface $token)
    {
        $response = $this->getHttpClient()->get($this->baseUrl . '/' . $this->version . '/users/show.json', [
            'query' => [
                'uid' => $token['uid'],
                'access_token' => $token->getToken(),
            ],
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Map the raw user array to a Socialite User instance.
     *
     * @param array $user
     *
     * @return \MComponent\WX\SWA\Socialite\User
     */
    protected function mapUserToObject(array $user)
    {
        return new User([
            'id' => $this->arrayItem($user, 'id'),
            'nickname' => $this->arrayItem($user, 'screen_name'),
            'name' => $this->arrayItem($user, 'name'),
            'email' => $this->arrayItem($user, 'email'),
            'avatar' => $this->arrayItem($user, 'avatar_large'),
        ]);
    }
}