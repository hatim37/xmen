<?php

namespace App\EntityListener;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserListener
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }
    /**
     * Cette fonction prepersit le mot de passe
     *
     * @param User $user
     * @return void
     */
    public function prePersist(User $user) : void
    {
        $this->encodePassword($user);
    }
    /**
     * Cette fonction permet la mise a jour du mot de passe
     *
     * @param User $user
     * @return void
     */
    public function preUpdate(User $user) : void
    {
        $this->encodePassword($user);
    }

    /**
     * Encoder un mot de passe
     *
     * @param User $user
     * @return void
     */
    public function encodePassword(User $user)
    {
        if ($user->getPlainPassword() === null) {
            return;
        }

        $user->setPassword(
            $this->hasher->hashPassword($user, $user->getPlainPassword())
        );

        $user->setPlainPassword(null);
    }
}
