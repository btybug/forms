<?php
namespace BtyBugHook\Forms\Repository;

use Btybug\btybug\Repositories\GeneralRepository;
use BtyBugHook\Forms\Models\FieldTypes;

class FieldTypesRepository extends GeneralRepository
{
    /**
     * @return mixed
     */

    public function model()
    {
        return new FieldTypes();
    }
}