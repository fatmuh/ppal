@extends('../layouts/' . $layout)

@section('head')
    <title>Login - Dashboard PPAL</title>
@endsection

@section('content')
    <div @class([
        'sm:-mx-8 p-3 sm:px-8 relative h-screen lg:overflow-hidden bg-primary xl:bg-white dark:bg-darkmode-800 xl:dark:bg-darkmode-600',
        'before:hidden before:xl:block before:content-[\'\'] before:w-[57%] before:-mt-[28%] before:-mb-[16%] before:-ml-[13%] before:absolute before:inset-y-0 before:left-0 before:transform before:rotate-[-4.5deg] before:bg-primary/20 before:rounded-[100%] before:dark:bg-darkmode-400',
        'after:hidden after:xl:block after:content-[\'\'] after:w-[57%] after:-mt-[20%] after:-mb-[13%] after:-ml-[13%] after:absolute after:inset-y-0 after:left-0 after:transform after:rotate-[-4.5deg] after:bg-primary after:rounded-[100%] after:dark:bg-darkmode-700',
    ])>
        <div class="container relative z-10 sm:px-10">
            <div class="block grid-cols-2 gap-4 xl:grid">
                <!-- BEGIN: Login Info -->
                <div class="hidden min-h-screen flex-col xl:flex">
                    <div class="my-auto">
                        <img
                            class="-intro-x -mt-16 w-1/3 ml-14"
                            src="{{ asset('assets/img/logo.png') }}"
                            alt="Persatuan Purnawirawan Angkatan Laut"
                        />
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="my-10 flex h-screen py-5 xl:my-0 xl:h-auto xl:py-0">
                    <div
                        class="mx-auto my-auto w-full rounded-md bg-white px-5 py-8 shadow-md dark:bg-darkmode-600 sm:w-3/4 sm:px-8 lg:w-2/4 xl:ml-20 xl:w-auto xl:bg-transparent xl:p-0 xl:shadow-none">
                        <h2 class="intro-x text-center text-2xl font-bold xl:text-left xl:text-3xl">
                            Sign In
                        </h2>
                        <form id="login-form" method="POST" action="{{ route('auth.authentication') }}">
                            @csrf
                            <div class="intro-x mt-8">
                                <div>
                                    <x-base.form-input
                                        name="email"
                                        class="intro-x login__input block min-w-full px-4 py-3 xl:min-w-[350px]"
                                        id="email"
                                        type="text"
                                        value="admin@gmail.com"
                                        placeholder="Email"
                                    />
                                </div>
                                <div>
                                    <x-base.form-input.password
                                        name="password"
                                        class="login__input mt-4 block min-w-full px-4 py-3 xl:min-w-[350px]"
                                        id="password"
                                        type="password"
                                        value="password"
                                        placeholder="Kata Sandi"
                                    />
                                </div>
                            </div>
                            <div class="intro-x mt-4 flex text-xs text-slate-600 dark:text-slate-500 sm:text-sm">
                                {{-- <a href="" class="ml-auto">Lupa Kata Sandi?</a> --}}
                            </div>
                            <div class="intro-x mt-5 text-center xl:mt-8 xl:text-right">
                                <x-base.button
                                    class="w-full px-4 py-3 align-top xl:mr-3 xl:w-32"
                                    id="btn-login"
                                    variant="primary"
                                    type="submit"
                                >
                                    Masuk
                                </x-base.button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
    </div>
@endsection

@once
    @push('scripts')
    @endpush

    @push('validation-script')
        {!! JsValidator::formRequest('App\Http\Requests\LoginRequest', '#login-form') !!}
    @endpush
@endonce
