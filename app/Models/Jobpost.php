<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobpost extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'job_post_id';

    protected $table = 'jobpost';

    protected $fillable = ['job_post_id','title','description','target_country','Jtype','Duration','price','level','skills_required','Hirer_id'];
    public function hirer()
    {
        return $this->belongsTo(User::class, 'hirer_id');
    }


}
