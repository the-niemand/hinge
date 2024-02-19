<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobapplication extends Model
{
    use HasFactory;

    protected $table = 'jobapplication';

    protected $primaryKey = 'job_application_id';

    protected $fillable = ['job_application_id', 'proposal', 'files','status' ,'Hirer_id', 'Freelancer_id', 'job_post_id'];

    public function hirer()
    {
        return $this->belongsTo(User::class, 'Hirer_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'Freelancer_id');
    }

    public function jobpost()
    {
        return $this->belongsTo(Jobpost::class, 'job_post_id');
    }
}
