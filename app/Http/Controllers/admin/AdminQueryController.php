<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\AffiliationRequestEmployee;
use App\Models\AffiliationRequestStudent;
use App\Models\ClassRoom;
use App\Models\Employee;
use App\Models\Master;
use App\Models\Student;
use App\Models\Teacher;

class AdminQueryController extends ResponseController
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }


    //////////// get all
    public function all_masters()
    {
        $master = Master::latest()->orderBy('id', 'desc')->with('employee')->get();

        return view('admin.master.masters')->with('data', $master);
    }

    public function all_teachers()
    {
        $teacher = Teacher::latest()->orderBy('id', 'desc')->with('employee')->get();

        return view('admin.teacher.teachers')->with('data', $teacher);
    }

    public function all_students()
    {
        $student = Student::latest()->orderBy('full_name', 'desc')->with('classRoom')->get();
        return view('admin.student.students')->with('data', $student);
    }
    ////////////

    //////show info
    public function showStudent(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required',
            ]
        );
        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }

        $student = Student::where('id', $request->id)->with('mark')->with('absence_Let_st')->with('student_Note')->get();
        if (!$student) {
            return redirect()->back()->with('faile', 'student not exists');
        }
        return view('admin.student.showStudent')->with('data', $student);
        // return view('admin.master.sss')->with('data', $student);
    }

    public function showMaster(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required',
            ]
        );
        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }
        $master = Master::where('id', $request->id)->with('employee')->with('ClassRoom')->get();
        if (!$master) {
            return redirect()->back()->with('faile', 'master not exists');
        }
        return view('admin.master.showMaster')->with('data', $master);
    }

    public function showTeacher(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required',
            ]
        );
        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }
        $teacher = Teacher::where('id', $request->id)->with('employee')->get();
        if (!$teacher) {
            return redirect()->back()->with('faile', 'teacher not exists');
        }
        return view('admin.teacher.showTeacher')->with('data', $teacher);
    }
    ///////////

    ///////////class
    public function showClass(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required',
            ]
        );

        $class = ClassRoom::where('id', $request->id)->with('master')->with('student')->with('teacher')->get();
        if (!$class) {
            return redirect()->back()->with('faile', 'class not exists');
        }

        return view('admin.class.showclass')->with('data', $class);
    }
    public function classStudents(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required',
            ]
        );
        $class = ClassRoom::where('id', $request->id)->first();
        if (!$class) {
            return redirect()->back()->with('faile', 'class room not exists');
        }
        $students = Student::where('class_room_id', $request->id)->get();
        if (!$students) {
            return redirect()->back()->with('faile', 'no student exists');
        }
        return view('admin.student.students')->with('data', $students);
    }


    public function all_classes(Request $request)
    {
        $classroom = ClassRoom::latest()->orderBy('level', 'desc')->get();

        return $this->responseData($classroom, 'succeed');
    }

    public function get_classes_bylevel(Request $request)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'level' => 'required',
            ]
        );

        if ($validate->fails()) {
            return $this->responseError($validate->errors());
        }

        $classroom = ClassRoom::where('level', '=', $request->level)->get();
        if (!$classroom) {
            return $this->responseData([], 'classroom not exists');
        }
        return $this->responseData($classroom, 'succeed');
    }

    ////////// find student by name
    public function findStudent(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'full_name' => 'required',
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }

        $student = Student::where('full_name', $request->full_name)->get();
        if (!$student) {
            return redirect()->back()->with('faile', 'didn`t found');
        }
        return view('admin.student.showStudent')->with('data', $student);
    }

    //////////find employee
    public function findEmployee(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'full_name' => 'required',
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }

        $employee = Employee::where('full_name', $request->full_name)->first();
        if (!$employee) {
            return redirect()->back()->with('faile', 'employee not exists');
        }
        if ($employee->job_type == "teacher") {
            $teacher = Teacher::where('employee_id', $employee->id)->with('employee')->get();
            return view('admin.teacher.showTeacher')->with('data', $teacher);
        } else {
            $master = Master::where('employee_id', $employee->id)->with('employee')->with('ClassRoom')->get();
            return view('admin.master.showMaster')->with('data', $master);
        }
    }

    public function affiliationEmployee(Request $request)
    {
        $data=AffiliationRequestEmployee::latest()->orderBy('id','desc')->get();
        return view('admin.affiliationRequestEmployee')->with('data', $data);
    }
    public function affiliationStudent(Request $request)
    {
        $data=AffiliationRequestStudent::latest()->orderBy('id','desc')->get();
        return view('admin.affiliationRequestStudent')->with('data', $data);
    }
}
