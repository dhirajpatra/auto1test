<?php
declare(strict_types=1);
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

/**
 * Interface BrokenCarDetailsInterface
 */
interface BrokenCarDetailsInterface {
    public function isBroken() : bool;
}

/**
 * Interface PaintingDamagedCarDetailsInterface
 */
interface PaintingDamagedCarDetailsInterface {
    public function isPaintDamaged() : bool;
}

/**
 * Class BrokenAndPaintDamaged
 */
class BrokenAndPaintDamaged implements BrokenCarDetailsInterface, PaintingDamagedCarDetailsInterface
{
    /**
     * @var bool
     */
    private $broken;
    /**
     * @var bool
     */
    private $paintDamaged;

    /**
     * BrokenAndPaintDamaged constructor.
     * @param bool $isBroken
     * @param bool $isPaintDamaged
     */
    public function __construct(bool $isBroken, bool $isPaintDamaged)
    {
        $this->broken = $isBroken;
        $this->paintDamaged = $isPaintDamaged;
    }

    /**
     * @return bool
     */
    public function isBroken(): bool
    {
        return $this->broken;
    }

    /**
     * @return bool
     */
    public function isPaintDamaged(): bool
    {
        return $this->paintDamaged;
    }
}

/**
 * Class Body
 */
class Body extends BrokenAndPaintDamaged
{
}

/**
 * Class Door
 */
class Door extends BrokenAndPaintDamaged
{
}

/**
 * Class Tyre
 */
class Tyre implements BrokenCarDetailsInterface
{
    /**
     * @var bool
     */
    private $broken;

    /**
     * Tyre constructor.
     * @param bool $isBroken
     */
    public function __construct(bool $isBroken)
    {
        $this->broken = $isBroken;
    }

    /**
     * @return bool
     */
    public function isBroken(): bool
    {
        return $this->broken;
    }

}

/**
 * Class Car
 */
class Car
{

    /**
     * @var CarDetail[]
     */
    private $details;

    /**
     * Car constructor.
     * @param array $details Dependency Injection by objcts params
     */
    public function __construct(array $details)
    {
        $this->details = $details;
    }

    /**
     * @return bool
     */
    public function carDetails(): bool
    {
        $result = true;

        /**
         * this will loop through all parts objects
         */
        foreach ($this->details as $detail) {
            /**
             * first it will check whether method exists for that class
             * we are not breaking SOLID: Interface Segregation Principle
             * as we are not implementing any class or interface here
             */
            if (method_exists($detail, 'isBroken')) {
                $result = ($detail->isBroken() && $result) ? true : false;
            }

            if (method_exists($detail, 'isPaintDamaged')) {
                $result = ($detail->isPaintDamaged() && $result) ? true : false;
            }
        }

        return $result;
    }

}

$cars[] = new Car([new Door(true, false), new Tyre(false), new Body(true, true)]);
$cars[] = new Car([new Door(true, true), new Tyre(true), new Body(true, true)]);

foreach ($cars as $car) {
    echo 'This car is ' . (($car->carDetails() == true) ? 'OK' : 'not OK') . '<br>';
}
