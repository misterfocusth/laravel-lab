@php
    $colors = [
        'bg-red-300',
        'bg-blue-300',
        'bg-green-300',
        'bg-yellow-300',
        'bg-pink-300',
        'bg-purple-300',
        'bg-indigo-300',
    ];
@endphp

<x-layout>
    <div>
        <h1 class="text-3xl font-bold">หนังสือขายดี</h1>
    </div>
    <div class="grid grid-cols-3 gap-16 mt-12">
        @unless ($books->isEmpty())
            @foreach ($books as $book)
                <div class="flex flex-col items-center justify-center">
                    <div class="{{ $colors[array_rand($colors)] }} w-40 h-52 flex flex-col items-center justify-center">
                        BOOK
                    </div>
                    <h2 class="font-bold mt-2">{{ $book->title }}</h2>
                    <p>{{ $book->author->name }}</p>
                    <p>{{ $book->price }} บาท</p>
                </div>
            @endforeach
        @else
            <p>ไม่มีข้อมูลหนังสือ</p>
        @endunless
    </div>
</x-layout>
