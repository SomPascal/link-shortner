@extends('form.layout')

@section('title')

@section('content')
    <form 
      action="{{ route('doLogin') }}"
      method="post"
      class="bg-zinc-200 p-3 rounded w-[40%] min-w-[300px] flex flex-col gap-3 shadow-md"
    >
      @dump($errors)
      @csrf

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

      <label for="remember_me" class="cursor-pointer">
        <input type="checkbox"  alue="on" name="remember_me" id="remember_me">
        <span>Remember me</span>
      </label>

      <button type="submit" class="p-2 text-center bg-red-500 rounded-md text-zinc-200 cursor-pointer">
        Login
      </button>

      <p>
        Don't have an account yet?
        <a href="{{ route('register') }}" class="text-red-500">
          register
        </a>
      </p>
    </form>
@endsection