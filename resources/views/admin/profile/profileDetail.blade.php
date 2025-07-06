@extends('layout.main')
@php
$isGoogleLogin = !is_null($user->media_id);
@endphp

<!-- Body main section starts --> @section('content') <main>
    <div class="container-fluid">
        <!-- Breadcrumb start -->
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">Games</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="#" class="f-s-14 f-w-500">
                            <span>
                                <i class="ph-duotone  ph-stack f-s-16"></i> Beranda
                            </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb end -->
        <!-- setting-app start -->

        <div class="row">
            <div class="col-lg-4 col-xxl-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="vertical-tab setting-tab">
                            <ul class="nav nav-tabs app-tabs-primary " id="v-bg" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile-tab-pane" type="button" role="tab"
                                        aria-controls="profile-tab-pane" aria-selected="true">
                                        <i class="ph-bold  ph-user-circle-gear pe-2"></i> Personal Info </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="security-tab" data-bs-toggle="tab"
                                        data-bs-target="#security-tab-pane" type="button" role="tab"
                                        aria-controls="security-tab-pane" aria-selected="false">
                                        <i class="ph-bold  ph-shield-check pe-2"></i>Security </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-8 col-xxl-9">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="profile-tab-pane" role="tabpanel"
                        aria-labelledby="profile-tab" tabindex="0">
                        <div class="card setting-profile-tab">
                            <div class="card-header">
                                <h5>Profile</h5>
                            </div>
                            <div class="card-body">
                                <div class="profile-tab profile-container">
                                    <div class="image-details">
                                        <div class="profile-image"></div>
                                        <div class="profile-pic">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg">
                                                    <label for="imageUpload">
                                                        <i class="ti ti-photo-heart"></i>
                                                    </label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imgPreview"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="person-details">
                                        <h5 class="f-w-600">
                                            {{ $user->name ?? 'Nama Pengguna' }}
                                            <img width="20" height="20"
                                                src="{{ asset('assets/images/profile-app/01.png') }}" alt="verified">
                                        </h5>
                                        <p>
                                            {{ $user->userData->bio ?? 'Tulis deskripsi singkat' }}
                                        </p>
                                    </div>

                                    <form id="profile-form" class="app-form">
                                        @csrf
                                        <h5 class="mb-2 text-dark f-w-600">User Info</h5>
                                        <div class="row">
                                            {{-- Username --}}
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="name"
                                                        value="{{ $user->name ?? '' }}" placeholder="Nama lengkap">
                                                </div>
                                            </div>

                                            {{-- Handphone --}}
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">No Handphone</label>
                                                    <input type="text" class="form-control" name="handphone"
                                                        value="{{ $user->userData->handphone ?? '' }}"
                                                        placeholder="08xxxxxxxxxx">
                                                </div>
                                            </div>

                                            {{-- Alamat --}}
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Alamat</label>
                                                    <textarea class="form-control" name="alamat"
                                                        placeholder="Alamat lengkap">{{ $user->userData->alamat ?? '' }}</textarea>
                                                </div>
                                            </div>

                                            {{-- Bio --}}
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Bio</label>
                                                    <textarea class="form-control" name="bio"
                                                        placeholder="Deskripsi singkat">{{ $user->userData->bio ?? '' }}</textarea>
                                                </div>
                                            </div>

                                            {{-- Submit --}}
                                            <div class="col-12">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="security-tab-pane" role="tabpanel" aria-labelledby="security-tab"
                        tabindex="0">
                        {{-- Google Card --}}
                        <div class="card">
                            <div class="card-body">
                                <div class="row security-box-card align-items-center">
                                    <div class="col-md-3 position-relative">
                                        <span>
                                            <img src="{{ asset('assets/images/setting-app/google.png') }}" alt=""
                                                class="w-35 h-35 anti-code">
                                        </span>
                                        <p class="security-box-title text-dark f-w-500 f-s-16 ms-5 security-code">
                                            Authentication</p>
                                    </div>
                                    <div class="col-md-6 security-discription">
                                        <p class="text-secondary f-s-16">
                                            Authentication is connected through Google.
                                        </p>
                                        <span class="badge text-light-secondary p-2">
                                            @if($user->media_id)
                                            <i class="ph-fill ph-check-circle me-1 text-success"></i> Connected via
                                            Google
                                            @else
                                            <i class="ph-fill ph-x-circle me-1 text-danger"></i> Local Account
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-md-3 text-end">
                                        @if($user->media_id)
                                        <button type="button" class="btn btn-success" disabled>Connected</button>
                                        @else
                                        <button type="button" class="btn btn-outline-secondary"
                                            disabled>Unavailable</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Password Card --}}
                        <form id="security-form">
                            @csrf
                            <div class="card security-card-content">
                                <div class="card-body">
                                    <div class="account-security mb-2">
                                        <div class="row align-items-center">
                                            <div class="col-sm-9">
                                                <h5 class="text-primary f-w-600">Change Password</h5>
                                                <p class="account-discription text-secondary f-s-16 mt-3">
                                                    Untuk mengganti password, aktifkan opsi di bawah dan isi kolom yang
                                                    diperlukan. Password baru harus minimal 8 karakter serta mengandung
                                                    huruf besar, kecil, angka dan simbol.
                                                </p>
                                            </div>
                                            <div class="col-sm-3 account-security-img">
                                                <img src="{{ asset('assets/images/setting-app/password.jpg') }}" alt=""
                                                    class="w-150">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Form Keamanan --}}
                                    <form id="security-form">
                                        @csrf

                                        {{-- Email --}}
                                        <div class="mb-3">
                                            <label class="form-label">Email address</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $user->email }}" placeholder="Email"
                                                {{ $isGoogleLogin ? 'readonly disabled' : '' }}>

                                        </div>

                                        {{-- Checkbox: Ganti Password --}}
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="changePasswordCheckbox"
                                                {{ $isGoogleLogin ? 'disabled' : '' }}>
                                            <label class="form-check-label" for="changePasswordCheckbox">Ganti
                                                Password</label>
                                        </div>

                                        {{-- Bagian Password --}}
                                        <div id="passwordFields" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-label">Password Saat Ini</label>
                                                <input type="password" name="current_password" class="form-control"
                                                    placeholder="Password lama" {{ $isGoogleLogin ? 'disabled' : '' }}>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Password Baru</label>
                                                <input type="password" name="new_password" class="form-control"
                                                    placeholder="Password baru" {{ $isGoogleLogin ? 'disabled' : '' }}>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Konfirmasi Password</label>
                                                <input type="password" name="new_password_confirmation"
                                                    class="form-control" placeholder="Ulangi password baru"
                                                    {{ $isGoogleLogin ? 'disabled' : '' }}>
                                            </div>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary"
                                                {{ $isGoogleLogin ? 'disabled' : '' }}>Simpan</button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--setting app end -->
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('changePasswordCheckbox');
        const passwordFields = document.getElementById('passwordFields');

        checkbox.addEventListener('change', function () {
            passwordFields.style.display = this.checked ? 'block' : 'none';

            // Optional: Bersihkan field saat checkbox di-uncheck
            if (!this.checked) {
                passwordFields.querySelectorAll('input').forEach(el => el.value = '');
            }
        });
    });

