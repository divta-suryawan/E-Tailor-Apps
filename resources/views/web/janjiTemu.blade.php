<x-template>
  <x-navbar/>

  <x-container>
    <div class="lg:px-40 xl:px-80">
      <div class="font-bold text-xl mb-8">Jadwalkan pertemuan anda</div>
      <div class="mb-4">
        <div>Nama anda</div>
        <input type="text" id="nama" class="border w-full p-2 rounded-sm focus:outline-tailor-100">
      </div>
  
      <div class="mb-4">
        <div>Nomor telepon / whatsapp</div>
        <input type="text" id="phone" class="border w-full p-2 rounded-sm focus:outline-tailor-100">
      </div>
  
      <div class="mb-4">
        <div>Tanggal ketemu</div>
        <input type="date" id="tanggal" class="border w-full p-2 rounded-sm focus:outline-tailor-100">
      </div>

      <div class="flex justify-end w-full">
        <button class="bg-tailor-100 hover:bg-tailor-200 text-white py-2 px-4 rounded-md duration-150" id="btnJanjiTemu">Buat janji temu</button>
      </div>

    </div>

  </x-container>
</x-template>

<script src="{{ asset('assets/sweetalert/script.js')}}"></script>
<script>
  const btnJanjiTemu = document.getElementById('btnJanjiTemu')
  const nama = document.getElementById('nama')
  const phone = document.getElementById('phone')
  const tanggal = document.getElementById('tanggal')
  const pathSegmentsPac = location.pathname.split('/');

  btnJanjiTemu.addEventListener('click', () => {
    $.ajax({
    type: "post",
    url: `{{ url('api/v1/booking/create') }}`,
    dataType: "json",
    data: {
      customer_name: nama.value,
      phone_number: phone.value,
      appointment_date: tanggal.value,
      id_package: pathSegmentsPac[2]
    },
    success: function(response) {
      if (response.code === 422) {
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: 'Terjadi kesalahan!'
        })
      } else {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil Booking!',
          text: 'Anda telah melakukan janji ketemu pada '+ tanggal.value 
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = '/';
          }
        });
      }

    },
    error: function(error) {
      Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: 'Terjadi kesalahan!'
      })
    }
  })
  })

</script>