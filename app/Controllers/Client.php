<?php

namespace App\Controllers;

class Client extends BaseController
{
   
    public function viewCreateClient()
    {
        return view('admin/contents/client/view_createclient');
    }
}
