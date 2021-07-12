<?php
namespace App\Services;
use Coderello\SocialGrant\Resolvers\SocialUserResolverInterface;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Socialite\Facades\Socialite;
class SocialUserResolver implements SocialUserResolverInterface
{
    /**
     * Resolve user by provider credentials.
     *
     * @param string $provider
     * @param string $accessToken
     *
     * @return Authenticatable|null
     */
    public function resolveUserByProviderCredentials(string $provider, string $accessToken ): ?Authenticatable
    {
        $providerUser = null;

        try {
            if($provider == "twitter") {
                $secretToken =  $_SESSION['secret_token'] ;
                $providerUser = Socialite::driver('twitter')->userFromTokenAndSecret($accessToken, $secretToken);
            }
            else
            $providerUser = Socialite::driver($provider)->userFromToken($accessToken);

//            dd($providerUser);

        } catch (Exception $exception) {
//            dd($exception->getMessage());
            return $exception->getMessage();
        }

        if ($providerUser) {

            if($provider == "twitter")
            return (new SocialAccountsService())->findOrCreateTwitter($providerUser, $provider);

            return (new SocialAccountsService())->findOrCreate($providerUser, $provider);
        }
        return null;
    }
}