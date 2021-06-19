<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return string $user_id
     */
    public function getImage(Request $request)
    {
        //なぜかこうしないとクエリパラメータ-が取得できない
        $user_id =$request->all()['user_id'];
        $image = Image::where('user_id', $user_id)->where('is_delete', false)->first();
        $has_image = is_null($image);

        if(!$has_image) {

            return $image->path;

        } else {

            return '/storage/noImage.gif';

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO ここに既存のイメージを論理削除する処理が必要
        $this->validate($request, [
            'user_id' => 'required|min: 1',
            'file' => 'required|image'
        ],
        [
            'file.required' => '画像が選択されていません',
            'file.image' => '画像ファイルではありません'
        ]);
        if (request()->file) {
            $has_old_image = false;
            // すでに登録されているデータがあるか？
            $user_id = request()->user_id;
            $old_image = Image::where('user_id', $user_id)->where('is_delete', false)->first();
            $has_old_image = is_null($old_image);
            if(has_old_image) {
                //既存のイメージを論理削除 $old_image->is_delete = true;
                $flight->save();

            }

            $file_name = random_bytes (2).request()->file->getClientOriginalName();
            request()->file->storeAs('public', $file_name);

            $new_image = new Image();
            $new_image->path = 'storage/' . $file_name;
            $new_image->is_delete = false;
            $new_image->user_id = $request->user_id;
            $new_image->save();

            return['success' => '登録しました！'];

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
