<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class BaseAdminController extends Controller
{

  protected function addUserCount()
  {

    $user = auth()->user();
    $expiresAt = now()->addHours(23);
    if ($user)
      views($user)->cooldown($expiresAt)->record();
  }
}
