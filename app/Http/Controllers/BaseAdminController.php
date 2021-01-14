<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class BaseAdminController extends Controller
{
  public function __construct()
  {
    $this->middleware(function ($request, $next) {
      $user = Auth::user();
      $expiresAt = now()->addHours(1);
      if ($user)
        views($user)->cooldown($expiresAt)->record();
      return $next($request);
    });
  }
}
