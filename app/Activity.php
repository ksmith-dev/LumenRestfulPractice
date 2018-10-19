<?php
/**
 * Created by PhpStorm.
 * User: Kevin
 * Date: 9/16/2018
 * Time: 9:12 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $table = 'activity';

    protected $fillable = ['code', 'title', 'icon', 'description'];
}