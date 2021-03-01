<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

	protected $fillable = [
	   'image', 'title', 'link', 'status', 'is_deleted'
	];
}