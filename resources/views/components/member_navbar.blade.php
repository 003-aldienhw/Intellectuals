<?php 
    $current_page = basename($_SERVER['PHP_SELF']);
    $active_style = "bg-[#D9D9D9] text-[#00117E]";
    $nothing = "";
?>
<nav class="fixed bg-[#00117E] h-full w-55 text-center shadow-xl/50 z-1000">
    <h1 class="font-display text-3xl m-5">Intellctuals</h1>

    <div class="flex flex-col w-full mt-20">
        <a href="/anggota/beranda" class="flex text-lg h-20 items-center justify-center <?= $current_page == 'beranda' ? $active_style : $nothing ?>">Beranda</a>
        <a href="/anggota/history" class="flex text-lg h-20 items-center justify-center <?= $current_page == 'history' ? $active_style : $nothing ?>">History</a>
        <a href="/anggota/pengembalian" class="flex text-lg h-20 items-center justify-center <?= $current_page == 'pengembalian' ? $active_style : $nothing ?>">Pengembalian</a>
    </div>
</nav>
<nav class="fixed flex ml-55 items-center bg-[#00117E] p-5 h-20 shadow-xl/20 w-[calc(100%-13.75rem)]">
    <input type="text" placeholder="Cari Buku" class="absolute left-1/2 -translate-x-1/2 bg-[#D9D9D9] w-70 h-10 p-1 rounded-lg text-[#666]">
    <div class="ml-auto flex items-center gap-2">
        <h1>User</h1>
        <a href="/anggota/profil">
            <img src="{{ asset('images/download-removebg-preview.png') }}" alt="ProfileIcon" width="80">
        </a>
    </div>
</nav>