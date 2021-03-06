<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Student;
use App\Subject;
use App\Course;
use App\Batch;
use App\Group;
use App\Inquire;
use App\Education;
use App\Township;
use Rabbit;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
   /* public function __construct($value='')
    {
        $this->middleware('role:Admin')->except('store','search_inquire');
    }*/
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $courses = Course::all();
      $batches = Batch::all();

      $bid = 0;

      if (request('batch')) {
        $bid = request('batch');
        $groups = Group::where('batch_id',$bid)->get();
        $students = Student::where('batch_id',$bid)->get();

        return view('students.index',compact('students','courses','batches','groups','bid'));
      }else{
        $students = Student::all();
        // Return 
        return view('students.index',compact('students','courses','batches','bid'));
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $subjects = Subject::all();
      $courses = Course::all();
      $batches = Batch::all();

      return view('students.create',compact('subjects','courses','batches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //$redirect_back = redirect()->back()->getTargetUrl();

      // dd($redirect_back->withInput(Input::flash()));

      // Validation
      $request->validate([
        "namee" => 'required|min:5|max:191',
        "namem" => 'required|min:5|max:191',
        "degree" => 'required',
        "city" => 'required',
        "accepted_year" => 'required',
        "address" => 'required',
        "email" => 'unique:students',
        "phone" => 'required|max:12',
        "dob" => 'required',
        "gender" => 'required',
        // "subjects" => '',
        "p1" => 'required',
        "p1_rs" => 'required',
        "p1_phone" => 'required',
        "p2" => 'required',
        "p2_rs" => 'required',
        "p2_phone" => 'required',
        "because" => 'required'
      ]);
        $inquireno = request('inquireno');
        // Save Data

        $user = User::firstOrNew(['email' =>  request('email'), 'name' => request('namee') ]);

        dd($user);

        $user = new User;
        $user->name = request('namee');
        $user->email=request('email');
        $user->password=Hash::make("123456789");
        $user->save();

        $user->assignRole('Student');
        $id = $user->id;

        $township = Township::find(request('city'));

        $townshipid = $township->id;
        $city = $township->city->name;

        $student = new Student;
        $student->inquire_no =request('inquireno');
        $student->namee = request('namee');
        $student->namem = Rabbit::zg2uni(request('namem')); ;
        $student->email = request('email');
        $student->phone = request('phone');
        $student->address = request('address');
        $student->degree = request('degree');
        $student->city = $city;
        $student->accepted_year = request('accepted_year');
        $student->dob = request('dob');
        $student->gender = request('gender');
        $student->p1 = request('p1');
        $student->p1_phone = request('p1_phone');
        $student->p1_relationship = request('p1_rs');
        $student->p2 = request('p2');
        $student->p2_phone = request('p2_phone');
        $student->p2_relationship = request('p2_rs');
        $student->because = request('because');
        $student->status = 'Active';
        $student->batch_id = request('batch_id');
        $student->township_id = $townshipid;
        $student->user_id = $id;
        $student->save();



        $subjects = request('subjects');

        // Save student_subject
        $student->subjects()->detach();
        $student->subjects()->attach($subjects);


        return 'ok';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $student = Student::find($id);
      return view('students.show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student == null) {
            Student::withTrashed()->find($id)->restore();
        }else{
            $student->delete();
        }
        // Return
        return redirect()->route('students.index');
    }

  
}
