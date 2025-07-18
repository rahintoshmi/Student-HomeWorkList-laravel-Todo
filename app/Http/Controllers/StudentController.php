<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    function student()
    {
        return view('Student');
    }
    function info(){
        $infos = Student::orderBy('status','ASC')->latest()->paginate(3);
        return view('Student',compact('infos'));
    }
    function store(StudentRequest $request, $id = null)
    {
        try{
             //store data
        $msg = $id ? 'Information Updated Successfully!' : 'Information Added Successfully!';
        Student::updateOrCreate([
            'id' => $id,
        ],$request->all());
         return to_route('info')->with('msg', $this->getMsg($msg));
        }
        catch(Exception $e){
            return to_route('info')->with('msg', $this->getErrorMsg());
        }
    }
    private function getMsg($msg='success',$type='success'){
        return [
            'type' => $type,
            'res' => $msg
        ];
    }
    private function getErrorMsg(){
        return [
            'type' =>'error',
            'res' => $msg ?? 'Something went wrong! Please try again.' 
        ];
    }
    function delete($id)
    {
        try {
            Student::findOrFail($id)->delete();
            // return to_route('info')->with('msg', $this->getMsg('Information Deleted Successfully!'));
            return redirect()->back()->with('msg', $this->getMsg('Information Deleted successfully!'));
        } catch (Exception $e) {
            return to_route('info')->with('msg',  $this->getErrorMsg());
        }
    }
    function edit($id)
    {
        try {
            $infos = Student::findOrFail($id);
            return view('Edit', compact('infos'));
        } catch (Exception $e) {
            return to_route('info')->with('msg', $this->getErrorMsg());
        }
    }
    function status($id){
        try{
           $info = Student::findOrFail($id);
           $info->status = $info->status == 0 ? 1 : 0; // Toggle the status
           $info->save();
        
           $status = $info->status == 0 ? 'Incomplete' : 'Completed';
           return to_route('info')->with('msg', $this->getMsg("HomeWork marked as $status!"));
        }
        catch(Exception $e){
           return to_route('info')->with('msg', $this->getErrorMsg());
        }
    }
}
