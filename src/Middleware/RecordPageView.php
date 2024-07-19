<?php

declare(strict_types=1);

namespace RVxLab\Analytics\Middleware;

use Illuminate\Http\Request;
use RVxLab\Analytics\Models\AnalyticsEvent;
use Symfony\Component\HttpFoundation\Response;

class RecordPageView
{
    /** @param \Closure(Request): Response $next */
    public function handle(Request $request, \Closure $next): mixed
    {
        $response = $next($request);

        if ($request->isMethod('GET')) {
            rescue(fn () => AnalyticsEvent::query()->create([
                'type' => 'pageview',
                'data' => [
                    'path' => $request->path(),
                ],
                'user_agent' => $request->userAgent(),
                'ip_address' => $request->ip(),
            ]));
        }

        return $response;
    }
}
