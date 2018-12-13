<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class AdminuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取管理员列表数据
        $adminuser=DB::table("admin_user")->paginate(3);
        // // 加载模块
        return view("Admin.Adminuser.index",['adminuser'=>$adminuser]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //管理员添加
         return view("Admin.Adminuser.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        // 密码加密
        $data['password']=hash::make($data['password']);
        // dd($data);
        if (DB::table("admin_user")->insert($data)) {
            return redirect("/adminuser")->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=DB::table("admin_user")->where('id','=',$id)->first();
        // dd($data);
        return view('admin.adminuser.edit',['id'=>$id,'user'=>$data,'password'=>$data]);
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
         $data=$request->except(['_token','_method']);
        // dd($data);
        if (DB::table("admin_user")->where('id','=',$id)->update($data)) {
            return redirect("/adminuser")->with('success','修改成功');
        }else{
         return redirect('/adminsuser/$id/edit')->with('error','数据修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(DB::table("admin_user")->where("id",'=',$id)->delete()){
            return redirect("/adminuser")->with('success','数据删除成功');
        }else{
            return redirect("/adminuser")->with('error','数据删除失败');
        }
    }
}
