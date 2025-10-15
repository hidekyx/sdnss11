@extends('dashboard.layout.app')

@section('content')
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        {{ $detailMenu }} - {{ $subMenu }}
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <!-- BEGIN: Form Layout -->
            <div class="grid grid-cols-12 gap-6 intro-y box p-5">
                <div class="sm:col-span-4 col-span-12 border-r border-gray-200">
                    <div class="intro-x flex items-center">
                        <button class="w-10 h-10 rounded-full button text-white bg-theme-1">1</button>
                        <div class="font-medium text-base ml-3">Informasi Akun</div>
                    </div>
                    <div class="intro-x flex items-center mt-5">
                        <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200">2</button>
                        <div class="text-base text-gray-700 ml-3">Informasi Pribadi</div>
                    </div>
                    <div class="intro-x flex items-center mt-5">
                        <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200">3</button>
                        <div class="text-base text-gray-700 ml-3">Foto Profil</div>
                    </div>
                </div>
                <div class="sm:col-span-8 col-span-12">
                    <form class="validate-form" id="create-user-form" action="{{ $detailMenu == 'Tambah' ? route('dashboard-pembelajaran-guru-dan-tendik-simpan') : route('dashboard-pembelajaran-guru-dan-tendik-perbaharui', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if($detailMenu != 'Tambah')
                        @method('PUT')
                        @endif

                        @if(session('alert_type'))
                        <x-alert
                            :title="session('alert_title')"
                            :type="session('alert_type')"
                            :messages="session('alert_messages')"
                            :display="'block'" />
                        @endif

                        @if(session('errors'))
                            <x-alert :title="'Validasi Gagal!'" :type="'danger'" :messages="[]" :display="'block'" />
                        @endif

                        <div id="informasi-akun-section">
                            <h2 class="intro-x text-lg font-medium mb-5 pb-1 border-b border-gray-200">Informasi Akun</h2>
                            <div class="grid grid-cols-12 gap-6">
                                <div class="col-span-12 md:col-span-6 intro-x">
                                    <label for="role_id">Role</label>
                                    <div class="mt-2">
                                        <select id="role_id" name="role_id" data-placeholder="Pilih Role" class="select2 w-full" required>
                                            @foreach($kategoriRole as $kr)
                                            <option value="{{ $kr->id }}" {{ isset($user) && $user->role->id == $kr->id ? 'selected' : '' }}>{{ $kr->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 intro-x">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" type="email" class="input w-full border mt-2" placeholder="Input Email" value="{{ $user->email ?? '' }}" required>
                                </div>
                                <div class="col-span-12 md:col-span-6 intro-x">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" type="password" class="input w-full border mt-2" placeholder="Input Password" minlength="8" {{ isset($user) && $user->password ? 'value=".$user->password." disabled' : 'required' }}>
                                </div>
                                <div class="col-span-12 md:col-span-6 intro-x">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="input w-full border mt-2" placeholder="Input Konfirmasi Password" minlength="8" {{ isset($user) && $user->password ? 'value=".$user->password." disabled' : 'required' }}>
                                    <label id="password_confirmation_error" class="error" style="display: none !important;">Password tidak sama.</label>
                                </div>
                            </div>
                        </div>

                        <div id="informasi-pribadi-section">
                            <h2 class="intro-x text-lg font-medium mb-5 pb-1 border-b border-gray-200">Informasi Pribadi</h2>
                            <div class="grid grid-cols-12 gap-6 mt-3">
                                <div class="col-span-12 md:col-span-6 intro-x">
                                    <label for="name">Nama Lengkap</label>
                                    <input id="name" name="name" type="text" class="input w-full border mt-2" placeholder="Input Nama Lengkap" value="{{ $user->name ?? '' }}" required>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-3 intro-x">
                                    <label for="nip">NIP</label>
                                    <input id="nip" name="nip" type="number" class="input w-full border mt-2" placeholder="Input NIP" minlength="10" maxlength="20" value="{{ $user->nip ?? '' }}" required>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-3 intro-x">
                                    <label for="nrk">NRK</label>
                                    <input id="nrk" name="nrk" type="number" class="input w-full border mt-2" placeholder="Input NRK" minlength="6" maxlength="10" value="{{ $user->nrk ?? '' }}" required>
                                </div>
                                <div class="col-span-12 md:col-span-6 intro-x">
                                    <label for="no_hp">No HP</label>
                                    <input id="no_hp" name="no_hp" type="text" class="input w-full border mt-2" placeholder="Input No HP" value="{{ $user->no_hp ?? '' }}" required>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-3 intro-x">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input id="tempat_lahir" name="tempat_lahir" type="text" class="input w-full border mt-2" placeholder="Input Tempat Lahir" value="{{ $user->tempat_lahir ?? '' }}" required>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-3 intro-x">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input id="tanggal_lahir" name="tanggal_lahir" type="date" class="input w-full border mt-2" placeholder="Input Tanggal Lahir" value="{{ $user->tanggal_lahir ?? '' }}" required>
                                </div>
                                <div class="col-span-12 intro-x">
                                    <label for="alamat">Alamat</label>
                                    <textarea id="alamat" name="alamat" class="input w-full border mt-2" placeholder="Input Alamat" rows="4" required>{{ $user->alamat ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div id="foto-profil-section">
                            <h2 class="intro-x text-lg font-medium mb-5 pb-1 border-b border-gray-200">Foto Profil</h2>
                            <div class="grid grid-cols-12 gap-6 mt-3">
                                <div class="col-span-12 intro-x">
                                    <div class="border border-gray-200 rounded-md p-5">
                                        <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                            @if(isset($user) && $user->avatar && Storage::disk('public')->exists('images/avatar/' . $user->avatar))
                                            <img id="foto-preview" class="rounded-md" alt="Foto Profil" src="{{ asset('storage/images/avatar/'.$user->avatar) }}">
                                            @else
                                            <img id="foto-preview" class="rounded-md" alt="Foto Profil" src="{{ asset('assets/dashboard/images/profile-11.jpg') }}">
                                            @endif
                                            <div title="Hapus Foto?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div>
                                        </div>
                                        <div class="w-40 mx-auto cursor-pointer relative mt-5">
                                            <button type="button" class="button w-full bg-theme-1 text-white">Upload Foto</button>
                                            <input id="foto-input" name="avatar" type="file" accept=".png, .jpg, .jpeg" class="w-full h-full top-0 left-0 absolute opacity-0" {{ isset($user) && $user->avatar ? '' : 'required'}}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-5">
                            <button type="button" class="button w-24 border bg-gray-200 text-gray-600 mr-1 back-btn">Kembali</button>
                            <button type="button" class="button w-24 bg-theme-1 text-white opacity-50 next-btn cursor-not-allowed" disabled>Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let currentStep = 1;

        $("#informasi-pribadi-section, #foto-profil-section").hide();

        function updateSteps() {
            $("#informasi-akun-section, #informasi-pribadi-section, #foto-profil-section").hide();

            if (currentStep === 1) $("#informasi-akun-section").show();
            if (currentStep === 2) $("#informasi-pribadi-section").show();
            if (currentStep === 3) $("#foto-profil-section").show();

            $(".intro-x button").each(function(index) {
                let step = index + 1;
                if (step === currentStep) {
                    $(this).removeClass("bg-gray-200 text-gray-600").addClass("bg-theme-1 text-white");
                } else {
                    $(this).removeClass("bg-theme-1 text-white").addClass("bg-gray-200 text-gray-600");
                }
            });

            if (currentStep === 3) {
                $(".next-btn").text("Simpan").attr("type", "submit");;
            } else {
                $(".next-btn").text("Selanjutnya").attr("type", "button");;
            }

            updateNextButtonState();
        }


        function validateCurrentStep() {
            let isValid = true;
            let currentSection = $("#informasi-akun-section, #informasi-pribadi-section, #foto-profil-section").filter(":visible");

            currentSection.find("input[required], select[required], textarea[required]").each(function() {
                let value = $(this).val();
                let minLength = $(this).attr("minlength");
                let maxLength = $(this).attr("maxlength");

                // ✅ Empty check
                if (!value) {
                    isValid = false;
                    markInvalid($(this));
                    return; // skip other checks for this field
                }

                // ✅ Min length check
                if (minLength && value.length < parseInt(minLength)) {
                    isValid = false;
                    markInvalid($(this));
                    return;
                }

                // ✅ Max length check
                if (maxLength && value.length > parseInt(maxLength)) {
                    isValid = false;
                    markInvalid($(this));
                    return;
                }

                // ✅ Passed all checks
                markValid($(this));
            });

            // ✅ Password match check (Step 1)
            if (currentStep === 1) {
                let pw = $("#password").val();
                let pwConf = $("#password_confirmation").val();

                if (pw !== pwConf || !pwConf) {
                    isValid = false;
                    $("#password, #password_confirmation")
                        .addClass("border-red-500")
                        .removeClass("border-green-500");

                    $("#password_confirmation_error").show();
                    $("#password_confirmation_success").hide();
                } else {
                    $("#password, #password_confirmation")
                        .addClass("border-green-500")
                        .removeClass("border-red-500");

                    $("#password_confirmation_error").hide();
                    $("#password_confirmation_success").show();
                }
            }

            return isValid;
        }

        function markInvalid(el) {
            el.addClass("border-red-500").removeClass("border-green-500");
        }

        function markValid(el) {
            el.addClass("border-green-500").removeClass("border-red-500");
        }

        // Apply to all required fields immediately on input/change
        $("input[required], select[required], textarea[required]").on("input change", function() {
            if (!$(this).val()) {
                $(this)
                    .addClass("border-red-500")
                    .removeClass("border-green-500");
            } else {
                $(this)
                    .addClass("border-green-500")
                    .removeClass("border-red-500");
            }
        });

        $("#password, #password_confirmation").on("keyup", function() {
            let pw = $("#password").val();
            let pwConf = $("#password_confirmation").val();

            if (pwConf && pw !== pwConf) {
                $("#password_confirmation_error").show();
                $("#password_confirmation_success").hide();
                $("#password_confirmation")
                    .addClass("border-red-500")
                    .removeClass("border-green-500");
            } else if (pwConf && pw === pwConf) {
                $("#password_confirmation_success").show();
                $("#password_confirmation_error").hide();
                $("#password_confirmation")
                    .addClass("border-green-500")
                    .removeClass("border-red-500");
            } else {
                $("#password_confirmation_error, #password_confirmation_success").hide();
                $("#password_confirmation").removeClass("border-red-500 border-green-500");
            }
        });

        function updateNextButtonState() {
            let isValid = true;
            let currentSection = $("#informasi-akun-section, #informasi-pribadi-section, #foto-profil-section").filter(":visible");

            currentSection.find("input[required], select[required], textarea[required]").each(function() {
                if (!$(this).val()) {
                    isValid = false;
                }
            });

            // Special rule for Step 1 (password match)
            if (currentStep === 1) {
                let pw = $("#password").val();
                let pwConf = $("#password_confirmation").val();
                if (pw !== pwConf || !pwConf) {
                    isValid = false;
                }
            }

            // Toggle button state
            if (isValid) {
                $(".next-btn").prop("disabled", false).removeClass("opacity-50 cursor-not-allowed");
            } else {
                $(".next-btn").prop("disabled", true).addClass("opacity-50 cursor-not-allowed");
            }
        }

        $("input[required], select[required], textarea[required]").on("input change", function() {
            updateNextButtonState();
        });

        // Also validate password live
        $("#password, #password_confirmation").on("keyup", function() {
            updateNextButtonState();
        });


        $(".next-btn").on("click", function() {
            if (currentStep < 3) {
                if (!validateCurrentStep()) {
                    return;
                }
                currentStep++;
                updateSteps();
            } else {
                if (!validateCurrentStep()) {
                    return;
                }
                $("#create-user-form").submit();
            }
        });

        $(".back-btn").on("click", function() {
            if (currentStep > 1) {
                currentStep--;
                updateSteps();
            }
        });

        $("#foto-input").on("change", function(event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#foto-preview").attr("src", e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        updateSteps();
    });
</script>

@endpush