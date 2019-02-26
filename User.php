<?php
declare(strict_types=1);
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


/**
 * Class User
 */
class User
{
    private $str;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->str = '';
    }

    /**
     * @param string $first
     * @return User
     */
    public function setFirstName($first = '') : self {
        $this->str .= $first;
        return $this;
    }

    /**
     * @param string $last
     * @return User
     */
    public function setLastName($last = '') : self {
        $this->str .= ' ' . $last;
        return $this;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email = '') : self {
        $this->str .= ' &lt;' . $email . '&gt;';
        return $this;
    }

    /**
     * @return string
     */
    public function __toString() : string {
        return $this->str;
    }

}

/**
 * John Doe <john.doe@example.com>
 */

$user = new User();

$user->setFirstName('John')
    ->setLastName('Doe')
    ->setEmail('john.doe@example.com');

echo $user;
