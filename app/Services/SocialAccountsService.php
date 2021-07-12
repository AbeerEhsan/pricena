<?php
namespace App\Services;
use App\Models\User;
use App\Models\LinkedSocialAccount;
use Laravel\Socialite\Two\User as ProviderUser;
use Laravel\Socialite\One\User as TwiiterProviderUser;
class SocialAccountsService
{
    /**
     * Find or create user instance by provider user instance and provider name.
     *
     * @param ProviderUser $providerUser
     * @param string $provider
     *
     * @return User
     */
    public function findOrCreate(ProviderUser $providerUser, string $provider): User
    {
        $linkedSocialAccount = LinkedSocialAccount::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();
        if ($linkedSocialAccount) {
            return $linkedSocialAccount->user;
        } else {
            $user = null;
            $email = $providerUser->getEmail();

            if (isset($email)) {
                $user = User::where('email', $email)->first();
            }

            if (! $user) {
                $user = User::create([
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'type' => "user",
                ]);

                $user->linkedSocialAccounts()->create([
                    'provider_id' => $providerUser->getId(),
                    'provider_name' => $provider,
                ]);
            }

            return $user;
        }
    }

    public function findOrCreateTwitter(TwiiterProviderUser $providerUser, string $provider): User
    {
        $linkedSocialAccount = LinkedSocialAccount::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        if ($linkedSocialAccount) {
            return $linkedSocialAccount->user;
        } else {
            $user = null;
            $email = $providerUser->getEmail();
            if (isset($email)) {
                $user = User::where('email', $email)->first();
            }

            if (! $user) {
                $user = User::create([
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'type' => "user",
                ]);

                $user->linkedSocialAccounts()->create([
                    'provider_id' => $providerUser->getId(),
                    'provider_name' => $provider,
                ]);
            }

            return $user;
        }
    }
}