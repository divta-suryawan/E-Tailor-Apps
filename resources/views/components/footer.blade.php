<div class="bg-gray-800 text-white {{$class ?? ''}}">
  {{-- flex flex-col justify-center gap-8 sm:flex-row sm:justify-between --}}
  <x-container class="pb-32 sm:pb-12 grid grid-cols-1 sm:grid-cols-3 gap-4">
    <div class="flex justify-center sm:justify-start items-start">
      <div class="flex flex-row sm:flex-col md:flex-row gap-2 items-center w-fit">
        <img src="{{ asset('assets/images/logo-e-tailor.svg') }}" alt="" class="w-12 h-12">
        <div class="font-bold text-xl">E Tailor App</div>
      </div>
      {{-- <div class="text-sm mt-4">Lorem ipsum dolor sit amet</div> --}}
    </div>
  
    <div class="text-center">
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ex porro magni minus quod, soluta ipsum</p>
    </div>
  
    <div class="text-center sm:text-end">
      <div class="text-lg font-semibold mb-1">Quick Nav</div>
      <div class="flex flex-col sm:justify-end text-sm">
        <a href="/app" class="hover:underline">Beranda</a>
        <a href="/app/rumah-jahit" class="hover:underline">Rumah Jahit</a>
        <a href="/app/tentang-kami" class="hover:underline">Tentang Kami</a>
        <a href="/app/bergabung" class="hover:underline">Bergabung</a>
      </div>
    </div>
  </x-container>
</div>