<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Image;

class ImageApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO 論理削除されていない単一の値を取る必要がある
        $has_image = false;
        //既存のイメージがあるか判定する関数

        //もしなかったらデフォルトイメージを返す
        if($has_image) {
            //デフォルトのイメージを返す処理
        } else {
            //単一の値を返す必要がある
            //return Image::all();
            return 'storage/app/public/noImage.gif';

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
            if(has_old_image) {
                //既存のイメージを論理削除
            }

            $file_name = random_bytes (10);
            request()->file->storeAs('public', $file_name);

            $image = new Image();
            $image->path = 'storage/' . $file_name;
            $image->is_delete = false;
            $image->user_id = $request->user_id;
            $image->save();

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
