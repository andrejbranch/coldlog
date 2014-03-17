<?php

namespace ColdLog\Bundle\MainBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use FOS\UserBundle\Document\User as FOSUser;
use Doctrine\ODM\MongoDB\SoftDelete\SoftDeleteable;

/**
 * @ODM\Document(collection="users")
 */
class User extends FOSUser implements SoftDeleteable
{
    /** @ODM\Id */
    protected $id;

    /** @ODM\String */
    protected $username;

    /** @ODM\String */
    protected $usernameCanonical;

    /** @ODM\String */
    protected $email;

    /** @ODM\String */
    protected $emailCanonical;

    /** @ODM\Boolean */
    protected $enabled;

    /** @ODM\String */
    protected $salt;

    /** @ODM\String */
    protected $password;

    /** @ODM\Date */
    protected $lastLogin;

    /** @ODM\String */
    protected $confirmationToken;

    /** @ODM\Date */
    protected $passwordRequestedAt;

    /** @ODM\Boolean */
    protected $locked;

    /** @ODM\Boolean */
    protected $expired;

    /** @ODM\Date */
    protected $expiresAt;

    /** @ODM\Boolean */
    protected $credentialsExpired;

    /** @ODM\Date */
    protected $credentialsExpireAt;

    /** @ODM\Date */
    protected $deletedAt;

    public function __construct()
    {
        parent::__construct();
    }

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}
