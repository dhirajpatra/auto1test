<?php
declare(strict_types=1);
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

interface HeroInterface
{

    public function getForce(): int;

    public function getImmunity(): int;

    public function getHealthPoints(): int;

    public function setHealthPoints(int $healthPoints);
}

class DamageHelper
{
    const DAMAGE_RAND_FACTOR = 0.2;

    public static function getDamage(HeroInterface $attacker, HeroInterface $defender)
    {
        if ($attacker->getForce() < $defender->getForce()) {
            return 0;
        }

        $damageBase = round(($attacker->getForce() - $defender->getForce()) / $defender->getImmunity());

        $damageFactor = $damageBase * self::DAMAGE_RAND_FACTOR;
        $minDamage    = $damageBase - $damageFactor;
        $maxDamage    = $damageBase + $damageFactor;

        return random_int($minDamage, $maxDamage);
    }
}

class Fight
{
    public function makeFight(HeroInterface $attacker, HeroInterface $defender)
    {
        $damage = DamageHelper::getDamage($attacker, $defender);
        $defender->setHealthPoints($defender->getHealthPoints()-$damage);
    }
}
