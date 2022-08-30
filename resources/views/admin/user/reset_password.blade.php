@extends('layouts.admin')
@section('breadcrumb')
<div class="row">
    <x-breadcrumb_left
        :links="[
            ['name' => 'Dashboard', 'url' => '/'],
            ['name' => 'User', 'url' => '#'],
            ['name' => 'Reset Password', 'url' => '#'],
        ]"

        :title="'Reset Password'"
        :description="'Reset Password Anggota'"
    />
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Reset Password</h4>
            </div>
            <div class="card p-4">
                <p class="fs-2">*Email yang dimasukan akan membuat password direset menjadi "pramuka"</p>
                <x-input :name="'email'" :type="'email'" :label="'Email Anggota'" :col="12" :attr="['required']"/>
                <div class="mb-3 btn-group my-3 ml-4" id="confirm">
                    <button type="button" id="submit" class="btn btn-outline-primary">Reset Password</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#submit').click(function (e) {
            var email = $('#email').val();
            $.ajax({
                type: "post",
                url: @json(url('api/reset-password')),
                data: {email:email},
                success: function (response) {
                    alert(response);
                    window.location.reload();
                }
            });
        });
    </script>
@endsection
