@extends('layout')

@section('title', 'Account')

@section('content')
    @php
        $user = auth()->user();
    @endphp

    <div class="bg-zinc-200 rounded-md p-2 w-[30%] min-w-[300px] flex flex-col">
        <div class="flex flex-row justify-between items-center">
            <h2 class="text-xl font-bold">
                Account
            </h2>

            <div class="flex items-center gap-2 mb-1">
                <a href="{{ route('url.list') }}" class="p-1 rounded-md bg-blue-500 text-sm text-zinc-200 inline-block">
                    My Links
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-1 text-sm bg-zinc-400 rounded cursor-pointer">
                        logout
                    </button>
                </form>
            </div>

        </div>
        <hr>

        <p>
            <b>Name: </b> {{ Str::limit($user->name, 255) }}
        </p>

        <p>
            <b>Email: </b> {{ Str::limit($user->email, 255) }}
        </p>

        <p>
            <b>Joined At: </b> {{ Str::limit($user->created_at, 255) }}
        </p>
    </div>
@endsection