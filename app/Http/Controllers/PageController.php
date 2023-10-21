<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\HistoryLelang;
use App\Models\Lelang;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("pages.{$page}")) {

            switch ($page) {
                case 'user-management':
                    // Get all users sort by latest created
                    $user = User::orderBy('created_at', 'desc')->get();
                    return view("pages.{$page}", [
                        'users' => $user
                    ]);
                case 'barang-management':
                    // Get all barangs sort by latest created
                    $barang = Barang::orderBy('created_at', 'desc')->get();
                    return view("pages.{$page}", [
                        'barangs' => $barang
                    ]);

                case "lelang-management": 
                    $lelang = Lelang::orderBy('created_at', 'desc')->get();
                    $barangs = Barang::orderBy('created_at', 'desc')->get();
                    $petugas = User::where('role', 'petugas')->get();
                    $users = User::where('role', 'user')->get();
                    return view("pages.{$page}", [
                        'lelangs' => $lelang,
                        'barangs' => $barangs,
                        'petugas' => $petugas,
                        'users' => $users
                    ]);
                case 'lelang':
                    $barang = Barang::orderBy('created_at', 'desc')->get();
                    $lelang = Lelang::orderBy('created_at', 'desc')->get();
                    return view("pages.{$page}", [
                        'barangs' => $barang,
                        'lelangs' => $lelang,
                    ]);
                
                case 'my-bidding':
                    $myBiddings = HistoryLelang::where('id_user', auth()->user()->id)->get();
                    return view("pages.{$page}", [
                        'myBiddings' => $myBiddings
                    ]);


                default:
                    // Handle the default case
            }

            return view("pages.{$page}");
        }

        return abort(404);
    }

    public function vr()
    {
        return view("pages.virtual-reality");
    }

    public function rtl()
    {
        return view("pages.rtl");
    }

    public function profile()
    {
        return view("pages.profile-static");
    }

    public function signin()
    {
        return view("pages.sign-in-static");
    }

    public function signup()
    {
        return view("pages.sign-up-static");
    }
}
