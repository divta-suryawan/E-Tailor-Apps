<x-template>
  <x-navbar/>

  <x-container>
    <div class="lg:px-40 xl:px-80">
      <div class="font-bold text-xl">Ajukan bergabung</div>
      <div class="mb-8">
        Temukan peluang baru. Segera daftar untuk menjadi penjahit di platform kami dan mulai menjalani perjalanan jahit Anda.
      </div>
      
      <div class="mb-4">
        <div>Nama anda</div>
        <input type="text" class="border w-full p-2 rounded-sm focus:outline-tailor-100">
      </div>
  
      <div class="mb-4">
        <div>Email anda</div>
        <input type="email" class="border w-full p-2 rounded-sm focus:outline-tailor-100">
      </div>

      <div class="mb-4">
        <div>Subjek</div>
        <input type="text" value="Ajuan bergabung" disabled class="border w-full p-2 rounded-sm focus:outline-tailor-100 disabled:bg-gray-200">
      </div>
  
      <div class="mb-4">
        <div>Pesan anda</div>
        <textarea rows="4" class="border w-full p-2 rounded-sm focus:outline-tailor-100">Saya ingin bergabung menjadi penjahit di E Tailor App</textarea>
      </div>

      <div class="flex justify-end w-full">
        <button class="bg-tailor-100 hover:bg-tailor-200 text-white py-2 px-4 rounded-md duration-150">Kirim</button>
      </div>

    </div>

  </x-container>

  <x-footer class="mt-8" />
</x-template>