<?php

namespace App\Models;

use App\Http\Controllers\Scrappers\JarirScrapper;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Scrapper\JarirScrapper;

class Scrapper extends Model{

    public $fillable = [
        "website_name",
        "base_url",
        "class",
        "type",
        "is_active",
        "is_run"
    ];

    public static $scrappers = [
        "Jarir" => JarirScrapper::class,
    ];

}
