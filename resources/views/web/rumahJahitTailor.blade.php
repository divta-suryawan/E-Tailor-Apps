<x-template>
  <x-navbar/>

  <x-container>
    <div class="w-full text-center" id="loading">Loading...</div>
  </x-container>

  <div id="allContent" class="hidden">
    <x-container>
      <div class="flex justify-between items-center" id="profileTailor"></div>
    </x-container>
  
    <hr>
  
    <x-container>
      <p id="description"></p>
    </x-container>
  
    <x-container>
      <div class="text-xl font-semibold mb-4">Paket yang ditawarkan</div>
      <div class="grid grid-cols-4 gap-4" id="containerPaket"></div>
    </x-container>
  </div>

  <x-container id="dataNotFound" class="hidden">
    <h1 class="w-full text-center text-xl font-semibold">Rumah Jahit tidak ditemukan</h1>
  </x-container>

</x-template>

<script>
  const path = location.pathname
  const pathSegments = path.split('/');
  $.ajax({
    type: "get",
    url: `{{ url('api/v1/tailor/get/${pathSegments[2]}') }}`,
    dataType: "json",
    success: function(response) {
      $(document).ready(function() {

        $("#loading").addClass('hidden')
        response.code === 404 ? $('#dataNotFound').removeClass('hidden') : $("#allContent").removeClass('hidden')

        const item = response.data
        // empty container element
        $("#profileTailor").empty();
        $("#description").empty();
        const classBtn = 'bg-tailor-100 hover:bg-tailor-200 text-white py-1 px-4 rounded-md duration-150 text-center text-xs sm:text-base'

        var html = /*html*/`
          <div class="flex flex-row items-center gap-4">
            <img src="/uploads/tailor/${item.tailor_img}" alt="" class="w-14 h-14 sm:w-32 sm:h-32 object-cover rounded-full">
            <div>
              <h1 class="text-xl sm:text-3xl font-semibold">${item.tailor_name}</h1>
              <div class="mt-1 sm:mt-4">
                <div>${item.address}</div>
                <div>${item.phone}</div>
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-2">
            <a href="#" class="${classBtn}">Hubungi</a>
            <a href="/rumah-jahit/${item.id}/janji-temu" class="${classBtn}">Janji Temu</a>
          </div>
        `;

        // add element to container
        $("#profileTailor").append(html);
        $("#description").append(item.description)
      });

    },
    error: function() {
      console.log("Failed to get data from the server");
    }
  });
</script>