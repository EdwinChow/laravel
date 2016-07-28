<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
    //列表
    public function index(){
    	return view('admin/comment/index')->withArticles(Comment::all());
    }
    //编辑
    public function edit($id){
        $comment=Comment::find($id);
        return view('admin/comment/edit')->with('comment',$comment);
    }
    //修改
    public function update(Request $request){
        $this->validate($request, [
            'id' => 'required|max:11',
            'nickname' => 'required|max:255',
            'content' => 'required',
        ]);
        
        $comment=Comment::find($request->get('id'));
        $comment->nickname=$request->get('nickname');
        $comment->content=$request->get('content');
        
        if ($comment->save()) {
            return redirect('admin/comment');
        }else{
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }
    
    //删除
    public function destroy($id){
        Comment::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }
}
