<?php
/**
 * @link      http://github.com/zetta-repo/tss-skeleton for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Jenssegers\Date\Date;
use Zetta\DoctrineUtil\Entity\AbstractEntity;
use Zetta\ZendAuthentication\Entity\UserInterface;

/**
 * User
 *
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends AbstractEntity implements UserInterface
{
    const STATUS_INACTIVE = 1;
    const STATUS_ACTIVE = 2;

    const GENRE_FEMALE = 1;
    const GENERO_MALE = 2;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var Role
     *
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $role;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $avatar;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", nullable=true)
     */
    protected $genre;

    /**
     * @var Date
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $birthday;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $bio;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint")
     */
    protected $status;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $token;

    /**
     * @var boolean
     *
     * @ORM\Column(name="confirmed_email", type="boolean")
     */
    protected $confirmedEmail;

    /**
     * @var Collection|Credential[]
     *
     * @ORM\OneToMany(targetEntity="Credential", mappedBy="user", cascade={"all"}, fetch="EXTRA_LAZY")
     */
    protected $credentials;

    /**
     * Usuario constructor.
     */
    public function __construct()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->active = true;
        $this->confirmedEmail = false;
        $this->credentials = new ArrayCollection();
    }

    /**
     * Get the User id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the User id
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the User role
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the User role
     * @param Role $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get the User username
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the User username
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get the User name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the User name
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the User email
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the User email
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the User avatar
     * @param string $prefix
     * @return string
     */
    public function getAvatar($prefix = 'public')
    {
        $pos = strpos($this->avatar, $prefix);
        if ($pos) {
            return substr($this->avatar, $pos + strlen($prefix));
        } else {
            return $this->avatar;
        }
    }

    /**
     * Set the User avatar
     * @param string $avatar
     * @param bool $overwrite
     * @param string $dir
     * @return User
     */
    public function setAvatar($avatar, $overwrite = true, $dir = 'upload')
    {
        if (is_array($avatar)) {
            if (isset($avatar['error']) && $avatar['error'] === UPLOAD_ERR_OK && isset($avatar['tmp_name'])) {
                $avatar = $avatar['tmp_name'];
            } else {
                $overwrite = false;
            }
        }

        if ($overwrite) {
            if (is_file($this->avatar) && strpos($this->avatar, $dir)) {
                unlink($this->avatar);
            }
            $this->avatar = $avatar;
        }

        return $this;
    }

    /**
     * Get the User genre
     * @return int
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set the User genre
     * @param int $genre
     * @return User
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * Get the User birthday
     * @return Date
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set the User birthday
     * @param Date $birthday
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * Get the User bio
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the User bio
     * @param string $bio
     * @return User
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * Get the User status
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the User status
     * @param int $status
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get the User active
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set the User active
     * @param bool $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Get the User token
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the User token
     * @param string $token
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get the User confirmedEmail
     * @return bool
     */
    public function isConfirmedEmail()
    {
        return $this->confirmedEmail;
    }

    /**
     * Set the User confirmedEmail
     * @param bool $confirmedEmail
     * @return User
     */
    public function setConfirmedEmail($confirmedEmail)
    {
        $this->confirmedEmail = $confirmedEmail;
        return $this;
    }

    /**
     * Get the User credentials
     * @return Credential[]|Collection
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * Set the User credentials
     * @param Credential[]|Collection $credentials
     * @return User
     */
    public function setCredentials($credentials)
    {
        $this->credentials = $credentials;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSignAllowed()
    {
        return $this->isActive();
    }

    /**
     * @param bool $signAllowed
     * @return User
     */
    public function setSignAllowed($signAllowed)
    {
        // TODO: SignAllowed
        $this->active = $signAllowed;
        return $this;
    }

    /**
     * Get the User role name
     * @param Role $role
     * @return string
     */
    public function role($role = null)
    {
        if ($role instanceof Role) {
            $this->setRole($role);
        }

        if (!is_null($this->getRole())) {
            return $this->getRole()->getName();
        }

        return '';
    }
}
