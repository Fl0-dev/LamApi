<?php

namespace App\Entity\User;

class UserRole
{
    const USER = 'ROLE_USER';

    const ADMIN = 'ROLE_ADMIN';
    const ADMIN_MASTER = 'ROLE_ADMIN_MASTER';
    const ADMIN_EDITOR = 'ROLE_ADMIN_EDITOR';
    const ADMIN_AUTHOR = 'ROLE_ADMIN_AUTHOR';

    const CONSUMER = 'ROLE_CONSUMER';
    const CONSUMER_EMPLOYER = 'ROLE_CONSUMER_EMLOYER';
    const CONSUMER_CANDIDATE = 'ROLE_CONSUMER_CANDIDATE';

}
