<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeCotroller extends Controller
{
    //clase testimonial
    public function home()
    {
        // the function route call directly the controller, dont go to routes file
        // ->action([CatalogController::class, 'index']);
        return redirect(url("catalog"));
    }
}
