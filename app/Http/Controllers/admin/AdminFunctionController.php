<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Address;
use App\Models\Class_Teacher;
use App\Models\ClassRoom;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use App\Models\Master;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Database\DBAL\TimestampType;

class AdminFunctionController extends ResponseController
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }
    // generate Password
    public function generatePassword()
    {
        $lowercase = range('a', 'z');
        $uppercase = range('A', 'Z');
        $digits = range(0, 9);
        $special = ['#', '$'];
        $chars = array_merge($lowercase, $uppercase, $digits, $special);
        $length = env('PASSWORD_LENGTH', 8);

        do {
            $password = array();

            for ($i = 0; $i < $length; $i++) {
                $int = rand(0, count($chars) - 1);
                array_push($password, $chars[$int]);
            }
        } while (empty(array_intersect($special, $password)));

        $passwords = implode('', $password);
        return $passwords;
    }

    public function createEmployee(Request $request, $data)
    {
        $address = Address::create([
            'city' => $request->get('city'),
            'region' => $request->get('region'),
            'street' => $request->get('street'),
            'bulid_num' => $request->get('bulid_num'),
            'street' => $request->get('street'),
        ]);

        $employee = Employee::create([
            'f_name' => $request->get('f_name'),
            'm_name' => $request->get('m_name'),
            'l_name' => $request->get('l_name'),
            'full_name' => $data['fullname'],
            'birthday' => $request->get('birthday'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'job_type' => $request->get('job_type'),
            'edu_degree' => $request->get('edu_degree'),
            'start_date' => $request->get('start_date'),
            'address_id' => $address->id,
            'password' => Hash::make($data['password']),
            'active' => 1,

        ]);
        return $employee;
    }

    //////create master
    public function createMaster(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'work_time' => 'required',
                'salary' => 'required|numeric',

                'f_name' => 'required',
                'm_name' => 'required',
                'l_name' => 'required',
                'birthday' => 'required',
                'phone' => 'required|numeric',
                'job_type' => 'required',
                'edu_degree' => 'required',
                'start_date' => 'required',

                'city' => 'required',
                'region' => 'required',
                'street' => 'required',
                'bulid_num' => 'required'
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }
        $fullName = $request->f_name . " " . $request->m_name . " " . $request->l_name;

        $fullNames = [
            'full_name' => $fullName
        ];
        $validate_fullName = Validator::make(
            $fullNames,
            [
                'full_name' => 'required|unique:employees,full_name',
            ]
        );
        if ($validate_fullName->fails()) {
            return redirect()->back()->with('faile', $validate_fullName->errors());
        }

        $password = $this->generatePassword();
        $data = [
            'fullname' => $fullName,
            'password' => $password
        ];
        $employee = $this->createEmployee($request, $data);

        Master::create([
            'work_time' => $request->get('work_time'),
            'salary' => $request->get('salary'),
            'employee_id' => $employee->id,
        ]);
        return redirect()->back()->with('success', 'master created')->with('user',$data);
    }


    //updet master
    public function editeMaster(Request $request)
    {
        $master = Master::where('id', $request->id)->with('employee')->get();
        return view('admin.master.updateMaster')->with('data', $master);
    }
    public function updateMaster(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'work_time' => 'required',
                'salary' => 'required|numeric',

                'f_name' => 'required',
                'm_name' => 'required',
                'l_name' => 'required',
                'birthday' => 'required',
                'phone' => 'required|numeric',
                'job_type' => 'required',
                'edu_degree' => 'required',
                'start_date' => 'required',

                'city' => 'required',
                'region' => 'required',
                'street' => 'required',
                'bulid_num' => 'required'
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }
        $fullName = $request->f_name . " " . $request->m_name . " " . $request->l_name;

        $isfind = Master::find($request->id);
        if (!$isfind) {
            return redirect()->back()->with('faile', 'master not exists');
        }

        Master::where('id', $request->id)->first()->update([
            'work_time' => $request->get('work_time'),
            'salary' => $request->get('salary'),
        ]);

        $master = Master::where('id', $request->id)->first();

        Employee::where('id', $master->employee_id)->first()->update([
            'f_name' => $request->get('f_name'),
            'm_name' => $request->get('m_name'),
            'l_name' => $request->get('l_name'),
            'full_name' => $fullName,
            'birthday' => $request->get('birthday'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'job_type' => $request->get('job_type'),
            'edu_degree' => $request->get('edu_degree'),
            'start_date' => $request->get('start_date'),
        ]);

        $employee = Employee::where('id', $master->employee_id)->first();

        Address::where('id', $employee->address_id)->first()->update([
            'city' => $request->get('city'),
            'region' => $request->get('region'),
            'street' => $request->get('street'),
            'bulid_num' => $request->get('bulid_num'),
            'street' => $request->get('street'),
        ]);
        return redirect('all-masters')->with('success', 'updeted successfully');
    }

    //////creat teacher
    public function createTeacher(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'subject' => 'required',
                'session_price' => 'required|numeric',
                'salary' => 'required',

                'f_name' => 'required',
                'm_name' => 'required',
                'l_name' => 'required',
                'birthday' => 'required',
                'phone' => 'required|numeric',
                'job_type' => 'required',
                'edu_degree' => 'required',
                'start_date' => 'required',

                'city' => 'required',
                'region' => 'required',
                'street' => 'required',
                'bulid_num' => 'required'
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }
        $fullName = $request->f_name . " " . $request->m_name . " " . $request->l_name;

        $fullNames = [
            'full_name' => $fullName
        ];
        $validate_fullName = Validator::make(
            $fullNames,
            [
                'full_name' => 'required|unique:employees,full_name',
            ]
        );
        if ($validate_fullName->fails()) {
            return redirect()->back()->with('faile', $validate_fullName->errors());
        }

        $password = $this->generatePassword();
        $data = [
            'fullname' => $fullName,
            'password' => $password
        ];
        $employee = $this->createEmployee($request, $data);

        $teacher = Teacher::create([

            'subject' => $request->get('subject'),
            'session_price' => $request->get('session_price'),
            'salary' => $request->get('salary'),
            'employee_id' => $employee->id,
        ]);
        return redirect()->back()->with('success', 'teacher created')->with('user',$data);
    }

    //update teacher
    public function editeTeacher(Request $request)
    {
        $teacher = Teacher::where('id', $request->id)->with('employee')->get();
        return view('admin.teacher.updateTeacher')->with('data', $teacher);
        // return $this->responseData($master,'');
    }
    public function updateTeacher(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'subject' => 'required',
                'session_price' => 'required|numeric',
                'salary' => 'required',

                'f_name' => 'required',
                'm_name' => 'required',
                'l_name' => 'required',
                'birthday' => 'required',
                'phone' => 'required|numeric',
                'job_type' => 'required',
                'edu_degree' => 'required',
                'start_date' => 'required',

                'city' => 'required',
                'region' => 'required',
                'street' => 'required',
                'bulid_num' => 'required'
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }
        $fullName = $request->f_name . " " . $request->m_name . " " . $request->l_name;

        $isfind = Teacher::find($request->id);
        if (!$isfind) {
            return redirect()->back()->with('faile', 'teacher not exists');
        }
        Teacher::where('id', $request->id)->first()->update([

            'subject' => $request->get('subject'),
            'session_price' => $request->get('session_price'),
            'salary' => $request->get('salary'),
        ]);

        $teacher = Teacher::where('id', $request->id)->first();

        Employee::where('id', $teacher->employee_id)->first()->update([
            'f_name' => $request->get('f_name'),
            'm_name' => $request->get('m_name'),
            'l_name' => $request->get('l_name'),
            'full_name' => $fullName,
            'birthday' => $request->get('birthday'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'job_type' => $request->get('job_type'),
            'edu_degree' => $request->get('edu_degree'),
            'start_date' => $request->get('start_date'),
        ]);

        $employee = Employee::where('id', $teacher->employee_id)->first();

        Address::where('id', $employee->address_id)->first()->update([
            'city' => $request->get('city'),
            'region' => $request->get('region'),
            'street' => $request->get('street'),
            'bulid_num' => $request->get('bulid_num'),
            'street' => $request->get('street'),
        ]);
        return redirect('all-teachers')->with('success', 'updeted successfully');
    }


    //////create student
    public function createStudent(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'f_name' => 'required',
                'm_name' => 'required',
                'l_name' => 'required',
                'mother_name' => 'required',
                'birthday' => 'required',
                'phone' => 'required|numeric',
                'email' => 'email',
                'parent_phone' => 'required',
                'class_room_id' => 'required',

                'city' => 'required',
                'region' => 'required',
                'street' => 'required',
                'bulid_num' => 'required'
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }
        $fullName = $request->f_name . " " . $request->m_name . " " . $request->l_name;

        $fullNames = [
            'full_name' => $fullName
        ];
        $validate_fullName = Validator::make(
            $fullNames,
            [
                'full_name' => 'required|unique:students,full_name',
            ]
        );
        if ($validate_fullName->fails()) {
            return redirect()->back()->with('faile', $validate_fullName->errors());
        }

        $class = ClassRoom::find($request->class_room_id);
        if (!$class) {
            return redirect()->back()->with('faile', 'class id not exists');
        }
        $addres = Address::create([

            'city' => $request->get('city'),
            'region' => $request->get('region'),
            'street' => $request->get('street'),
            'bulid_num' => $request->get('bulid_num'),
            'street' => $request->get('street'),

        ]);

        $password = $this->generatePassword();
        $data = [
            'fullname' => $fullName,
            'password' => $password
        ];

        $student = Student::create([

            'f_name' => $request->get('f_name'),
            'm_name' => $request->get('m_name'),
            'l_name' => $request->get('l_name'),
            'full_name' => $fullName,
            'mother_name' => $request->get('mother_name'),
            'birthday' => $request->get('birthday'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'parent_phone' => $request->get('parent_phone'),
            'class_room_id' => $request->get('class_room_id'),
            'address_id' => $addres->id,
            'password' => Hash::make($password),
        ]);

        $user = student::where('id', $student->id)->get();

        return redirect()->back()->with('success', 'student created')->with('user',$data);
    }

    //update student
    public function editeStudent(Request $request)
    {
        $student = Student::find($request->id);
        return view('admin.student.updateStudent')->with('data', $student);
    }
    public function updateStudent(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'f_name' => 'required',
                'm_name' => 'required',
                'l_name' => 'required',
                'mother_name' => 'required',
                'birthday' => 'required',
                'phone' => 'required|numeric',
                'parent_phone' => 'required',
                'class_room_id' => 'required',

                'city' => 'required',
                'region' => 'required',
                'street' => 'required',
                'bulid_num' => 'required'
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }

        $isfind = Student::find($request->id);
        if (!$isfind) {
            return redirect()->back()->with('faile', 'student not exists');
        }
        $fullName = $request->f_name . " " . $request->m_name . " " . $request->l_name;
        $class = ClassRoom::find($request->class_room_id);
        if (!$class) {
            return redirect()->back()->with('faile', 'class not exists');
        }


        Student::where('id', $request->id)->first()->update([

            'f_name' => $request->get('f_name'),
            'm_name' => $request->get('m_name'),
            'l_name' => $request->get('l_name'),
            'full_name' => $fullName,
            'mother_name' => $request->get('mother_name'),
            'birthday' => $request->get('birthday'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'parent_phone' => $request->get('parent_phone'),
            'class_room_id' => $request->get('class_room_id'),
        ]);

        $student = Student::where('id', $request->id)->first();
        Address::where('id', $student->address_id)->first()->update([

            'city' => $request->get('city'),
            'region' => $request->get('region'),
            'street' => $request->get('street'),
            'bulid_num' => $request->get('bulid_num'),
            'street' => $request->get('street'),

        ]);
        return redirect('all-students')->with('success', 'updeted successfully');
    }

    // creat class room
    public function createClass(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'room_name' => 'required',
                'date' => 'required',
                'image' => 'mimes:jpg,jpeg,png,gif|max:10000',
                'master_id' => 'required',
                'level' => 'required',
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }

        $master = Master::find($request->master_id);
        if (!$master) {
            return redirect()->back()->with('faile', 'master not exists');
        }

        $class = ClassRoom::create([
            'room_name' => $request->get('room_name'),
            'date' => $request->get('date'),
            'master_id' => $request->get('master_id'),
            'level' => $request->get('level'),
        ]);

        $image = $request->image;
        if ($image) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $image);
            ClassRoom::where('id', $class->id)->first()->update([
                'image' => $image,
            ]);
        }
        return redirect()->back()->with('success', 'created success');
    }

    //delete function
    public function deleteTeacher(Request $request)
    {
        $validate = Validator::make($request->all(), ['id' => 'required',]);

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }
        $teacher = Teacher::where('id', '=', $request->id)->first();
        if (!$teacher) {
            return redirect()->back()->with('faile', 'teacher not exists');
        }
        $employee = Employee::where('id', $teacher->employee_id)->first();
        $teacher->delete();
        $employee->delete();

        return redirect()->route('all-teachers')->with('success', 'deleted successfully');
    }

    public function deleteMaster(Request $request)
    {
        $validate = Validator::make($request->all(), ['id' => 'required',]);

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }
        $master = Master::where('id', '=', $request->id)->first();
        if (!$master) {
            return redirect()->back()->with('faile', 'master not exists');
        }
        $employee = Employee::where('id', $master->employee_id)->first();
        $master->delete();
        $employee->delete();
        return redirect()->route('all-masters')->with('success', 'deleted successfully');
    }

    public function deleteStudent(Request $request)
    {
        $validate = Validator::make($request->all(), ['id' => 'required',]);

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }

        $student = Student::where('id', '=', $request->id)->first();
        if (!$student) {
            return redirect()->back()->with('faile', 'student not exists');
        }

        $student->delete();
        return redirect()->route('all-students')->with('success', 'deleted successfully');
    }
    public function deleteClass(Request $request)
    {
        $validate = Validator::make($request->all(), ['id' => 'required',]);

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }
        $classe = ClassRoom::where('id', '=', $request->id)->first();
        if (!$classe) {
            return redirect()->back()->with('faile', 'class room not exists');
        }
        Student::where('class_room_id', $classe->id)->delete();
        $classe->delete();
        return redirect()->route('home')->with('success', 'deleted successfully');
    }


    /////////////add schedule to class
    public function addSchedule(Request $request)
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
        $class = ClassRoom::find($request->id);
        if (!$class) {
            return redirect()->back()->with('faile', 'class not exists');
        }
        return view('admin.class.addScheduleClass')->with('data', $class);
    }
    public function addScheduleClass(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'schedule' => 'mimes:jpg,jpeg,png,gif|required|max:10000',
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }
        $class = ClassRoom::find($request->id);
        if (!$class) {
            return redirect()->back()->with('faile', 'class not exists');
        }
        if ($class->image) {
            if (File::exists(public_path('images/' . $class->image))) {
                File::delete(public_path('images/' . $class->image));
            }
        }
        $schedule = time() . '.' . $request->schedule->extension();
        $request->schedule->move(public_path('images'), $schedule);
        ClassRoom::where('id', $class->id)->first()->update([
            'image' => $schedule,
        ]);
        return redirect('home')->with('success', 'adding success');
    }

    //////////////add teacher to class
    public function addTeacher(Request $request)
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
        $class = ClassRoom::find($request->id);
        if (!$class) {
            return redirect()->back()->with('faile', 'class not exists');
        }
        $teachers=Teacher::all();
        return view('admin.class.addTeacherClass')->with('data', $class)->with('teachers',$teachers);
    }

    public function addTeacherClass(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'teacher_id' => 'required',
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }
        $class = ClassRoom::find($request->id);
        if (!$class) {
            return redirect()->back()->with('faile', 'class not exists');
        }
        $teacher = Teacher::find($request->teacher_id);
        if (!$teacher) {
            return redirect()->back()->with('faile', 'teacher not exists');
        }
         Class_Teacher::create([
            'class_room_id' => $request->get('id'),
            'teacher_id' => $request->get('teacher_id'),

        ]);
        return redirect('home')->with('success', 'adding success');
    }


    //change password
    public function changeEmployeePassword(Request $request)
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

        $employee = Employee::find($request->id);
        if (!$employee) {
            return redirect()->back()->with('faile', 'employee not exists');
        }

        $password = $this->generatePassword();
        Employee::where('id', $request->id)->first()->update([
            'password' => Hash::make($password),
        ]);
        return redirect()->back()->with('password', $password);
    }
    public function changeStudentPassword(Request $request)
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

        $student = Student::find($request->id);
        if (!$student) {
            return redirect()->back()->with('faile', 'employee not exists');
        }

        $password = $this->generatePassword();
        Student::where('id', $request->id)->first()->update([
            'password' => Hash::make($password),
        ]);
        return redirect()->back()->with('password', $password);
    }

    /////add scheduule for a teacher
    public function addTeacherSchedule(Request $request)
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
        $teacher = Teacher::find($request->id);
        if (!$teacher) {
            return redirect()->back()->with('faile', 'teacher not exists');
        }
        return view('admin.teacher.addScheduleTeacher')->with('data', $teacher);
    }

    public function addScheduleteacher(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'schedule' => 'mimes:jpg,jpeg,png,gif|required|max:10000',
            ]
        );

        if ($validate->fails()) {
            return redirect()->back()->with('faile', $validate->errors());
        }
        $teacher = Teacher::find($request->id);
        if (!$teacher) {
            return redirect()->back()->with('faile', 'teacher not exists');
        }
        if ($teacher->image) {
            if (File::exists(public_path('images/' . $teacher->image))) {
                File::delete(public_path('images/' . $teacher->image));
            }
        }
        $schedule = time() . '.' . $request->schedule->extension();
        $request->schedule->move(public_path('images'), $schedule);
        Teacher::where('id', $teacher->id)->first()->update([
            'image' => $schedule,
        ]);
        return redirect(url()->previous())->with('success', 'adding success');
    }

    //ending service
    public function endService(Request $request)
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
        $isfind = Employee::find($request->id);
        if (!$isfind) {
            return redirect()->back()->with('faile', 'not exists');
        }
        Employee::where('id', $request->id)->first()->update([
            'active' => 0,
            'end_date' => now(),

        ]);

        return redirect()->back()->with('success', 'the employee is out off service now');
    }
}
