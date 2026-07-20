<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class VisitorCounter
{
    public function handle($request, Closure $next)
    {
        try {
            $today = date('Y-m-d');
            
            $visitor = Visitor::where('date', $today)->first();
            
            if ($visitor) {
                $visitor->increment('count');
            } else {
                Visitor::create([
                    'date' => $today,
                    'count' => 1
                ]);
            }
        } catch (\Exception $e) {
            // Jika error, abaikan (tidak mengganggu website)
            // Log error jika perlu
        }
        
        return $next($request);
    }
}