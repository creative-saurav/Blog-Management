<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function system_settings(){
        return view('admin.settings.system_settings');
    }
    public function system_settings_update(Request  $request){
        $data = $request->all();

            if(SystemSetting::where('key', 'system_title')->get()->count()> 0){
                SystemSetting::where('key', 'system_title')->update(['key' =>'system_title', 'value'=>$data['system_title'] ]);
            }else{
                SystemSetting::create([
                    'key' => 'system_title',
                    'value' => $data['system_title'] 
                ]);
            }
            if(SystemSetting::where('key', 'system_email')->get()->count()> 0){
                SystemSetting::where('key', 'system_email')->update(['key' => 'system_email', 'value'=> $data['system_email']]);
            }else{
                SystemSetting::create([
                    'key' => 'system_email',
                    'value' => $data['system_email']
                ]);
            }
            if(SystemSetting::where('key', 'keyword')->get()->count()> 0){
                SystemSetting::where('key', 'keyword')->update(['key' => 'keyword', 'value'=> $data['keyword']]);
            }else{
                SystemSetting::create([
                    'key' => 'keyword',
                    'value' => $data['keyword']
                ]);
            }
            if(SystemSetting::where('key', 'website_description')->get()->count()> 0){
                SystemSetting::where('key', 'website_description')->update(['key' => 'website_description', 'value'=> $data['website_description']]);
            }else{
                SystemSetting::create([
                    'key' => 'website_description',
                    'value' => $data['website_description']
                ]);
            }
            if(SystemSetting::where('key', 'system_currency')->get()->count()> 0){
                SystemSetting::where('key', 'system_currency')->update(['key' => 'system_currency', 'value'=> $data['system_currency']]);
            }else{
                SystemSetting::create([
                    'key' => 'system_currency',
                    'value' => $data['system_currency']
                ]);
            }
            if(SystemSetting::where('key', 'address')->get()->count()> 0){
                SystemSetting::where('key', 'address')->update(['key' => 'address', 'value'=> $data['address']]);
            }else{
                SystemSetting::create([
                    'key' => 'address',
                    'value' => $data['address']
                ]);
            }
            if(SystemSetting::where('key', 'phone')->get()->count()> 0){
                SystemSetting::where('key', 'phone')->update(['key' => 'phone', 'value'=> $data['phone']]);
            }else{
                SystemSetting::create([
                    'key' => 'phone',
                    'value' => $data['phone']
                ]);
            }
            if(SystemSetting::where('key', 'language')->get()->count()> 0){
                SystemSetting::where('key', 'language')->update(['key' => 'language', 'value'=> $data['language']]);
            }else{
                SystemSetting::create([
                    'key' => 'language',
                    'value' => $data['language']
                ]);
            }
            if(SystemSetting::where('key', 'timezone')->get()->count()> 0){
                SystemSetting::where('key', 'timezone')->update(['key' => 'timezone', 'value'=> $data['timezone']]);
            }else{
                SystemSetting::create([
                    'key' => 'timezone',
                    'value' => $data['timezone']
                ]);
            }
            if(SystemSetting::where('key', 'purchase_code')->get()->count()> 0){
                SystemSetting::where('key', 'purchase_code')->update(['key' => 'purchase_code', 'value'=> $data['purchase_code']]);
            }else{
                SystemSetting::create([
                    'key' => 'purchase_code',
                    'value' => $data['purchase_code']
                ]);
            }
            if(SystemSetting::where('key', 'country')->get()->count()> 0){
                SystemSetting::where('key', 'country')->update(['key' => 'country', 'value'=> $data['country']]);
            }else{
                SystemSetting::create([
                    'key' => 'country',
                    'value' => $data['country']
                ]);
            }
            if(SystemSetting::where('key', 'author')->get()->count()> 0){
                SystemSetting::where('key', 'author')->update(['key' => 'author', 'value'=> $data['author']]);
            }else{
                SystemSetting::create([
                    'key' => 'author',
                    'value' => $data['author']
                ]);
            }
        

        Session::flash('success', get_phrase('Setting update successfully!'));
        return redirect()->back();
    }
    public function system_settings_social(Request $request){
        $data = $request->all();
            if(SystemSetting::where('key', 'facebook')->get()->count()> 0){
                SystemSetting::where('key', 'facebook')->update(['key' => 'facebook', 'value'=> $data['facebook']]);
            }else{
                SystemSetting::create([
                    'key' => 'facebook',
                    'value' => $data['facebook']
                ]);
            }
            if(SystemSetting::where('key', 'twitter')->get()->count()> 0){
                SystemSetting::where('key', 'twitter')->update(['key' => 'twitter', 'value'=> $data['twitter']]);
            }else{
                SystemSetting::create([
                    'key' => 'twitter',
                    'value' => $data['twitter']
                ]);
            }
            if(SystemSetting::where('key', 'linkedin')->get()->count()> 0){
                SystemSetting::where('key', 'linkedin')->update(['key' => 'linkedin', 'value'=> $data['linkedin']]);
            }else{
                SystemSetting::create([
                    'key' => 'linkedin',
                    'value' => $data['linkedin']
                ]);
            }

         Session::flash('success', get_phrase('Setting update successfully!'));
        return redirect()->back();
    }

    public function system_smtp(){
        return view('admin.settings.smtp_settings');
    }

    public function smtp_settings_update(Request $request){
        $data = $request->all();
           if(SystemSetting::where('key', 'smtp_protocol')->get()->count()> 0){
                SystemSetting::where('key', 'smtp_protocol')->update(['key' => 'smtp_protocol', 'value'=> $data['smtp_protocol']]);
            }else{
                SystemSetting::create([
                    'key' => 'smtp_protocol',
                    'value' => $data['smtp_protocol']
                ]);
            }
           if(SystemSetting::where('key', 'smtp_crypto')->get()->count()> 0){
                SystemSetting::where('key', 'smtp_crypto')->update(['key' => 'smtp_crypto', 'value'=> $data['smtp_crypto']]);
            }else{
                SystemSetting::create([
                    'key' => 'smtp_crypto',
                    'value' => $data['smtp_crypto']
                ]);
            }
           if(SystemSetting::where('key', 'smtp_host')->get()->count()> 0){
                SystemSetting::where('key', 'smtp_host')->update(['key' => 'smtp_host', 'value'=> $data['smtp_host']]);
            }else{
                SystemSetting::create([
                    'key' => 'smtp_host',
                    'value' => $data['smtp_host']
                ]);
            }
           if(SystemSetting::where('key', 'smtp_port')->get()->count()> 0){
                SystemSetting::where('key', 'smtp_port')->update(['key' => 'smtp_port', 'value'=> $data['smtp_port']]);
            }else{
                SystemSetting::create([
                    'key' => 'smtp_port',
                    'value' => $data['smtp_port']
                ]);
            }
           if(SystemSetting::where('key', 'smtp_username')->get()->count()> 0){
                SystemSetting::where('key', 'smtp_username')->update(['key' => 'smtp_username', 'value'=> $data['smtp_username']]);
            }else{
                SystemSetting::create([
                    'key' => 'smtp_username',
                    'value' => $data['smtp_username']
                ]);
            }
           if(SystemSetting::where('key', 'smtp_password')->get()->count()> 0){
                SystemSetting::where('key', 'smtp_password')->update(['key' => 'smtp_password', 'value'=> $data['smtp_password']]);
            }else{
                SystemSetting::create([
                    'key' => 'smtp_password',
                    'value' => $data['smtp_password']
                ]);
            }
            Session::flash('success', get_phrase('SMTP Settings update successfully!'));
            return redirect()->back();


    }



}
