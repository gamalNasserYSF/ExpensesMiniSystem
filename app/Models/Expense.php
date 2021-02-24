<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Expense
 *
*/
class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'attachment',
        'entry_date',
        'amount',
        'user_id',
        'status'
    ];

    const Status = [
        'new' => 0,
        'approved' => 1,
        'cancelled' => 2,
        'reject' => 3,
    ];

    protected $appends = [
       'user'
    ];
    /**
     * return full path for attachment file
     *
     * @param $subPath
     * @return string
     */
    public function getAttachmentAttribute($subPath)
    {
        return asset('storage/app').'/'.$subPath;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserAttribute()
    {
        return $this->user()->first();
    }



}
