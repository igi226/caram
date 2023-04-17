<?php

namespace App\Http\Controllers\Admin\SiteSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateReq;
use App\Models\Site_settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SitesettingController extends Controller
{
    public function show()
    {
        $data["site_settings"] = Site_settings::where(
            "slug",
            "caramia-slug"
        )->first();
        return view("Admin.SiteSetting.siteSetting", $data);
    }

    public function update(ValidateReq $req)
    {
        // dd('cc');
        $data = $req->except("_token", "logo_image", "favicon_image");

        if ($req->has("logo_image")) {
            $img = Site_settings::where("slug", "caramia-slug")->first();
            File::delete("storage/SiteImages/" . $img->logo_image);

        
            $image = $req->file("logo_image");
            //dd($image);

            $logo_image =
                time() .
                rand(0000, 9999) .
                "." .
                $image->getClientOriginalExtension();
            //dd($logo_image);
            $image->storeAs("public/SiteImages", $logo_image);
            //storePubliclyAs
            $data["logo_image"] = $logo_image;
        }

        //dd($data);
        else {
            // dd('no');
            $img = Site_settings::where("slug", "caramia-slug")->first();
            $data["logo_image"] = $img->logo_image;
        }

        if ($req->has("favicon_image")) {
            $img = Site_settings::where("slug", "caramia-slug")->first();
            File::delete("storage/SiteImages/" . $img->favicon_image);
          
            $image = $req->file("favicon_image");
            // dd($image);

            $favicon =
                time() .
                rand(0000, 9999) .
                "." .
                $image->getClientOriginalExtension();
            // dd($favicon);
            $image->storeAs("public/SiteImages", $favicon);
            //storePubliclyAs
            $data["favicon_image"] = $favicon;
        }

        //dd($data);
        else {
            $img = Site_settings::where("slug", "caramia-slug")->first();
            $data["favicon_image"] = $img->favicon_image;
        }

        $update = Site_settings::where("slug", "caramia-slug")->update(
            $data
        );
        if ($update) {
            return redirect()
                ->back()
                ->with("msg", "Site Information Updated Successfully");
        } else {
            return redirect()
                ->back()
                ->with("msg", "Some Error Occur!");
        }
    }
}
