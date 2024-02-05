<?php

namespace App\Repository;

use App\Models\Setting;
use App\Repository\SettingsRepositoryInterface;


class SettingsRepository implements SettingsRepositoryInterface{

    public function index(){
        $settings =Setting::selection()->get();

        return view('admin.settings.index',compact('settings'));

    }
    public function create(){

        return view('admin.settings.create');
        
    }
      public function edit($id){
        // return $id;
          $setting =Setting::find($id);
        return view('admin.settings.edit',compact('setting'));
        
    }
    public function update($request,$id){

        // return $request;
        try{
      $setting=  Setting::find($id);

        $data['title_ar']=$request->title_ar;
        $data['title_en']=$request->title_en;
        $data['content_ar']=$request->body_ar;
        $data['content_en']=$request->body_en;
        $data['type']=$request->type;
        
        $setting->update( $data);
       

        session()->flash('edit', trans('admin.editmsf'));
        return redirect()->route('settings.index');
        }catch(\Exception $e){
		
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
     
    }

    public function editSetting($type){
        // return $id;
          $setting =Setting::where('type',$type)->first();
        //  return $type;
        return view('admin.settings.editSetting',compact('setting','type'));
        
    }
    public function updateSetting($request,$type){

        // return $request;
    //   $setting=  Setting::where('type',$type)->first();

        // $data['title_ar']=$request->title_ar;
        // $data['title_en']=$request->title_en;
        // $data['content_ar']=$request->body_ar;
        // $data['content_en']=$request->body_en;
        // $data['type']=$request->type;
        try{
        Setting::updateOrCreate(
            ['id' => $request->id],
            [
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'content_ar' => $request->body_ar,
                'content_en' => $request->body_en,
                'type' => $request->type,
            
            ]);
       

        session()->flash('edit', trans('admin.editmsf'));
        
        return redirect()->back()->withInput();
        }catch(\Exception $e){
		
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
     
    }
    public function store($request){
        // return $request;
        try{
        $data['title_ar']=$request->title_ar;
        $data['title_en']=$request->title_en;
        $data['content_ar']=$request->body_ar;
        $data['content_en']=$request->body_en;
        $data['type']=$request->type;


        Setting::create($data);

        session()->flash('Add', trans('admin.addmsg'));
        return redirect()->route('settings.index');
        }catch(\Exception $e){
		
		return redirect()->back()->withErrors(['error' => $e->getMessage()]);
	}
        
    }
   


    private function delete(Setting $Setting)
    {
        $Setting->delete();

    }

    public function search($request)
    {
        $output = "";
        $output .='<tr>
                        <th>'.trans('settings.title').'</th>
                        <th>'.trans('settings.type').'</th>
                        <th>'.trans('settings.type').'</th>
                        <th>'.trans('admin.edit').'</th>
                        <th >'.trans('admin.delete').'</th>
                                </tr>';
         $settings = Setting::where('title_ar', 'Like', '%' . $request->search . '%')->where('title_en', 'Like', '%' . $request->search . '%')->get();
        foreach ($settings as $setting) {
            $output .= '<tr id="sid '.$setting->id.'}}">
<td> ' . '<input type="checkbox" name="properties_id[]" class="checkbox" value="'.$setting->id.'"/> ' . '</td>
<td>'.$setting->title.'</td>
                                    
<td>'.$setting->type.'</td>
 <td>
 ' . ' <a href="/properties/edit'.$setting->id . '" class="btn btn-success btn-sm">'.trans('admin.edit').'</a>' . '</td>
   <td>' . ' <a href="/DeleteProperity/' . $setting->id . '"  class="btn btn-danger btn-sm">'.trans('admin.delete').'</a>' . '</td>
</tr>';
        }
        return response($output);
    }

    public function deletesearch($id)
    {
        $setting = Setting::find($id);
        $setting->delete();
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->route('settings.index');
    }


    public function MultiDelete($request){

        $ids=$request->settings_id;

        Setting::whereIn('id', $ids)->delete();
        session()->flash('delete',trans('admin.deletemsg'));
        return redirect()->route('settings.index');
    }


}