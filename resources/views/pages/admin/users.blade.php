@extends('layouts.app')

@section('content')
    <div>
        <div class="mb-5">
            <h2>Users</h2>
        </div>
        @foreach($users as $user)
            <div class="user-details d-flex align-items-center justify-content-between">
                <div class="d-flex user-section">
                    <div class=" d-flex align-items-center justify-content-center">
                        <p>
                            {{ $user->name }}
                        </p>
                    </div>
                    <p>
                        {{ $user->email }}
                    </p>
                </div>
                <div class="d-flex">
                    @if(is_null($user->status))
                        <form method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="reject">
                            <button type="submit" class="btn-baseGrey mr-3">Reject</button>
                        </form>
                        <form method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="accept">
                            <button type="submit" class="btn-baseDark">Accept</button>
                        </form>

                    @else
                        <button class="btn">{{ $user->status }}</button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
