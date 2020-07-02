<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $casts = ['profile' => 'array'];
    protected $appends = ['name'];

    // Should be that one person vs many users, but don't want to change users table, so use belongsToMany instead.
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getNameAttribute()
    {
        if (trim($this->first_name) === trim($this->last_name)) {
            return $this->first_name;
        } else {
            return $this->first_name . ' ' . $this->last_name;
        }
    }

    public function supervisees()
    {
        return $this->belongsToMany(Person::class, 'supervisee_supervisor', 'supervisor_id', 'supervisee_id')->withPivot(['supervisor_title', 'supervisee_title']);
    }

    public function supervisors()
    {
        return $this->belongsToMany(Person::class, 'supervisee_supervisor', 'supervisee_id', 'supervisor_id')->withPivot(['supervisor_title', 'supervisee_title']);
    }
}
