<?php

namespace Styde;

use Styde\SessionManager as Session;

class Authenticator
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var SessionManager
     */
    protected $session;

    /**
     * Authenticator construct.
     * 
     * @param User $user
     * @param Session $session
     */
    public function __construct(User $user,Session $session)
    {
        $this->user = $user;
        $this->session = $session;
    }

    public function check()
    {
        return $this->user() != null;
    }

    public function user()
    {
        if ($this->$user !=null) {
            return $this->$user;
        }

        $data = $this->session->get('user_data');

        if (!is_null($data)) {
            return $this->$user = new User($data);
        }

        return null;
        
    }
}