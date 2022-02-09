<?php

namespace App\Http\Controllers;
use App\Faq;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $faqs = Faq::all();
        $departmetns = [];
        foreach ($faqs as $faq){
            if (in_array($faq['departments']['name'], $departmetns)) {
            }else{
                $departmetns[] = $faq['departments']['name'];
            }
        }
        return view('home', compact('faqs', 'departmetns'));
    }

}
