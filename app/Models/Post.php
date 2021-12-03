<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Post extends Model
{
    use SoftDeletes;

    use Sortable;

    protected $table = "posts";

    protected $fillable = [
        'title',
        'description',
        'status',
        'create_user_id',
        'updated_user_id',
        'deleted_user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $sortable = [
        'title',
        'description',
        'status',
        'create_user_id',
        'updated_user_id',
        'deleted_user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static function getPost()
    {
        $records = DB::table('posts')->select(
            "id",
            "title",
            "description",
            "create_user_id",
            "updated_user_id",
            "deleted_user_id",
            "created_at",
            "updated_at",
            "deleted_at"
            )->orderBy('id','asc')->get()->toArray();
        return $records;
    }

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'create_user_id', 'id')->withDefault([
            'name' => 'Guest User'
        ]);
    }
}
