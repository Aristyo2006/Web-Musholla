<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Profile Picture -->
        <div class="flex items-center gap-8 p-8 bg-emerald-50 dark:bg-white/5 border border-emerald-100 dark:border-white/10 rounded-[3rem] shadow-2xl shadow-emerald-950/5 dark:shadow-black/20 transition-all duration-500">
            <div class="relative group">
                <div class="w-28 h-28 rounded-full overflow-hidden border-4 border-white dark:border-emerald-500/30 shadow-2xl bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center text-emerald-700 dark:text-white text-4xl font-black transition-all group-hover:border-emerald-400 duration-500">
                    @if($user->profile_picture)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($user->profile_picture) }}" alt="Avatar" class="w-full h-full object-cover">
                    @else
                        {{ substr($user->name, 0, 1) }}
                    @endif
                </div>
                <div class="absolute inset-0 bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
            </div>
            <div class="flex-1">
                <x-input-label for="profile_picture" :value="__('Foto Profil')" class="text-zinc-500 dark:text-white font-black mb-2 uppercase tracking-[0.2em] text-[10px] transition-colors duration-500" />
                <input id="profile_picture" name="profile_picture" type="file" class="mt-1 block w-full text-sm text-zinc-400 dark:text-emerald-300/60 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-emerald-600 dark:file:bg-emerald-500/10 file:text-white dark:file:text-emerald-400 hover:file:bg-emerald-700 dark:hover:file:bg-emerald-500/20 transition-all cursor-pointer duration-500" accept="image/*" />
                <p class="mt-3 text-[10px] text-zinc-300 dark:text-emerald-300/30 font-black uppercase tracking-wider italic transition-colors duration-500">Maks. 2MB (PNG, JPG, GIF)</p>
                <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
