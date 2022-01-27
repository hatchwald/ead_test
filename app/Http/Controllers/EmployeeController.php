<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee');
    }

    public function GetAll()
    {
        $data = Employee::all();
        $datas = ['data' => $data];
        return response()->json($datas, 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = $request->validate([
                'foto_profil' => 'required|image|max:1999',
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'nomor_hp' => 'required|integer',
                'email' => 'required|unique:employee',
                'current_salary' => 'required|integer',
            ]);

            $original_filename = $request->file('foto_profil')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload_foto_profil/';
            $image = 'U-' . time() . '.' . $file_ext;

            if ($request->file('foto_profil')->move($destination_path, $image)) {
                $image = 'upload_foto_profil/' . $image;
                $datas = ['message' => 'success', 'data' => $image];
            } else {
                $response = ['message' => 'Error at upload image', 'original_code' => 500];
                return response()->json($response, 500);
            }

            $data = Employee::create(
                [
                    'nama' => $request->nama,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'nomor_hp' => $request->nomor_hp,
                    'email' => $request->email,
                    'current_salary' => $request->current_salary,
                    'foto_profil' => $image,
                ]
            );

            return response()->json(['message' => 'success created data', 'original_code' => 200, 'data' => $data], 200);
        } catch (\Throwable $th) {
            if (isset($image)) {
                $dir_img = "./" . $image;
                if (file_exists($dir_img)) {
                    unlink($dir_img);
                }
            }
            return response()->json(['message' => $th->getMessage(), 'original_code' => $th->getCode()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        try {
            $validator = $request->validate([
                'foto_profil' => 'required|image|max:1999',
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'nomor_hp' => 'required|integer',
                'current_salary' => 'required|integer',
            ]);

            $employee = Employee::find($id);
            $prev_img = "./" . $employee->foto_profil;
            if (file_exists($prev_img)) {
                unlink($prev_img);
            }

            $original_filename = $request->file('foto_profil')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload_foto_profil/';
            $image = 'U-' . time() . '.' . $file_ext;

            if ($request->file('foto_profil')->move($destination_path, $image)) {
                $image = 'upload_foto_profil/' . $image;
                $datas = ['message' => 'success', 'data' => $image];
            } else {
                $response = ['message' => 'Error at upload image', 'original_code' => 500];
                return response()->json($response, 500);
            }

            $employee->foto_profil = $image;
            $employee->nama = $request->nama;
            $employee->jenis_kelamin = $request->jenis_kelamin;
            $employee->nomor_hp = $request->nomor_hp;
            $employee->current_salary - $request->current_salary;
            $employee->save();

            return response()->json(['message' => 'success updated data', 'original_code' => 200, 'data' => $employee], 200);
        } catch (\Throwable $th) {
            if (isset($image)) {
                $dir_img = "./" . $image;
                if (file_exists($dir_img)) {
                    unlink($dir_img);
                }
            }
            return response()->json(['message' => $th->getMessage(), 'original_code' => $th->getCode()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::find($id);
            $prev_img = "./" . $employee->foto_profil;
            if (file_exists($prev_img)) {
                unlink($prev_img);
            }
            $employee->delete();
            return response()->json(['message' => 'success delete data', 'original_code' => 200, 'data' => $employee], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'original_code' => $th->getCode()], 500);
        }
    }

    public function DataExport()
    {
        $data = Employee::all();
        return view('export-employee', ['data' => $data]);
    }
}
