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
        <input type="text" id="nama" class="border w-full p-2 rounded-sm focus:outline-tailor-100">
      </div>
  
      <div class="mb-4">
        <div>Email anda</div>
        <input type="email" id="email" class="border w-full p-2 rounded-sm focus:outline-tailor-100">
      </div>

      <div class="mb-4">
        <div>Subjek</div>
        <input type="text" id="subjek" value="Ajuan bergabung" disabled class="border w-full p-2 rounded-sm focus:outline-tailor-100 disabled:bg-gray-200">
      </div>
  
      <div class="mb-4">
        <div>Pesan anda</div>
        <textarea rows="4" id="pesan" class="border w-full p-2 rounded-sm focus:outline-tailor-100">Saya ingin bergabung menjadi penjahit di E Tailor App</textarea>
      </div>

      <div class="flex justify-end w-full">
        <button id="kirim" class="bg-tailor-100 hover:bg-tailor-200 text-white py-2 px-4 rounded-md duration-150">Kirim</button>
      </div>

    </div>

  </x-container>

  <x-footer class="mt-8" />
</x-template>

<script src="{{ asset('assets/sweetalert/script.js')}}"></script>
<script>
  const nama = document.getElementById('nama')
  const email = document.getElementById('email')
  const subjek = document.getElementById('subjek')
  const pesan = document.getElementById('pesan')
  const kirim = document.getElementById('kirim')

  kirim.addEventListener('click', () => {
    if (nama.value && email.value && pesan.value) {
      window.open(`https://wa.me/+6283133118728?text=halo kak, saya ${nama.value} dengan email ${email.value}, ${pesan.value}`, '_blank')
    } else {
      Swal.fire({
        icon: 'warning',
        title: 'Peringatan!',
        text: 'nama, email, dan pesan tidak boleh kosong'
      })
    }
  })

</script>