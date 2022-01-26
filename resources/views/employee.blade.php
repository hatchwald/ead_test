@extends('layouts.layouts')
@section('content')
<h3 class="text-center">Data Employee</h3>
<div class="float-end">
    <a href="#" id="btn_add" class="btn btn-primary">Add New Data</a>
</div>
<table class="table" id="table_employee">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Nomor HP</th>
            <th scope="col">Email</th>
            <th scope="col">Salary</th>
            <th scope="col">Foto Profil</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $value)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$value->nama}}</td>
            <td>{{$value->jenis_kelamin}}</td>
            <td>{{$value->nomor_hp}}</td>
            <td>{{$value->email}}</td>
            <td>{{$value->current_salary}}</td>
            <td><img src="./{{$value->foto_profil}}" class="img-tables" alt=""></td>
            <td><a href="#" class="btn btn-warning">Update</a> <a href="#" class="btn btn-danger">Delete</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<div id="testings"></div>

<!-- modal section -->
<div class="modal fade" tabindex="-1" id="modal_dialogue">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="form_employee">
                    @csrf
                    <fieldset>
                        <div class="mb-3">
                            <label for="" class="form-label">
                                Nama
                            </label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama anda" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">
                                Jenis Kelamin
                            </label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                <option value=""></option>
                                <option value="laki-laki">laki-laki</option>
                                <option value="perempuan">perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">
                                Nomor HP/Telf
                            </label>
                            <input type="text" id="nomor_hp" name="nomor_hp" class="form-control" placeholder="Nomor Telf/Hp" required>
                        </div>
                        <div class="mb-3">
                            <label for="">
                                Email
                            </label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email anda" required>
                        </div>
                        <div class="mb-3">
                            <label for="">
                                Salary
                            </label>
                            <input type="text" id="current_salary" name="current_salary" class="form-control" placeholder="Current Salary" required>
                        </div>
                        <div class="mb-3">
                            <label for="">
                                Foto Profile
                            </label>
                            <input type="file" id="foto_profil" name="foto_profil" class="form-control" required>
                        </div>
                    </fieldset>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submit_btn" class="btn btn-primary">Send Comment</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Toast -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 5">
    <div id="toast_notif" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class=" toast-header">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">

        </div>
    </div>
</div>
@endsection