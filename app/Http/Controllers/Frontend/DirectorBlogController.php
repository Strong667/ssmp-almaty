<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DirectorBlog;
use Illuminate\Support\Facades\Storage;

class DirectorBlogController extends Controller
{
    /**
     * Показать страницу блога директора
     */
    public function show()
    {
        $director = DirectorBlog::query()
            ->orderBy('created_at', 'desc')
            ->first();

        if ($director && $director->photo) {
            $director->photo_url = Storage::disk('public')->url($director->photo);
        } else {
            $director->photo_url = null;
        }

        return view('frontend.director-blog.show', compact('director'));
    }
}
