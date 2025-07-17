@extends('layout')

@section('title', 'Urls')

@section('content')
    <div class="bg-zinc-200 w-[50%] min-w-[300px] p-2 rounded shadow-md flex flex-col">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold">
                Links
            </h2>

            <div class="flex gap-2">
                <a href="{{ route('account') }}" class="text-sm text-zinc-200 bg-blue-500 p-1 mb-1 rounded">
                    Account
                </a>
                <section id="create-link"></section>
            </div>
        </div>

        @if ($urls->total() <= 0)
            <p class="p-5 bg-zinc-300">
                No Url found. Create one.
            </p>
        @else
            <table class="w-full" border="1" style="border: 1;">
                <thead>
                    <tr>
                        <td>
                            link
                        </td>

                        <td>
                            Short link
                        </td>

                        <td>
                            clicks
                        </td>

                        <td>
                            Created
                        </td>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($urls as $url)
                        <tr>
                            @php
                                $short_url = route('url.redirect', ['short_code' => $url->short_code]);
                            @endphp

                            <td>
                                <a class="text-sm text-blue-500" target="_blank" href="{{ $url->original_url }}">
                                    {{ Str::limit($url->original_url, 25) }}
                                </a>
                            </td>
                            
                            <td>
                                <a class="text-sm text-blue-500" target="_blank" href="{{ $short_url }}">
                                   {{ Str::limit($short_url, 20) }}
                                </a>
                            </td>

                            <td>{{ $url->click_count }}</td>

                            <td>{{ $url->created_at->diffForHumans() }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $urls->links() }}
        @endif
    </div>
@endsection