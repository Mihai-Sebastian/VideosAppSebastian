<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Tests\Unit\VideosTest;

class VideosManageController extends Controller
{
    public function manage()
    {
        if (auth()->user()->can('manage-videos')) {
            return view('videos.manage');
        }
        abort(403, 'Unauthorized');
    }


}
