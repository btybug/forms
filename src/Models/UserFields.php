<?php namespace BtyBugHook\Forms\Models;

use Illuminate\Database\Eloquent\Model;

class UserFields extends Model
{
    protected $table = 'fbp_user_fields';

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
      'json_data' => 'json'
    ];
    public function user()
    {
        return $this->belongsTo('Btybug\User\User', 'user_id', 'id');
    }
}