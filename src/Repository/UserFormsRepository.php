<?php namespace BtyBugHook\Forms\Repository;

use Btybug\btybug\Repositories\GeneralRepository;
use BtyBugHook\Forms\Models\UserForms;

class UserFormsRepository extends GeneralRepository
{
    public function model()
    {
        return new UserForms();
    }
}