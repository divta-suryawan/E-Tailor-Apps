<x-template>
  <x-navbar/>

  <x-container>
    <div class="lg:px-40 xl:px-80">
      <div class="font-bold text-xl">Ajukan bergabung</div>
      <div class="mb-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit non aut ad, laboriosam dolore eius doloremque voluptatem consequuntur suscipit hic.</div>
      
      <div class="mb-4">
        <div>Nama anda</div>
        <input type="text" class="border w-full p-2 rounded-sm focus:outline-tailor-100">
      </div>
  
      <div class="mb-4">
        <div>Email anda*</div>
        <input type="email" class="border w-full p-2 rounded-sm focus:outline-tailor-100">
      </div>

      <div class="mb-4">
        <div>Subjek</div>
        <input type="text" class="border w-full p-2 rounded-sm focus:outline-tailor-100">
      </div>
  
      <div class="mb-4">
        <div>Pesan anda</div>
        <textarea rows="4" class="border w-full p-2 rounded-sm focus:outline-tailor-100"></textarea>
      </div>

      <div class="flex justify-end w-full">
        <button class="bg-tailor-100 hover:bg-tailor-200 text-white py-2 px-4 rounded-md duration-150">Kirim</button>
      </div>

    </div>

  </x-container>

  <x-footer class="mt-8" />
</x-template>