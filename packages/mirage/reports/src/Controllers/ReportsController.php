<?php

namespace Mirage\Reports\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mirage\Reports\Models\ReportBuilder;

class ReportsController extends Controller{

    public function index(){
        $tables = \DB::select("SHOW TABLES");
        $data = [
            'tables' => $tables
        ];
        return view('reports::all-tables' , $data);
    }

    public function getFields(){
        if (\request('flag') == 'model'){
            $nameOfModel = \request('table');
            $model = new $nameOfModel;
            $tableName = $model->getTable();
            $fields = \Schema::getColumnListing($tableName);
            return $fields;
        }
        else {
            $fields = \DB::select(\DB::raw('SHOW FIELDS FROM ' . \request('table')));
            return $fields;
        }
    }

   public function report(Request $request){
//        $validated = $request->validate([
//            "name" => "required_without:model",
//            "model" => "required_without:name"
//        ]);
        if ($request->list != null){
            $report = ReportBuilder::create([
                'slug' => $request->name == null ? $request->model : $request->name,
                'table_properties' => json_encode($request->list),
                "is_table" => "true",
            ]);
            if ($request->model == null) {
                $fields = \DB::table($request->name)->limit(20)->get($request->list);
            }
            else {
                $fields = ReportBuilder::all($request->list);
            }

            $data = [
                'title' => $request->name,
                'fields' => $fields,
                'headers' => $request->list
            ];
            return view('reports::show-report' , $data);
        }
        else {
            ReportBuilder::create([
                'slug' => $request->name == null ? $request->model : $request->name,
                'chart_properties' => json_encode($request->field),
                "is_chart" => "false",
            ]);
            $field = $request->field;
            $chartData = '[';
            $labels = '[';
            if ($request->model == null) {
                $result = \DB::select(\DB::raw("SELECT " . $request->field . " ,COUNT(*) as number FROM " . $request->name . " GROUP BY " . $request->field));
            }
            else {
                $result = $request->model::groupBy($request->field)->select($request->field, \DB::raw('count(*) as number'))->get();
//                dd($result);
//                $result = $request->model::groupBy(strval($request->field))->count($request->field);
//                dd($result);
            }
            foreach ($result as $key) {
                $chartData .= $key->number . " , ";
                $labels .= '"' . $key->$field . '"' . ' , ';
            }
            $chartData = substr($chartData, 0, -2); // remove last coma ,
            $labels = substr($labels, 0, -2);
            $chartData .= ']';
            $labels .= ']';
            $data = [
                'title' => $request->name == null ? $request->model : $request->name,
                'field' => $request->field ,
                'chartData' => $chartData,
                'type' => $request->type,
                'labels' => $labels
            ];
            return view('reports::charts', $data);

        }

   }














//    public function report(Request $request){
//        $validate = $request->validate([
//            "name" => "required",
//        ]);
//        ReportBuilder::create([
//            'slug' => $request->name,
//            'fields' => json_encode($request->list),
//        ]);
//        $fields = \DB::table($request->name)->limit(20)->get($request->list);
//        $data = [
//            'title' => $request->name,
//            'fields' => $fields,
//            'headers' => $request->list
//        ];
//        return view('reports::show-report' , $data);
//    }
//
//    public function getTablesPie(){
//        $tables = \DB::select("SHOW TABLES");
//        return view('reports::tables' , compact('tables'));
//    }
//
//    public function pieChar(Request $request){
//        $filedName = $request->field;
//        $result = \DB::select(\DB::raw("SELECT ". $request->field . " ,COUNT(*) as number FROM " . $request->name . " GROUP BY " .$request->field));
//        $chartData = "";
//        foreach ($result as $val){
//            $chartData .= "['".$val->$filedName."',     ".$val->number."],";
//        }
//        $data = [
//          'title' =>$request->name,
//          'field' => $request->field,
//          'chartData' => $chartData
//        ];
//        return view('reports::pie' , $data);
//    }


}
