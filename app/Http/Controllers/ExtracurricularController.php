<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Extracurricular;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class ExtracurricularController extends Controller
{
    # Index Data
    public function index()
    {
        $title = "Extracurricular";
        $eskul = Extracurricular::with('students')->get();
        return view('extracurricular',[
            "eskullist" => $eskul,
            "title" => $title
        ]);
    }

    # Detail Data
    public function show($id)
    {
        $eskul = Extracurricular::with('students')->findOrFail($id);
        return view('extracurricular-detail',[
            "eskul" => $eskul,
            "title" => "Extracurriculars"
        ]);
    }

    # Create Data
    public function create()
    {
        return view('extracurricular-add',[
            "title" => "Extracurriculars"
        ]);
    }

    # Create Action 
    public function store(Request $request)
    {
        $eskul = Extracurricular::create($request->all());
        # Create Flash Message
        if($eskul){
            Session::flash('store-success');
            Session::flash('message', 'Add New Extracurricular Running Successfully!');
        }else{
            Session::flash('store-error');
            Session::flash('message', 'Add New Extracurricular Error!');
        }
        return redirect('/extracurricular');
    }

    # Update Data 
    public function edit($id)
    {
        $eskul = Extracurricular::findOrFail($id);
        return view('extracurricular-edit',[
            "eskul" => $eskul,
            "title" => "Extracurriculars"
        ]);
    }

    # Update Data Action 
    public function update(Request $request, $id)
    {
        $eskul = Extracurricular::findOrFail($id);
        $eskul->update($request->all());
        # Create Flash Message
        if($eskul){
            Session::flash('update-success');
            Session::flash('message', 'Update Extracurricular Running Successfully!');
        }else{
            Session::flash('update-error');
            Session::flash('message', 'Update Extracurricular Error!');
        }
        return redirect('/extracurricular');
    }

    # Delete Data
    public function delete($id)
    {
        $eskul = Extracurricular::findOrFail($id);
        return view('extracurricular-delete',[
            'eskul' => $eskul,
            'title' => 'Extracurricular'
        ]);
    }

    # Delete Data Action 
    public function destroy($id)
    {
        $eskul = Extracurricular::findOrFail($id);
        $eskul->delete();
        # Create Flash Message
        if($eskul){
            Session::flash('success-destroy');
            Session::flash('message', 'Delete Extracurricular Running Successfully!');
        }else{
            Session::flash('error-destroy');
            Session::flash('message', 'Delete Extracurricular Error!');
        }
        return redirect('/extracurricular');
    }
}
