<?php
namespace BtyBugHook\Forms\Repository;

use Btybug\btybug\Repositories\GeneralRepository;
use BtyBugHook\Forms\Models\UserFields;

class UserFieldRepository extends GeneralRepository
{
    /**
     * @return mixed
     */

    public function model()
    {
        return new UserFields();
    }
}