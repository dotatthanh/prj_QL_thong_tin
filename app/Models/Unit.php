<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'parent_id',
    ];

    public function stations()
    {
        return $this->hasMany(Station::class);
    }

    public function getParentAttribute()
    {
    	$unit = Unit::find($this->parent_id);

    	return $unit ? $unit->name : '';
    }

    public static function getTreeUnit($unit_id) 
    {
        if (auth()->user()->hasRole('Admin')) {
            $units = Unit::query();
        }
        else {
            $parentArr = Unit::whereIn('id', $unit_id)->pluck('id')->toArray();
            $parentId = $parentArr;
            $data = $parentArr;
            while (count($parentId) > 0){
                $childs = Unit::selectRaw("units.*")
                    ->whereIn('units.parent_id', $parentId)
                    ->get();
       
                $parentId = [];
                if(!empty($childs)) {
                    foreach($childs as $child){
                        array_push($parentId, $child->id);
                        array_push($data, $child->id);
                    }
                }
            } 

            $units = Unit::whereIn('id', $data);
        }

        return $units;
    }
}
