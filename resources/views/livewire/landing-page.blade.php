<div
    class="flex flex-col bg-indigo-900 w-full h-screen"
    x-data="{
            showSubscribeForm: @entangle('showSubscribeForm'),
            showSuccess: @entangle('showSuccess'),
        }"
>
    <nav class="flex justify-between container pt-5 mx-auto text-indigo-200">
        <a class="text-4xl font-bold" href="/">
            <x-application-logo class="w-16 h-16 fill-current"></x-application-logo>
        </a>

        <div class="flex justify-end">
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </nav>

    <div class="flex items-center container mx-auto h-full">
        <div class="flex flex-col items-start w-1/3">
            <h1 class="text-white font-bold text-5xl leading-tight mb-4">
                Simple generic landing page to subscribe
            </h1>

            <p class="text-indigo-200 text-xl mb-10">
                We are just checking the <span class="font-bold underline">TALL</span> stack.
                Would you mind subscribing?
            </p>

            <x-button
                class="py-3 px-8 bg-red-500 hover:bg-red-600"
                x-on:click="showSubscribeForm = true"
            >
                SUBSCRIBE
            </x-button>
        </div>
    </div>

    <x-modal class="bg-pink-500" trigger="showSubscribeForm">
        <p class="text-white text-5xl font-extrabold text-center">
            Let's do it!
        </p>
        <form wire:submit.prevent="subscribe" class="flex flex-col items-center p-24">
            <x-input
                wire:model="email"
                class="px-5 py-3 w-80 border border-blue-400"
                type="email" name="email" placeholder="Email address"
            />

            <span class="text-gray-100 text-xs">
                {{
                    $errors->has('email')
                    ? $errors->first('email')
                    : 'We will send you a confirmation email.'
                }}
            </span>

            <x-button class="px-5 py-3 mt-5 w-80 bg-blue-500 justify-center">
                <span class="animate-spin" wire:loading wire:target="subscribe">
                    &#9696;
                </span>

                <span wire:loading.remove wire:target="subscribe">
                    Get In
                </span>
            </x-button>
        </form>
    </x-modal>

    <x-modal class="bg-green-500" trigger="showSuccess">
        <p class="animate-pulse text-white text-9xl font-extrabold text-center">
            &check;
        </p>
        <p class="text-white text-5xl font-extrabold text-center mt-16">
            Great!
        </p>
        <p class="text-white text-3xl text-center">
            @if(request()->has('verified') && request()->get('verified') == 1)
                Thanks for confirm.
            @else
                See you in your inbox
            @endif
        </p>
    </x-modal>
</div>
