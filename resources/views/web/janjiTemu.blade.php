<x-template>
  <x-navbar/>

  <x-container>
    <div class="lg:px-40 xl:px-80">
      <div class="font-bold text-xl mb-8">Jadwalkan pertemuan anda</div>
      <div class="mb-4">
        <div>Nama anda</div>
        <input type="text" class="border w-full p-2 rounded-sm focus:outline-tailor-100">
      </div>
  
      <div class="mb-4">
        <div>Nomor telepon / whatsapp</div>
        <input type="text" class="border w-full p-2 rounded-sm focus:outline-tailor-100">
      </div>
  
      <div class="mb-4">
        <div>Tanggal ketemu</div>
        <input type="date" class="border w-full p-2 rounded-sm focus:outline-tailor-100">
      </div>

      <div class="flex justify-end w-full">
        <button class="bg-tailor-100 hover:bg-tailor-200 text-white py-2 px-4 rounded-md duration-150">Buat janji temu</button>
      </div>

    </div>

  </x-container>
</x-template>