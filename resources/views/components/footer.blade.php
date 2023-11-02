<div class="bg-gray-800 text-white {{$class ?? ''}}">
  <x-container class="pb-32 sm:pb-12 grid grid-cols-1 sm:grid-cols-3 gap-4">

    <div class="sm:pr-8 px-20 sm:px-0 text-center sm:text-start">
      <div class="flex justify-center sm:justify-start items-start">
        <div class="flex flex-row sm:flex-col md:flex-row gap-2 items-center w-fit">
          <img src="{{ asset('assets/images/logo-e-tailor.svg') }}" alt="" class="w-12 h-12">
          <div class="font-bold text-xl">E Tailor App</div>
        </div>
      </div>
      <div class="mt-4 text-sm">Tempat di mana kebutuhan pakaian Anda bertemu dengan kreativitas para ahli jahit.</div>
    </div>
  
    <div class="text-center ">
      <div class="text-lg font-semibold mb-1">Quick Nav</div>
      <div class="flex flex-col text-sm">
        <div>
          <a href="/" class="hover:underline">Beranda</a>
        </div>
        <div>
          <a href="/rumah-jahit" class="hover:underline">Rumah Jahit</a>
        </div>
        <div>
          <a href="/tentang-kami" class="hover:underline">Tentang Kami</a>
        </div>
        <div>
          <a href="/bergabung" class="hover:underline">Bergabung</a>
        </div>
      </div>
    </div>

    <div class="text-center sm:text-end">
      <div class="text-lg font-semibold mb-1">Hubungi Kami</div>
      <div class="flex flex-col sm:justify-end text-sm">
        <div>WhatsApp: 0877 2222 1111</div>
        <div>Lokasi: Kota Palu</div>
      </div>
    </div>

  </x-container>
</div>