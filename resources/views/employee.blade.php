@extends('layouts.layouts')
@section('title','Employee Page')
@section('content')
<h3 class="text-center">Data Employee</h3>
<div class="pb-4">
    <a href="#" id="btn_add" class="btn btn-primary">Add New Data</a>
    <a href="/export-employee" class="btn btn-secondary">Export data To Word</a>
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

    </tbody>
</table>
<div id="testings"></div>

<!-- modal section -->
<div class="modal fade" tabindex="-1" id="modal_dialogue">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Data Employee</h5>
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
                        <button type="submit" id="submit_btn" class="btn btn-primary">Post Data</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_dialogue_update">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Data Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="form_employee_update">
                    @csrf
                    <fieldset>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id_employee" id="id_employee">
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
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email anda" disabled>
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
                        <button type="submit" id="submit_btn" class="btn btn-primary">Post Data</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modal_dialogue_delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="form_employee_delete">
                    @csrf
                    <fieldset>
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id_employee" id="id_employee_delete">
                        Kamu yakin ingin menghapus data karyawan <b><span id="employee_name">M</span></b> ?
                    </fieldset>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submit_btn_delete" class="btn btn-primary">Delete Data</button>
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