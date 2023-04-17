<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class ValidateReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if(Request::is('admin/site-setting')){
            return [
                'site_name' => 'required|string',
                'address' => 'required|string',
                'email' => 'required|email',
                
            ];
        }elseif(Request::segment(2) == "terms-Conditions")
        {
            return[
            'terms' => 'required|string',
           
            ];
        }elseif(Request::segment(2) == "privacy-policy")
        {
            return[
            'privacy' => 'required|string',
           
            ];
        }elseif(Request::segment(2) == "about-us-text")
        {
            return[
            'aboutUs' => 'required|string',
           
            ];
        }elseif(Request::segment(2) == "add-user"){
            return[
                'name' => 'required|string',
                'title' => 'required|string',
                'email' => 'required|email',
                'family_name' => 'required|string',
                'dob' => 'required',
                
                'termsAccept' => 'required',
                
                ];
        }elseif(Request::segment(2) == "edit-user"){
            return[
                'name' => 'required|string',
                'title' => 'required|string',
                'email' => 'required|email',
                'family_name' => 'required|string',
                'dob' => 'required',
                ];
        }elseif(Request::segment(2) == "profile"){
            return[
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string|max:50',
                ];
        }elseif(Request::segment(2) == "change-password"){
           
            return[
                'current_password' => 'required',
                'new_password' => 'required|string|min:8',
                'new_confirm_password' => 'same:new_password',
                ];
        }elseif(Request::segment(2) == "add-videos"){
       
       
            return[
                'v_name' => 'required|string',
                // 'v_description' => 'required|string',
                'v_video' => 'required|mimes:mp4,mov,ogg',
                // 'v_status' => 'required|string',
                'user_id' => 'required|integer',
                'contest_id' => 'required|integer'
                ];
            
        }elseif(Request::segment(2) == "edit-videos"){
       
           
            return[
                'v_name' => 'required|string',
                ];
        }elseif(Request::segment(2) == "add-contests"){
       
           
            return[
                'contest_name' => 'required|string',
                'contest_description' => 'required|string|max:600',
                'contest_start_dt' => 'required|date|after_or_equal:' . date('Y-m-d'),
                'end_dt' => 'required|date|after_or_equal:contest_start_dt',

              
                'contest_status' => 'required',
                ];
        }elseif(Request::segment(2) == "edit-contests"){
            return[
                'contest_name' => 'required|string',
                'contest_description' => 'required|string|max:600',
                'contest_start_dt' => 'required|date',
                'end_dt' => 'required|date|after_or_equal:contest_start_dt',

              
                'contest_status' => 'required',
                ];
        }else{
           return redirect()->back()->with('msg', 'No Validation Here');
        }
        
    }
}
