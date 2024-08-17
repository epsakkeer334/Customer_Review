@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Customer Reviews</h1>
    <a href="{{ route('reviews.create') }}" class="btn btn-primary">Add New Review</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Review Text</th>
                <th>Rating</th>
                <th>Sentiment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>
                <td>{{ $review->customer_name }}</td>
                <td>{{ $review->review_text }}</td>
                <td>{{ $review->rating }}</td>
                <td>{{ $review->sentiment }}</td>
                <td>
                    <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
