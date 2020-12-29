<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = "categories";

    protected $fillable = [
        'name',
        'icon',
        'banner',
        'meta_title',
        'meta_description'
    ];

    static function getValidationRules(){
        $rules = [
            'name' => 'required',
            'icon' => 'mimes:jpg,jpeg,png,bmp,tiff |max:4096',
            'banner' => 'mimes:jpg,jpeg,png,bmp,tiff |max:4096'
        ];
        return $rules;
    }
}
