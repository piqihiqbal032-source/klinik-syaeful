<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

class VisitorCounter
{
    public function handle($request, Closure $next)
    {
        $today = date('Y-m-d');
        
        // Cek apakah sudah ada data hari ini
        $visitor = Visitor::where('date', $today)->first();
        
        if ($visitor) {
            $visitor->increment('count');
        } else {
            Visitor::create([
                'date' => $today,
                'count' => 1
            ]);
        }
        
        return $next($request);
    }
}