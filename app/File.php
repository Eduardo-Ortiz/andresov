<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //

    public function uniqueDownloads()
    {
        return Download::where('file_id', '=',$this->id)->distinct('ip')->count('ip');
    }

    public function totalDownloads()
    {
        return Download::where('file_id', '=',$this->id)->count();
    }
}
