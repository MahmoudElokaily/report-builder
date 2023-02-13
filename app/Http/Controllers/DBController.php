<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mirage\Reports\Models\ReportBuilder;

class DBController extends Controller
{
    public function index(){
        $tables = \DB::select("SHOW TABLES");
        return view('reports' , compact('tables'));
    }

    public function getTAbleFields(){
        $fields = \DB::select(\DB::raw('SHOW FIELDS FROM '.\request('table')));
        return $fields;
    }

    public function report(Request $request){
        $validate = $request->validate([
            "name" => "required",
        ]);
        ReportBuilder::create([
            'slug' => $request->name,
            'fields' => json_encode($request->list),
        ]);
        $fields = \DB::table($request->name)->limit(20)->get($request->list);
        $data = [
            'title' => $request->name,
            'fields' => $fields,
            'headers' => $request->list
        ];

        return view('show-report' , $data);

    }
}
