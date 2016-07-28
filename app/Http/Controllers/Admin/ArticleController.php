<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \App\Article;

class ArticleController extends Controller
{
    //列表
    public function index(){
    	return view('admin/article/index')->withArticles(Article::all());
    }
    
    //新增
    public function create()
    {
        return view('admin/article/create');
    }
    
    //保存
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:articles|max:255',
            'body' => 'required',
        ]);
    
        $article = new Article;
        $article->title = $request->get('title');
        $article->body = $request->get('body');
        $article->user_id = $request->user()->id;
    
        if ($article->save()) {
            return redirect('admin/article');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }
    
    //编辑
    public function edit(Request $request,$id)
    {
        $articles=Article::find($id);
        
        return view('admin/article/edit')->with('article',$articles);
    }
    
    //修改
    public function update(Request $request){
        $this->validate($request, [
            'id' => 'required|max:11',
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $id = $request->get('id');
        
        $article = Article::find($id);
        $article->title=$request->get('title');
        $article->body=$request->get('body');
        
        if ($article->save()) {
            return redirect('admin/article');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }
    
    //删除
    public function destroy($id){
        Article::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }
    
}
