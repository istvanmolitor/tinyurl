<?php

declare(strict_types=1);

namespace Molitor\Tinyurl\Http\Controllers\Web;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Molitor\Tinyurl\Models\Tinyurl;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RedirectController extends Controller
{
    public function __invoke(string $slug): RedirectResponse
    {
        $tinyurl = Tinyurl::where('slug', $slug)->first();

        if (! $tinyurl) {
            throw new NotFoundHttpException();
        }

        $target = $tinyurl->redirect ?? $tinyurl->url;

        return redirect()->away($target, 301);
    }
}
