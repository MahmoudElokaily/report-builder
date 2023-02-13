<?php

namespace Mirage\Reports\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Mirage\Reports\Models\ReportBuilder
class ReportBuilder extends Model
{
    use HasFactory;
    public $table = "reports_builder";
    protected $fillable = ['slug' , 'table_properties' , 'chart_properties' ,  'is_table'  , 'is_chart', 'created_at' , 'updated_at'];
}
