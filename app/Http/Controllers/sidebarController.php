<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class sidebarController extends Controller
{
    // use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        $roleId = 1; // Assuming role_id is 1, you may get it from the session or auth user

        // Fetch menus based on role_id
        $menus = DB::table('user_menu')
            ->join('user_access_menu', 'user_menu.id', '=', 'user_access_menu.menu_id')
            ->where('user_access_menu.role_id', $roleId)
            ->orderBy('user_access_menu.menu_id', 'ASC')
            ->select('user_menu.id', 'menu')
            ->get();

        // Fetch submenus for each menu
        $subMenus = [];
        foreach ($menus as $menu) {
            $subMenus[$menu->id] = DB::table('user_sub_menu')
                ->join('user_menu', 'user_sub_menu.menu_id', '=', 'user_menu.id')
                ->where('user_sub_menu.menu_id', $menu->id)
                ->where('user_sub_menu.is_active', 1)
                ->get();
        }

        // Pass data to the view
        return view('template.sidebar', compact('menus', 'subMenus'));
    }
}
