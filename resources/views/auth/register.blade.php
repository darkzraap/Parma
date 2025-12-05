<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Parma</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>

<body>

    <div class="flex flex-col items-center px-6 py-10 min-h-dvh">
        <img src="{{ asset('assets/svgs/logo.svg') }}" class="mb-[53px]" alt="">

        <form action="{{ route('register') }}" method="POST"
            class="mx-auto max-w-[345px] w-full p-6 bg-white rounded-3xl mt-auto">

            @csrf

            <div class="flex flex-col gap-5">
                <p class="text-[22px] font-bold">
                    New Account
                </p>

                <!-- Full Name -->
                <div class="flex flex-col gap-2.5">
                    <label for="fullname" class="text-base font-semibold">Full Name</label>
                    <input
                        style="background-image: url('{{ asset('assets/svgs/ic-profile.svg') }}')"
                        type="text"
                        name="name"
                        id="fullname"
                        class="form-input"
                        placeholder="Write your full name"
                        required>
                </div>

                <!-- Email Address -->
                <div class="flex flex-col gap-2.5">
                    <label for="email" class="text-base font-semibold">Email Address</label>
                    <input
                        style="background-image: url('{{ asset('assets/svgs/ic-email.svg') }}')"
                        type="email"
                        name="email"
                        id="email"
                        class="form-input"
                        placeholder="Your email address"
                        required>
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-2.5">
                    <label for="password" class="text-base font-semibold">Password</label>
                    <input
                        style="background-image: url('{{ asset('assets/svgs/ic-lock.svg') }}')"
                        type="password"
                        name="password"
                        id="password"
                        class="form-input"
                        placeholder="Protect your password"
                        required>
                </div>

                <!-- Confirm Password -->
                <div class="flex flex-col gap-2.5">
                    <label for="password_confirmation" class="text-base font-semibold">Confirm Password</label>
                    <input
                        style="background-image: url('{{ asset('assets/svgs/ic-lock.svg') }}')"
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-input"
                        placeholder="Repeat your password"
                        required>
                </div>

                <button type="submit"
                    class="inline-flex text-white font-bold text-base bg-primary rounded-full whitespace-nowrap px-[30px] py-3 justify-center items-center">
                    Create My Account
                </button>
            </div>
        </form>

        <a href="{{ route('login') }}" class="font-semibold text-base mt-[30px] underline">
            Sign In to My Account
        </a>
    </div>

</body>

</html>
