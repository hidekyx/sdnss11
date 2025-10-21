@extends('dashboard.layout.app')

@section('autentikasi')
<div class="authincation vh-100 h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <img src="{{ asset('images/layout/logo-sekolah.png') }}" style="max-width: 100px;">
                                </div>
                                <h4 class="text-center mb-4">Login ke dalam Dashboard SDN SS11</h4>
                                <form action="{{ route('login-attempt') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="mb-1 form-label">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Masukkan email anda" required>
                                    </div>
                                    <div class="mb-4 position-relative">
                                        <label class="mb-1 form-label">Password</label>
                                        <input type="password" name="password" id="dz-password" class="form-control" placeholder="Masukkan password anda" required>
                                        <span class="show-pass eye">
                                            <i class="fa fa-eye-slash"></i>
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>

                                    @if(session('alert_type'))
                                    <x-alert
                                        :title="session('alert_title')"
                                        :type="session('alert_type')"
                                        :icon="session('alert_icon')"
                                        :messages="session('alert_messages')"
                                        :display="'block'" />
                                    @endif

                                    @if(session('errors'))
                                    <x-alert :title="'Validasi Gagal!'" :type="'danger'" :icon="'mdi-alert'" :messages="[]" :display="'block'" />
                                    @endif

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Log In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush