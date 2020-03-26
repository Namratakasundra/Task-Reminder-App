<?php

namespace App\Http\Middleware;

use Closure;

class TaskReminder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try 
        {
            $token_check = 'Task Reminder app';
            if($token_check && ($token_check == 'Task Reminder app'))
            {
                return $next($request);
            }
        } 
        catch (Exception $e) 
        {
            $e;
        }
        return response([
            'status' => false,
            'message' => 'Authentication failed'
        ]);
    }
}
