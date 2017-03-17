<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserTrioAttempt extends Model
{
    protected $fillable = [
        'trio_id',
        'user_id',
        'attempts',
        'solved',
    ];

    static function totalAttempts() {
        return self::sum('attempts');
    }

    static function mostSolvedTrios($top = 5) {
        return self::select('trio_id', DB::raw('SUM(solved) as solved'))->groupBy('trio_id')
            ->orderBy('solved', 'desc')->take($top)->get();
    }

    static function hardestTrios($top = 5) {
        return self::select('trio_id', DB::raw('SUM(attempts) as attempts'),
            DB::raw('SUM(solved) as solved'),
            DB::raw('case when SUM(solved)=0 then null else -1*SUM(attempts)/SUM(solved) end as ratio'))
            ->groupBy('trio_id')->orderBy('ratio', 'asc')
            ->orderBy('attempts', 'desc')->take($top)->get();
    }

    static function totalSolved() {
        return self::sum('solved');
    }

    static function triosSolved() {
        return self::select(DB::raw('CASE WHEN SUM(solved) > 0 THEN 1 ELSE 0 END as solved'))
            ->groupBy('trio_id')->sum('solved');
    }
}
