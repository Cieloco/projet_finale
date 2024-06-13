<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Task;

class CheckTaskPermission
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $task = $request->route()->parameter('task');

        if ($task && !$user->isAdmin() && !$user->isDirecteur() && $task->utilisateur_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
