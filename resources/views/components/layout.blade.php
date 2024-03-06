<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Lab (Sila Pakdeewong)</title>

    @vite('resources/css/app.css')
</head>

<body>
    <nav class="p-6 bg-pink-300 text-black text-lg font-semibold flex items-center justify-between">
        <div>
            <a href="/">บุ๊คบุ๊ค</a>
        </div>
        <div class="flex items-center flex-row gap-4">
            <a href="/search">ค้นหา</a>
            <a href="/authors">ชื่อผู้แต่ง</a>
            @auth
                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <div class="flex items-center flex-row gap-4">
                        <a href="orders">รายการสั่งซื้อ</a>
                        <span class="underline">{{ auth()->user()->name }}'s Profile</span>
                        <button type="submit">ออกจากระบบ</button>
                    </div>

                </form>
            @endauth
            @guest
                <a href="/login">เข้าสู่ระบบ</a>
            @endguest
        </div>
    </nav>

    <x-flash-message />

    <main class="px-24 mt-12">
        {{ $slot }}
    </main>
</body>

</html>
