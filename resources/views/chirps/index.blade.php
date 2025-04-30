<x-app-layout>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <form action="{{ route('chirps.store') }}"
              method="POST">
            @csrf

            <textarea name="message"
                      id="message"
                      rows="3"
                      class="block w-full p-4
                      border-gray-300
                      focus:border-indigo-300
                      focus:ring focus:ring-indigo-200
                      rounded-md shadow-sm shadow-orange-700/50 "
                      placeholder="{{ __("What's on your mind?") }}"
            >{{ old('message') }}</textarea>

            <x-input-error :messages="$errors->get('message')"
                           class="mt-2 text-red-500"/>

            <x-primary-button class="mt-4">
                {{ __("Chirp") }}
            </x-primary-button>

        </form>

        <article class="my-8 bg-white shadow-sm rounded-lg divide-y">
            @foreach($chirps as $chirp)

                <section class="p-6 flex space-x-2">

                    <i class="fa-regular fa-comment-dots fa-shake text-xl text-blue-500"
                       style="--fa-animation-duration: 2s; --fa-animation-iteration-count: 2; --fa-animation-timing:ease-in-out;"
                       aria-hidden="true"
                    ></i>

                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <h5 class="flex flex-col">
                                <span class="text-gray-600 text-sm">
                                    {{ $chirp->user->name }}
                                </span>
                                <small class="text-xs text-gray-400">
                                    {{ $chirp->created_at->format('j M Y, g:i a') }}
                                </small>
                            </h5>

                            @if($chirp->user->is(auth()->user()))

                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            Actions
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>

                                        <form method="POST"
                                              action="{{ route('chirps.destroy', $chirp) }}">
                                            @csrf
                                            @method('delete')

                                            <x-dropdown-link
                                                :href="route('chirps.destroy',$chirp)"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>

                                        </form>
                                    </x-slot>
                                </x-dropdown>


                            @endif

                            <p class="mt-4 text-lg text-gray-800">
                                {{ $chirp->message }}
                            </p>
                        </div>
                    </div>
                </section>

            @endforeach
        </article>
    </div>

</x-app-layout>
