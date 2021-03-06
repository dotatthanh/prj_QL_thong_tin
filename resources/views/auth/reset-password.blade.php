{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}


<x-app-layout>
    @section('content')
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-soft-primary">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary"> Thay ?????i m???t kh???u</h5>
                                            <p>Thay ?????i m???t kh???u b???i Skote.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ asset('images/profile-img.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <a href="index.html">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ asset('images/logo.svg') }}" alt="" class="rounded-circle" height="67">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="p-2">
                                    <div class="alert alert-success text-center mb-4" role="alert">
                                        Nh???p Email c???a b???n v?? h?????ng d???n s??? ???????c g???i cho b???n!
                                    </div>
                                    
                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <!-- Password Reset Token -->
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Nh???p email" name="email" value="{{ old('email', $request->email) }}" required>
                                            {!! $errors->first('email', '<span class="error">:message</span>') !!}        
                                        </div>

                                        <div class="form-group">
                                            <label for="password">M???t kh???u</label>
                                            <input type="password" class="form-control" id="password" placeholder="Nh???p m???t kh???u" required autocomplete="new-password" name="password">
                                            {!! $errors->first('password', '<span class="error">:message</span>') !!}
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation">X??c nh???n m???t kh???u</label>
                                            <input type="password" class="form-control" id="password_confirmation" placeholder="Nh???p x??c nh???n m???t kh???u" name="password_confirmation" required>  
                                            {!! $errors->first('password_confirmation', '<span class="error">:message</span>') !!}      
                                        </div>


                                        <div class="mt-4">
                                            <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Thay ?????i m???t kh???u</button>
                                        </div>
                                    </form>

                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <p>N???u b???n ???? nh??? ? <a href="{{ route('login') }}" class="font-weight-medium text-primary"> ????ng nh???p t???i ????y</a> </p>
                            <p>?? 2020 Skote. ???????c ph??t h??nh b???i <i class="mdi mdi-heart text-danger"></i> Themesbrand</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection('content')
</x-app-layout>