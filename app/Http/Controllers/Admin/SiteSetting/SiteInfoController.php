<?php

namespace App\Http\Controllers\Admin\SiteSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateReq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteInfoController extends Controller
{
    public function updateSiteInfo(ValidateReq $req){
   
        $data = $req->except('_token', 'files');
        
        $update = DB::table('site_policies')->where('slug','site-policy')->update($data);
        
        if($update){
            return redirect()->back()->with('msg', 'Information Updated Successfully');
        }else{
            return redirect()->back()->with('msg', 'Not Updated,, Some Error Occur!');

        }

    }
    public function terms(){
        $data['termsCond'] = DB::table('site_policies')->where('slug','site-policy')->select('terms')->first();
        return view('Admin.SiteSetting.terms', $data);
    }

    public function termsUpdate(ValidateReq $req) {
        return $this->updateSiteInfo($req);
    }

    public function privacy() {
    $data['privacy'] = DB::table('site_policies')->where('slug','site-policy')->select('privacy')->first();
    return view('Admin.SiteSetting.privacy', $data);
    }

    public function privacyUpdate(ValidateReq $req) {
        return $this->updateSiteInfo($req);
    }

    public function about() {
        $data['aboutUs'] = DB::table('site_policies')->where('slug','site-policy')->select('aboutUs')->first();
        return view('Admin.SiteSetting.aboutUs', $data);
        }
    
        public function aboutUpdate(ValidateReq $req) {
            return $this->updateSiteInfo($req);
        }
}
