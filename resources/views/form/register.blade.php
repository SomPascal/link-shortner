@extends('form.layout')

@section('content')
    <form 
      action="{{ route('doRegister') }}"
      method="post"
      class="bg-zinc-200 p-3 rounded w-[40%] min-w-[300px] flex flex-col gap-3 shadow-md"
    >
      @csrf

      <x-form.input 
        type="text"
        placeholder="Your name"
        name="name"
        id="id"
        label="Name"
      />

      <x-form.input 
        type="email"
        placeholder="Your email"
        name="email"
        id="email"
        label="Email"
      />

      <x-form.input 
        type="password"
        placeholder="Your password"
        name="password"
        id="password"
        label="Password"
      />

      <x-form.input 
        type="password"
        placeholder="Your password again"
        name="password_again"
        id="password_again"
        label="Password again"
      />

      <button type="submit" class="p-2 text-center bg-red-500 rounded-md text-zinc-200 cursor-pointer">
        Register
      </button>

      <p>
        Already have an account?
        <a href="{{ route('login') }}" class="text-red-500">
          Login
        </a>
      </p>
    </form>
@endsection