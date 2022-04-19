<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use ApiResponse;

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
            'website_id' => 'exists:websites,id',
            'title' => 'required|max:255',
            'description' => 'required',
            ]
        );

        if($validator->fails()) {
            return $this->errorResponse($validator->errors()->toArray());
        } else {
            $post = Post::create($validator->validated());
            return $this->successResponse(compact('post'));
        }
    }
}
