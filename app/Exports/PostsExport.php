<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Auth;

class PostsExport implements FromCollection, WithHeadings
{
    public function headings():array
    {
        return [
            'Id',
            'Title',
            'Description',
            'Status',
            'Create User',
            'Created At',
            'Updated At',      
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Post::all()->map(function($post) {

            return [
                'id' => $post->id,
               'title' => $post->title,
               'description' => $post->description,
               'status' => $post->status,
               'create_user_id' => $post->user->name,
               'created_at' => $post->created_at,
               'updated_at' => $post->updated_at,
            ];
         });
    }
}