</script>
<script>
    function showToast(type, message) {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = `alert alert-${type}`;
        toast.innerText = message;
        toast.style.minWidth = '250px';
        toast.style.marginTop = '0.5rem';
        container.appendChild(toast);
        setTimeout(() => toast.remove(), 4000);
    }

    function showAlert(type, message) {
        const container = document.getElementById('alert-container');
        container.innerHTML = `
        <div class="alert alert-${type}">
            ${message}
        </div>
    `;
        setTimeout(() => container.innerHTML = '', 5000);
    }
  </script>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        // Form Profil
        document.querySelector('#profile-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);

            // Hapus error sebelumnya
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            form.querySelectorAll('.error-feedback').forEach(el => el.remove());

            fetch("{{ route('admin_detail_update', ['id' => $user->id]) }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.errors) {
                        Object.entries(data.errors).forEach(([field, messages]) => {
                            const input = form.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('is-invalid');
                                const div = document.createElement('div');
                                div.className = 'text-danger error-feedback';
                                div.innerText = messages[0];
                                input.parentNode.appendChild(div);
                            }
                        });
                        showToast('danger', 'Terdapat kesalahan input profil.');
                    } else if (data.error) {
                        showToast('danger', data.error);
                        showAlert('danger', data.error);
                    } else if (data.reload) {
                        location.reload();
                    }

                })
                .catch(() => {
                    showToast('danger', 'Gagal memperbarui profil.');
                    showAlert('danger', 'Gagal memperbarui profil.');
                });
        });

        // Form Security
        document.querySelector('#security-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);

            // Reset error sebelumnya
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            form.querySelectorAll('.error-feedback').forEach(el => el.remove());
            const isGoogleLogin = {{ $user-> media_id ? 'true' : 'false'}};

            if (isGoogleLogin) {
                showToast('danger', 'Akun Google tidak dapat mengubah email atau password.');
                return;
            }

            fetch("{{ route('admin_security_update', ['id' => $user->id]) }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.errors) {
                        Object.entries(data.errors).forEach(([field, messages]) => {
                            const input = form.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('is-invalid');

                                const existing = input.parentNode.querySelector(
                                    '.error-feedback');
                                if (existing) existing.remove();

                                const div = document.createElement('div');
                                div.className = 'text-danger error-feedback';
                                div.innerText = messages[0];
                                input.parentNode.appendChild(div);
                            }
                        });

                        showToast('danger', 'Terdapat kesalahan dalam form keamanan.');
                    } else if (data.error) {
                        showToast('danger', data.error);
                    } else if (data.reload) {
                        location.reload();
                    } else {
                        showToast('success', data.message || 'Keamanan akun berhasil diperbarui');
                    }
                })
                .catch(() => {
                    showToast('danger', 'Terjadi kesalahan saat memperbarui keamanan.');
                });
        });


    });

</script>



@endsection
